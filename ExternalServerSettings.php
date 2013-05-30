<?php

// MediaWiki4Intranet configuration base for external (WWW) installations
// (c) Stas Fomin, Vitaliy Filippov 2008-2012

set_include_path( dirname(__FILE__) . '/../extensions/php-openid' . PATH_SEPARATOR . get_include_path());

require_once(dirname(__FILE__).'/ServerSettings.php');

#$wgUsePathInfo = true;
#$wgArticlePath = "/$1";

# Для коротких URL (http://domain.com/ArticleName) нужно использовать mod_rewrite.
# Конфигурация:
#
# RewriteCond %{THE_REQUEST} ^\S+\s*/*index.php/
# RewriteRule ^index.php/(.*)$ /$1 [R=301,L,NE]
# RewriteCond %{REQUEST_FILENAME} !-f
# RewriteCond %{REQUEST_FILENAME} !-d
# RewriteRule ^(.*)$ index.php/$1 [L,B,QSA]
#
# Подробнее см. http://wiki.4intra.net/Mediawiki4Intranet, секция "Короткие URL"

require_once("$IP/extensions/OpenID/OpenID.setup.php");
$wgCookieExpiration = 30 * 86400;

//$wgGroupPermissions['*']['edit'] = false;
//$wgGroupPermissions['*']['delete'] = false;
//$wgGroupPermissions['*']['undelete'] = false;
//$wgGroupPermissions['*']['createpage'] = false;
//$wgGroupPermissions['*']['createtalk'] = false;
//$wgGroupPermissions['*']['import'] = false;
//$wgGroupPermissions['*']['importupload'] = false;
//$wgGroupPermissions['user']['delete'] = false;
//$wgGroupPermissions['user']['undelete'] = false;
//$wgGroupPermissions['user']['createpage'] = false;
//$wgGroupPermissions['user']['createtalk'] = false;
//$wgGroupPermissions['user']['movefile'] = false;
//$wgGroupPermissions['autoconfirmed']['createpage'] = true;
//$wgGroupPermissions['autoconfirmed']['createtalk'] = true;
//$wgGroupPermissions['autoconfirmed']['import'] = true;
//$wgGroupPermissions['autoconfirmed']['importupload'] = false;
//$wgGroupPermissions['sysop']['createpage'] = true;
//$wgGroupPermissions['sysop']['createtalk'] = true;
//$wgGroupPermissions['sysop']['renameuser'] = true;
//$wgGroupPermissions['bureaucrat']['createpage'] = true;
//$wgGroupPermissions['bureaucrat']['createtalk'] = true;

###### PANIC BUTTON #######
# Prevent all users from editing (only adminns and bureaucrates can edit)
# $wgGroupPermissions['user']['edit'] = false;
# Panic button: admins may lock the database
$wgGroupPermissions['sysop']['siteadmin'] = true;
$wgReadOnlyFile = 'DBLockReason';
###########################

//$wgAutoConfirmCount = 3;   # solve two captchas
//$wgAutoConfirmAge = 86400 * 2; # Four days times 86400 seconds/day
$wgEmailConfirmToEdit = true;

require_once("extensions/ListFeed/ListFeed.php");
$egListFeedFeedUrlPrefix = '/rss';
$egListFeedFeedDir = $IP.'/rss';

#require_once("extensions/SimpleAntiSpam/SimpleAntiSpam.php");
require_once("extensions/Collection/Collection.php");


#Disabling this allows for improved caching, because all anonymous visitors can then be served the exact same version of each page.
$wgShowIPinHeader = false;


## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "";
$wgRightsText = "";
$wgRightsIcon = "";


require_once("$IP/extensions/ConfirmEdit/Asirra.php");
$wgCaptchaClass = 'Asirra';
