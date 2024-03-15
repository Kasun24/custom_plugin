<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CodzBee_Test
 */

?>

<footer id="colophon" class="site-footer bg-light py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="site-info text-center text-lg-start">
                    <a href="<?php echo esc_url(__('https://wordpress.org/', 'codzbee-test')); ?>">
                        <?php
                        /* translators: %s: CMS name, i.e. WordPress. */
                        printf(esc_html__('Proudly powered by %s', 'codzbee-test'), 'WordPress');
                        ?>
                    </a>
                    <span class="sep"> | </span>
                    <?php
                    /* translators: 1: Theme name, 2: Theme author. */
                    printf(esc_html__('Theme: %1$s by %2$s.', 'codzbee-test'), 'codzbee-test', '<a href="http://underscores.me/">Underscores.me</a>');
                    ?>
                </div><!-- .site-info -->
            </div><!-- .col-lg-6 -->
            <div class="col-lg-6 text-center text-lg-end">
                <p>&copy; <?php echo date('Y'); ?> Your Site Name. All Rights Reserved.</p>
            </div><!-- .col-lg-6 -->
        </div><!-- .row -->
    </div><!-- .container -->
</footer><!-- #colophon -->
</div><!-- #page -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<?php wp_footer(); ?>

</body>

</html>
