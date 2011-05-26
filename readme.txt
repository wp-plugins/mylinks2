=== MyLinks2 - The link directory with automatical thumbnail generation ===
Plugin Name: mylinks2
Plugin URI: http://www.2020media.com/mylinks
Description: Displays blogroll links on a Page or Post. Insert `[mylinks]` or `[mylinks=categoryname]` to a Page or Post and it will display all your blogroll links there - with live thumbnails of every link. 
Version: 3.3
Author: Original by Sascha Ende. Updated by R Wickham 2011
Author URI: http://www.2020media.com
Min WP Version: 2.3
Tags: thumbnail,thumbnails,thumb,screenshot,snapshot,link,links,images,image,directory,blogroll
Requires at least: 2.3
Tested up to: 3.2
Stable tag: trunk
Contributors: endemedia,workshopshed,2020media
Donate link: http://www.2020media.com
License: GPLv2 or later

Displays dynamically generated blogroll thumbnail images on a Page or Post. 

== Description ==

Displays blogroll links on a Page or Post. Insert `[mylinks]` to a Page or Post and it will display all your blogroll links there- with live snapshots of every page. Very nice too look!

Only 1-2 Minutes and the thumbnails snapshots are generated. The initial generation takes some time, because the server has to deliver many thumbnails at one time. Once cached (1-2minutes), the thumbnails will appear instantly.

== TODO == 

1. Create a cache of the image.
2. allow editing of the thumbnail size (preset by www.shrinktheweb.com)

== INSTALLATION ==

1. Upload the mylinks.zip file using the plugin manager. 
2. Activate the plugin and add your API key in the My Links option under Settings. Then add the shortcode to your page/posts.
3. Example: Use `[mylinks]` in your page or post to display all your links
4. Example: Use `[mylinks=categoryname]` to display just the links of the category `categoryname` in your page or post
5. Example: Use `[thumb]http://www.your-homepage.com[/thumb]` to display a thumbnail of the website `http://www.your-homepage.com` in your page or post 
6. Thats it :) You just have to update your wordpress links.

== CHANGE LAYOUT ==

Just change the templates in the `templates` subdirectory of the mylinks-plugin: `all_links.html` is the template for displaying all links and `one_category.html` is the template for displaying just one category. I think its easy to understand how it works :)


== Changelog ==

= 3.3 = 
* First release of rebuilt plugin by 2020Media

== Upgrade Notice ==

= 3.3 = 
* Fixes problems in original mylinks plugin

== Frequently Asked Questions ==

= Do I need a graphic software? =

No, the thumbnails are generated and hosted by `http://www.shrinktheweb.com`.

= When will the thumbnails be generated? =

Normally, new website thumbnails will be generated in 1-5 minutes by www.shrinktheweb.com... sometimes it takes (maximum) 24 hours. If they dont appear, you have given a wrong link, the website could not be reached or its just toooooooo slow :)

= Do i have to upload pictures? =

No, only use the tag [mylinks] in the editor

= What size do the thumbnails have? =

width: 320 and height: 240

= Does my link open in a new window? =

Yes the link on the thumbnail opens in a new window with target _blank

= How can i sort the links? =

The links are sorted by title only. So if you start the link title with "1. link title", "2. link title", "3. link title" ... - you can sort your links. 

= How can i change the layout? =

Just change the templates in the `templates` subdirectory of the mylinks plugin. `all_links.html` is the template for all links and `one_category.html` is the template for displaying just one category.

= Can i ask the author something? =

Yes

== Screenshots ==

screenshot-1.jpg