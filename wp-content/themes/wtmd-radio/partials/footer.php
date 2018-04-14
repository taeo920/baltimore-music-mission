<footer class="footer">
	<div class="footer__container">
		<address class="footer__copyright">&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?></address>
		
		<div class="footer__menu">
			<?php wp_nav_menu( array(
				'theme_location' => 'footer',
				'container' => false,
				'menu_class' => 'menu menu--footer'
			)); ?>
		</div>
	</div>

	<?php wp_footer(); ?>
</footer>