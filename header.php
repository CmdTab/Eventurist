<!DOCTYPE html>
<html class="no-js<?php mh_html_class(); ?>" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
<?php wp_head(); ?>
<script src="https://use.typekit.net/gst3ymy.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>
</head>
<body <?php body_class(); ?>>
	<?php get_template_part('content', 'svg'); ?>
<div class="site">

		<header class="site-header">
			<img src = "<?php echo get_template_directory_uri(); ?>/images/header.png">
		</header>
		<nav class="subnav group">
			<?php wp_nav_menu( array( 'menu_class' => 'main-events','theme_location' => 'subnav' ) ); ?>
			<a href="#" class="toggle-more">
				<span class="assistive-text">Show Categories</span>
				<svg class="icon icon-down-arrow"><use xlink:href="#icon-down-arrow"></use></svg>
			</a>
			<div class="filter-drawer group">
				<div class="featured-list">
					<?php wp_nav_menu( array( 'menu_class' => 'featured-menu','theme_location' => 'featmenu' ) ); ?>
				</div>
				<div class="all-cats">
					<?php wp_nav_menu( array( 'menu_class' => 'categories group','theme_location' => 'catmenu' ) ); ?>
				</div>
			</div>
		</nav>
