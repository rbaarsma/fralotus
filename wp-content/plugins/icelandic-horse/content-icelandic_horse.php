<?php
/**
 * The template used for displaying icelandic horse content
 */
$custom = get_post_custom();
$data = unserialize($custom['data'][0]); 
$stamboom = unserialize($custom['stamboom'][0]); 

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	</header>
	<div class="entry-content row">
		<?php if (isset($data['pregnant']) && $data['pregnant']): ?>
		<div class="col-sm-5 ">
			<img src="<?php echo $data['pregnant']; ?>" class='img-responsive img-rounded'>
			<div class="">
				<strong><?php echo $stamboom['name']['m'] ?></strong>
			</div>
		</div>
		<div class="col-sm-2">
			<div style="font-family: 'Rock Salt', cursive;font-size: 100px;padding: 25px;">X</div>
		</div>
		<?php else: ?>
		<div class="col-md-7">
			<?php if (isset($data['geboortedatum']) && $data['geboortedatum']): ?>
			<dl class="dl-horizontal">
			  <dt><?php _e('Geboortedatum', 'icelandic-horse'); ?></dt>
			  <dd><?php $ts = strtotime($data['geboortedatum']); echo $ts ? strftime('%e %B  %Y', $ts) : $data['geboortedatum']; ?></dd>
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
			  <dd><?php echo $stamboom['name']['m']; ?></dd>
			</dl>
			<?php endif ;?>
			<?php if (isset($stamboom['name']['m']) && $stamboom['name']['m']): ?>
			<dl class="dl-horizontal">
			  <dt><?php _e('Vader', 'icelandic-horse'); ?></dt>
			  <dd><?php echo $stamboom['name']['f']; ?></dd>
			</dl>
			<?php endif ;?>
			<?php if (isset($data['keuringsresultaat']) && $data['keuringsresultaat']): ?>
			<dl class="dl-horizontal">
			  <dt><?php _e('Keuringsresultaat', 'icelandic-horse'); ?></dt>
			  <dd><?php echo $data['keuringsresultaat']; ?></dd>
			</dl>
			<?php endif ;?>
			<?php if (isset($data['pricecat']) && $data['pricecat']): ?>
			<dl class="dl-horizontal">
			  <dt><?php _e('Prijscategorie', 'icelandic-horse'); ?></dt>
			  <dd><?php echo $data['pricecat']; ?></dd>
			</dl>
			<?php endif ;?>
			<?php if (isset($data['studfee']) && $data['studfee']): ?>
			<dl class="dl-horizontal">
			  <dt><?php _e('Dekgeld', 'icelandic-horse'); ?></dt>
			  <dd><?php echo $data['studfee']; ?></dd>
			</dl>
			<?php endif ;?>
		</div>
		<?php endif; ?>
		<div class="col-md-5 ">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(600,400), array('class'=>'img-responsive img-rounded') ); ?></a>
			<?php if (isset($data['pregnant']) && $data['pregnant']): ?>
			<div class="">
				<strong><?php echo $stamboom['name']['f'] ?></strong>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-offset-7" style="margin-top: 10px;">
			<a href="<?php the_permalink(); ?>" class="btn btn-info"><?php echo _e("Bekijken"); ?></a>
		</div>
	</div>
	<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
