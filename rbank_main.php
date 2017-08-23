<?php
/**
 * Plugin Name: RBank 
 * Plugin URI: https://www.facebook.com/ridwan.hasanah3
 * Description: RBank adalah widget untuk menampilkan logo bank dan norek anda
 * Author: ridwan
 * Version: 1.0
 * Author URI: https://www.facebook.com/ridwan.hasanah3
 * Text Domain: RBank
 */

/*======= CSS Include Start =========*/
add_action('wp_head', 'rbank_style' );
function rbank_style(){

	echo '<link href="'.plugin_dir_url(__FILE__ ).'asset/css/style.css" rel="stylesheet" type="text/css">';
}
/*======= CSS Include End =========*/

function rbank_widget($args){
	extract($args);
	echo $before_widget;
	echo $before_title;
	//echo 'RBank Ridwan<hr>';

	$options = get_option('rbank-widget' );

	if (!is_array($options)) {
		
		$options = array(
			'judul-widget'=>'RBANK');
	}

	echo $options['judul-widget'];
	echo $after_title;
	rbank_widget_show();
	echo $after_widget;


}

function rbank_init(){ //fungsi loaded widget

	wp_register_sidebar_widget(
		'rbank_widget_plugin',
		'RBank',
		'rbank_widget',
		array(
			'description'=>'RBank Show Your Rekening Bank') 
		);

	wp_register_widget_control(
		'rbank_widget_plugin',
		'Rbank',
		'rbank_control' );


}

add_action('plugins_loaded','rbank_init' );

function rbank_widget_show(){ //fungsi tampilan widget
	$options = get_option('rbank-widget' );
	if (!is_array($options)) {
		$options = array(
			'norek1'=>'',
			'norek2'=>'',
			'norek3'=>'',
			'norek4'=>'',
			'img1'  =>'',
			'img2'  =>'',
			'img3'  =>'',
			'img4'  =>'');
	}
	?>
	<table>
		<tr>
			<td><img src="<?php echo $options['img1']; ?>" width="50px" height="50px"></td>
			<td>
				<p class="norek"><?php echo $options['norek1']; ?></p>
			</td>
		</tr>
		<tr>
			<td><img src="<?php echo $options['img2']; ?>" width="50px" height="50px"></td>
			<td>
				<p><?php echo $options['norek2']; ?></p>
			</td>
		</tr>
		<tr>
			<td><img src="<?php echo $options['img3']; ?>" width="50px" height="50px"></td>
			<td>
				<p><?php echo $options['norek3']; ?></p>
			</td>
		</tr>
		<tr>
			<td><img src="<?php echo $options['img4']; ?>" width="50px" height="50px"></td>
			<td>
				<p><?php echo $options['norek4']; ?></p>
			</td>
		</tr>
	</table>
	<?php
}

/*====== Control Judul Widget ======*/
function rbank_control(){ 

	$options = get_option('rbank-widget');
	if (!is_array($options)) {
		
		$options = array(
			'judul-widget'=>'RBank');
	}

	if ($_POST['rbank-submit']) {
		
		$options['judul-widget'] = $_POST['judul-widget'];
		$options['norek1'] = $_POST['norek1'];
		$options['norek2'] = $_POST['norek2'];
		$options['norek3'] = $_POST['norek3'];
		$options['norek4'] = $_POST['norek4'];
		$options['img1']   = $_POST['img1'];
		$options['img2']   = $_POST['img2'];
		$options['img3']   = $_POST['img3'];
		$options['img4']   = $_POST['img4'];
		update_option("rbank-widget",$options );
	}?>
	<p>
		<label for="judul-widget">Title</label><br>
		<input type="text" name="judul-widget" id="judul-widget" value="<?php echo $options['judul-widget']; ?>"><br>
	</p>
	<table>
		<tr>
			<td>
				<label>Teks 1</label>
			</td>
			<td><input type="text" name="norek1" id="norek1" value="<?php echo $options['norek1']?>"></td>
		</tr>
		<tr>
			<td><label>Gambar 1</label></td>
			<td><input type="text" name="img1" id="img1" value="<?php echo $options['img1'];?>"></td>
		</tr>
		<tr>
			<td>
				<label>Teks 2</label>
			</td>
			<td><input type="text" name="norek2" id="norek2" value="<?php echo $options['norek2']?>"></td>
		</tr>
		<tr>
			<td><label>Gambar 2</label></td>
			<td><input type="text" name="img2" id="img2" value="<?php echo $options['img2'];?>"></td>
		</tr>
		<tr>
			<td>
				<label>Teks 3</label>
			</td>
			<td><input type="text" name="norek3" id="norek3" value="<?php echo $options['norek3']?>"></td>
		</tr>
		<tr>
			<td><label>Gambar 3</label></td>
			<td><input type="text" name="img3" id="img3" value="<?php echo $options['img3'];?>"></td>
		</tr>
		<tr>
			<td>
				<label>Teks 4</label>
			</td>
			<td><input type="text" name="norek4" id="norek4" value="<?php echo $options['norek4'];?>"></td>
		</tr>
		<tr>
			<td><label>Gambar 4</label></td>
			<td><input type="text" name="img4" id="img4" value="<?php echo $options['img4'];?>"></td>
		</tr>
	</table>
	<input type="hidden" name="rbank-submit" id="rbank-submit" value="1">
	<?php
}
?>