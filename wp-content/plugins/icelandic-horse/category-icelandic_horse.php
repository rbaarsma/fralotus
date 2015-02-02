<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @since 1.0.0
 */
get_header(); ?>

	<div class="container">
		<div class="row">
			<section id="primary" class="col-md-8 col-lg-9 pull-right hfeed">
				<?php
				if (is_category(3)) // veulens
				{
					$categories = get_categories(array('parent' => 3, 'order'=>'DESC'));
					foreach ($categories as $category): ?>
						<article class="sub-category" id="category-<?php echo $category->term_id ?>">
						<div class="entry-content row">
							<div class="col-sm-7">
								<h2 class="entry-title"><a href="<?php echo get_category_link($category); ?>"><?php echo $category->name ?></a></h2>
								<!--<p><?php echo __('Aantal paarden'); ?>: <?php echo $category->category_count ?></p>-->
								<a class="btn btn-primary" href="<?php echo get_category_link($category); ?>"><?php echo __('Bekijken'); ?></a>
							</div>
							<?php if (function_exists('z_taxonomy_image_url')): ?>
							<div class="col-sm-5">
								<a href="<?php echo get_category_link($category); ?>"><img class="img-responsive img-rounded" src="<?php echo z_taxonomy_image_url($category->term_id); ?>"></a>
							</div>
							<?php endif; ?>
						</div>
						</article>
						
					<?php endforeach;
					
				}
				else
				{
					
					query_posts($query_string . '&orderby=menu_order&order=ASC');

					?>
					<?php if ( have_posts() ) : ?>

						<header id="archive-header">
							<?php if ( is_author() ) echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
							<h1 class="page-title">
								<?php echo single_cat_title( '', false ); ?>
							</h1><!-- .page-title -->
							<?php
							if ( $description = term_description() )
								printf( '<h2 class="archive-meta">%s</h2>', $description );
							?>
						</header>

						<?php
						while ( have_posts() ) : the_post();

							/* Include the post format-specific template for the content. If you want to
							 * this in a child theme then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							//get_template_part( 'content', get_post_type() ?: 'icelandic_horse' );

							// checks if the file exists in the theme first,
							// otherwise serve the file from the plugin
							if ( $theme_file = locate_template( array ( 'content-icelandic_horse.php' ) ) ) {
								$template_path = $theme_file;
							} else {

								$template_path = plugin_dir_path( __FILE__ ) . '/content-icelandic_horse.php';
							}

							load_template($template_path, false);

						endwhile;

						bavotasan_pagination();
					else :
						get_template_part( 'content', 'none' );
					endif;
				}
				?>

			</section><!-- #primary.c8 -->
			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>