<?php
/**
 * The Template for displaying all single posts.
 *
 * @since 1.0.0
 */
get_header(); 
wp_enqueue_script('jquery.fancybox.pack.js', '/wp-content/themes/fralotus-arcade-child/js/fancybox/source/jquery.fancybox.pack.js');
wp_enqueue_style('jquery.fancybox.css','/wp-content/themes/fralotus-arcade-child/js/fancybox/source/jquery.fancybox.css')

?>

	<div class="container">
		<div class="row">
			<div id="primary" class="col-md-8 col-lg-9 pull-right hfeed">
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
					<?php
					// Display a thumbnail if one exists and not on single post
					bavotasan_display_post_thumbnail();

					get_template_part( 'content', 'header' ); ?>				
					<?php while ( have_posts() ) : the_post(); ?>

						<?php 
						$custom = get_post_custom();
						$data = unserialize($custom['data'][0]); 
						$nakomelingen = unserialize($custom['nakomelingen'][0]); 
						$stamboom = unserialize($custom['stamboom'][0]); 
						$keuring = unserialize($custom['keuring'][0]); 
						$exterieur = $keuring['exterieur'];
						$verrichtingen = $keuring['verrichtingen'];
						$totaal = $keuring['totaal'];
						$fotos = unserialize($custom['gallery'][0]); 

						$firstname = current(explode(" ",$data['name']))
						?>
						<div class="row">
							<div class="col-sm-6">
								<?php if (isset($data['gender']) && $data['gender']): ?>
								<dl class="dl-horizontal">
								  <dt><?php _e('Geslacht', 'icelandic-horse'); ?></dt>
								  <dd><?php echo _e(ucfirst($data['gender'])); ?></dd>
								</dl>
								<?php endif ;?>
								<?php if (isset($data['feif']) && $data['feif']): ?>
								<dl class="dl-horizontal">
								  <dt><?php _e('FEIF Nummer', 'icelandic-horse'); ?></dt>
								  <dd><?php echo $data['feif']; ?></dd>
								</dl>
								<?php endif ;?>
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
								<?php if (isset($data['status']) && $data['status']): ?>
								<dl class="dl-horizontal">
								  <dt>&nbsp;</dt>
								  <dd><?php echo $data['status']; ?></dd>
								</dl>
								<?php endif ;?>								
								<?php if (isset($data['studfee']) && $data['studfee']): ?>
								<dl class="dl-horizontal">
								  <dt><?php _e('Dekgeld', 'icelandic-horse'); ?></dt>
								  <dd><?php echo $data['studfee']; ?></dd>
								</dl>
								<?php endif ;?>
							</div>
							<?php if (isset($data['image']) && $data['image']): ?>
							<div class="col-sm-6">
								<a rel='gallery' href='<?php echo $data['image']; ?>' class='fancybox'><img src="<?php echo $data['image']; ?>" class='img-responsive img-rounded'></a>
							</div>
							<?php endif; ?>
						</div>
						<div class="" id="icelandic-horse-tabs">
							<!-- extra info? -->
							<ul class="nav nav-tabs" role="tablist">
								<?php if ($fotos !== false): ?>
								<li class="active">
									<a role="tab" data-toggle="tab" href="#gallery"><?php echo _e("Foto's", 'icelandic-horse'); ?></a>
								</li>
								<?php endif; ?>
								<?php if ($data['movie1'] || $data['movie2']): ?>
								<li>
									<a role="tab" data-toggle="tab" href="#movie"><?php echo _e("Video's", 'icelandic-horse'); ?></a>
								</li>
								<?php endif; ?>
								<?php if (get_the_content() != ''): ?>
								<li <?php if ($fotos === false): ?>class="active"<?php endif; ?>>
									<a role="tab" data-toggle="tab" href="#info"><?php echo _e('Informatie', 'icelandic-horse'); ?></a>
								</li>
								<?php endif; ?>
								<?php if ($nakomelingen !== false && $nakomelingen[0]['name'] != ''): ?>
								
								<li>
									<a role="tab" data-toggle="tab" href="#nakomelingen"><?php echo _e('Nakomelingen', 'icelandic-horse'); ?></a>
								</li>
								<?php endif; ?>
								<?php if (@$verrichtingen['show']['self'] || @$exterieur['show']['self'] || @$verrichtingen['show']['f'] || @$exterieur['show']['f'] || @$verrichtingen['show']['m'] || @$exterieur['show']['m']): ?>
								<li>
									<a role="tab" data-toggle="tab" href="#keuringsresultaten"><?php echo _e('Keurings resultaten', 'icelandic-horse') ?></a>
								</li>
								<?php endif; ?>
								<?php if ($stamboom['name']['m'] || $stamboom['name']['f']): ?>
								<li>
									<a role="tab" data-toggle="tab" href="#stamboom"><?php echo _e('Stamboom', 'icelandic-horse') ?></a>
								</li>
								<?php endif; ?>
							</ul>

							<div class="tab-content">
								<div class="tab-pane <?php if ($fotos !== false): ?>active<?php endif; ?>" id="gallery">
									<div class="row">
										<?php foreach ($fotos as $foto): ?>
											<?php if ($foto['image']): ?>
												<div class="col-sm-6 col-md-3">
													<div class="thumbnail">
														<a rel='gallery' href='<?php echo $foto['image']; ?>' class='fancybox'><img src="<?php echo $foto['image']; ?>" class="img-responsive img-rounded" alt="" title="<?php echo $foto['desc']; ?>"></a>
														<?php if ($foto['desc']): ?>
															<small class="caption">
																<?php echo $foto['desc']; ?>
															</small>
														<?php endif; ?>
													</div>
												</div>
												<?php endif; ?>
										<?php endforeach; ?>
									</div>
								</div>
								<div class="tab-pane" id="movie">
                                    <?php if ($data['movie1']): ?>
                                    <div style="position: relative;padding-bottom: 56.25%; /* 16:9 */padding-top: 25px;height: 0; <?php if ($data['movie2']): ?>margin-bottom: 15px;<?php endif; ?>">
                                        <iframe style="	position: absolute;top: 0;left: 0;width: 100%;height: 100%;" width="100%" src="https://www.youtube.com/embed/<?php echo $data['movie1']; ?>" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                    <?php endif; ?>
                                    <?php if ($data['movie2']): ?>
                                    <div style="position: relative;padding-bottom: 56.25%; /* 16:9 */padding-top: 25px;height: 0;">
                                        <iframe style="	position: absolute;top: 0;left: 0;width: 100%;height: 100%;" src="https://www.youtube.com/embed/<?php echo $data['movie2']; ?>" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                    <?php endif; ?>                                    
								</div>                                
								<div class="tab-pane <?php if ($fotos === false): ?>active<?php endif; ?>" id="info" >
									<?php the_content(); ?>
								</div>
								<div class="tab-pane" id="nakomelingen">
									<?php foreach ($nakomelingen as $nakomeling): ?>
										<h2><?php echo $nakomeling['name']; ?></h2>
										<div class="row icelandic-horse-nakomelingen">
											<div class="col-sm-6">
												<?php if (isset($nakomeling['name']) && $nakomeling['name']): ?>
												<?php endif ;?>
												<?php if (isset($nakomeling['feif']) && $nakomeling['feif']): ?>
												<dl class="dl-horizontal">
												  <dt><?php _e('FEIF Nummer', 'icelandic-horse'); ?></dt>
												  <dd><?php echo $nakomeling['feif']; ?></dd>
												</dl>
												<?php endif ;?>
												<?php if (isset($nakomeling['year']) && $nakomeling['year']): ?>
												<dl class="dl-horizontal">
												  <dt><?php _e('Geboortejaar', 'icelandic-horse'); ?></dt>
												  <dd><?php echo $nakomeling['year']; ?></dd>
												</dl>
												<?php endif ;?>
												<?php if (isset($nakomeling['kleur']) && $nakomeling['kleur']): ?>
												<dl class="dl-horizontal">
												  <dt><?php _e('Kleur', 'icelandic-horse'); ?></dt>
												  <dd><?php echo $nakomeling['kleur']; ?></dd>
												</dl>
												<?php endif ;?>
												<?php if (isset($nakomeling['parent']) && $nakomeling['parent']): ?>
												<dl class="dl-horizontal">
												  <dt><?php $data['gender'] == 'merrie' ? _e('Vader', 'icelandic-horse') : _e('Moeder', 'icelandic-horse'); ?></dt>
												  <dd><?php echo $nakomeling['parent']; ?></dd>
												</dl>
												<?php endif ;?>
												<?php if (isset($nakomeling['link']) && $nakomeling['link']): ?>
												<dl class="dl-horizontal">
												  <dt>&nbsp;</dt>
												  <dd><a class='btn btn-info' href='<?php echo $nakomeling['link']; ?>'>Meer info</a></dd>
												</dl>
												<?php endif ;?>
											</div>
											<?php if (isset($nakomeling['image']) && $nakomeling['image']): ?>
											<div class="col-sm-6">
												<a rel="nakomelingen" href='<?php echo $nakomeling['image']; ?>' class='fancybox'><img style='width: 100%;' class='img-responsive img-rounded' src="<?php echo $nakomeling['image']; ?>" class="img-responsive"></a>
											</div>
											<?php endif; ?>
										</div>
									<?php endforeach; ?>
								</div>
								<div class="tab-pane" id="keuringsresultaten">
									<h3><?php echo _e("Totalen", 'icelandic-horse'); ?></h3>
									<table class='table' style='width: auto;'>
										<thead>
											<th style='width: 20em;'>&nbsp;</th>
											<?php if (@$verrichtingen['show']['self'] || @$exterieur['show']['self']): ?><th style='width: 6em;'><?php echo $firstname ?></th><?php endif; ?>
											<?php if (@$verrichtingen['show']['m'] || @$exterieur['show']['m']): ?><th style='width: 6em;'><?php echo _e('Moeder', 'icelandic-horse') ?></th><?php endif; ?>
											<?php if (@$verrichtingen['show']['f'] || @$exterieur['show']['f']): ?><th style='width: 6em;'><?php echo _e('Vader', 'icelandic-horse') ?></th><?php endif; ?>
										</thead>
										<tbody>
											<tr>
												<th><?php echo _e("Exterieur", 'icelandic-horse'); ?></th>
												<?php if (@$verrichtingen['show']['self'] || @$exterieur['show']['self']): ?><td><?php if (@$exterieur['show']['self']): ?><?php if (isset($exterieur['totaal']['self']) && $exterieur['totaal']['self']): ?><?php echo $exterieur['totaal']['self']; ?><?php else: ?>&nbsp;<?php endif; ?><?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['m'] || @$exterieur['show']['m']): ?><td><?php if (@$exterieur['show']['m']): ?><?php if (isset($exterieur['totaal']['m']) && $exterieur['totaal']['m']): ?><?php echo $exterieur['totaal']['m']; ?><?php else: ?>&nbsp;<?php endif; ?><?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['f'] || @$exterieur['show']['f']): ?><td><?php if (@$exterieur['show']['f']): ?><?php if (isset($exterieur['totaal']['f']) && $exterieur['totaal']['f']): ?><?php echo $exterieur['totaal']['f']; ?><?php else: ?>&nbsp;<?php endif; ?><?php endif; ?></td><?php endif; ?>
											</tr>
											<tr>
												<th><?php echo _e("Verrichtingen", 'icelandic-horse'); ?></th>
												<?php if (@$verrichtingen['show']['self'] || @$exterieur['show']['self']): ?><td><?php if (@$verrichtingen['show']['self']): ?><?php if (isset($verrichtingen['totaal']['self']) && $verrichtingen['totaal']['self']): ?><?php echo $verrichtingen['totaal']['self']; ?><?php else: ?>&nbsp;<?php endif; ?><?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['m'] || @$exterieur['show']['m']): ?><td><?php if (@$verrichtingen['show']['m']): ?><?php if (isset($verrichtingen['totaal']['m']) && $verrichtingen['totaal']['m']): ?><?php echo $verrichtingen['totaal']['m']; ?><?php else: ?>&nbsp;<?php endif; ?><?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['f'] || @$exterieur['show']['f']): ?><td><?php if (@$verrichtingen['show']['f']): ?><?php if (isset($verrichtingen['totaal']['f']) && $verrichtingen['totaal']['f']): ?><?php echo $verrichtingen['totaal']['f']; ?><?php else: ?>&nbsp;<?php endif; ?><?php endif; ?></td><?php endif; ?>
											</tr>
											<tr>
												<th><?php echo _e("Gemiddeld", 'icelandic-horse'); ?></th>
												<?php if (@$verrichtingen['show']['self'] || @$exterieur['show']['self']): ?><td><?php if (@$verrichtingen['show']['self'] && @$exterieur['show']['self']): ?><?php if (isset($totaal['self']) && $totaal['self']): ?><?php echo $totaal['self']; ?><?php else: ?>&nbsp;<?php endif; ?><?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['m'] || @$exterieur['show']['m']): ?><td><?php if (@$verrichtingen['show']['m'] && @$exterieur['show']['m']): ?><?php if (isset($totaal['m']) && $totaal['m']): ?><?php echo $totaal['m']; ?><?php else: ?>&nbsp;<?php endif; ?><?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['f'] || @$exterieur['show']['f']): ?><td><?php if (@$verrichtingen['show']['f'] && @$exterieur['show']['f']): ?><?php if (isset($totaal['f']) && $totaal['f']): ?><?php echo $totaal['f']; ?><?php else: ?>&nbsp;<?php endif; ?><?php endif; ?></td><?php endif; ?>
											</tr>
										</tbody>
									</table>								

									<h3><?php echo _e('Exterieur', 'icelandic-horse'); ?></h3>
									<table class='table' style='width: auto;'>
										<thead>
											<th style='width: 20em;'><?php echo _e("Onderdeel", 'icelandic-horse'); ?></th>
											<?php if (@$exterieur['show']['self']): ?><th style='width: 6em;'><?php echo $firstname ?></th><?php endif; ?>
											<?php if (@$exterieur['show']['m']): ?><th style='width: 6em;'><?php echo _e('Moeder', 'icelandic-horse') ?></th><?php endif; ?>
											<?php if (@$exterieur['show']['f']): ?><th style='width: 6em;'><?php echo _e('Vader', 'icelandic-horse') ?></th><?php endif; ?>
										</thead>
										<tbody>
											<tr>
												<th><?php echo _e("Hoofd", 'icelandic-horse'); ?></th>
												<?php if (@$exterieur['show']['self']): ?><td><?php if (isset($exterieur['hoofd']['self']) && $exterieur['hoofd']['self']): ?><?php echo $exterieur['hoofd']['self']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$exterieur['show']['m']): ?><td><?php if (isset($exterieur['hoofd']['m']) && $exterieur['hoofd']['m']): ?><?php echo $exterieur['hoofd']['m']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$exterieur['show']['f']): ?><td><?php if (isset($exterieur['hoofd']['f']) && $exterieur['hoofd']['f']): ?><?php echo $exterieur['hoofd']['f']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
											</tr>
											<tr>
												<th><?php echo _e("Hals/Schouder/Borst", 'icelandic-horse'); ?></th>
												<?php if (@$exterieur['show']['self']): ?><td><?php if (isset($exterieur['hsb']['self']) && $exterieur['hsb']['self']): ?><?php echo $exterieur['hsb']['self']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$exterieur['show']['m']): ?><td><?php if (isset($exterieur['hsb']['m']) && $exterieur['hsb']['m']): ?><?php echo $exterieur['hsb']['m']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$exterieur['show']['f']): ?><td><?php if (isset($exterieur['hsb']['f']) && $exterieur['hsb']['f']): ?><?php echo $exterieur['hsb']['f']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
											</tr>
											<tr>
												<th><?php echo _e("Bovenlijn/kruis", 'icelandic-horse'); ?></th>
												<?php if (@$exterieur['show']['self']): ?><td><?php if (isset($exterieur['bk']['self']) && $exterieur['bk']['self']): ?><?php echo $exterieur['bk']['self']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$exterieur['show']['m']): ?><td><?php if (isset($exterieur['bk']['m']) && $exterieur['bk']['m']): ?><?php echo $exterieur['bk']['m']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$exterieur['show']['f']): ?><td><?php if (isset($exterieur['bk']['f']) && $exterieur['bk']['f']): ?><?php echo $exterieur['bk']['f']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
											</tr>
											<tr>
												<th><?php echo _e("Verhoudingen", 'icelandic-horse'); ?></th>
												<?php if (@$exterieur['show']['self']): ?><td><?php if (isset($exterieur['verh']['self']) && $exterieur['verh']['self']): ?><?php echo $exterieur['verh']['self']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$exterieur['show']['m']): ?><td><?php if (isset($exterieur['verh']['m']) && $exterieur['verh']['m']): ?><?php echo $exterieur['verh']['m']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$exterieur['show']['f']): ?><td><?php if (isset($exterieur['verh']['f']) && $exterieur['verh']['f']): ?><?php echo $exterieur['verh']['f']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
											</tr>
											<tr>
												<th><?php echo _e("Benen", 'icelandic-horse'); ?></th>
												<?php if (@$exterieur['show']['self']): ?><td><?php if (isset($exterieur['benen']['self']) && $exterieur['benen']['self']): ?><?php echo $exterieur['benen']['self']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$exterieur['show']['m']): ?><td><?php if (isset($exterieur['benen']['m']) && $exterieur['benen']['m']): ?><?php echo $exterieur['benen']['m']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$exterieur['show']['f']): ?><td><?php if (isset($exterieur['benen']['f']) && $exterieur['benen']['f']): ?><?php echo $exterieur['benen']['f']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
											</tr>
											<tr>
												<th><?php echo _e("Gewrichten", 'icelandic-horse'); ?></th>
												<?php if (@$exterieur['show']['self']): ?><td><?php if (isset($exterieur['gewr']['self']) && $exterieur['gewr']['self']): ?><?php echo $exterieur['gewr']['self']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$exterieur['show']['m']): ?><td><?php if (isset($exterieur['gewr']['m']) && $exterieur['gewr']['m']): ?><?php echo $exterieur['gewr']['m']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$exterieur['show']['f']): ?><td><?php if (isset($exterieur['gewr']['f']) && $exterieur['gewr']['f']): ?><?php echo $exterieur['gewr']['f']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
											</tr>
											<tr>
												<th><?php echo _e("Hoeven", 'icelandic-horse'); ?></th>
												<?php if (@$exterieur['show']['self']): ?><td><?php if (isset($exterieur['hoeven']['self']) && $exterieur['hoeven']['self']): ?><?php echo $exterieur['hoeven']['self']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$exterieur['show']['m']): ?><td><?php if (isset($exterieur['hoeven']['m']) && $exterieur['hoeven']['m']): ?><?php echo $exterieur['hoeven']['m']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$exterieur['show']['f']): ?><td><?php if (isset($exterieur['hoeven']['f']) && $exterieur['hoeven']['f']): ?><?php echo $exterieur['hoeven']['f']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
											</tr>
											<tr>
												<th><?php echo _e("Manen/staart", 'icelandic-horse'); ?></th>
												<?php if (@$exterieur['show']['self']): ?><td><?php if (isset($exterieur['ms']['self']) && $exterieur['ms']['self']): ?><?php echo $exterieur['ms']['self']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$exterieur['show']['m']): ?><td><?php if (isset($exterieur['ms']['m']) && $exterieur['ms']['m']): ?><?php echo $exterieur['ms']['m']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$exterieur['show']['f']): ?><td><?php if (isset($exterieur['ms']['f']) && $exterieur['ms']['f']): ?><?php echo $exterieur['ms']['f']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
											</tr>
											<tr>
												<th><?php echo _e("Totaal", 'icelandic-horse'); ?></th>
												<?php if (@$exterieur['show']['self']): ?><td><?php if (isset($exterieur['totaal']['self']) && $exterieur['totaal']['self']): ?><?php echo $exterieur['totaal']['self']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$exterieur['show']['m']): ?><td><?php if (isset($exterieur['totaal']['m']) && $exterieur['totaal']['m']): ?><?php echo $exterieur['totaal']['m']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$exterieur['show']['f']): ?><td><?php if (isset($exterieur['totaal']['f']) && $exterieur['totaal']['f']): ?><?php echo $exterieur['totaal']['f']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
											</tr>

										</tbody>
									</table>

									<h3><?php echo _e('Verrichtingen', 'icelandic-horse'); ?></h3>
									<table class='table' style='width: auto;'>
										<thead>
											<th style='width: 20em;'><?php echo _e("Onderdeel", 'icelandic-horse'); ?></th>
											<?php if (@$verrichtingen['show']['self']): ?><th style='width: 6em;'><?php echo $firstname ?></th><?php endif; ?>
											<?php if (@$verrichtingen['show']['m']): ?><th style='width: 6em;'><?php echo _e('Moeder', 'icelandic-horse') ?></th><?php endif; ?>
											<?php if (@$verrichtingen['show']['f']): ?><th style='width: 6em;'><?php echo _e('Vader', 'icelandic-horse') ?></th><?php endif; ?>
										</thead>
										<tbody>
											<tr>
												<th><?php echo _e("T&ouml;lt", 'icelandic-horse'); ?></th>
												<?php if (@$verrichtingen['show']['self']): ?><td><?php if (isset($verrichtingen['tolt']['self']) && $verrichtingen['tolt']['self']): ?><?php echo $verrichtingen['tolt']['self']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['m']): ?><td><?php if (isset($verrichtingen['tolt']['m']) && $verrichtingen['tolt']['m']): ?><?php echo $verrichtingen['tolt']['m']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['f']): ?><td><?php if (isset($verrichtingen['tolt']['f']) && $verrichtingen['tolt']['f']): ?><?php echo $verrichtingen['tolt']['f']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
											</tr>
											<tr>
												<th><?php echo _e("Langzame T&ouml;lt", 'icelandic-horse'); ?></th>
												<?php if (@$verrichtingen['show']['self']): ?><td><?php if (isset($verrichtingen['ltolt']['self']) && $verrichtingen['ltolt']['self']): ?><?php echo $verrichtingen['ltolt']['self']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['m']): ?><td><?php if (isset($verrichtingen['ltolt']['m']) && $verrichtingen['ltolt']['m']): ?><?php echo $verrichtingen['ltolt']['m']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['f']): ?><td><?php if (isset($verrichtingen['ltolt']['f']) && $verrichtingen['ltolt']['f']): ?><?php echo $verrichtingen['ltolt']['f']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
											</tr>
											<tr>
												<th><?php echo _e("Draf", 'icelandic-horse'); ?></th>
												<?php if (@$verrichtingen['show']['self']): ?><td><?php if (isset($verrichtingen['draf']['self']) && $verrichtingen['draf']['self']): ?><?php echo $verrichtingen['draf']['self']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['m']): ?><td><?php if (isset($verrichtingen['draf']['m']) && $verrichtingen['draf']['m']): ?><?php echo $verrichtingen['draf']['m']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['f']): ?><td><?php if (isset($verrichtingen['draf']['f']) && $verrichtingen['draf']['f']): ?><?php echo $verrichtingen['draf']['f']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
											</tr>
											<tr>
												<th><?php echo _e("Telgang", 'icelandic-horse'); ?></th>
												<?php if (@$verrichtingen['show']['self']): ?><td><?php if (isset($verrichtingen['telgang']['self']) && $verrichtingen['telgang']['self']): ?><?php echo $verrichtingen['telgang']['self']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['m']): ?><td><?php if (isset($verrichtingen['telgang']['m']) && $verrichtingen['telgang']['m']): ?><?php echo $verrichtingen['telgang']['m']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['f']): ?><td><?php if (isset($verrichtingen['telgang']['f']) && $verrichtingen['telgang']['f']): ?><?php echo $verrichtingen['telgang']['f']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
											</tr>
											<tr>
												<th><?php echo _e("Galop", 'icelandic-horse'); ?></th>
												<?php if (@$verrichtingen['show']['self']): ?><td><?php if (isset($verrichtingen['galop']['self']) && $verrichtingen['galop']['self']): ?><?php echo $verrichtingen['galop']['self']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['m']): ?><td><?php if (isset($verrichtingen['galop']['m']) && $verrichtingen['galop']['m']): ?><?php echo $verrichtingen['galop']['m']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['f']): ?><td><?php if (isset($verrichtingen['galop']['f']) && $verrichtingen['galop']['f']): ?><?php echo $verrichtingen['galop']['f']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
											</tr>
											<tr>
												<th><?php echo _e("Langzame Galop", 'icelandic-horse'); ?></th>
												<?php if (@$verrichtingen['show']['self']): ?><td><?php if (isset($verrichtingen['lgalop']['self']) && $verrichtingen['lgalop']['self']): ?><?php echo $verrichtingen['lgalop']['self']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['m']): ?><td><?php if (isset($verrichtingen['lgalop']['m']) && $verrichtingen['lgalop']['m']): ?><?php echo $verrichtingen['lgalop']['m']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['f']): ?><td><?php if (isset($verrichtingen['lgalop']['f']) && $verrichtingen['lgalop']['f']): ?><?php echo $verrichtingen['lgalop']['f']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
											</tr>
											<tr>
												<th><?php echo _e("Karakter/temperament", 'icelandic-horse'); ?></th>
												<?php if (@$verrichtingen['show']['self']): ?><td><?php if (isset($verrichtingen['kt']['self']) && $verrichtingen['kt']['self']): ?><?php echo $verrichtingen['kt']['self']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['m']): ?><td><?php if (isset($verrichtingen['kt']['m']) && $verrichtingen['kt']['m']): ?><?php echo $verrichtingen['kt']['m']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['f']): ?><td><?php if (isset($verrichtingen['kt']['f']) && $verrichtingen['kt']['f']): ?><?php echo $verrichtingen['kt']['f']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
											</tr>
											<tr>
												<th><?php echo _e("Indruk/Beeld onder de ruiter", 'icelandic-horse'); ?></th>
												<?php if (@$verrichtingen['show']['self']): ?><td><?php if (isset($verrichtingen['indruk']['self']) && $verrichtingen['indruk']['self']): ?><?php echo $verrichtingen['indruk']['self']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['m']): ?><td><?php if (isset($verrichtingen['indruk']['m']) && $verrichtingen['indruk']['m']): ?><?php echo $verrichtingen['indruk']['m']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['f']): ?><td><?php if (isset($verrichtingen['indruk']['f']) && $verrichtingen['indruk']['f']): ?><?php echo $verrichtingen['indruk']['f']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
											</tr>
											<tr>
												<th><?php echo _e("Stap", 'icelandic-horse'); ?></th>
												<?php if (@$verrichtingen['show']['self']): ?><td><?php if (isset($verrichtingen['stap']['self']) && $verrichtingen['stap']['self']): ?><?php echo $verrichtingen['stap']['self']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['m']): ?><td><?php if (isset($verrichtingen['stap']['m']) && $verrichtingen['stap']['m']): ?><?php echo $verrichtingen['stap']['m']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['f']): ?><td><?php if (isset($verrichtingen['stap']['f']) && $verrichtingen['stap']['f']): ?><?php echo $verrichtingen['stap']['f']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
											</tr>
											<tr>
												<th><?php echo _e("Totaal", 'icelandic-horse'); ?></th>
												<?php if (@$verrichtingen['show']['self']): ?><td><?php if (isset($verrichtingen['totaal']['self']) && $verrichtingen['totaal']['self']): ?><?php echo $verrichtingen['totaal']['self']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['m']): ?><td><?php if (isset($verrichtingen['totaal']['m']) && $verrichtingen['totaal']['m']): ?><?php echo $verrichtingen['totaal']['m']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
												<?php if (@$verrichtingen['show']['f']): ?><td><?php if (isset($verrichtingen['totaal']['f']) && $verrichtingen['totaal']['f']): ?><?php echo $verrichtingen['totaal']['f']; ?><?php else: ?>&nbsp;<?php endif; ?></td><?php endif; ?>
											</tr>
										</tbody>
									</table>	
								</div>
								<div class="tab-pane" id="stamboom">

										<div class="row">
											<div class='col-md-4'></div>
											<div class='col-md-4'></div>
											<div class='col-md-4'>FF: <?php if ($stamboom['link']['ff']): ?><a href="<?php echo $stamboom['link']['ff']; ?>"><?php echo $stamboom['name']['ff']; ?></a><?php else: ?><?php echo $stamboom['name']['ff']; ?><?php endif; ?><br><?php echo $stamboom['feif']['ff']; ?></div>
										</div>
										<div class="row">
											<div class='col-md-4'></div>
											<div class='col-md-4'>F: <?php if ($stamboom['link']['f']): ?><a href="<?php echo $stamboom['link']['f']; ?>"><?php echo $stamboom['name']['f']; ?></a><?php else: ?><?php echo $stamboom['name']['f']; ?><?php endif; ?><br><?php echo $stamboom['feif']['f']; ?></div>
											<div class='col-md-4'></div>
										</div>
										<div class="row">
											<div class='col-md-4'></div>
											<div class='col-md-4'></div>
											<div class='col-md-4'>FM: <?php if ($stamboom['link']['fm']): ?><a href="<?php echo $stamboom['link']['fm']; ?>"><?php echo $stamboom['name']['fm']; ?></a><?php else: ?><?php echo $stamboom['name']['fm']; ?><?php endif; ?><br><?php echo $stamboom['feif']['fm']; ?></div>
										</div>
										<div class="row">
											<div class='col-md-4'><?php echo $data['name']; ?><br><?php echo $data['feif']?></div>
											<div class='col-md-4'></div>
											<div class='col-md-4'></div>
										</div>
										<div class="row">
											<div class='col-md-4'></div>
											<div class='col-md-4'></div>
											<div class='col-md-4'>MF: <?php if ($stamboom['link']['mf']): ?><a href="<?php echo $stamboom['link']['mf']; ?>"><?php echo $stamboom['name']['mf']; ?></a><?php else: ?><?php echo $stamboom['name']['mf']; ?><?php endif; ?><br><?php echo $stamboom['feif']['mf']; ?></div>
										</div>
										<div class="row">
											<div class='col-md-4'></div>
											<div class='col-md-4'>M: <?php if ($stamboom['link']['m']): ?><a href="<?php echo $stamboom['link']['m']; ?>"><?php echo $stamboom['name']['m']; ?></a><?php else: ?><?php echo $stamboom['name']['m']; ?><?php endif; ?><br><?php echo $stamboom['feif']['m']; ?></div>
											<div class='col-md-4'></div>
										</div>
										<div class="row">
											<div class='col-md-4'></div>
											<div class='col-md-4'></div>
											<div class='col-md-4'>MM: <?php if ($stamboom['link']['mm']): ?><a href="<?php echo $stamboom['link']['mm']; ?>"><?php echo $stamboom['name']['mm']; ?></a><?php else: ?><?php echo $stamboom['name']['mm']; ?><?php endif; ?><br><?php echo $stamboom['feif']['mm']; ?></div>
										</div>

								</div>
							</div>

						</div>
					<?php endwhile; // end of the loop. ?>
					<?php get_template_part( 'content', 'footer' ); ?>
				</article>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>

<script type="text/javascript">
	jQuery(document).ready(function () {
		jQuery('.fancybox').fancybox();
	});
</script>

<?php get_footer(); ?>