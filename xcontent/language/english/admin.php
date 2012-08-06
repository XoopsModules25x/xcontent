<?php

/*
Module: xContent

Version: 2.01

Description: Multilingual Content Module with tags and lists with search functions

Author: Written by Simon Roberts aka. Wishcraft (simon@chronolabs.coop)

Owner: Chronolabs

License: See /docs - GPL 2.0
*/

	xoops_loadlanguage('modinfo', 'xcontent');
	//Permissions
	define('_XCONTENT_NOPERMSSET', 'No Permissions to Set!');
	define('_XCONTENT_PERMISSIONSVIEWCATEGORY', 'View Categories!');
	define('_XCONTENT_VIEW_FUNCTION', 'View');
	define('_XCONTENT_PERMISSIONSVIEWPAGE', 'View xContent Page');
	
	define('_XCONTENT_AM_ADDPAGE_TITLEA', 'Content Page');
	define('_XCONTENT_AM_ADDPAGE_TITLEB', 'New Page');
	define('_XCONTENT_AM_CATEGORY_TITLEA', 'Category');
	define('_XCONTENT_AM_CATEGORY_TITLEB', 'New Category');
	define('_XCONTENT_AM_BLOCK_TITLEA', 'Block');
	define('_XCONTENT_AM_BLOCK_TITLEB', 'New Block');
	
	// Version 2.16
	// Dashboard
	define('_XCONTENT_ADMIN_COUNTS', 'Article and Category Counts');
	define('_XCONTENT_ADMIN_THEREARE_CATEGORIES', 'There are %s categories');
	define('_XCONTENT_ADMIN_THEREARE_ARTICLES', 'There are %s articles/blogs');
	
	// About
	define('_XCONTENT_ABOUT_MAKEDONATE', 'Make Donation for the use of xContent!');
?>