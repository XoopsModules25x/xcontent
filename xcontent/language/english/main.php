<?php

/*
Module: xContent

Version: 2.01

Description: Multilingual Content Module with tags and lists with search functions

Author: Written by Simon Roberts aka. Wishcraft (simon@chronolabs.coop)

Owner: Chronolabs

License: See /docs - GPL 2.0
*/


	include_once('modinfo.php');

	// Options & Messages
	define('_XCONTENT_AD_PAGE', 'Content Page');
	define('_XCONTENT_AD_CATEGORY', 'Category');
	define('_XCONTENT_AD_PARENT', 'Parent Node');
	define('_XCONTENT_AD_SUBMENUS', 'Submenu');
	define('_XCONTENT_AD_HOMEPAGE', 'Homepage');
	define('_XCONTENT_AD_ACTIONS', 'Actions');
	define('_XCONTENT_AD_WEIGHT', 'Weight');
	define('_XCONTENT_AD_RSSENABLED', 'RSS Enabled');
	define('_XCONTENT_AD_TITLE', 'Block Description');
	define('_XCONTENT_AD_CREATED', 'Created');
	define('_XCONTENT_AD_MADEBY', 'Last Edited By');
	define('_XCONTENT_NONE', '(none)');
	define('_XCONTENT_MSG_XCONTENTSAVED', 'Content Saved!');
	define('_XCONTENT_NOPERMISSIONS', 'No Permissions to View Page or Content');
	define('_XCONTENT_NOTVISIBLE', 'View Page not permitted this page is not currently visible!');
	define('_XCONTENT_PAGETITLESEP', ' : ');
	define('_XCONTENT_NOSTORY', 'No story/content specified!');
	define('_XCONTENT_CRUMBSEP', '>');
	define('_XCONTENT_WRITTENBY', 'Written by:&nbsp;');
	define('_XCONTENT_MSG_SECURITYTOKEN', 'passkey Security Token needs to be refreshed - please refresh the screen!');
	define('_XCONTENT_AD_CONFIRM_DELETE', 'Are you sure you wish to delete the page <strong>%s</strong>');
	define('_XCONTENT_AD_MSG_DELETE', 'Content Deleted Successfully!');
	define('_XCONTENT_AD_CONFIRM_COPY', 'Are you sure you wish to copy the page <strong>%s</strong>');
	define('_XCONTENT_AD_MSG_COPY', 'xContent Coping Successfully - %s subsets copied!');
	define('_XCONTENT_NEEDCATEGORIES', 'Need to have categories loaded!');
	define('_XCONTENT_MSG_CATEGORYSAVED', 'Category saved successfully');
	define('_XCONTENT_MSG_CATEGORYNOTSAVED', 'The category did not save successfully');
	define('_XCONTENT_MSG_BLOCKSAVED', 'Block saved successfully');
	define('_XCONTENT_MSG_BLOCKNOTSAVED', 'The block did not save successfully');
	define('_XCONTENT_XCONTENTEXPIRED', 'xContent has passed it expiry date!');
	define('_XCONTENT_TOBEPUBLISHED', 'xContent has to reach it publishing date!');
	
	// PAssWord form
	define('_XCONTENT_MF_ENTERPASSWORD', 'Enter the password for the content!');
	define('_XCONTENT_MF_PASSWORD', 'Content password');
	define('_XCONTENT_MF_PASSWORD_DESC', '');
	
	// PRINTING
	define('_XCONTENT_PRINTERFRIENDLY', 'Printer Friendly');
	define('_XCONTENT_URLFORSTORY', 'Direct URL:');
	define('_XCONTENT_THISCOMESFROM', 'This Comes From:');
	
	//PDF
	define('_XCONTENT_PDF_AUTHOR', 'Author');
	define('_XCONTENT_PDF_DATE', 'Published');
	define('_XCONTENT_POSTEDBY', 'Posted By');
	define('_XCONTENT_POSTEDON', 'Posted On');
	define('_XCONTENT_PAGE', 'Generated %s, Page %s');
	
	// EDIT BLOCK FORM
	define('_XCONTENT_AD_NEWBLOCK', 'Create New Block');
	define('_XCONTENT_AD_EDITBLOCK', 'Edit The Block');
	define('_XCONTENT_AD_OPENDESCRIPTION', 'Reference');
	define('_XCONTENT_AD_OPENDESCRIPTION_DESC', 'This is what you refer the block too');
	define('_XCONTENT_AD_BLOCKHTML', 'BLOCK Code');
	define('_XCONTENT_AD_BLOCKHTML_DESC', 'HTML/XCODE/TEXT Code for inhertitable');
	
	// EDIT CATEGORY FORM
	define('_XCONTENT_AD_NEWCATEGORY', 'New Category');
	define('_XCONTENT_AD_EDITCATEGORY', 'Edit Category');
	define('_XCONTENT_AD_CAT_MENUTITLE', 'Menu Title');
	define('_XCONTENT_AD_CAT_RSSENABLED', 'RSS Enabled');
	define('_XCONTENT_AD_CAT_OPTIONS', 'Options');
	define('_XCONTENT_AD_CAT_LANGUAGE', 'Category Language');
	define('_XCONTENT_AD_CAT_LANGUAGE_DESC', '');
	define('_XCONTENT_AD_CAT_CATEGORYPARENT', 'Category Parent Node');
	define('_XCONTENT_AD_CAT_KEYWORDS', 'Meta Keywords');
	define('_XCONTENT_AD_CAT_PAGEDESCRIPTION', 'Meta Page Description');
	define('_XCONTENT_AD_CAT_RSSDESCRIPTION', 'RSS Items Description');
	define('_XCONTENT_AD_CAT_TEXT', 'Category Caption');
	
	// EDIT XCONTENT FORM
	define('_XCONTENT_AD_EDITXCONTENT', 'Edit Multilingual Content Page');
	define('_XCONTENT_AD_NEWXCONTENT', 'New Multilingual Content Page');
	define('_XCONTENT_AD_LANGUAGE', 'Page Language');
	define('_XCONTENT_AD_MENUTITLE', 'Menu Title');
	define('_XCONTENT_AD_PAGETITLE', 'Page Title');
	define('_XCONTENT_AD_INHERITBLOCK', 'Inherited Block');
	define('_XCONTENT_AD_KEYWORDS', 'Meta Keywords');
	define('_XCONTENT_AD_PAGEDESCRIPTION', 'Meta Page Description');
	define('_XCONTENT_AD_TEMPLATES', 'Rss & Content Template');
	define('_XCONTENT_AD_RSS', 'RSS Item');
	define('_XCONTENT_AD_TEXT', 'Item Content');
	define('_XCONTENT_AD_URL', 'URL');
	define('_XCONTENT_AD_PASSWORD', 'Page Password');
	define('_XCONTENT_AD_PASSWORD_CONFIRM', 'Confirm:');
	define('_XCONTENT_AD_OPTIONS', 'Options');
	define('_XCONTENT_AD_URLADDRESS', 'URL:');
	define('_XCONTENT_AD_REDIRECTLINK', 'Redirect Link on Load');
	define('_XCONTENT_AD_PUBLISH', 'Published or Redirect');
	define('_XCONTENT_AD_EXPIRE', 'Expired then Redirect');
	define('_XCONTENT_AD_SET', 'Save Setting Now?');
	define('_XCONTENT_AD_PUBlISHDATETIME', 'Published from:');
	define('_XCONTENT_AD_EXPIREDATETIME', 'Expires on:');
	define('_XCONTENT_AD_REDIRECTPAGE', 'or Redirect to page:');
	define('_XCONTENT_AD_VISIBLE', 'Visible');
	define('_XCONTENT_AD_NOHTML', 'No Html');
	define('_XCONTENT_AD_NOSMILEY', 'No Smilies');
	define('_XCONTENT_AD_NOBREAKS', 'No Line Feed');
	define('_XCONTENT_AD_NOCOMMENTS', 'No Comments');
	define('_XCONTENT_AD_SUBMENU', 'Sub Menu Items');
	define('_XCONTENT_AD_TITLE_DESC', 'Appears in menus for page!');
	define('_XCONTENT_AD_PAGETITLE_DESC', 'Appears as heading of page!');
	define('_XCONTENT_AD_PARENTPAGE_DESC', 'Parent Page');
	define('_XCONTENT_AD_CATEGORY_DESC', 'Categorisation for page');
	define('_XCONTENT_AD_INHERITBLOCK_DESC', 'Inherited block for page');
	define('_XCONTENT_AD_KEYWORDS_DESC', 'These are the page keywords');
	define('_XCONTENT_AD_PAGEDESCRIPTION_DESC', 'Description of page in Search Engines');
	define('_XCONTENT_AD_TEMPLATE_DESC', 'Predefined Templates');
	define('_XCONTENT_AD_RSS_DESC', 'RSS Document to appear in category rss feed!');
	define('_XCONTENT_AD_TEXT_DESC', 'xContent that appears in the page under ID');
	define('_XCONTENT_AD_URL_DESC', 'URL for redirection!');
	define('_XCONTENT_AD_PASSWORD_DESC', 'Page password protection');
	define('_XCONTENT_AD_TAGS_DESC', 'Tags/Keyphrases for page!');
	define('_XCONTENT_AD_PUBLISH_DESC', 'Page will only appear and publish after this date!');
	define('_XCONTENT_AD_EXPIRE_DESC', 'Page will only publish until this time and date!');
	define('_XCONTENT_AD_LANGUAGE_DESC', 'Select the language for this page!');
	define('_XCONTENT_AD_CAT_PAGETITLE', 'Category Page Title');
	define('_XCONTENT_AD_PUBLISHED', 'Published');
	
	define('_XCONTENT_AD_ADDPAGE_TITLEA', 'Content Page');
	define('_XCONTENT_AD_ADDPAGE_TITLEB', 'New Page');
	define('_XCONTENT_AD_CATEGORY_TITLEA', 'Category');
	define('_XCONTENT_AD_CATEGORY_TITLEB', 'New Category');
	define('_XCONTENT_AD_BLOCK_TITLEA', 'Block');
	define('_XCONTENT_AD_BLOCK_TITLEB', 'New Block');
	define('_XCONTENT_AM_MANAGE_TITLEA', 'Manage Content');
	
?>