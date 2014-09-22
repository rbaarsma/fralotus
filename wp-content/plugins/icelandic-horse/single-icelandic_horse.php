<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php $data = get_post_custom(); ?>
			<?php var_dump($data); ?>
			
<dl>
  <dt><?php _e('Naam', 'icelandic-horse'); ?></dt>
  <dd><?php $data['']; ?></dd>
</dl>			
				<table>
					<?php if (isset($data['name']) && $data['name'][0]): ?>
					<tr>
						<th><?php _e( 'Naam', 'icelandic-horse' ); ?></th>
						<th><?php echo $data['name'][0] ?></th>
					</tr>
					<?php endif; ?>
				</table>


				<?php //comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>