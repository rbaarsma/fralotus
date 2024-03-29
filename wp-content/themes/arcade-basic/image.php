<?php
/**
 * The template for displaying image attachments
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @since 1.0.0
 */

// Retrieve attachment metadata.
$metadata = wp_get_attachment_metadata();

get_header(); ?>

	<div class="container">
		<div class="row">
			<div id="primary" class="col-md-8 col-lg-9 pull-right hfeed">
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header>
							<?php the_title( '<h1 class="entry-title"><i class="fa fa-picture-o"></i> ', '</h1>' ); ?>

							<div class="entry-meta">

								<span class="entry-date"><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></span>
								&nbsp;&bull;&nbsp;
								<span class="full-size-link"><a href="<?php echo wp_get_attachment_url(); ?>"><?php echo $metadata['width']; ?> &times; <?php echo $metadata['height']; ?></a></span>
								&nbsp;&bull;&nbsp;
								<span class="parent-post-link"><a href="<?php echo get_permalink( $post->post_parent ); ?>" rel="gallery"><?php echo get_the_title( $post->post_parent ); ?></a></span>
							</div><!-- .entry-meta -->
						</header>

						<div class="entry-content">
							<div class="entry-attachment">
								<div class="attachment">
									<?php bavotasan_the_attached_image(); ?>
								</div><!-- .attachment -->

								<?php if ( has_excerpt() ) : ?>
								<div class="entry-caption">
									<?php the_excerpt(); ?>
								</div><!-- .entry-caption -->
								<?php endif; ?>
							</div><!-- .entry-attachment -->

							<?php the_content( '' ); ?>
						</div><!-- .entry-content -->

						<footer class="entry">
						    <?php
						    wp_link_pages( array( 'before' => '<p id="pages">' . __( 'Pages:', 'arcade' ) ) );
						    edit_post_link( __( '(edit)', 'arcade' ), '<p class="edit-link">', '</p>' );
						    ?>
						</footer><!-- .entry -->
					</article><!-- #post-## -->

					<div id="posts-pagination" class="clearfix">
						<h3 class="sr-only"><?php _e( 'Post navigation', 'arcade' ); ?></h3>
						<div class="previous pull-left"><?php previous_image_link( false, __( '&larr; Previous Image', 'arcade' ) ); ?></div>
						<div class="next pull-right"><?php next_image_link( false, __( 'Next Image &rarr;', 'arcade' ) ); ?></div>
					</div><!-- #posts-pagination -->

					<?php comments_template(); ?>

				<?php endwhile; // end of the loop. ?>
			</div><!-- #primary -->
			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>