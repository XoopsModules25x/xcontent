<?php

/*
Module: xContent

Version: 2.01

Description: Multilingual Content Module with tags and lists with search functions

Author: Written by Simon Roberts aka. Wishcraft (simon@chronolabs.coop)

Owner: Chronolabs

License: See /docs - GPL 2.0
*/


	// XOOPS VERSION
	
	// DO NOT CHANGE - HEADER INFORMATION
	define('_XCONTENT_MODULENAME', 'Multilingual Content Module');
	define('_XCONTENT_VERSION', 2.17);
	define('_XCONTENT_AUTHOR', 'Written by Simon Roberts aka. Wishcraft');
	define('_XCONTENT_OWNER', 'Chronolabs');
	define('_XCONTENT_CONTACT', 'All inquiries regarding the module can be sent to simon@chronolabs.coop');
	define('_XCONTENT_DESCRIPTION', 'Advanced Multilingual Content Module');
	define('_XCONTENT_LICENSE', 'GPL 2.0 - See /docs/LICENCE');
	define('_XCONTENT_OFFICIAL', true);
	define('_XCONTENT_LOGOIMAGE', 'images/xcontent_slogo.png');
	define('_XCONTENT_DIRNAME', 'xcontent');
	define('_XCONTENT_SQLFILE_MYSQL', 'sql/mysql.sql');

	// MAINTENANCE ACtioNS
	define('_XCONTENT_INSTALL', 'include/install.php');
	define('_XCONTENT_UNINSTALL', 'include/uninstall.php');
	define('_XCONTENT_UPDATE', 'include/update.php');
	
	// MENUs
	define('_XCONTENT_XCONTENT_ADMENU1', 'Manage Content');
	define('_XCONTENT_XCONTENT_ADMENU2', 'Add Content');
	define('_XCONTENT_XCONTENT_ADMENU3', 'Manage Categories');
	define('_XCONTENT_XCONTENT_ADMENU4', 'Add Category');
	define('_XCONTENT_XCONTENT_ADMENU5', 'Linked Blocks');
	define('_XCONTENT_XCONTENT_ADMENU6', 'Add Linked Block');
	define('_XCONTENT_XCONTENT_ADMENU7', 'Permissions');

	// MENU ICONS?IMAGES
	define('_XCONTENT_XCONTENT_ADMENU1_ICON', 'images/manage.xcontent.png');
	define('_XCONTENT_XCONTENT_ADMENU2_ICON', 'images/add.xcontent.png');
	define('_XCONTENT_XCONTENT_ADMENU3_ICON', 'images/manage.categories.png');
	define('_XCONTENT_XCONTENT_ADMENU4_ICON', 'images/add.category.png');
	define('_XCONTENT_XCONTENT_ADMENU5_ICON', 'images/manage.inheritable.blocks.png');
	define('_XCONTENT_XCONTENT_ADMENU6_ICON', 'images/add.inheritable.block.png');
	define('_XCONTENT_XCONTENT_ADMENU7_ICON', 'images/permissions.png');

	//MYSQL TABLES WITHOUT PREFIX // DO NOT CHANGE
	define('_XCONTENT_TABLE_XCONTENT', 'xcontent_xcontent');
	define('_XCONTENT_TABLE_CATEGORY', 'xcontent_categories');
	define('_XCONTENT_TABLE_TEXT', 'xcontent_text');
	define('_XCONTENT_TABLE_BLOCK', 'xcontent_blocks');

	//SEARCH SETTINGS // DO NOT CHANGE
	define('_XCONTENT_HASSEARCH', false);
	define('_XCONTENT_SEARCH_FILE', 'include/search.inc.php');
	define('_XCONTENT_SEARCH_FUNCTION', 'xcontent_search');
	
	//COMMENT SETTINGS // DO NOT CHANGE
	define('_XCONTENT_HASCOMMENT', true);
	define('_XCONTENT_COMMENT_ITEM', 'storyid');
	define('_XCONTENT_COMMENT_PAGE', 'index.php');
	
	//MAIN PAGES SETTING // DO NOT CHANGE
	define('_XCONTENT_HASMAIN', true);
	define('_XCONTENT_USESMARTY', true);
	
	//TEMPLATE SETTINGS // DO NOT CHANGE
	define('_XCONTENT_TEMPLATE_INDEX', 'xcontent_index.html');
	define('_XCONTENT_TEMPLATE_INDEX_DESC', 'Index File for xContent');
	define('_XCONTENT_TEMPLATE_BREADCRUMB', 'xcontent_breadcrumb.html');
	define('_XCONTENT_TEMPLATE_BREADCRUMB_DESC', 'Breadcrumb for Index File for xContent');
	define('_XCONTENT_TEMPLATE_CPANEL_ADDEDITPAGE', 'xcontent_cpanel_addeditpage.html');
	define('_XCONTENT_TEMPLATE_CPANEL_ADDEDITPAGE_DESC', 'xContent Cpanel Edit From for xContent');
	define('_XCONTENT_TEMPLATE_CPANEL_ADDEDITCATEGORY', 'xcontent_cpanel_addeditcategory.html');
	define('_XCONTENT_TEMPLATE_CPANEL_ADDEDITCATEGORY_DESC', 'xContent Cpanel Edit From for Category');
	define('_XCONTENT_TEMPLATE_CPANEL_ADDEDITBLOCK', 'xcontent_cpanel_addeditblock.html');
	define('_XCONTENT_TEMPLATE_CPANEL_ADDEDITBLOCK_DESC', 'xContent Cpanel Edit From for block');
	define('_XCONTENT_TEMPLATE_INDEX_ADDEDITPAGE', 'xcontent_index_addeditpage.html');
	define('_XCONTENT_TEMPLATE_INDEX_ADDEDITPAGE_DESC', 'xContent Index Edit From for xContent');
	define('_XCONTENT_TEMPLATE_INDEX_ADDEDITCATEGORY', 'xcontent_index_addeditcategory.html');
	define('_XCONTENT_TEMPLATE_INDEX_ADDEDITCATEGORY_DESC', 'xContent Index Edit From for Category');
	define('_XCONTENT_TEMPLATE_INDEX_ADDEDITBLOCK', 'xcontent_index_addeditblock.html');
	define('_XCONTENT_TEMPLATE_INDEX_ADDEDITBLOCK_DESC', 'xContent Cpanel Edit From for block');
	define('_XCONTENT_TEMPLATE_CPANEL_JSON_ADDEDITPAGE', 'xcontent_cpanel_json_addeditpage.html');
	define('_XCONTENT_TEMPLATE_CPANEL_JSON_ADDEDITPAGE_DESC', 'xContent Cpanel Edit From for xContent for json');
	define('_XCONTENT_TEMPLATE_CPANEL_JSON_ADDEDITCATEGORY', 'xcontent_cpanel_json_addeditcategory.html');
	define('_XCONTENT_TEMPLATE_CPANEL_JSON_ADDEDITCATEGORY_DESC', 'xContent Cpanel Edit From for Category for json');
	define('_XCONTENT_TEMPLATE_CPANEL_JSON_ADDEDITBLOCK', 'xcontent_cpanel_json_addeditblock.html');
	define('_XCONTENT_TEMPLATE_CPANEL_JSON_ADDEDITBLOCK_DESC', 'xContent Cpanel Edit From for block for json');
	define('_XCONTENT_TEMPLATE_INDEX_JSON_ADDEDITPAGE', 'xcontent_index_json_addeditpage.html');
	define('_XCONTENT_TEMPLATE_INDEX_JSON_ADDEDITPAGE_DESC', 'xContent Index Edit From for xContent for json');
	define('_XCONTENT_TEMPLATE_INDEX_JSON_ADDEDITCATEGORY', 'xcontent_index_json_addeditcategory.html');
	define('_XCONTENT_TEMPLATE_INDEX_JSON_ADDEDITCATEGORY_DESC', 'xContent Index Edit From for Category for json');
	define('_XCONTENT_TEMPLATE_INDEX_JSON_ADDEDITBLOCK', 'xcontent_index_json_addeditblock.html');
	define('_XCONTENT_TEMPLATE_INDEX_JSON_ADDEDITBLOCK_DESC', 'xContent Cpanel Edit From for block for json');
	define('_XCONTENT_TEMPLATE_INDEX_MANAGE', 'xcontent_index_manage.html');
	define('_XCONTENT_TEMPLATE_INDEX_MANAGE_DESC', 'xContent Manager Template - Displays lists');
	define('_XCONTENT_TEMPLATE_INDEX_PASSWORD', 'xcontent_index_password.html');
	define('_XCONTENT_TEMPLATE_INDEX_PASSWORD_DESC', 'xContent Password Prompt Template');
	
	//CLASS NAMES // DO NOT CHANGE
	define('_XCONTENT_CLASS_XCONTENT', 'xcontent');
	define('_XCONTENT_CLASS_CATEGORY', 'category');
	define('_XCONTENT_CLASS_TEXT', 'text');
	define('_XCONTENT_CLASS_BLOCK', 'block');
	define('_XCONTENT_CLASS_XLANGUAGE_EXT', 'xlanguage_ext');
	
	//FUNCTIOnAL PAGE OpERATORs -- DO NOT CHANGE
	define('_XCONTENT_URL_OP_SAVE', 'save');
	define('_XCONTENT_URL_OP_EDIT', 'edit');
	define('_XCONTENT_URL_OP_ADD', 'add');
	define('_XCONTENT_URL_OP_DELETE', 'delete');
	define('_XCONTENT_URL_OP_COPY', 'copy');
	define('_XCONTENT_URL_OP_MANAGE', 'manage');
	define('_XCONTENT_URL_OP_PERMISSIONS', 'permissions');
	define('_XCONTENT_URL_FORM_XCONTENT', 'xcontent');
	define('_XCONTENT_URL_FORM_CATEGORY', 'category');
	define('_XCONTENT_URL_FORM_BLOCK', 'block');
	define('_XCONTENT_URL_FCT_CATEGORIES', 'categories');
	define('_XCONTENT_URL_FCT_XCONTENT', 'xcontent');
	define('_XCONTENT_URL_FCT_CATEGORY', 'category');
	define('_XCONTENT_URL_FCT_BLOCK', 'block');
	define('_XCONTENT_URL_FCT_BLOCKS', 'blocks');
	define('_XCONTENT_URL_FCT_PAGES', 'pages');
	define('_XCONTENT_URL_FCT_TEMPLATE', 'template');
	
	//ENUMERATORS // DO NOT CHANGE
	define('_XCONTENT_ENUM_TYPE_BLOCK', 'block');
	define('_XCONTENT_ENUM_TYPE_CATEGORY', 'category');
	define('_XCONTENT_ENUM_TYPE_XCONTENT', 'xcontent');
	
	// PATHs // DO NOT CHANGE
	define('_XCONTENT_PATH_PHP_GROUPPERMS', '/class/xoopsform/grouppermform.php');
	define('_XCONTENT_PATH_PHP_TEMPLATE', '/class/template.php');
	define('_XCONTENT_PATH_PHP_FORMLOADER', '/class/xoopsformloader.php');
	define('_XCONTENT_PATH_PHP_FORM_TAG', '/modules/tag/include/formtag.php');
	define('_XCONTENT_PATH_PHP_HEADER', '/header.php');
	define('_XCONTENT_PATH_PHP_FOOTER', '/footer.php');
	define('_XCONTENT_PATH_PHP_COMMENTVIEW', '/include/comment_view.php');
	define('_XCONTENT_PATH_MODULE_ROOT', '/modules/'._XCONTENT_DIRNAME.'/index.php');
	define('_XCONTENT_PATH_PHP_FPDF', '/modules/'._XCONTENT_DIRNAME.'/include/fpdf/fpdf.inc.php');
	define('_XCONTENT_PATH_PHP_JSON', '/modules/'._XCONTENT_DIRNAME.'/include/JSON.php');
	define('_XCONTENT_PATH_PREDEFINED_HTML', '/modules/'._XCONTENT_DIRNAME.'/templates/predefined/xcontent/');
	define('_XCONTENT_PATH_PREDEFINED_RSS', '/modules/'._XCONTENT_DIRNAME.'/templates/predefined/rss/');
	define('_XCONTENT_PATH_CSS_INDEX', '/modules/'._XCONTENT_DIRNAME.'/templates/css/xcontent.css');
	define('_XCONTENT_PATH_CSS_PRINT', '/modules/'._XCONTENT_DIRNAME.'/templates/css/print.css');
	define('_XCONTENT_PATH_JS_CORE', '/modules/'._XCONTENT_DIRNAME.'/templates/js/core.js');
	define('_XCONTENT_PATH_JS_JQUERY', '/browse.php?Frameworks/jquery/jquery.js');
	define('_XCONTENT_PATH_PHP_FUNCTIONS', '/modules/'._XCONTENT_DIRNAME.'/include/functions.php');
	define('_XCONTENT_PATH_PHP_FORMOBJECTS', '/modules/'._XCONTENT_DIRNAME.'/include/formobjects.xcontent.php');
	define('_XCONTENT_PATH_PHP_FORMS', '/modules/'._XCONTENT_DIRNAME.'/include/forms.xcontent.php');
	define('_XCONTENT_PATH_PHP_FORM_LANGUAGES', '/modules/'._XCONTENT_DIRNAME.'/include/formselectlanguages.php');
	define('_XCONTENT_PATH_PHP_FORM_CATEGORIES', '/modules/'._XCONTENT_DIRNAME.'/include/formselectcategories.php');
	define('_XCONTENT_PATH_PHP_FORM_PAGES', '/modules/'._XCONTENT_DIRNAME.'/include/formselectpages.php');
	define('_XCONTENT_PATH_PHP_FORM_BLOCKS', '/modules/'._XCONTENT_DIRNAME.'/include/formselectblocks.php');
	define('_XCONTENT_PATH_PHP_FORM_HTMLTEMPLATES', '/modules/'._XCONTENT_DIRNAME.'/include/formselecttemplates.php');
	
	// PERMiSSION OPTIONS // DO NOT CHANGE
	define('_XCONTENT_PERM_VIEW_CATEGORY', 'Categories Viewing Permissions');
	define('_XCONTENT_PERM_VIEW_XCONTENT', 'Content Viewing Permissions');
	define('_XCONTENT_PERM_VIEW_BLOCK', 'Block Viewing Permissions');
	define('_XCONTENT_PERM_EDIT_CATEGORY', 'Categories Edit Permissions');
	define('_XCONTENT_PERM_EDIT_XCONTENT', 'Content Edit Permissions');
	define('_XCONTENT_PERM_EDIT_BLOCK', 'Block Edit Permissions');
	define('_XCONTENT_PERM_ADD_CATEGORY', 'Categories Adding Permissions');
	define('_XCONTENT_PERM_ADD_XCONTENT', 'Content Adding Permissions');
	define('_XCONTENT_PERM_ADD_BLOCK', 'Block Adding Permissions');
	define('_XCONTENT_PERM_DEFAULT_TEMPLATE', 'Default Permissions');

	// PERMISSION TYPES & MODES // DO NOT CHANGE
	define('_XCONTENT_PERM_MODE_VIEW', 'view');
	define('_XCONTENT_PERM_MODE_EDIT', 'edit');
	define('_XCONTENT_PERM_MODE_ADD', 'add');
	define('_XCONTENT_PERM_MODE_COPY', 'copy');
	define('_XCONTENT_PERM_MODE_DELETE', 'delete');
	define('_XCONTENT_PERM_MODE_ALL', 'all');
	define('_XCONTENT_PERM_TYPE_CATEGORY', '_category');
	define('_XCONTENT_PERM_TYPE_XCONTENT', '_xcontent');
	define('_XCONTENT_PERM_TYPE_BLOCK', '_block');
	define('_XCONTENT_PERM_TYPE_TEMPLATE', '_default');
	
	// PERMISSION TEMPLATES // DO NOT CHANGE
	define('_XCONTENT_PERM_TEMPLATE_ADD_XCONTENT', 1);
	define('_XCONTENT_PERM_TEMPLATE_ADD_CATEGORY', 2);
	define('_XCONTENT_PERM_TEMPLATE_ADD_BLOCK', 3);
	define('_XCONTENT_PERM_TEMPLATE_EDIT_XCONTENT', 4);
	define('_XCONTENT_PERM_TEMPLATE_EDIT_CATEGORY', 5);
	define('_XCONTENT_PERM_TEMPLATE_EDIT_BLOCK', 6);
	define('_XCONTENT_PERM_TEMPLATE_VIEW_XCONTENT', 7);
	define('_XCONTENT_PERM_TEMPLATE_VIEW_CATEGORY', 8);
	define('_XCONTENT_PERM_TEMPLATE_VIEW_BLOCK', 9);
	define('_XCONTENT_PERM_TEMPLATE_COPY_XCONTENT', 10);
	define('_XCONTENT_PERM_TEMPLATE_COPY_CATEGORY', 11);
	define('_XCONTENT_PERM_TEMPLATE_COPY_BLOCK', 12);
	define('_XCONTENT_PERM_TEMPLATE_DELETE_XCONTENT', 13);
	define('_XCONTENT_PERM_TEMPLATE_DELETE_CATEGORY', 14);
	define('_XCONTENT_PERM_TEMPLATE_DELETE_BLOCK', 15);
	define('_XCONTENT_PERM_TEMPLATE_PERMISSIONS', 16);
	define('_XCONTENT_PERM_TEMPLATE_MANAGE_XCONTENT', 17);
	define('_XCONTENT_PERM_TEMPLATE_MANAGE_CATEGORY', 18);
	define('_XCONTENT_PERM_TEMPLATE_MANAGE_BLOCK', 19);
	
	// PERMISSION TEMPLATES desCRIPTIons
	define('_XCONTENT_PERM_TEMPLATE_ADD_XCONTENT_DESC', 'Add Content');
	define('_XCONTENT_PERM_TEMPLATE_ADD_CATEGORY_DESC', 'Add Category');
	define('_XCONTENT_PERM_TEMPLATE_ADD_BLOCK_DESC', 'Add Block');
	define('_XCONTENT_PERM_TEMPLATE_EDIT_XCONTENT_DESC', 'Edit Content');
	define('_XCONTENT_PERM_TEMPLATE_EDIT_CATEGORY_DESC', 'Category Edit');
	define('_XCONTENT_PERM_TEMPLATE_EDIT_BLOCK_DESC', 'Edit Blocks');
	define('_XCONTENT_PERM_TEMPLATE_VIEW_XCONTENT_DESC', 'View Content');
	define('_XCONTENT_PERM_TEMPLATE_VIEW_CATEGORY_DESC', 'View Category');
	define('_XCONTENT_PERM_TEMPLATE_VIEW_BLOCK_DESC', 'View Block');
	define('_XCONTENT_PERM_TEMPLATE_COPY_XCONTENT_DESC', 'Copy Content');
	define('_XCONTENT_PERM_TEMPLATE_COPY_CATEGORY_DESC', 'Copy Category');
	define('_XCONTENT_PERM_TEMPLATE_COPY_BLOCK_DESC', 'Copy Block');
	define('_XCONTENT_PERM_TEMPLATE_DELETE_XCONTENT_DESC', 'Delete Content');
	define('_XCONTENT_PERM_TEMPLATE_DELETE_CATEGORY_DESC', 'Delete Category');
	define('_XCONTENT_PERM_TEMPLATE_DELETE_BLOCK_DESC', 'Delete Block');
	define('_XCONTENT_PERM_TEMPLATE_PERMISSIONS_DESC', 'Access & Change Permissions');
	define('_XCONTENT_PERM_TEMPLATE_MANAGE_XCONTENT_DESC', 'Manage Content');
	define('_XCONTENT_PERM_TEMPLATE_MANAGE_CATEGORY_DESC', 'Manage Categories');
	define('_XCONTENT_PERM_TEMPLATE_MANAGE_BLOCK_DESC', 'Manage Blocks');
	
	//PERMISSIOn TITLES
	define('_XCONTENT_PERMISSIONS_CATEGORY', 'Permissions for Categories');
	define('_XCONTENT_PERMISSIONS_XCONTENT', 'Permissions for Content');
	define('_XCONTENT_PERMISSIONS_BLOCKS', 'Permissions for Blocks');
	define('_XCONTENT_PERMISSIONS_DEFAULT', 'Permissions Defaults');
	
	// LANGUAGE DESCRIPTIONS
	define('_XCONTENT_USEJSON', 'Use Secure JSON for forms?');
	define('_XCONTENT_USEJSON_DESC', 'Enabling this option will use JQuery and Secure JSON method for loading forms, not all editors work with this!');
	define('_XCONTENT_WRITENBY', 'Display Written By');
	define('_XCONTENT_WRITENBY_DESC', 'This displays the author of the article/content.');
	define('_XCONTENT_SECURITY', 'Security Type');
	define('_XCONTENT_SECURITY_DESC', 'Type of security complexity you wish to use!');
	define('_XCONTENT_MUlTILINGUAL', 'Multilinguage Documents');
	define('_XCONTENT_SUPPORTTAGS', 'Support Tagging');
	define('_XCONTENT_SUPPORTTAGS_DESC', 'Support Tag (2.3 or later)<br/><a href="http://sourceforge.net/projects/xoops/files/XOOPS%20Module%20Repository/XOOPS%20tag%202.30%20RC/">Download Tag Module</a>');
	define('_XCONTENT_MUlTILINGUAL_DESC', 'Allows for multiple languages per page to be specified');
	define('_XCONTENT_XCONTENT_NAME', 'Lingual Content');
	define('_XCONTENT_XCONTENT_DIRNAME', 'xcontent');
	define('_XCONTENT_EDITORS', 'Editor!');
	define('_XCONTENT_EDITORS_DESC', 'Editor to use for text editing!');
	define('_XCONTENT_RSSICON', 'Enable RSS Icon');
	define('_XCONTENT_RSSICON_DESC', 'Enables RSS Access');
	define('_XCONTENT_PRINTICON', 'Enable Print Icon');
	define('_XCONTENT_PRINTICON_DESC', 'Enables Printing');
	define('_XCONTENT_ADDTHIS', 'Enable Social Bookmarks');
	define('_XCONTENT_ADDTHISICON_DESC', 'Enables Social Bookmarking');
	define('_XCONTENT_ADDTHISCODE', 'Social Bookmark Code');
	define('_XCONTENT_ADDTHISCODE_DESC', 'Code for the sharing bookmark <a href="http://www.addthis.com">Get it here</a>');
	define('_XCONTENT_PDFICON', 'Enable PDF?');
	define('_XCONTENT_PDFICON_DESC', 'Enables the PDF Functions');
	define('_XCONTENT_BREADCRUMB', 'Enable Breadcrumb?');
	define('_XCONTENT_BREADCRUMB_DESC', 'Enabled the Bread Crumb');
	define('_XCONTENT_HTACCESS', 'Enabled HTACCESS SEO');
	define('_XCONTENT_HTACCESS_DESC', 'This enables SEO');
	define('_XCONTENT_BASEURL', 'Base URL for SEO');
	define('_XCONTENT_BASEURL_DESC', 'Base URL for SEO');
	define('_XCONTENT_ENDOFURL', 'End of URL');
	define('_XCONTENT_ENDOFURL_DESC', 'File Extension to HTML Files');
	define('_XCONTENT_ENDOFURLRSS', 'End of URL');
	define('_XCONTENT_ENDOFURLRSS_DESC', 'File Extension to RSS Pages');
	define('_XCONTENT_ENDOFURLPDF', 'End of URL');
	define('_XCONTENT_ENDOFURLPDF_DESC', 'File Extension to Adobe Acrobat (PDF) Files');
	define('_XCONTENT_FORCECPANELJQUERY', 'Force JQuery on Control Panel');
	define('_XCONTENT_FORCECPANELJQUERY_DESC', 'Forces the installed runtime copy of JQuery!');
	define('_XCONTENT_FORCEJQUERY', 'Force JQuery on Content Pages');
	define('_XCONTENT_FORCEJQUERY_DESC', 'Forces the installed runtime copy of JQuery!');

	//SECURITY TYPES
	define('_XCONTENT_SECURITY_BASIC', 'Basic');
	define('_XCONTENT_SECURITY_INTERMEDIATE', 'Intermediate');
	define('_XCONTENT_SECURITY_ADVANCED', 'Advanced');
	define('_XCONTENT_SECURITY_BASIC_DESC', 'Basic Permissions');
	define('_XCONTENT_SECURITY_INTERMEDIATE_DESC', 'Intermediate Permissions');
	define('_XCONTENT_SECURITY_ADVANCED_DESC', 'Advanced Permissions');
	
	// Version 2.16
	//FUNCTIOnAL PAGE OpERATORs -- DO NOT CHANGE
	define('_XCONTENT_URL_OP_DASHBOARD', 'dashboard');
	define('_XCONTENT_URL_OP_ABOUT', 'about');
	
	//ADMINISTRATION SETTINGS // DO NOT CHANGE
	define('_XCONTENT_HASADMIN', true);
	define('_XCONTENT_ADMIN_INDEX', 'admin/index.php?op='._XCONTENT_URL_OP_DASHBOARD);
	define('_XCONTENT_ADMIN_MENU', 'admin/menu.php');
	define('_XCONTENT_SYSTEM_MENU', true);

	// MENUs
	define('_XCONTENT_XCONTENT_ADMENU0', 'Home');
	define('_XCONTENT_XCONTENT_ADMENU8', 'About');
	
	// MENU ICONS?IMAGES
	define('_XCONTENT_XCONTENT_ADMENU0_ICON', '../../Frameworks/moduleclasses/icons/32/home.png');
	define('_XCONTENT_XCONTENT_ADMENU8_ICON', '../../Frameworks/moduleclasses/icons/32/about.png');
		
?>