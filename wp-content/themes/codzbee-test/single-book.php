<?php
get_header();

// Start the loop
if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();
?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php
                // Display book details
                echo '<p><strong>Author:</strong> ' . get_post_meta( get_the_ID(), 'book_author', true ) . '</p>';
                echo '<p><strong>Genre:</strong> ' . get_post_meta( get_the_ID(), 'book_genre', true ) . '</p>';
                echo '<p><strong>Rating:</strong> ' . get_post_meta( get_the_ID(), 'book_rating', true ) . '</p>';
                echo '<p><strong>Publication Year:</strong> ' . get_post_meta( get_the_ID(), 'book_publication_year', true ) . '</p>';
                
                // Display book content
                the_content();
                ?>
            </div><!-- .entry-content -->

        </article><!-- #post-<?php the_ID(); ?> -->

<?php
    endwhile;
else :
    // If no book found
    get_template_part( 'template-parts/content', 'none' );
endif;

get_footer();
