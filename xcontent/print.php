<?php

/*
Module: xContent

Version: 2.01

Description: Multilingual Content Module with tags and lists with search functions

Author: Written by Simon Roberts aka. Wishcraft (simon@chronolabs.coop)

Owner: Chronolabs

License: See /docs - GPL 2.0
*/


include 'header.php';

$xcontent_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_XCONTENT, _XCONTENT_DIRNAME);

if ( empty($storyid) &&$xcontent_handler->getCount(new Criteria('storyid', $storyid))==0) {
	redirect_header(XOOPS_URL._XCONTENT_PATH_MODULE_ROOT,2,_XCONTENT_NOSTORY);
}

if ($xcontent = $xcontent_handler->getContent(intval($storyid))) {
	
	if (!$gperm_handler->checkRight(_XCONTENT_PERM_MODE_VIEW._XCONTENT_PERM_TYPE_XCONTENT,$xcontent['xcontent']->getVar('storyid'),$groups, $modid))
		redirect_header(XOOPS_URL, 10, _XCONTENT_NOPERMISSIONS);
	elseif (!$gperm_handler->checkRight(_XCONTENT_PERM_MODE_VIEW._XCONTENT_PERM_TYPE_CATEGORY,$xcontent['xcontent']->getVar('catid'),$groups, $modid)
			&& $GLOBALS['xoopsModuleConfig']['security'] != _XCONTENT_SECURITY_BASIC )
		redirect_header(XOOPS_URL, 10, _XCONTENT_NOPERMISSIONS);
	else {
	
		if ($GLOBALS['xoopsModuleConfig']['htaccess'])
		if (strpos($_SERVER['REQUEST_URI'], 'odules/')>0) {
			$category = $category_handler->getCategory($xcontent['xcontent']->getVar('catid'));
			if ($category['text']->getVar('title')!='') {
				header( "HTTP/1.1 301 Moved Permanently" ); header('Location: '.XOOPS_URL.'/'.$GLOBALS['xoopsModuleConfig']['baseurl'].'/'.xoops_sef($category['text']->getVar('title')).'/print,'.$storyid.$GLOBALS['xoopsModuleConfig']['endofurl']);
			} else {
				header( "HTTP/1.1 301 Moved Permanently" ); header('Location: '.XOOPS_URL.'/'.$GLOBALS['xoopsModuleConfig']['baseurl'].'/print,'.$storyid.$GLOBALS['xoopsModuleConfig']['endofurl']);
			}
			exit(0);
		}

		if ($xcontent['xcontent']->getVar('publish')>time()&&$xcontent['xcontent']->getVar('publish')!=0) {
			if ($xcontent['xcontent']->getVar('publish_storyid')>0)
				redirect_header(XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/?storyid='.$xcontent['xcontent']->getVar('publish_storyid'), 10, _XCONTENT_TOBEPUBLISHED);
			else
				redirect_header(XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/', 10, _XCONTENT_TOBEPUBLISHED);
			exit(0);
		} elseif ($xcontent['xcontent']->getVar('expire')<time()&&$xcontent['xcontent']->getVar('expire')!=0) {
			if ($xcontent['xcontent']->getVar('expire_storyid')>0)
				redirect_header(XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/?storyid='.$xcontent['xcontent']->getVar('expire_storyid'), 10, _XCONTENT_XCONTENTEXPIRED);
			else
				redirect_header(XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/', 10, _XCONTENT_XCONTENTEXPIRED);
			exit(0);
		} elseif (strlen($xcontent['xcontent']->getVar('password'))==32) {
			if (!isset($_COOKIE['xcontent_password']))
				$_COOKIE['xcontent_password'] = array();
			if ($_COOKIE['xcontent_password'][md5(sha1(XOOPS_LICENSE_KEY).$storyid)]==false)
				if (md5($_POST['password'])!=$xcontent['xcontent']->getVar('password')) {
					include_once $GLOBALS['xoops']->path(_XCONTENT_PATH_PHP_HEADER);
					$xoopsOption['template_main'] = _XCONTENT_TEMPLATE_INDEX_PASSWORD;
					$GLOBALS['xoopsTpl']->assign('xoops_pagetitle', xcontent_getPageTitle($xcontent['xcontent']->getVar('storyid')));
					$GLOBALS['xoTheme']->addMeta( 'meta', 'keywords', xcontent_getMetaKeywords($xcontent['xcontent']->getVar('storyid')));
					$GLOBALS['xoTheme']->addMeta( 'meta', 'description', xcontent_getMetaDescription($xcontent['xcontent']->getVar('storyid')));
					$GLOBALS['xoopsTpl']->assign('xoXcontent', array_merge($xcontent['xcontent']->toArray(), $xcontent['text']->toArray(), $xcontent['perms']));
					$GLOBALS['xoopsTpl']->assign('form', xcontent_passwordform($xcontent['xcontent']->getVar('storyid')));
					include_once $GLOBALS['xoops']->path(_XCONTENT_PATH_PHP_FOOTER);
					exit(0);
				} else {
					$_COOKIE['xcontent_password'][md5(sha1(XOOPS_LICENSE_KEY).$storyid)]=true;
				}
			else 
				$_COOKIE['xcontent_password'][md5(sha1(XOOPS_LICENSE_KEY).$storyid)]=true;
			
		
		}		

	
		echo '<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">';
		echo '<html>';
		echo '<head>';
		echo '	<meta http-equiv="xContent-Type" xcontent="text/html; charset=UTF-8"/>';
		echo '	<title>'.xcontent_getPageTitle($xcontent['xcontent']->getVar('storyid'))._XCONTENT_PAGETITLESEP.$GLOBALS['xoopsConfig']['sitename']._XCONTENT_PAGETITLESEP._XCONTENT_PRINTERFRIENDLY.'</title>';
		echo '	<meta name="AUTHOR" xcontent="'.$GLOBALS['xoopsConfig']['sitename'].'"/>';
		echo '	<meta name="COPYRIGHT" xcontent="Copyright (c) 2005'.$GLOBALS['xoopsConfig']['sitename'].'"/>';
		echo '	<meta name="DESCRIPTION" xcontent="'.$GLOBALS['xoopsConfig']['slogan'].'"/>';
		echo '	<meta name="GENERATOR" xcontent="'.XOOPS_VERSION.'"/>';
		echo '	<link rel="stylesheet" type="text/css" media="screen" href="'.XOOPS_URL.'/modules/xcontent/templates/css/print.css" />';
		echo '</head>';		
		echo '<body bgcolor="#FFFFFF" text="#000000" topmargin="10" style="font:12px arial, helvetica, san serif;" onLoad="window.print()">';
		echo '	<table border="0" width="640" cellpadding="10" cellspacing="1" style="border: 1px solid #000000;" align="center">';
		echo '		<tr>';
		echo '			<td align="left">';
		echo '				<strong>'.clear_unicodeslashes($xcontent['text']->getVar('ptitle')).'</strong></td>';
		echo '		</tr>';
		echo '		<tr valign="top">';
		echo '			<td style="padding-top:0px;">';
		
		$nohtml = ($xcontent['xcontent']->getVar('nohtml'))?0:1;
		$nosmiley = ($xcontent['xcontent']->getVar('nosmiley'))?0:1;
		$nobreaks = ($xcontent['xcontent']->getVar('nobreaks'))?0:1;
		
		echo $myts->displayTarea(clear_unicodeslashes($xcontent['text']->getVar('text')), $nohtml, $nosmiley, 1, 1, $nobreaks);
			   
		echo '</td>';
		echo '		</tr>';
		echo '	</table>';
		echo '	<table border="0" width="640" cellpadding="10" cellspacing="1" align="center"><tr><td>';
		printf(_XCONTENT_THISCOMESFROM,$GLOBALS['xoopsConfig']['sitename']);
		echo '<br /><a href="'.XOOPS_URL.'/">'.XOOPS_URL.'</a><br /><br />'._XCONTENT_URLFORSTORY.'<br /><a href="'.XOOPS_URL.'/modules/'.$GLOBALS['xoopsModule']->dirname().'/index.php?id='.$storyid.'">'.XOOPS_URL.'/modules/'.$GLOBALS['xoopsModule']->dirname().'/index.php?storyid='.$storyid.'</a>';
		echo '</td></tr></table></body>';
		echo '</html>';
	
	}
}	


?>
