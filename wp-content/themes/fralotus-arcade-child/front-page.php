<?php
/**
 * The front page template.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @since 1.0.0
 */
get_header();

global $paged;
$bavotasan_theme_options = bavotasan_theme_options();

if ( 2 > $paged ) {
	// Display jumbo headline is the option is set
	if ( ! empty( $bavotasan_theme_options['jumbo_headline_title'] ) ) {
	?>
	<div class="home-top">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="home-jumbotron jumbotron">
						<h1><?php echo apply_filters( 'the_title', html_entity_decode( $bavotasan_theme_options['jumbo_headline_title'] ) ); ?></h1>
						<p class="lead"><?php echo wp_kses_post( html_entity_decode( $bavotasan_theme_options['jumbo_headline_text'] ) ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="home-page-widgets">
		<div class="container">
			<div class="row">
				<aside class="home-widget col-md-3 bavotasan_custom_text_widget">
					<a href="/category/merries"><img class="sex-icon" src="/wp-content/themes/fralotus-arcade-child/icons/sex_female.png"></a>
					<h3 class="home-widget-title"><a href="/category/merries"><?php echo __('Merries'); ?></a></h3>
					<a href="/category/merries" class="btn btn-info btn-lg"><?php echo __('Bekijken'); ?></a>
				</aside>
				<aside class="home-widget col-md-3 bavotasan_custom_text_widget">
					<a href="/category/hengsten"><img class="sex-icon" src="/wp-content/themes/fralotus-arcade-child/icons/sex_male.png"></a>
					<h3 class="home-widget-title"><a href="/category/hengsten"><?php echo __('Hengsten'); ?></a></h3>
					<a href="/category/hengsten" class="btn btn-info btn-lg"><?php echo __('Bekijken'); ?></a>
				</aside>
				<aside class="home-widget col-md-3 bavotasan_custom_text_widget">
					<a href="/category/veulens"><img class="sex-icon" src="/wp-content/themes/fralotus-arcade-child/icons/sex_male_female.png"></a>
					<h3 class="home-widget-title"><a href="/category/veulens"><?php echo __('Veulens'); ?></a></h3>
					<a href="/category/veulens" class="btn btn-info btn-lg"><?php echo __('Bekijken'); ?></a>
				</aside>
				<aside class="home-widget col-md-3 bavotasan_custom_text_widget">
					<a href="/category/veulens/<?php echo (int)date("m") < 10 ? date("Y") : date("Y", strtotime("+1 year")) ?>"><img class="sex-icon" src="/wp-content/themes/fralotus-arcade-child/icons/sex_unknown.png"></a>
					<h3 class="home-widget-title"><a href="/category/veulens/<?php echo (int)date("m") < 10 ? date("Y") : date("Y", strtotime("+1 year")) ?>"><?php echo __('Verwachting'); ?> <?php echo (int)date("m") < 10 ? date("Y") : date("Y", strtotime("+1 year")) ?></a></h3>
					<a href="/category/veulens/<?php echo (int)date("m") < 10 ? date("Y") : date("Y", strtotime("+1 year")) ?>" class="btn btn-info btn-lg"><?php echo __('Bekijken'); ?></a>
				</aside>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div id="primary" class="col-lg-12">
				<h1 style='text-align:center;'>Verkooppaarden</h1>
                <?php
				query_posts('cat=6');
				if ( have_posts() ) {
					while ( have_posts() ) : the_post();
						get_template_part( 'content', get_post_type() ?: 'icelandic_horse' );
					endwhile;

					bavotasan_pagination();
				} else {

					get_template_part( 'content', 'none' );
					
				}
				?>
			</div><!-- #primary.c8 -->
			<?php //get_sidebar(); ?>
		</div>
	</div>

<?php
	}
}
get_footer(); ?>