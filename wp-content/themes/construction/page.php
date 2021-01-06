<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WPCharming
 */
global $wpc_option;

$page_layout     = get_post_meta( $post->ID, '_wpc_page_layout', true );
$page_breadcrumb = get_post_meta( $post->ID, '_wpc_hide_breadcrumb', true );
$page_comment    = wpcharming_option('page_comments');


wpcharming_get_header() ?>

		<?php
		global $post;
		wpcharming_get_page_header($post->ID);
		wpcharming_get_page_title($post->ID);
		?>

		<?php if ( $page_breadcrumb !== 'on' ) wpcharming_breadcrumb(); ?>

		<div id="content-wrap" class="<?php echo ( $page_layout == 'full-screen' ) ? '' : 'container'; ?> <?php echo wpcharming_get_layout_class(); ?>">
			<div id="primary" class="<?php echo ( $page_layout == 'full-screen' ) ? 'content-area-full' : 'content-area'; ?>">
				<main id="main" class="site-main" role="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<div class="entry-content">

								<?php the_content(); ?>

                                <div class="clearfix"></div>
                                <?php
                                wp_link_pages(
                                    array(
                                        'before' => '<div class="page-links">' . __( 'Pages:', 'wpcharming' ),
                                        'after'  => '</div>',
                                    )
                                );
                                ?>
                                

							</div><!-- .entry-content -->

						</article><!-- #post-## -->

						<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( $page_comment == '1' ) {
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						}
						?>

					<?php endwhile; // end of the loop. ?>

				</main><!-- #main -->
			</div><!-- #primary -->

			<?php echo wpcharming_get_sidebar(); ?>

		</div> <!-- /#content-wrap -->

<?php get_footer(); ?>
