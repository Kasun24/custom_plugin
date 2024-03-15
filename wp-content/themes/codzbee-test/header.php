<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'codzbee-test'); ?></a>

		<header id="masthead" class="site-header bg-dark py-3">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-3">
						<?php
						the_custom_logo();
						if (is_front_page() && is_home()) :
						?>
							<h1 class="site-title text-light"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
						<?php
						else :
						?>
							<p class="site-title text-light"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
						<?php
						endif;
						$codzbee_test_description = get_bloginfo('description', 'display');
						if ($codzbee_test_description || is_customize_preview()) :
						?>
							<p class="site-description text-light"><?php echo $codzbee_test_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
																		?></p>
						<?php endif; ?>
					</div><!-- .col-lg-3 -->

					<div class="col-lg-9">
						<nav id="site-navigation" class="main-navigation navbar navbar-expand-lg navbar-dark">
							<div class="container-fluid">
								<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
									<span class="navbar-toggler-icon"></span>
								</button>
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'menu-1',
										'menu_id'        => 'primary-menu',
										'container'      => 'div',
										'container_id'   => 'navbarNav',
										'container_class'=> 'collapse navbar-collapse',
										'menu_class'     => 'navbar-nav',
										'fallback_cb'    => '__return_false',
										'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
										'depth'          => 2,
										'walker'         => new WP_Bootstrap_Navwalker(),
									)
								);
								?>
							</div><!-- .container-fluid -->
						</nav><!-- #site-navigation -->
					</div><!-- .col-lg-9 -->
				</div><!-- .row -->
			</div><!-- .container -->
		</header><!-- #masthead -->

		<div id="content" class="site-content">
