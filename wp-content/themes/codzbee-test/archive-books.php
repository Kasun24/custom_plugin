<?php

get_header(); // Include the theme header

?>

<div class="container">
  <h1 class="text-center my-4">Our Book Collection</h1>
  <div class="row">

    <?php while ( have_posts() ) : the_post(); ?>

      <div class="col-md-4 mb-4">
        <a href="<?php the_permalink(); ?>">
          <?php the_post_thumbnail( 'thumbnail', array('class' => 'img-fluid') ); ?>
        </a>
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        </div>

    <?php endwhile; ?>

  </div>
</div>

<?php get_footer(); // Include the theme footer

?>
