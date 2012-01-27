<?php

/*
Plugin Name: MyLinks2
Plugin URI: http://www.2020media.com/mylinks
Description: Displays image thumbnails of blogroll links on a Page or Post. Insert `[mylinks]` to a Page or Post and it will display all your blogroll links there - with live snapshots of every page. Example 1: Use `[mylinks]` in your page or post to display all your links. Example 2: Use `[mylinks=slugname]` to display just the links of the category `slugname` in your page or post. Example 3: Use `[thumb]http://www.your-homepage.com[/thumb]` to display a thumbnail of the website `http://www.your-homepage.com` in your page or post. This plugin offers a choice of thumbnail API. Some APIs require a (free for low use) an API key. Enter it in the MyLinks2 section under Settings.
Version: 4.5
Author: 2020Media.com
Author URI: http://www.2020media.com/
Min WP Version: 2.3
Tags: thumbnail,thumbnails,thumb,screenshot,snapshot,link,links,images,image,directory,blogroll
Requires at least: 2.3
Tested up to: 3.3
Stable tag: trunk
License: GPLv2 or later
Contributors: 2020media,workshopshed
Donate link: http://www.2020media.com/wordpress
*/

// include options.php for the admin menu
include_once dirname( __FILE__ ) . '/options.php';



wp_enqueue_script('shrinktheweb', 'http://www.shrinktheweb.com/scripts/pagepix.js');


add_filter('the_content','getMyLinks');

add_action('wp_print_styles', 'add_mylinks2_stylesheet');


function add_mylinks2_stylesheet() {
		$myl2StyleUrl = plugins_url('/templates/mylinks.css', __FILE__ );
		$myl2StyleFile = dirname(__FILE__) .'/templates/mylinks.css';
        if ( file_exists($myl2StyleFile) ) {
            wp_register_style('myl2StyleSheets', $myl2StyleUrl);
            wp_enqueue_style( 'myl2StyleSheets');
        }
    }




function getMyLinks($content) {

	global $wpdb, $table_prefix;

		# get mylinks2 options from db
//		$options = get_option('mylinks2_plugin_options');
// Set defaults in case no options chosen
		$defaults = array(
		  'api_key' => "",
		  'img_size' => "xlg",
		  'api_service' => "PP",
		  'thumb_layout' => "right",
		);
$options = wp_parse_args(get_option('mylinks2_plugin_options'), $defaults);

	if(strpos($content,'[mylinks]') === false){

		return $content;

	}else{

		$res = '';

	$stmt = "	SELECT lin.*, ter.slug, ter.name as categoryname
				FROM ".$wpdb->term_relationships." as rel

				LEFT JOIN ".$wpdb->term_taxonomy." as tax
				ON rel.term_taxonomy_id = tax.term_taxonomy_id

				LEFT JOIN ".$wpdb->links." as lin
				ON rel.object_id = lin.link_id

				LEFT JOIN ".$wpdb->terms." as ter
				ON tax.term_id = ter.term_id

				WHERE tax.taxonomy = 'link_category'
				AND	lin.link_visible = 'Y'

				ORDER BY ter.slug ASC, lin.link_name ASC";

		$sqlres = $wpdb->get_results($stmt);

		# Load Template
		if ($options['thumb_layout']=="left"){
		$tpl = file_get_contents(dirname(__FILE__).'/templates/all_links.html');
}
else {
		$tpl = file_get_contents(dirname(__FILE__).'/templates/all_links2.html');
		};

		# Get Link Part from Template
		preg_match("/\<\!\-\-category\:start\-\-\>(.*?)\<\!\-\-category\:stop\-\-\>/sim",$tpl,$categoryparts);
		preg_match("/\<\!\-\-link\:start\-\-\>(.*?)\<\!\-\-link\:stop\-\-\>/sim",$tpl,$tplparts);



		$last_term = null;

		# Parse now the results...
		foreach($sqlres as $link){

			switch ($options['api_service']) {
				case STW:

			# Category?
			if($link->categoryname != $last_term){
				$res .= str_replace('{category}',$link->categoryname,$categoryparts[1]);
				$last_term = $link->categoryname;
			}

			$REPLACE = array(
				'{image}',
				'{link_name}',
				'{link_description}',
				'{link_url}'
			);

			$REPLACE_WITH = array(
		         '<script type="text/javascript"> stw_pagepix("'.($link->link_url).'", "'.$options['api_key'].'", "'.$options['img_size'].'"); </script>',
				$link->link_name,
				$link->link_description,
				$link->link_url
			);

			$res .= str_replace($REPLACE,$REPLACE_WITH,$tplparts[1]);

				break;
				case PP:
					switch ($options['img_size']) {
						case mcr:
							$options['img_size']="t";
							break;
						case tny:
							$options['img_size']="t";
							break;
						case vsm:
							$options['img_size']="s";
							break;
						case sm:
							$options['img_size']="m";
							break;
						case lg:
							$options['img_size']="l";
							break;
						case xlg:
							$options['img_size']="x";
							break;
						}

			# Category?
			if($link->categoryname != $last_term){
				$res .= str_replace('{category}',$link->categoryname,$categoryparts[1]);
				$last_term = $link->categoryname;
			}

			$REPLACE = array(
				'{image}',
				'{link_name}',
				'{link_description}',
				'{link_url}'
			);

			$REPLACE_WITH = array(
                '<img src=http://pagepeeker.com/thumbs.php?size='.($options['img_size']).'&url='.($link->link_url).' border=0>',
				$link->link_name,
				$link->link_description,
				$link->link_url
			);

			$res .= str_replace($REPLACE,$REPLACE_WITH,$tplparts[1]);

			break;
			default:
                               case PP:
                                        switch ($options['img_size']) {
                                                case mcr:
                                                        $options['img_size']="t";
                                                        break;
                                                case tny:
                                                        $options['img_size']="t";
                                                        break;
                                                case vsm:
                                                        $options['img_size']="s";
                                                        break;
                                                case sm:
                                                        $options['img_size']="m";
                                                        break;
                                                case lg:
                                                        $options['img_size']="l";
                                                        break;
                                                case xlg:
                                                        $options['img_size']="x";
                                                        break;
						default:
                                                       $options['img_size']="x";
                                                        break;
                                                }

                        # Category?
                        if($link->categoryname != $last_term){
                                $res .= str_replace('{category}',$link->categoryname,$categoryparts[1]);
                                $last_term = $link->categoryname;
                        }

                        $REPLACE = array(
                                '{image}',
                                '{link_name}',
                                '{link_description}',
                                '{link_url}'
                        );

                        $REPLACE_WITH = array(
                '<img src=http://pagepeeker.com/thumbs.php?size='.($options['img_size']).'&url='.($link->link_url).' border=0>',
                                $link->link_name,
                                $link->link_description,
                                $link->link_url
                        );

                        $res .= str_replace($REPLACE,$REPLACE_WITH,$tplparts[1]);

                        break;
			}

		}

		$tpl = str_replace(array($tplparts[0],$categoryparts[0]),array($res,''),$tpl);

		return str_replace('[mylinks]',$tpl,$content);
	}
}

##############################################################################################################
# Get thumbnails by category
##############################################################################################################

add_filter('the_content','getMyLinksByCategory');

function getMyLinksByCategory($content){
	return 	preg_replace_callback('/\[mylinks=(.*?)\]/sim','getMyLinksByCategoryCallback',$content);
}

function getMyLinksByCategoryCallback($matches){

	global $wpdb, $table_prefix;

	$stmt = "	SELECT lin.*, ter.slug, ter.name
				FROM ".$wpdb->term_relationships." as rel

				LEFT JOIN ".$wpdb->term_taxonomy." as tax
				ON rel.term_taxonomy_id = tax.term_taxonomy_id

				LEFT JOIN ".$wpdb->links." as lin
				ON rel.object_id = lin.link_id

				LEFT JOIN ".$wpdb->terms." as ter
				ON tax.term_id = ter.term_id

				WHERE tax.taxonomy = 'link_category'
				AND (ter.slug = '".$matches[1]."' OR	ter.name = '".$matches[1]."')
				AND	lin.link_visible = 'Y'

				ORDER BY lin.link_name ASC";

	$sqlres = $wpdb->get_results($stmt);

		# get mylinks2 options from db
		$options = get_option('mylinks2_plugin_options');

	if(count($sqlres) >= 1){

		$res = '';

		# Load Template
		if ($options['thumb_layout']=="left"){
		$tpl = file_get_contents(dirname(__FILE__).'/templates/one_category.html');
}
else {
		$tpl = file_get_contents(dirname(__FILE__).'/templates/one_category_2.html');
		};


		# Get Link Part from Template
		preg_match("/\<\!\-\-link\:start\-\-\>(.*?)\<\!\-\-link\:stop\-\-\>/sim",$tpl,$tplparts);

		# Parse now the results...
		foreach($sqlres as $link){

		switch ($options['api_service']) {
			case STW:

			$REPLACE = array(
				'{image}',
				'{link_name}',
				'{link_description}',
				'{link_url}'
			);

			$REPLACE_WITH = array(
                '<script type="text/javascript"> stw_pagepix("'.($link->link_url).'", "'.$options['api_key'].'", "'.$options['img_size'].'"); </script>',
				$link->link_name,
				$link->link_description,
				$link->link_url
			);

			$res .= str_replace($REPLACE,$REPLACE_WITH,$tplparts[1]);

			break;
			case PP:
					switch ($options['img_size']) {
						case mcr:
							$options['img_size']="t";
							break;
						case tny:
							$options['img_size']="t";
							break;
						case vsm:
							$options['img_size']="s";
							break;
						case sm:
							$options['img_size']="m";
							break;
						case lg:
							$options['img_size']="l";
							break;
						case xlg:
							$options['img_size']="x";
							break;
						}
			$REPLACE = array(
				'{image}',
				'{link_name}',
				'{link_description}',
				'{link_url}'
			);

			$REPLACE_WITH = array(
                '<img src=http://pagepeeker.com/thumbs.php?size='.($options['img_size']).'&url='.($link->link_url).' border=0>',
				$link->link_name,
				$link->link_description,
				$link->link_url
			);

			$res .= str_replace($REPLACE,$REPLACE_WITH,$tplparts[1]);
			break;
			default:
                        case PP:
                                        switch ($options['img_size']) {
                                                case mcr:
                                                        $options['img_size']="t";
                                                        break;
                                                case tny:
                                                        $options['img_size']="t";
                                                        break;
                                                case vsm:
                                                        $options['img_size']="s";
                                                        break;
                                                case sm:
                                                        $options['img_size']="m";
                                                        break;
                                                case lg:
                                                        $options['img_size']="l";
                                                        break;
                                                case xlg:
                                                        $options['img_size']="x";
                                                        break;
                                                }
                        $REPLACE = array(
                                '{image}',
                                '{link_name}',
                                '{link_description}',
                                '{link_url}'
                        );

                        $REPLACE_WITH = array(
                '<img src=http://pagepeeker.com/thumbs.php?size='.($options['img_size']).'&url='.($link->link_url).' border=0>',
                                $link->link_name,
                                $link->link_description,
                                $link->link_url
                        );

                        $res .= str_replace($REPLACE,$REPLACE_WITH,$tplparts[1]);
                        break;
			}

		}

		$tpl = str_replace($tplparts[0],$res,$tpl);

		return $tpl;
	}else{
		return '';
	}

}

########################################################################################
# Add one Thumb to the content
########################################################################################

add_filter('the_content','getMyLinksThumb');

function getMyLinksThumb($content) {
 	return preg_replace_callback("/\[thumb\](.*?)\[\/thumb\]/sim","getMyLinksThumbCallBack",$content);
}

function getMyLinksThumbCallBack($content){
		# get mylinks2 options from db
		$options = get_option('mylinks2_plugin_options');
		switch ($options['api_service']) {
			case STW:
	return '<script type="text/javascript"> stw_pagepix("'.$content[1].'", "'.$options['api_key'].'", "'.$options['img_size'].'"); </script>';

				break;

			case PP:
				switch ($options['img_size']) {
					case mcr:
						$options['img_size']="t";
						break;
					case tny:
						$options['img_size']="t";
						break;
					case vsm:
						$options['img_size']="s";
						break;
					case sm:
						$options['img_size']="m";
						break;
					case lg:
						$options['img_size']="l";
						break;
					case xlg:
						$options['img_size']="x";
						break;
					default:
                                               $options['img_size']="x";
                                                break;
					}
$imgsrc= "<img src=\"http://pagepeeker.com/thumbs.php?size=" .$options['img_size']."&url=" .$content[1]. "\" border=\"0\">";
				return $imgsrc;
				break;
                        default:
                                switch ($options['img_size']) {
                                        case mcr:
                                                $options['img_size']="t";
                                                break;
                                        case tny:
                                                $options['img_size']="t";
                                                break;
                                        case vsm:
                                                $options['img_size']="s";
                                                break;
                                        case sm:
                                                $options['img_size']="m";
                                                break;
                                        case lg:
                                                $options['img_size']="l";
                                                break;
                                        case xlg:
                                                $options['img_size']="x";
                                        	break;
					default:
                                               $options['img_size']="x";
                                                break;
                                        }
$imgsrc= "<img src=\"http://pagepeeker.com/thumbs.php?size=" .$options['img_size']."&url=" .$content[1]. "\" border=\"0\">";
                                return $imgsrc;
                                break;
				}


}
?>
