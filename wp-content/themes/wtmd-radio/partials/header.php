<header class="header">
	<div class="header__container">
		<a class="header__logo" href="<?php echo bloginfo('url'); ?>"><span class="sr-only"><?php echo bloginfo('name'); ?></span></a>

		<button class="header__toggle" aria-hidden="true" data-toggle-active="#header-nav"></button>

		<nav class="header__nav" id="header-nav">
			<div class="header__menu">
				<?php wp_nav_menu( array(
					'theme_location' => 'header',
					'container' => false,
					'menu_class' => 'menu menu--header',
					'link_after' => '<span class="menu__toggle js-sub-menu-toggle" aria-hidden="true"></span>',
					'depth' => 2
				)); ?>
			</div>

			<div class="header__brand-container">
				<div class="header__brand-header">Powered By</div>
				<a class="header__brand-logo" href="http://www.wtmd.org/radio/"><img src="<?php echo get_template_directory_uri(); ?>/images/logo-wtmd.png" alt="WTMD"></a>
			</div>
		</nav>
	</div>
</header>