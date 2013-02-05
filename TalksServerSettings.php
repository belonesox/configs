<?php
// MediaWiki4Intranet configuration base for special (seminars/conferences/talks directory).
// (c) Stas Fomin 2013

setlocale(LC_ALL, 'ru_RU.UTF-8');
setlocale(LC_NUMERIC, 'C');

if (defined('MW_INSTALL_PATH'))
    $IP = MW_INSTALL_PATH;
else
{
    foreach (debug_backtrace() as $frame)
        if (strtolower(substr($frame['file'], -strlen('LocalSettings.php'))) == 'localsettings.php')
            $IP = realpath(dirname($frame['file']));
    if (!$IP)
        $IP = realpath(dirname(__FILE__) . '/..');
}

$path = array($IP, "$IP/includes", "$IP/includes/specials","$IP/languages");
set_include_path(implode(PATH_SEPARATOR, $path) . PATH_SEPARATOR . get_include_path());

require_once($IP . '/includes/DefaultSettings.php');
$wgSitename         = "TalksWiki";

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
$wgScriptPath       = "/wiki";
$wgScriptExtension  = ".php";

$wgEnableEmail      = false;
$wgEnableUserEmail  = false;

$wgDBtype           = "mysql";
$wgDBserver         = "localhost";

$wgDBname           = "wiki";
$wgDBuser           = "wiki";
$wgDBpassword       = "wiki";
$wgDBadminuser      = "wiki";
$wgDBadminpassword  = "wiki";

$wgDBprefix         = "";

$wgDBTableOptions   = "ENGINE=InnoDB, DEFAULT CHARSET=utf8";
$wgDBmysql5         = true;

$wgEnableUploads    = true;

$wgLocalInterwiki   = $wgSitename;
$wgLocaltimezone    = "Europe/Moscow";

$wgRightsPage = "";
$wgRightsUrl = "";
$wgRightsText = "";
$wgRightsIcon = "";
$wgRightsCode = "";

$wgDiff3 = "diff3";
$wgImageMagickConvertCommand = "convert";

# When you make changes to this configuration file, this will make
# sure that cached pages are cleared.
$wgCacheEpoch = max( $wgCacheEpoch, gmdate( 'YmdHis', @filemtime( __FILE__ ) ) );
$wgMainCacheType = empty( $_SERVER['SERVER_NAME'] ) ? CACHE_NONE : CACHE_ACCEL;
$wgParserCacheType = $wgMessageCacheType = $wgMainCacheType;
$wgMemCachedServers = array();

$wgRawHtml = true;
$wgAllowUserJs = true;
$wgUseAjax = true;

$wgFileExtensions = array(
    'png', 'gif', 'jpg', 'jpeg', 'svg',
    'zip', 'rar', '7z', 'gz', 'bz2', 'xpi',
    'doc', 'docx', 'ppt', 'pptx', 'pps', 'ppsx', 'xls', 'xlsx', 'vsd',
    'djvu', 'pdf', 'xml', 'mm'
);

$wgAllowCopyUploads     = true;
$wgStrictFileExtensions = false;

array_push($wgUrlProtocols,"file://");
$wgLanguageCode = "ru";

$wgSMTP = false;
$wgShowExceptionDetails = true;

require_once($IP.'/extensions/ParserFunctions/ParserFunctions.php');
$wgPFStringLengthLimit = 4000;
$wgPFEnableStringFunctions = true;
require_once($IP.'/extensions/RegexParserFunctions/RegexParserFunctions.php');
require_once($IP.'/extensions/Cite/Cite.php');
require_once($IP.'/extensions/SyntaxHighlight_GeSHi/SyntaxHighlight_GeSHi.php');

$wgGroupPermissions['*']['interwiki'] = false;
$wgGroupPermissions['sysop']['interwiki'] = true;
$wgGroupPermissions['sysop']['override-export-depth'] = true;

require_once($IP.'/extensions/Interwiki/Interwiki.php');

require_once($IP.'/extensions/DocExport/DocExport.php');
require_once($IP.'/extensions/BatchEditor/BatchEditor.php');
require_once($IP.'/extensions/MarkupBabel/MarkupBabel.php');
require_once($IP.'/extensions/DeleteBatch/DeleteBatch.php');
require_once($IP.'/extensions/FullLocalImage/FullLocalImage.php');

require_once($IP.'/extensions/MMHandler/MMHandler.php');
/* for mindmap uploads */
$wgForbiddenTagsInUploads = array('<object', '<param', '<embed', '<script');

require_once($IP.'/extensions/PagedTiffHandler/PagedTiffHandler.php');
unset($wgAutoloadClasses['PagedTiffHandlerSeleniumTestSuite']);

require_once($IP.'/extensions/Mp3Handler/Mp3Handler.php');

require_once($IP.'/extensions/Dia/Dia.php');

$wgAllowCategorizedRecentChanges = true;
$wgFeedLimit = 500;

require_once($IP.'/extensions/AllNsSuggest/AllNsSuggest.php');
require_once($IP.'/extensions/NewPagesEx/NewPagesEx.php');
require_once($IP.'/extensions/SimpleTable/SimpleTable.php');
require_once($IP.'/extensions/MagicNumberedHeadings/MagicNumberedHeadings.php');
require_once($IP.'/extensions/MediaFunctions/MediaFunctions.php');
require_once($IP.'/extensions/AllowGetParamsInWikilinks/AllowGetParamsInWikilinks.php');
    require_once($IP.'/extensions/UserMagic/UserMagic.php');
require_once($IP.'/extensions/S5SlideShow/S5SlideShow.php');
require_once($IP.'/extensions/PlantUML/PlantUML.php');
require_once($IP.'/extensions/Polls/poll.php');
require_once($IP.'/extensions/Shortcuts/Shortcuts.php');
require_once($IP.'/extensions/RemoveConfidential/RemoveConfidential.php');
require_once($IP.'/extensions/CustomToolbox/CustomToolbox.php');
require_once($IP.'/extensions/CustomSidebar/CustomSidebar.php');
require_once($IP.'/extensions/FavRate/FavRate.php');
require_once($IP.'/extensions/SlimboxThumbs/SlimboxThumbs.php');
require_once($IP.'/extensions/CategoryTree/CategoryTree.php');


# FlvHandler
# FlvHandler
require_once($IP.'/extensions/FlvHandler/FlvHandler.php');

# MWQuizzer
require_once($IP.'/extensions/mediawikiquizzer/mediawikiquizzer.php');
$egMWQuizzerIntraACLAdminGroup = 'Group/QuizAdmin';
MediawikiQuizzer::setupNamespace(104);

# Namespaces with subpages
$wgNamespacesWithSubpages += array(
    NS_MAIN     => true,
    NS_PROJECT  => true,
    NS_TEMPLATE => true,
    NS_HELP     => true,
    NS_CATEGORY => true,
    NS_QUIZ     => true,
    NS_QUIZ_TALK => true,
);

# TemplatedPageList
require_once($IP.'/extensions/TemplatedPageList/TemplatedPageList.php');
$egSubpagelistAjaxDisableRE = '#^Блог:[^/]*$#s';

$wgMaxFilenameLength = 50;
$wgGalleryOptions['captionLength'] = 50; // 1.18

$wgSVGConverter = "inkscape";
$wgUseImageMagick = false;
$wgGDAlwaysResample = true;

require_once($IP . '/includes/GlobalFunctions.php');
if (wfIsWindows())
{
    $wgSVGConverterPath = realpath($IP."/../../app/inkscape/");
    $wgDIAConverterPath = realpath($IP."/../../app/dia/bin/");
    //$wgImageMagickConvertCommand = realpath($IP."/../../app/imagemagick")."/convert.exe";
    // Bug 48216 - Transliterate cyrillic file names of uploaded files
    $wgTransliterateUploadFilenames = true;
    $wgSphinxQL_host = '127.0.0.1';
    $wgSphinxQL_port = '9306';
    $wgZip = realpath("$IP/../../app/zip/zip.exe");
    $wgUnzip = realpath("$IP/../../app/zip/unzip.exe");
    $wgParserCacheType = $wgMessageCacheType = $wgMainCacheType = CACHE_DB;
}

$wgCookieExpiration = 3650 * 86400;

$wgLogo    = "$wgScriptPath/configs/logos/wiki4intranet-logo.png";
$wgFavicon = "$wgScriptPath/configs/favicons/wiki4intranet.ico";

$wgDebugLogFile = false;

$wgDefaultSkin = 'talks';

$wgGroupPermissions['*']['edit'] = false;

$wgSphinxTopSearchableCategory = "Root";

$wgNamespacesToBeSearchedDefault = array(
    NS_MAIN => 1,
    NS_USER => 1,
    NS_FILE => 1,
    NS_HELP => 1,
    NS_CATEGORY => 1,
);

$wgShellLocale = 'ru_RU.UTF-8';

$wgNoCopyrightWarnings = true;

$wgEnableMWSuggest     = true;
$wgOpenSearchTemplate  = true;

// Don't purge recent changes... (keep them for 50 years)
$wgRCMaxAge = 50 * 365 * 86400;

$wgGroupPermissions['user']['delete'] = true;
$wgGroupPermissions['user']['undelete'] = true;
$wgGroupPermissions['user']['movefile'] = true;
$wgGroupPermissions['user']['upload_by_url'] = true;
$wgGroupPermissions['user']['import'] = true;
$wgGroupPermissions['user']['importupload'] = true;
$wgGroupPermissions['sysop']['deletebatch'] = true;

// Default settings for Sphinx search
$wgSphinxSearch_weights = array('page_title' => 2, 'old_text' => 1);
$wgSphinxSearch_matches = 20;
$wgSphinxMatchAll = 1;
$wgSphinxSuggestMode = true;

$wgMaxImageArea = 5000*5000;

// Allow all ?action=raw content types
$wgAllowedRawCTypes = true;

// Also display categories on the top of page
$wgCatlinksTop = true;

// Use "wikipedia-like" search box in Vector skin
$wgDefaultUserOptions['vector-simplesearch'] = true;
$wgVectorUseSimpleSearch = true;

$wgEmergencyContact    = "stas-fomin@yandex.ru";
$wgPasswordSender      = "stas-fomin@yandex.ru";

$wgAllowExternalImages     = true;

// Bug 57350 - PDF and Djvu (UNIX only)
require_once($IP.'/extensions/PdfHandler/PdfHandler.php');

$wgDjvuDump = "djvudump";
$wgDjvuRenderer = "ddjvu";
$wgDjvuTxt = "djvutxt";
$wgDjvuPostProcessor = "ppmtojpeg";
$wgDjvuOutputExtension = 'jpg';

$wgPdfProcessor = 'nice -n 20 gs';
$wgPdftoText = ''; // it's useless, disable
$wgPdfCreateThumbnailsInJobQueue = true;
$wgPdfDpiRatio = 2;

$wgDiff3 = '/usr/bin/diff3';

// Bug 82496 - enable scary (cross-wiki) transclusions
$wgEnableScaryTranscluding = true;

// Bug 107222 - TikaMW. TODO: enable also on Windows along with Sphinx
require_once($IP.'/extensions/TikaMW/TikaMW.php');

$wgScriptPath = '';
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

$wgGroupPermissions['*']['edit'] = false;
$wgGroupPermissions['*']['delete'] = false;
$wgGroupPermissions['*']['undelete'] = false;
$wgGroupPermissions['*']['createpage'] = false;
$wgGroupPermissions['*']['createtalk'] = false;
$wgGroupPermissions['*']['import'] = false;
$wgGroupPermissions['*']['importupload'] = false;
$wgGroupPermissions['user']['delete'] = false;
$wgGroupPermissions['user']['undelete'] = false;
$wgGroupPermissions['user']['createpage'] = false;
$wgGroupPermissions['user']['createtalk'] = false;
$wgGroupPermissions['user']['movefile'] = false;
$wgGroupPermissions['autoconfirmed']['createpage'] = true;
$wgGroupPermissions['autoconfirmed']['createtalk'] = true;
$wgGroupPermissions['autoconfirmed']['import'] = true;
$wgGroupPermissions['autoconfirmed']['importupload'] = false;
$wgGroupPermissions['sysop']['createpage'] = true;
$wgGroupPermissions['sysop']['createtalk'] = true;
$wgGroupPermissions['bureaucrat']['createpage'] = true;
$wgGroupPermissions['bureaucrat']['createtalk'] = true;
$wgGroupPermissions['*']['createaccount'] = false;
$wgGroupPermissions['*']['edit'] = false;

$wgAutoConfirmAge = 86400 * 4; # Four days times 86400 seconds/day



require_once("extensions/ListFeed/ListFeed.php");
$egListFeedFeedUrlPrefix = '/rss';
$egListFeedFeedDir = $IP.'/rss';
