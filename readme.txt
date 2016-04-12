=== WP Push Notification ===
Contributors: avianstudio
Tags: push notification, offline notification, pushpad, automatic push notification, bloggers, news, subscribers, subscribe, push notification for WordPress, wp push notification, WordPress push notification
Requires at least: 4.4.2
Tested up to: 4.4.2
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Free WordPress plugin that helps you deliver fresh written content by push notifications directly to your subscribers.

== Description ==

WP Push Notification is a WordPress plugin dedicated to bloggers which helps subscribed readers to find out about the new articles even when they are not on the website. It is a click away distance until your readers get a push notification in their browser. WP Push Notification is a free plugin based on the Pushpad.xyz project.
You can manually send notifications by choosing the title, description and URL to be sent to the subscribers.

Automatic notifications
Just a checkbox away from sending automated notifications for each post you publish. You just have to focus on writing great content. 

It works with all browsers that support push notifications, Safari, Chrome and Firefox. The users don't need to install any app or extension in order to receive the notification. 

The parameters are:

- title (string) max 30 characters
- description (string) max 90 characters
- URL (string) http:// required

Widget available - WPN Push Button
Shortcode available - [wpn-button description="Get notifications" button_text="Subscribe" ]

== Installation ==

Use WordPress' Add New Plugin feature, searching "WP Push Notification", or download the archive and:

Unzip the archive on your computer
Upload wp-push-notification directory to the /wp-content/plugins/ directory
Activate the plugin through the 'Plugins' menu in WordPress
Go to WP Push Notification Menu and setup the AUTH Token and Project ID from https://pushpad.xyz/users/edit
Add the widget (WPN Push Button) with the subscription button in a visible place to get lots of subscribers or use the shortcode [wpn-button description="Get notifications" button_text="Subscribe" ] and be creative.

== Frequently Asked Questions ==

The plugin doesn't work or widget is not showing, why?
Please check if you have correctly added the AUTH Token and Project ID from https://pushpad.xyz/users/edit/. The plugin is not supposed to work without these two pieces of information. Everything should work fine if these are set up fine.

Do i need a SSL certification on my website?
No, don't worry about that.

I cannot find automatic sending settings?
You have a checkbox on the edit post page that you need to check before you go live with the new article. In the plugin settings you can find the title used by these notifications.

== Changelog ==

v 1.0.0 Initial Release