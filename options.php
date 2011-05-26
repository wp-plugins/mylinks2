<?php
/* thanks to http://codehunterbd.wordpress.com/2010/10/30/how-to-write-a-wordpress-plugin/  for the tutorial in writing this options section */

/* Runs when plugin is activated */
register_activation_hook(__FILE__,'my_links_install');

/* Runs on plugin deactivation*/
register_deactivation_hook(__FILE__,'my_links_remove');

function my_links_install() {
/* Creates new database field */
add_option("my_links_data", 'Default', '', 'yes');
}

function my_links_remove() {
/* Deletes the database field */
delete_option('my_links_data');
}





if ( is_admin() ){

/* Call the html code */
add_action('admin_menu', 'my_links_admin_menu');

function my_links_admin_menu() {
add_options_page('My Links', 'My Links', 'administrator',
'mylinks', 'my_links_html_page');
}
}


function my_links_html_page() {
?>
<div>
<h2>My Links Options</h2>
<p>&nbsp;</p>
<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>

<table width="100%">
<tr valign="top">
<th width="200" scope="row"><a href=http://www.shrinktheweb.com target=_blank>ShrinktheWeb</a> API key:</th>
<td width="406">
<input name="my_links_data" type="text" id="my_links_data"
value="<?php echo get_option('my_links_data'); ?>" />
<br />(See <a href=http://www.shrinktheweb.com/content/where-can-i-find-my-api-key.html target=_blank>http://www.shrinktheweb.com/content/where-can-i-find-my-api-key.html</a>)</td>
</tr>
</table>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="my_links_data" />

<p>
<input type="submit" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div>
<?php
}




