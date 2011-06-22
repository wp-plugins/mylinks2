<?php
/*
Donate link: http://www.2020media.com/wordpress
New version (June 2011) of options page using new API
ref: http://ottopress.com/2009/wordpress-settings-api-tutorial/
ref: http://www.presscoders.com/wordpress-settings-api-explained/
*/

// add options page
add_action('admin_menu', 'plugin_admin_add_page');
function plugin_admin_add_page() {
add_options_page('MyLinks2', 'MyLinks2', 'manage_options', 'mylinks2', 'plugin_options_page');
}

// display the admin options page
function plugin_options_page() {
?>
<div>
<h2>MyLinks2</h2>
Options relating to the MyLinks2 Plugin.
<form action="options.php" method="post">
<?php settings_fields('plugin_options'); ?>
<?php do_settings_sections('mylinks2'); ?>

<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form></div>
<?php
}

// add the admin settings and such
add_action('admin_init', 'plugin_admin_init');
function plugin_admin_init(){
register_setting( 'plugin_options', 'mylinks2_plugin_options', 'plugin_options_validate' );
add_settings_section('plugin_main', 'Main Settings', 'plugin_section_text', 'mylinks2');
add_settings_field('plugin_api_key', 'API Key', 'plugin_setting_api_key', 'mylinks2', 'plugin_main');
add_settings_field('plugin_img_size', 'Image Size', 'plugin_setting_img_size', 'mylinks2', 'plugin_main');
add_settings_field('plugin_thumb_layout', 'Image Layout', 'plugin_setting_thumb_layout', 'mylinks2', 'plugin_main');
add_settings_section('plugin_desc', 'Help', 'plugin_section_text2', 'mylinks2');

}

function plugin_section_text() {
echo '<p>Please enter your API key, and choose layout options. Click Save Changes once done.</p>';
}

function plugin_section_text2() {
echo '<p>MyLinks2 uses the website thumbnail service from <a href=http://www.shrinktheweb.com target=_blank>ShrinkTheWeb</a>. You will need to obtain an <a href=http://www.shrinktheweb.com/user/register target=_blank>API key</a>.<br /> The basic service offers 5,000 image hits per month and it\'s free. If you have a busy site, you can <a href=http://www.shrinktheweb.com/content/compare-thumbnail-offerings.html target=_blank>upgrade</a> your API key.
<br /><br />Need to find your API key? See <a href=http://www.shrinktheweb.com/content/where-can-i-find-my-api-key.html target=_blank>http://www.shrinktheweb.com/content/where-can-i-find-my-api-key.html</a></p><p><p>&nbsp;</p><em>Please note MyLinks2 and it\'s creators are not affiliated with ShrinkTheWeb in any way.</em></p>';
}


function plugin_setting_api_key() {
$options = get_option('mylinks2_plugin_options');
echo "<input id='plugin_api_key' name='mylinks2_plugin_options[api_key]' size='40' type='text' value='{$options['api_key']}' />";
}

function plugin_setting_img_size() {
$items = array("mcr"=>"Micro 75x56", "tny"=>"Tiny 90x68", "vsm"=>"Very small 100x75", "sm"=>"Small 120x90", "lg"=>"Large 200x150", "xlg"=>"Extra Large 320x240");
$options = get_option('mylinks2_plugin_options');
echo "<select id='plugin_img_size' name='mylinks2_plugin_options[img_size]'>";
	foreach($items as $item=>$itemnice) {
		$selected = ($options['img_size']==$item) ? 'selected="selected"' : '';
		echo "<option value='$item' $selected>$itemnice</option>";
	}
	echo "</select>";
}


function plugin_setting_thumb_layout() {
//$items = array("Left", "Right");
$items = array("left"=>"Left Layout", "right"=>"Right Layout");
$options = get_option('mylinks2_plugin_options');
echo "<select id='plugin_thumb_layout' name='mylinks2_plugin_options[thumb_layout]'>";
	foreach($items as $item=>$itemnice) {
		$selected = ($options['thumb_layout']==$item) ? 'selected="selected"' : '';
		echo "<option value='$item' $selected>$itemnice</option>";
	}
	echo "</select>";
}


// validate our options
function plugin_options_validate($input) {
$options = get_option('mylinks2_plugin_options');
$options['api_key'] = trim($input['api_key']);
if(!preg_match('/^[a-z0-9]{6,}$/i', $options['api_key'])) {
$options['api_key'] = 'error';
}
$options['img_size'] = trim($input['img_size']);
if(!preg_match('/^[a-z0-9]{2,}$/i', $options['img_size'])) {
$options['img_size'] = 'error';
}
$options['thumb_layout'] = trim($input['thumb_layout']);
if(!preg_match('/^[a-z0-9]+$/i', $options['thumb_layout'])) {
$options['thumb_layout'] = 'error';
}

return $options;
}




