<?php
/*
Plugin Name: Custom Books Post Type
Description: Creates a custom post type "Books" with additional metabox fields.
Version:     1.0
Author:      Kasun Sampath
License:     GPLv2 or later
*/

// Function to create the custom post type "Books"
function create_book_post_type()
{

    $labels = array(
        'name'                => _x('Books', 'Post Type General Name', 'your-textdomain'),
        'singular_name'       => _x('Book', 'Post Type Singular Name', 'your-textdomain'),
        'menu_name'           => __('Books', 'your-textdomain'),
        'parent_item_colon'   => __('Parent Book:', 'your-textdomain'),
        'all_items'           => __('All Books', 'your-textdomain'),
        'view_item'           => __('View Book', 'your-textdomain'),
        'add_new_item'        => __('Add New Book', 'your-textdomain'),
        'add_new'             => __('Add New', 'your-textdomain'),
        'edit_item'           => __('Edit Book', 'your-textdomain'),
        'update_item'         => __('Update Book', 'your-textdomain'),
        'search_items'         => __('Search Books', 'your-textdomain'),
        'not_found'           => __('No books found', 'your-textdomain'),
        'not_found_in_trash'  => __('No books found in Trash', 'your-textdomain'),
    );

    $args = array(
        'label'               => __('books', 'your-textdomain'),
        'description'         => __('Books custom post type', 'your-textdomain'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'author', 'thumbnail'), // Standard functionalities
        'public'              => true,
        'has_archive'          => true, // Allows archives for Books
        'menu_icon'           => 'dashicons-book', // Set an icon for Books menu
        'capability_type'     => 'post', // Use same capabilities as posts
        'menu_position'       => 5, // Position in admin menu (adjust as needed)
    );

    register_post_type('books', $args);
}

// Hook to register the custom post type on init
add_action('init', 'create_book_post_type');

function book_metabox()
{
    add_meta_box(
        'book_info_metabox', // Unique ID
        __('Book Information', 'your-textdomain'),
        'book_metabox_callback', // Callback function to display content
        'books', // Post type where the metabox should appear
        'normal', // Position (normal, side, or advanced)
        'high' // Priority (high, default, low)
    );
}

function book_metabox_callback($post)
{
    wp_nonce_field(basename(__FILE__), 'book_nonce'); // Security nonce

    // Get existing meta values
    $genre = get_post_meta($post->ID, 'book_genre', true);
    $rating = get_post_meta($post->ID, 'book_rating', true);
    $publication_year = get_post_meta($post->ID, 'book_publication_year', true);

    // Define predefined genres (modify as needed)
    $genres = array(
        'fiction' => 'Fiction',
        'non-fiction' => 'Non-Fiction',
        'fantasy' => 'Fantasy',
        // Add more genres as needed
    );

    echo '<label for="book_genre">Genre: </label>';
    echo '<select name="book_genre" id="book_genre">';
    foreach ($genres as $key => $value) {
        $selected = ($genre == $key) ? ' selected' : '';
        echo "<option value='$key'$selected>$value</option>";
    }
    echo '</select>';

    echo '<br><br>';

    echo '<label for="book_rating">Rating: </label>';
    echo '<input type="number" name="book_rating" id="book_rating" value="' . esc_attr($rating) . '">';

    echo '<br><br>';

    echo '<label for="book_publication_year">Publication Year: </label>';
    echo '<input type="number" name="book_publication_year" id="book_publication_year" value="' . esc_attr($publication_year) . '">';
}

// Save metabox data when the post is saved
if (isset($_POST['book_nonce']) && wp_verify_nonce($_POST['book_nonce'], basename(__FILE__))) {
    // Update genre
    $genre = sanitize_text_field($_POST['book_genre']);
    update_post_meta($post->ID, 'book_genre', $genre);

    // Update rating (ensure proper validation for numeric input)
    $rating = sanitize_text_field($_POST['book_rating']);
    update_post_meta($post->ID, 'book_rating', $rating);

    // Update publication year
    $publication_year = sanitize_text_field($_POST['book_publication_year']);
    update_post_meta($post->ID, 'book_publication_year', $publication_year);
}
