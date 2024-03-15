<?php
/*
Plugin Name: Custom Book Plugin
Description: Plugin to register custom post type "Books"
*/

// Register Custom Post Type
function custom_book_post_type()
{
    $labels = array(
        'name'                  => 'Books',
        'singular_name'         => 'Book',
        'menu_name'             => 'Books',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Book',
        'edit_item'             => 'Edit Book',
        'new_item'              => 'New Book',
        'view_item'             => 'View Book',
        'view_items'            => 'View Books',
        'search_items'          => 'Search Books',
        'not_found'             => 'No books found',
        'not_found_in_trash'    => 'No books found in Trash',
        'parent_item_colon'     => 'Parent Book:',
        'all_items'             => 'All Books',
        'archives'              => 'Book Archives',
        'attributes'            => 'Book Attributes',
        'insert_into_item'      => 'Insert into book',
        'uploaded_to_this_item' => 'Uploaded to this book',
        'featured_image'        => 'Featured Image',
        'set_featured_image'    => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image'    => 'Use as featured image',
        'filter_items_list'     => 'Filter books list',
        'items_list_navigation' => 'Books list navigation',
        'items_list'            => 'Books list',
        'item_published'        => 'Book published.',
        'item_published_privately' => 'Book published privately.',
        'item_reverted_to_draft' => 'Book reverted to draft.',
        'item_scheduled'        => 'Book scheduled.',
        'item_updated'          => 'Book updated.',
    );

    $args = array(
        'label'                 => 'Book',
        'description'           => 'Books',
        'labels'                => $labels,
        'supports'              => array('title', 'author', 'editor', 'thumbnail'),
        'taxonomies'            => array(),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-book-alt',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );

    register_post_type('book', $args);
}
add_action('init', 'custom_book_post_type', 0);

// Add Metabox
function custom_book_metabox()
{
    add_meta_box(
        'custom_book_metabox',
        'Book Details',
        'custom_book_metabox_callback',
        'book',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'custom_book_metabox');

// Metabox Callback Function
function custom_book_metabox_callback($post)
{
    // Add nonce for security
    wp_nonce_field(basename(__FILE__), 'custom_book_metabox_nonce');

    // Get saved values
    $genre = get_post_meta($post->ID, 'book_genre', true);
    $rating = get_post_meta($post->ID, 'book_rating', true);
    $publication_year = get_post_meta($post->ID, 'book_publication_year', true);
    $book_author = get_post_meta($post->ID, 'book_author', true);

    // Display fields in columns
    echo '<div class="book-fields">';
    echo '<div class="book-field">';
    echo '<label for="book_genre">Genre</label>';
    echo '<select id="book_genre" name="book_genre">';
    echo '<option value="fiction"' . selected($genre, 'fiction', false) . '>Fiction</option>';
    echo '<option value="non-fiction"' . selected($genre, 'non-fiction', false) . '>Non-Fiction</option>';
    echo '<option value="novel"' . selected($genre, 'novel', false) . '>Novel</option>';
    echo '<option value="fairy-tale"' . selected($genre, 'fairy-tale', false) . '>Fairy tale</option>';
    echo '<option value="other"' . selected($genre, 'other', false) . '>Other</option>';
    echo '</select>';
    echo '</div>'; // End of book-field

    echo '<div class="book-field">';
    echo '<label for="book_rating">Rating</label>';
    echo '<input type="number" id="book_rating" name="book_rating" value="' . esc_attr($rating) . '" min="1" max="10">';
    echo '</div>'; // End of book-field

    echo '<div class="book-field">';
    echo '<label for="book_publication_year">Publication Year</label>';
    echo '<input type="text" id="book_publication_year" name="book_publication_year" value="' . esc_attr($publication_year) . '">';
    echo '</div>'; // End of book-field

    echo '<div class="book-field">';
    echo '<label for="book_author">Book Author</label>';
    echo '<input type="text" id="book_author" name="book_author" value="' . esc_attr($book_author) . '">';
    echo '</div>'; // End of book-field

    echo '</div>'; // End of book-fields

}

// Save Metabox Data
function custom_book_metabox_save($post_id)
{
    // Check nonce
    if (!isset($_POST['custom_book_metabox_nonce']) || !wp_verify_nonce($_POST['custom_book_metabox_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // Check if autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // Check permissions
    if ('book' === $_POST['post_type']) {
        if (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
    }

    // Save fields
    $fields = array('book_genre', 'book_rating', 'book_publication_year', 'book_author'); // Include 'book_author'
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'custom_book_metabox_save');

// Enqueue Stylesheet
function custom_book_enqueue_styles()
{
    // Enqueue your stylesheet
    wp_enqueue_style('custom-book-plugin-style', plugins_url('css/custom-book-plugin.css', __FILE__));
}
add_action('admin_enqueue_scripts', 'custom_book_enqueue_styles');
