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
            <?php 
                $theme_options = get_option('narcissus_theme_options');
                if ( 'none' !== $theme_options['credit_link'] ) {
                    if ( 'both' == $theme_options['credit_link'] || 'wordPress' == $theme_options['credit_link']) {?>
                        <?php printf( __( 'Proudly powered by %s', 'narcissus' ), '<a href="http://wordpress.org/" rel="generator">WordPress</a>' ); ?>
                        <?php if ( 'both' == $theme_options['credit_link']) { ?>
                            <span class="sep"> | </span>
                        <?php }  
                    }
                    if ( 'both' == $theme_options['credit_link'] || 'theme' == $theme_options['credit_link']) {
                $myTheme = wp_get_theme();
                printf( __( 'Theme: %1$s by %2$s.', 'narcissus' ), 'Narcissus', '<a href="' . $myTheme->get( 'AuthorURI') . '" rel="designer">Zero Daedalus</a>' );
                    }?>
            <?php } ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
