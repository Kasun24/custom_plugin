<?php

get_header(); // Include the theme header

?>

<div class="container">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <h1 class="text-center my-4"><?php the_title(); ?></h1>

            <div class="row">
                <div class="col-md-8">
                    <?php the_content(); // Displays full post content 
                    ?>
                </div>
                <div class="col-md-4">
                    <?php
                    // Retrieve genre using get_post_meta()
                    $genre = get_post_meta(get_the_ID(), 'book_genre', true);

                    // Retrieve rating using get_post_meta()
                    $rating = get_post_meta(get_the_ID(), 'book_rating', true);

                    // Retrieve publication year using get_post_meta()
                    $publication_year = get_post_meta(get_the_ID(), 'book_publication_year', true);
                    ?>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Book Details</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Genre: <?php echo $genre; ?></li>
                                <li class="list-group-item">Rating: <?php echo $rating; ?></li>
                                <li class="list-group-item">Publication Year: <?php echo $publication_year; ?></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        <?php endwhile;
    else : ?>
        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
    <?php endif; ?>

</div>

<?php get_footer(); // Include the theme footer

?>