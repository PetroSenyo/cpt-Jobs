</div>
<footer>

</footer>
<a href="#" class="burger desctop_hide"><span class="burger-icon "></span></a>
<div class="mobile_menu_container desctop_hide cfx">
<nav class="mobile_nav">
	<?php
	$mobile_nav = array(
		'theme_location' => 'main_menu',
		'menu'           => '',
		'container'      => false,
		'menu_class'     => 'level_a'
	);
	wp_nav_menu( $mobile_nav );
	?>
</nav>
</div>

<?php wp_footer(); ?>
</body>
</html>