<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Narcissus
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if( !in_array( 'home', get_body_class() ) ) { ?>
        <header class="entry-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
        </header><!-- .entry-header -->
    <?php }	?>
    
        <div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'narcissus' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php edit_post_link( __( 'Edit', 'narcissus' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
