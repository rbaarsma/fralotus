<?php
/*
Plugin Name: Icelandic Horse
Plugin URI: 
Description: custom post type for Icelandic Horses
Version: 1.0
Author: Rein Baarsma
License: GPLv2
*/

add_action( 'init', 'create_icelandic_horse' );

function create_icelandic_horse() {
    register_post_type( 'icelandic_horse',
        array(
            'labels' => array(
                'name' => 'IJslands Paards',
                'singular_name' => 'IJslands paard',
                'add_new' => 'Toevoegen',
                'add_new_item' => 'IJslands paard toevoegen',
                'edit' => 'Bewerken',
                'edit_item' => 'IJslands paard bewerken',
                'new_item' => 'Nieuw IJslands paard',
                'view' => 'Bekijk',
                'view_item' => 'Bekijk IJslands paard',
                'search_items' => 'Zoek IJslands paard',
                'not_found' => 'Geen IJslands paard gevonden',
                'not_found_in_trash' => 'Geen IJslands paard gevonden in de prullenbak',
                'parent' => 'Parent IJslands paard'
            ),
 
            'public' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
			
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail' ),
             'taxonomies' => array('category'),
            'menu_icon' => plugins_url( 'images/horse_icon.jpg', __FILE__ ),
            'has_archive' => true,
			'rewrite' => array( 'slug' => 'paarden', 'with_front' => true, 'hierarchical' => false ),
        )
    );
}


add_action( 'admin_init', 'icelandic_horse_admin_init' );

function icelandic_horse_admin_init() {
    add_meta_box( 'icelandic_horse_personal_meta_box',
        'Gegevens',
        'display_icelandic_horse_personal_meta_box',
        'icelandic_horse', 'normal', 'high'
    );
    add_meta_box( 'icelandic_horse_stamboom_meta_box',
        'Stamboom',
        'display_icelandic_horse_stamboom_meta_box',
        'icelandic_horse', 'normal', 'high'
    );
    add_meta_box( 'icelandic_horse_nakomelingen_meta_box',
        'Nakomelingen',
        'display_icelandic_horse_nakomelingen_meta_box',
        'icelandic_horse', 'normal', 'high'
    );
    add_meta_box( 'icelandic_horse_keuring_meta_box',
        'Keuringsresultaten',
        'display_icelandic_horse_keuring_meta_box',
        'icelandic_horse', 'normal', 'high'
    );
    add_meta_box( 'icelandic_horse_gallery_meta_box',
        'Gallery',
        'swp_file_upload',
        'icelandic_horse', 'normal', 'high'
    );
}

function display_icelandic_horse_personal_meta_box( $icelandic_horse ) {
    // Retrieve current name of the Director and Movie Rating based on review ID
    $data = get_post_meta( $icelandic_horse->ID, 'data', true );
	
    ?>
    <table>
        <tr>
            <td style="width: 100%">Naam</td>
            <td><input type="text" size="80" name="icelandic_horse_data[name]" value="<?php echo @$data['name']; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100%">FEIF nummer</td>
            <td><input type="text" size="80" name="icelandic_horse_data[feif]" value="<?php echo @$data['feif']; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100%">Geboortedatum</td>
            <td><input type="date" size="80" name="icelandic_horse_data[geboortedatum]" value="<?php echo @$data['geboortedatum']; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100%">Kleur</td>
            <td><input type="text" size="80" name="icelandic_horse_data[kleur]" value="<?php echo @$data['kleur']; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100%">Afbeelding</td>
            <td>
				<input type="text" name="icelandic_horse_data[image]" size="70" value="<?php echo @$data['image']; ?>" />
				<input onclick="icelandic_horse_data_upload(event)" type="button" value="Upload">
				<input onclick="jQuery(this).parent().parent().remove();" type="button" value="Remove">
			</td>
        </tr>

    </table>

	<script type="text/javascript">

	// Uploading files
	var file_frame;
	function icelandic_horse_data_upload(event)
	{
		btn = event.target;

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
		file_frame.open();
		return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		title: jQuery( this ).data( 'uploader_title' ),
		button: {
		text: jQuery( this ).data( 'uploader_button_text' ),
		},
		multiple: false // Set to true to allow multiple files to be selected
		});

		// When a file is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();
			var url = attachment.url;

			jQuery(btn).prev().val(attachment.url);
		});

		// Finally, open the modal
		file_frame.open();
	}

	</script>
	<?php
}

function display_icelandic_horse_stamboom_meta_box( $icelandic_horse ) {
    // Retrieve current name of the Director and Movie Rating based on review ID
    $stamboom = get_post_meta( $icelandic_horse->ID, 'stamboom', true );
    $name = @$stamboom['name'];
	$feif = @$stamboom['feif'];

	?>
    <table>
        <tr>
            <td style="width: 100%">Naam Moeder (M)</td>
            <td><input type="text" size="80" name="icelandic_horse_stamboom[name][m]" value="<?php echo @$name['m']; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100%">FEIF Moeder (M)</td>
            <td><input type="text" size="80" name="icelandic_horse_stamboom[feif][m]" value="<?php echo @$feif['m']; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100%">Naam Vader (F)</td>
            <td><input type="text" size="80" name="icelandic_horse_stamboom[name][f]" value="<?php echo @$name['f']; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100%">FEIF Vader (F)</td>
            <td><input type="text" size="80" name="icelandic_horse_stamboom[feif][f]" value="<?php echo @$feif['f']; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100%">Naam FF</td>
            <td><input type="text" size="80" name="icelandic_horse_stamboom[name][ff]" value="<?php echo @$name['ff']; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100%">FEIF FF</td>
            <td><input type="text" size="80" name="icelandic_horse_stamboom[feif][ff]" value="<?php echo @$feif['ff']; ?>" /></td>
        </tr>
		<tr>
            <td style="width: 100%">Naam FM</td>
            <td><input type="text" size="80" name="icelandic_horse_stamboom[name][fm]" value="<?php echo @$name['fm']; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100%">FEIF FM</td>
            <td><input type="text" size="80" name="icelandic_horse_stamboom[feif][fm]" value="<?php echo @$feif['fm']; ?>" /></td>
        </tr>
		<tr>
            <td style="width: 100%">Naam MF</td>
            <td><input type="text" size="80" name="icelandic_horse_stamboom[name][mf]" value="<?php echo @$name['mf']; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100%">FEIF MF</td>
            <td><input type="text" size="80" name="icelandic_horse_stamboom[feif][mf]" value="<?php echo @$feif['mf']; ?>" /></td>
        </tr>
		<tr>
            <td style="width: 100%">Naam MM</td>
            <td><input type="text" size="80" name="icelandic_horse_stamboom[name][mm]" value="<?php echo @$name['mm']; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100%">FEIF MM</td>
            <td><input type="text" size="80" name="icelandic_horse_stamboom[feif][mm]" value="<?php echo @$feif['mm']; ?>" /></td>
        </tr>
    </table>
    <?php
}

function display_icelandic_horse_nakomelingen_meta_box( $icelandic_horse ) {
    // Retrieve current name of the Director and Movie Rating based on review ID
    $nakomelingen = get_post_meta( $icelandic_horse->ID, 'nakomelingen', true );
	if (!is_array($nakomelingen) || count($nakomelingen) === 0)
		$nakomelingen = array(array());
	
    ?>
	<div id="icelandic_horse_nakomelingen">
		<?php foreach ($nakomelingen as $i=>$nakomeling): ?>
		<h3>Nakomeling #<?php echo $i; ?> <a onclick="jQuery(this).parent().next().remove(); jQuery(this).parent().remove(); return false;">(verwijder)</a></h3>
		<table id="icelandic_horse_nakomeling_<?php echo $i; ?>">
			<tbody>
				<tr>
					<td style="width: 100%">Naam</td>
					<td><input type="text" size="80" name="icelandic_horse_nakomeling[<?php echo $i; ?>][name]" value="<?php echo @$nakomeling['name']; ?>" /></td>
				</tr>
				<tr>
					<td style="width: 100%">FEIF nummer</td>
					<td><input type="text" size="80" name="icelandic_horse_nakomeling[<?php echo $i; ?>][feif]" value="<?php echo @$nakomeling['feif']; ?>" /></td>
				</tr>
				<tr>
					<td style="width: 100%">Andere ouder</td>
					<td><input type="text" size="80" name="icelandic_horse_nakomeling[<?php echo $i; ?>][parent]" value="<?php echo @$nakomeling['parent']; ?>" /></td>
				</tr>
				<tr>
					<td style="width: 100%">Geboortejaar</td>
					<td><input type="number" size="80" name="icelandic_horse_nakomeling[<?php echo $i; ?>][year]" value="<?php echo @$nakomeling['year']; ?>" /></td>
				</tr>
				<tr>
					<td style="width: 100%">Afbeelding</td>
					<td>
						<input type="text" name="icelandic_horse_nakomeling[<?php echo $i; ?>][image]" size="70" value="<?php echo @$nakomeling['image']; ?>" />
						<input onclick="icelandic_horse_nakomeling_upload(event)" type="button" value="Upload">
					</td>
				</tr>
			</tbody>
		</table>
		<?php endforeach; ?>
	</div>
	<script type="text/javascript">
		function icelandic_horse_nakomeling_add()
		{
			var count = jQuery('#icelandic_horse_nakomelingen table').length;
			var html = jQuery('#icelandic_horse_nakomeling_0').html();
			jQuery('#icelandic_horse_nakomelingen').append('<h3>Nakomeling #'+count+' <a onclick="jQuery(this).parent().next().remove(); jQuery(this).parent().remove(); return false;">(verwijder)</a></h3><table id="icelandic_horse_nakomeling_'+count+'">'+html);
			jQuery('#icelandic_horse_nakomeling_'+count).find('input[type=text]').each(function (i,elem) {
				jQuery(elem).val('').attr('name', jQuery(elem).attr('name').replace(0,count));
			});
		}
		function icelandic_horse_nakomeling_upload(event)
		{
			btn = event.target;

			// If the media frame already exists, reopen it.
			if ( file_frame ) {
			file_frame.open();
			return;
			}

			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false // Set to true to allow multiple files to be selected
			});

			// When a file is selected, run a callback.
			file_frame.on( 'select', function() {
				// We set multiple to false so only get one image from the uploader
				attachment = file_frame.state().get('selection').first().toJSON();
				jQuery(btn).prev().val(attachment.url);
			});

			// Finally, open the modal
			file_frame.open();
		}
	</script>
	<input type="button" value="Toevoegen" onclick="icelandic_horse_nakomeling_add();">
	<?php
}

function display_icelandic_horse_keuring_meta_box( $icelandic_horse ) {
    // Retrieve current name of the Director and Movie Rating based on review ID
    $keuring = get_post_meta( $icelandic_horse->ID, 'keuring', true );
    $exterieur = @$keuring['exterieur'];
	$verrichtingen = @$keuring['verrichtingen'];
	$totaal = @$keuring['totaal'];

	?>
	<h3>Exterieur</h3>
    <table>
		<thead>
			<th>&nbsp;</th>
			<th>Paard</th>
			<th>Moeder</th>
			<th>Vader</th>
		</thead>
		<tbody>
			<tr>
				<td style="width: 100%">Hoofd</td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][hoofd][self]" value="<?php echo @$exterieur['hoofd']['self']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][hoofd][m]" value="<?php echo @$exterieur['hoofd']['m']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][hoofd][f]" value="<?php echo @$exterieur['hoofd']['f']; ?>" /></td>
			</tr>
			<tr>
				<td style="width: 100%">Hals/Schouder/Borst</td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][hsb][self]" value="<?php echo @$exterieur['hsb']['self']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][hsb][m]" value="<?php echo @$exterieur['hsb']['m']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][hsb][f]" value="<?php echo @$exterieur['hsb']['f']; ?>" /></td>
			</tr>
			<tr>
				<td style="width: 100%">Bovenlijn/kruis</td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][bk][self]" value="<?php echo @$exterieur['bk']['self']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][bk][m]" value="<?php echo @$exterieur['bk']['m']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][bk][f]" value="<?php echo @$exterieur['bk']['f']; ?>" /></td>
			</tr>
			<tr>
				<td style="width: 100%">Verhoudingen</td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][verh][self]" value="<?php echo @$exterieur['verh']['self']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][verh][m]" value="<?php echo @$exterieur['verh']['m']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][verh][f]" value="<?php echo @$exterieur['verh']['f']; ?>" /></td>
			</tr>
			<tr>
				<td style="width: 100%">Benen</td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][benen][self]" value="<?php echo @$exterieur['benen']['self']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][benen][m]" value="<?php echo @$exterieur['benen']['m']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][benen][f]" value="<?php echo @$exterieur['benen']['f']; ?>" /></td>
			</tr>
			<tr>
				<td style="width: 100%">Gewrichten</td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][gewr][self]" value="<?php echo @$exterieur['gewr']['self']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][gewr][m]" value="<?php echo @$exterieur['gewr']['m']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][gewr][f]" value="<?php echo @$exterieur['gewr']['f']; ?>" /></td>
			</tr>
			<tr>
				<td style="width: 100%">Hoeven</td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][hoeven][self]" value="<?php echo @$exterieur['hoeven']['self']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][hoeven][m]" value="<?php echo @$exterieur['hoeven']['m']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][hoeven][f]" value="<?php echo @$exterieur['hoeven']['f']; ?>" /></td>
			</tr>
			<tr>
				<td style="width: 100%">Manen/staart</td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][ms][self]" value="<?php echo @$exterieur['ms']['self']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][ms][m]" value="<?php echo @$exterieur['ms']['m']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][ms][f]" value="<?php echo @$exterieur['ms']['f']; ?>" /></td>
			</tr>
			<tr>
				<td style="width: 100%">Totaal</td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][totaal][self]" value="<?php echo @$exterieur['totaal']['self']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][totaal][m]" value="<?php echo @$exterieur['totaal']['m']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[exterieur][totaal][f]" value="<?php echo @$exterieur['totaal']['f']; ?>" /></td>
			</tr>

		</tbody>
    </table>
	
	<h3>Verrichtingen</h3>
    <table>
		<thead>
			<th>&nbsp;</th>
			<th>Paard</th>
			<th>Moeder</th>
			<th>Vader</th>
		</thead>
		<tbody>
			<tr>
				<td style="width: 100%">T&ouml;lt</td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][tolt][self]" value="<?php echo @$verrichtingen['tolt']['self']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][tolt][m]" value="<?php echo @$verrichtingen['tolt']['m']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][tolt][f]" value="<?php echo @$verrichtingen['tolt']['f']; ?>" /></td>
			</tr>
			<tr>
				<td style="width: 100%">Langzame T&ouml;lt</td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][ltolt][self]" value="<?php echo @$verrichtingen['ltolt']['self']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][ltolt][m]" value="<?php echo @$verrichtingen['ltolt']['m']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][ltolt][f]" value="<?php echo @$verrichtingen['ltolt']['f']; ?>" /></td>
			</tr>
			<tr>
				<td style="width: 100%">Draf</td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][draf][self]" value="<?php echo @$verrichtingen['draf']['self']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][draf][m]" value="<?php echo @$verrichtingen['draf']['m']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][draf][f]" value="<?php echo @$verrichtingen['draf']['f']; ?>" /></td>
			</tr>
			<tr>
				<td style="width: 100%">Telgang</td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][telgang][self]" value="<?php echo @$verrichtingen['telgang']['self']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][telgang][m]" value="<?php echo @$verrichtingen['telgang']['m']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][telgang][f]" value="<?php echo @$verrichtingen['telgang']['f']; ?>" /></td>
			</tr>
			<tr>
				<td style="width: 100%">Galop</td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][galop][self]" value="<?php echo @$verrichtingen['galop']['self']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][galop][m]" value="<?php echo @$verrichtingen['galop']['m']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][galop][f]" value="<?php echo @$verrichtingen['galop']['f']; ?>" /></td>
			</tr>
			<tr>
				<td style="width: 100%">Langzame Galop</td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][lgalop][self]" value="<?php echo @$verrichtingen['lgalop']['self']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][lgalop][m]" value="<?php echo @$verrichtingen['lgalop']['m']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][lgalop][f]" value="<?php echo @$verrichtingen['lgalop']['f']; ?>" /></td>
			</tr>
			<tr>
				<td style="width: 100%">Karakter/temperament</td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][kt][self]" value="<?php echo @$verrichtingen['kt']['self']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][kt][m]" value="<?php echo @$verrichtingen['kt']['m']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][kt][f]" value="<?php echo @$verrichtingen['kt']['f']; ?>" /></td>
			</tr>
			<tr>
				<td style="width: 100%">Indruk/Beeld onder de ruiter</td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][indruk][self]" value="<?php echo @$verrichtingen['indruk']['self']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][indruk][m]" value="<?php echo @$verrichtingen['indruk']['m']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][indruk][f]" value="<?php echo @$verrichtingen['indruk']['f']; ?>" /></td>
			</tr>
			<tr>
				<td style="width: 100%">Stap</td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][stap][self]" value="<?php echo @$verrichtingen['stap']['self']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][stap][m]" value="<?php echo @$verrichtingen['stap']['m']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][stap][f]" value="<?php echo @$verrichtingen['stap']['f']; ?>" /></td>
			</tr>
			<tr>
				<td style="width: 100%">Totaal</td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][totaal][self]" value="<?php echo @$verrichtingen['totaal']['self']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][totaal][m]" value="<?php echo @$verrichtingen['totaal']['m']; ?>" /></td>
				<td><input type="number" size="5" name="icelandic_horse_keuring[verrichtingen][totaal][f]" value="<?php echo @$verrichtingen['totaal']['f']; ?>" /></td>
			</tr>

		</tbody>
    </table>
		
	<h3>Totaal</h3>
    <table>
        <tr>
			<td style="width: 100%">Totaal</td>
			<td><input type="number" size="5" name="icelandic_horse_keuring[totaal][self]" value="<?php echo @$totaal['self']; ?>" /></td>
			<td><input type="number" size="5" name="icelandic_horse_keuring[totaal][m]" value="<?php echo @$totaal['m']; ?>" /></td>
			<td><input type="number" size="5" name="icelandic_horse_keuring[totaal][f]" value="<?php echo @$totaal['f']; ?>" /></td>
        </tr>
	</table>
    <?php
}
    /*******************************************************Podcast Meta-boxes  *******************/
//Add Metabox

add_action('add_meta_boxes', 'add_upload_file_metaboxes');

function add_upload_file_metaboxes()
{
	add_meta_box('swp_file_upload', 'File Upload', 'swp_file_upload', 'podcasts', 'normal', 'default');
}

function swp_file_upload()
{
	global $post;
// Noncename needed to verify where the data originated
	$galleries = get_post_meta($post->ID, 'gallery', true);
	if (!$galleries)
		$galleries = array(array());
	/*
	$media_file = get_post_meta($post->ID, '_wp_attached_file', true);
	if (!empty($media_file))
	{
		$strFile = $media_file;
	}
	 * 
	 */
	?>
	<div id="icelandic_horse_galleries">
		<?php foreach ($galleries as $i=>$gallery): ?>
		<h3>Foto #<?php echo $i; ?> <a onclick="jQuery(this).parent().next().remove(); jQuery(this).parent().remove(); return false;">(verwijder)</a></h3>
		<table id="icelandic_horse_gallery_<?php echo $i; ?>">
			<tbody>
				<tr>
					<td style="width: 100%">Afbeelding</td>
					<td>
						<input type="text" name="icelandic_horse_gallery[<?php echo $i; ?>][image]" size="70" value="<?php echo @$gallery['image']; ?>" />
						<input onclick="icelandic_horse_gallery_upload(event)" type="button" value="Upload">
					</td>
				</tr>
				<tr>
					<td style="width: 100%">Beschrijving</td>
					<td><input type="text" size="80" name="icelandic_horse_gallery[<?php echo $i; ?>][desc]" value="<?php echo @$gallery['desc']; ?>" /></td>
				</tr>
			</tbody>
		</table>
		<?php endforeach; ?>
	</div>	
	
	<script type="text/javascript">
		function icelandic_horse_gallery_add()
		{
			var count = jQuery('#icelandic_horse_galleries table').length;
			var html = jQuery('#icelandic_horse_gallery_0').html();
			jQuery('#icelandic_horse_galleries').append('<h3>Foto #'+count+' <a onclick="jQuery(this).parent().next().remove(); jQuery(this).parent().remove(); return false;">(verwijder)</a></h3><table id="icelandic_horse_gallery_'+count+'">'+html);
			jQuery('#icelandic_horse_gallery_'+count).find('input[type=text]').each(function (i,elem) {
				jQuery(elem).val('').attr('name', jQuery(elem).attr('name').replace(0,count));
			});
		}
		// Uploading files
		var file_frame;
		function icelandic_horse_gallery_upload(event)
		{
			btn = event.target;

			// If the media frame already exists, reopen it.
			if ( file_frame ) {
			file_frame.open();
			return;
			}

			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false // Set to true to allow multiple files to be selected
			});

			// When a file is selected, run a callback.
			file_frame.on( 'select', function() {
				// We set multiple to false so only get one image from the uploader
				attachment = file_frame.state().get('selection').first().toJSON();
				var url = attachment.url;

				jQuery(btn).prev().val(attachment.url);
			});

			// Finally, open the modal
			file_frame.open();
		}
	</script>
	<input type="button" value="Toevoegen" onclick="icelandic_horse_gallery_add();">	
	<?php

	function admin_scripts()
	{
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
	}

	function admin_styles()
	{
		wp_enqueue_style('thickbox');
	}
	add_action('admin_print_scripts', 'admin_scripts');
	add_action('admin_print_styles', 'admin_styles');
}

add_action( 'save_post', 'add_icelandic_horse_fields', 10, 2 );

function add_icelandic_horse_fields( $icelandic_horse_id, $post ) {	
    // Check post type for movie reviews
    if ( $post->post_type == 'icelandic_horse' ) 	
	{
		// Is the user allowed to edit the post?
		if (!current_user_can('edit_post', $post->ID))
			return $post->ID;
		
        // Store data in post meta table if present in post data
		update_post_meta( $icelandic_horse_id, 'data', $_POST['icelandic_horse_data'] );
		update_post_meta( $icelandic_horse_id, 'stamboom', $_POST['icelandic_horse_stamboom'] );
		update_post_meta( $icelandic_horse_id, 'nakomelingen', $_POST['icelandic_horse_nakomeling'] );
		update_post_meta( $icelandic_horse_id, 'keuring', $_POST['icelandic_horse_keuring'] );
		update_post_meta( $icelandic_horse_id, 'gallery', $_POST['icelandic_horse_gallery'] );
    }
}

add_filter( 'template_include', 'include_template_function', 1 );

function include_template_function( $template_path ) {
	if ( get_post_type() == 'icelandic_horse' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single-icelandic_horse.php' ) ) ) {
                $template_path = $theme_file;
            } else {
				
                $template_path = plugin_dir_path( __FILE__ ) . '/single-icelandic_horse.php';
            }
        }
    }
    return $template_path;
}

?>