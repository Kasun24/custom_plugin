<?php
/*
Template Name: All Books
*/

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main container" role="main"><!-- Added container class for Bootstrap -->

        <div class="row"><!-- Start Bootstrap row -->

            <?php
            // The WordPress loop to display all books
            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();
            ?>
                    <div class="col-md-4"><!-- Use col-md-4 to display 3 books per row on medium devices -->
                        <div class="card mb-3"><!-- Use Bootstrap card component -->
                            <?php
                                if ( has_post_thumbnail() ) :
                                    echo '<img src="' . get_the_post_thumbnail_url( get_the_ID(), 'medium' ) . '" class="card-img-top" alt="' . esc_attr( get_the_title() ) . '">';
                                endif;
                            ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php the_title(); ?></h5>
                                <p class="card-text"><?php the_content(); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary">View More</a>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
            else :
                // If no books found
                get_template_part( 'template-parts/content', 'none' );
            endif;
            ?>

        </div><!-- End Bootstrap row -->

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
