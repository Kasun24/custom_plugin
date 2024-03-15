<?php
/*
Template Name: All Books
*/

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        // The WordPress loop to display all books
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();

                // Use template part to display each book content
                get_template_part( 'template-parts/content', 'book' );

            endwhile;
        else :
            // If no books found
            get_template_part( 'template-parts/content', 'none' );
        endif;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
