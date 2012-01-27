=== MyLinks2 ===
Contributors: 2020media,workshopshed
Donate link: http://www.2020media.com/wordpress
Tags: thumbnail,thumbnails,thumb,screenshot,snapshot,link,links,images,image,directory,blogroll
Requires at least: 2.3
Tested up to: 3.3
Stable tag: trunk

MyLinks2 displays dynamically generated thumbnail images from your blogroll or link on a Page or Post. 

== Description ==

Displays blogroll links on a Page or Post with thumbnail images of the linked site. Also generates image for a individual link within a page. Insert `[mylinks]` to a Page or Post and it will display all your blogroll links there - with live snapshots of every page. 

Thumbnails snapshots are generated from 3rd party services. The initial generation takes up to a minute, because the server has to deliver many thumbnails at one time. Once cached (1-2minutes), the thumbnails will appear instantly.

== Installation ==

Note - if you are upgrading from 3.3 please make a note of your API key - it will not be copied to this new release!

1. Upload the mylinks.zip file using the plugin manager. 
2. Activate the plugin and go to the Settings page to select the API service, add your API key (if used) and other options. Then add the shortcode to your page/posts as follows.
3. Example: Use `[mylinks]` in your page or post to display all your links
4. Example: Use `[mylinks=categoryname]` to display just the links of the category `categoryname` in your page or post
5. Example: Use `[thumb]http://www.your-homepage.com[/thumb]` to display a thumbnail of the website `http://www.your-homepage.com` in your page or post 
6. Thats it :)

== Frequently Asked Questions ==

= Do I need a graphic software? =

No, the thumbnails are generated and hosted by 3rd party image generation services

= When will the thumbnails be generated? =

Normally, new website thumbnails will be generated in 1-5 minutes by the API. sometimes it takes (maximum) 24 hours. 

= What size do the thumbnails have? =

You can choose from 6 sizes from 75x56px to 480x380px

= How can i sort the links? =

The links are sorted by title only. So if you start the link title with "1. link title", "2. link title", "3. link title" ... - you can sort your links. 

= How can i change the layout? =

Two preset layouts are provided.
You can also change the templates in the `templates` subdirectory of the mylinks plugin. `all_links.html` is the template for all links and `one_category.html` is the template for displaying just one category.

== Screenshots ==

1. screenshot-1.jpg


== Changelog ==

= 4.5 =
Reverted to code in 4.3 after Shrinktheweb took our problem javascript

= 4.4 =
Temporary fix for ShrinktheWeb javascript bug affecting Admin menu

= 4.3 =
Fixed image size problem in category display (thanks gluggy)

= 4.2 =
Updated documentation and added default behavior so works without any configuration

= 4.1 =
Fixed 'headers already sent error'

= 4.0 =
Support added for thumbnail generation service, pagepeeker.com

= 3.7 =
Remove of urlencode of urls as STW Javascript doesn't like them

= 3.6 =
* fixed errors introduced in 3.5

= 3.5 = 
* recoded image getting function after API changes at ShrinktheWeb

= 3.4 =
* Fixed function name clash
* Added choice of sizes
* Added additonal layout choice
* Rewrote options page (unfortunately this meant existing API keys need to be re-entered.

= 3.3 =
* First release by 2020Media


== CHANGE LAYOUT ==

Just change the templates in the `templates` subdirectory of the mylinks plugin. `all_links.html` is the template for all links and `one_category.html` is the template for displaying just one category.


