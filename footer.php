<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Narcissus
 */
?>

	</div><!-- #content -->

</div><!-- #page -->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'narcissus_credits' ); ?>
			<a href="http://wordpress.org/" rel="generator"><?php printf( __( 'Proudly powered by %s', 'narcissus' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php 
                $myTheme = wp_get_theme();
                printf( __( 'Theme: %1$s by %2$s.', 'narcissus' ), 'Narcissus', '<a href="' . $myTheme->get( 'AuthorURI') . '" rel="designer">Zero Daedalus</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
