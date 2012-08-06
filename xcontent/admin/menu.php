<?php

/*
Module: xContent

Version: 2.01

Description: Multilingual Content Module with tags and lists with search functions

Author: Written by Simon Roberts aka. Wishcraft (simon@chronolabs.coop)

Owner: Chronolabs

License: See /docs - GPL 2.0
*/

defined("XOOPS_ROOT_PATH") or die("XOOPS root path not defined");

$path = dirname(dirname(dirname(dirname(__FILE__))));
include_once $path . '/mainfile.php';

$dirname         = basename(dirname(dirname(__FILE__)));
$module_handler  = xoops_gethandler('module');
$module          = $module_handler->getByDirname($dirname);
$pathIcon32      = $module->getInfo('icons32');
$pathModuleAdmin = $module->getInfo('dirmoduleadmin');
$pathLanguage    = $path . $pathModuleAdmin;


if (!file_exists($fileinc = $pathLanguage . '/language/' . $GLOBALS['xoopsConfig']['language'] . '/' . 'main.php')) {
    $fileinc = $pathLanguage . '/language/english/main.php';
}

$adminmenu = array();
$i=1;
//$adminmenu[$i]['icon'] = _XCONTENT_XCONTENT_ADMENU0_ICON;
$adminmenu[$i]['image'] = _XCONTENT_XCONTENT_ADMENU0_ICON;
$adminmenu[$i]['title'] = _XCONTENT_XCONTENT_ADMENU0;
$adminmenu[$i]['link']  = "admin/index.php?op="._XCONTENT_URL_OP_DASHBOARD;
$adminmenu[$i]["icon"]  = $pathIcon32 . '/home.png';
$i++;
//$adminmenu[$i]['icon'] = _XCONTENT_XCONTENT_ADMENU3_ICON;
$adminmenu[$i]['image'] = _XCONTENT_XCONTENT_ADMENU3_ICON;
$adminmenu[$i]["icon"]  = $pathIcon32 . '/category.png';
$adminmenu[$i]['title'] = _XCONTENT_XCONTENT_ADMENU3;
$adminmenu[$i]['link']  = "admin/index.php?op="._XCONTENT_URL_OP_MANAGE."&fct="._XCONTENT_URL_FCT_CATEGORIES;
$i++;
//$adminmenu[$i]['icon'] = _XCONTENT_XCONTENT_ADMENU1_ICON;
$adminmenu[$i]['image'] = _XCONTENT_XCONTENT_ADMENU1_ICON;
$adminmenu[$i]["icon"]  = $pathIcon32 . '/manage.png';
$adminmenu[$i]['title'] = _XCONTENT_XCONTENT_ADMENU1;
$adminmenu[$i]['link']  = "admin/index.php?op="._XCONTENT_URL_OP_MANAGE."&fct="._XCONTENT_URL_FCT_XCONTENT;
//$i++;
//$adminmenu[$i]['icon'] = _XCONTENT_XCONTENT_ADMENU2_ICON;
//$adminmenu[$i]['image'] = _XCONTENT_XCONTENT_ADMENU2_ICON;
//$adminmenu[$i]['title'] = _XCONTENT_XCONTENT_ADMENU2;
//$adminmenu[$i]['link']  = "admin/index.php?op="._XCONTENT_URL_OP_ADD."&fct="._XCONTENT_URL_FCT_XCONTENT;
//$i++;
//$adminmenu[$i]['icon'] = _XCONTENT_XCONTENT_ADMENU4_ICON;
//$adminmenu[$i]['image'] = _XCONTENT_XCONTENT_ADMENU4_ICON;
//$adminmenu[$i]['title'] = _XCONTENT_XCONTENT_ADMENU4;
//$adminmenu[$i]['link']  = "admin/index.php?op="._XCONTENT_URL_OP_ADD."&fct="._XCONTENT_URL_FCT_CATEGORIES;
$i++;
//$adminmenu[$i]['icon'] = _XCONTENT_XCONTENT_ADMENU5_ICON;
$adminmenu[$i]["icon"]  = $pathIcon32 . '/block.png';
$adminmenu[$i]['image'] = _XCONTENT_XCONTENT_ADMENU5_ICON;
$adminmenu[$i]['title'] = _XCONTENT_XCONTENT_ADMENU5;
$adminmenu[$i]['link']  = "admin/index.php?op="._XCONTENT_URL_OP_MANAGE."&fct="._XCONTENT_URL_FCT_BLOCKS;
//$i++;
//$adminmenu[$i]['icon'] = _XCONTENT_XCONTENT_ADMENU6_ICON;
//$adminmenu[$i]['image'] = _XCONTENT_XCONTENT_ADMENU6_ICON;
//$adminmenu[$i]['title'] = _XCONTENT_XCONTENT_ADMENU6;
//$adminmenu[$i]['link']  = "admin/index.php?op="._XCONTENT_URL_OP_ADD."&fct="._XCONTENT_URL_FCT_BLOCKS;
$i++;
//$adminmenu[$i]['icon'] = _XCONTENT_XCONTENT_ADMENU7_ICON;
$adminmenu[$i]['image'] = _XCONTENT_XCONTENT_ADMENU7_ICON;
$adminmenu[$i]["icon"]  = $pathIcon32 . '/permissions.png';
$adminmenu[$i]['title'] = _XCONTENT_XCONTENT_ADMENU7;
$adminmenu[$i]['link']  = "admin/index.php?op="._XCONTENT_URL_OP_PERMISSIONS."&fct="._XCONTENT_URL_FCT_TEMPLATE.'&mode='._XCONTENT_PERM_MODE_ALL;
$i++;
$adminmenu[$i]['icon'] = _XCONTENT_XCONTENT_ADMENU8_ICON;
$adminmenu[$i]['image'] = _XCONTENT_XCONTENT_ADMENU8_ICON;
$adminmenu[$i]['title'] = _XCONTENT_XCONTENT_ADMENU8;
$adminmenu[$i]['link']  = "admin/index.php?op="._XCONTENT_URL_OP_ABOUT;

//$i++;
//$adminmenu[$i]['title'] = _AM_MODULEADMIN_ABOUT;
//$adminmenu[$i]["link"]  = "admin/about.php";
//$adminmenu[$i]["icon"]  = $pathIcon32 . '/about.png';