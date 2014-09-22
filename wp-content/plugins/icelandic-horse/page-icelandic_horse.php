<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @since 1.0.0
 */
get_header();
?>

	<div class="container">
		<div class="row">
			<div id="primary" class="col-md-8 col-lg-9 pull-right hfeed">
				<?php
				while ( have_posts() ) : the_post();
					$custom = get_post_custom();
					$data = unserialize($custom['data'][0]); 
					$stamboom = unserialize($custom['stamboom'][0]); 
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1 class="entry-title">
							<?php the_title(); ?>
							<?php if (isset($data['feif']) && $data['feif']): ?>
							<small>
							  <?php echo $data['feif']; ?>
							</small>
							<?php endif ;?>
						</h1>
						<div class="row">
							<div class="col-md-6">
								<?php if (isset($data['geboortedatum']) && $data['geboortedatum']): ?>
								<dl class="dl-horizontal">
								  <dt><?php _e('Geboortedatum', 'icelandic-horse'); ?></dt>
								  <dd><?php echo $data['geboortedatum']; ?></dd>
								</dl>
								<?php endif ;?>
								<?php if (isset($data['kleur']) && $data['kleur']): ?>
								<dl class="dl-horizontal">
								  <dt><?php _e('Kleur', 'icelandic-horse'); ?></dt>
								  <dd><?php echo $data['kleur']; ?></dd>
								</dl>
								<?php endif ;?>
								
								<?php if (isset($stamboom['name']['m']) && $stamboom['name']['m']): ?>
								<dl class="dl-horizontal">
								  <dt><?php _e('Moeder', 'icelandic-horse'); ?></dt>
								  <dd><?php echo $stamboom['name']['m']; ?> <small><?php echo $stamboom['feif']['m']; ?></small></dd>
								</dl>
								<?php endif ;?>
								<?php if (isset($stamboom['name']['m']) && $stamboom['name']['m']): ?>
								<dl class="dl-horizontal">
								  <dt><?php _e('Vader', 'icelandic-horse'); ?></dt>
								  <dd><?php echo $stamboom['name']['f']; ?> <small><?php echo $stamboom['feif']['f']; ?></small></dd>
								</dl>
								<?php endif ;?>
							</div>
							<div class="col-md-6">
								<?php the_post_thumbnail( array(300,200), array('class'=>'img-responsive img-rounded') ); ?> 
								<br>
								<a href="<?php the_permalink(); ?>" class="btn btn-info"><?php echo _e("Bekijken"); ?></a>
							</div>
						</div>
						
						
					</article><!-- #post-<?php the_ID(); ?> -->

					<?php
					comments_template( '', true );
				endwhile;
				?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>