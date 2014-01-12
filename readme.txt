=== Cartograf Cookie filter ===

Contributors: versvs, dmikam
Donate link: http://example.com/
Tags: cookie law, eu, european union, cookie control, spain, spanish cookie law
Requires at least: 3.6
Tested up to: 3.8.1
Stable tag: 1.0
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Prevents the installation of tracking cookies without the informed consent of the visitor. Spanish Cookie law compliant.

== Description ==

This plugin allows site builders to comply with the spanish cookie law, that regulates the use of tracking cookies in websites according to the EU directive.

Note that this is important as one of the first countries to introduce this regulation after the EU directive was emitted was UK. But the UK law has some differences with the spanish regarding "informed consent" of the visitor, thus cookies needs to be treated a bit differently.

This plugin allows the user to insert code (typically, javascript code) in both header and footer and for two different cases (cookie accepted, cookie not accepted). It also provides HTML id and classes that enable easy customization.

The development and manteniance of this plugin is sponsored by [Cartograf](http://www.cartograf.net)


== Installation ==

You may install this plugin following the next steps:

1. Download the ZIP file.
2. Unzip the file and upload the newly created folder with its contents to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Go to the settings page for this plugin and configure all that you need: message to be shown, scripts to be inserted on cookie acceptance (typically, your Google Analytics code, or similar, goes here) in header OR footer, cookie acceptance criteria (timeout, scrollout) and a list of pages or posts containing extra information about cookies and thus to be treated as an exception.

== Frequently Asked Questions ==

= Is this plugin suited for building sites according to the spanish cookie law? =

Yes, it is.

= How can I customize the cookie bar? =

The plugin provides both html ID and classes to help themers. We plan to allow easy color config in next versions.


== Screenshots ==

1. Soon to be available screenshot.

== Changelog ==

= 1.0 =
* First stable release.
* Included settings page.
* Included slug exceptions.
* Both timeout and scrollout acceptance of the cookies are now considered.

= 0.5 =
* Now saving options as WP options.

= 0.1 =
* Initial commit.


== Upgrade Notice ==

= 1.0 =
* Overwrite previous version of the plugin.


== About Cartograf ==

The development of this plugin has been funded by [Cartograf](http://www.cartograf.net), a consultancy company specialized in free software based in Madrid.
