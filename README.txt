=== Plugin Name ===
Contributors: nickpp
Donate link: www.mailshogun.com
Tags: comments, spam
Requires at least: 3.0.1
Tested up to: 5.0.3
Stable tag: 5.0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Mailshogun is a very easy way to define domain emails (such as info@mywordpressdomain.com) within the Wordpress dashboard without using external services such as Gmail and Zoho. All emails are forwarded to gmail accounts, and from there users can reply with the same domain email. 

== Description ==

MailShogun is a WordPress plugin that forwards domain emails (e.g. info@mydomain.com) to any Gmail account without creating dedicated mailboxes. The plugin has a built-in free email address.
In many cases after a WordPress website has been built, there is also a need to add emails that will be branded with the same website domain.
It’s a personalized email address using your domain name. For example name@mywordpressdomain.com.

A business email address makes a great professional impression. 

Here are some options you may want to start with:
name@mywordpressdomain.com
sales@mywordpressdomain.com
contact@mywordpressdomain.com

There are several other options, however, they present some disadvantages.
There are domain registrants, such as GoDaddy, and other mail forwarding services, where, for example, info@mywordpressdomain.com will be forwarded to infomywordpressdomain@gmail.com. The limitation of these solutions, is that they are only one sided. If you want to send an email back it won’t have “yourdomain” suffix, it will be an email that comes from Gmail, which in some cases might make you look less professional. 
Other solutions include buying addresses from third party email providers. The most popular service is Gsuite by Google. If you want to have name@mywordpressdomain.com with Gsuite, you will have to open a new “company” in Gsuite and then define every address. Every address has its own storage. Limitations are – high price (around $5 per mailbox per month), and all of the definitions of these addresses are done from an eternal dashboard. Another disadvantage is that every address is a real mailbox. If employee1@mywordpressdomain.com should move to employee2@mywordpressdomain.com all past emails of 1 are staying forever in the storage of 1. It is very complicated to move these emails to another box.
Mailshogun overcomes all these disadvantages with these unique features: It is an email forwarding system, but you can also send back emails from your gmail and your customer will receive the email from your unique domain. It is a full solution in both sides. There are no inboxes for the addresses, and it is very flexible- you can open, delete, modify addresses very easily. Perhaps you have info, webmaster, contact, sales emails, you can forward all of them to one Gmail address. All mail definitions are done from the WordPress standard admin dashboard – like any other plugin. Mailshogun is also cheap, as one address is free and others are $10 per year, which is 1/6 the price of Gsuite.


== Important ==

Since Mailshogun plugin is communicating with external mail servers in order to provide its service, it means that the plugin is not independent. Make sure that your firewall or IP mapping has access to https://api.mailshogun.com.

== How it works ===
If you define one address from info@my-domain.com that will be forwarded to info-my-domain@gmail.com, this information is stored in Mailshogun servers and configure the servers accordingly. The actual forwarding is done there.
This is exactly how it works if you define Gsuite or other external email.
In addition to the communication with mailshogun servers, there is also connection to Paypal. This is optional, only if you choose to use the premium version that will allow forwarding of more addresses. The free version has 1 address.



== Installation ==

From your WordPress dashboard

Visit Plugins > Add New
Search for “mailshogun”
Install the “mailshogun” plugin
Activate “mailshogun” from your Plugins page

To setup mailshogun addresses after the plugin is activated:
go to Setting and then mailshogun

== Frequently Asked Questions ==


== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0 =
First release
