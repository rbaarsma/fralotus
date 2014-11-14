<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-0" class="post no-results not-found">
		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'Geen paarden hier..', 'fralotus-arcade-child' ); ?></h1>
		</header>

		<div class="entry-content">
			<p><?php _e( 'Alle paarden in deze categorie schijnen er vandoor te zijn gegaan!', 'fralotus-arcade-child' ); ?></p>
			<?php //get_search_form(); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-0 -->
