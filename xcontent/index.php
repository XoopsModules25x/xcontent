<?php

/*
Module: xContent

Version: 2.01

Description: Multilingual Content Module with tags and lists with search functions

Author: Written by Simon Roberts aka. Wishcraft (simon@chronolabs.coop)

Owner: Chronolabs

License: See /docs - GPL 2.0
*/

include ('header.php');

$xoopsOption['template_main'] = _XCONTENT_TEMPLATE_INDEX;
include_once $GLOBALS['xoops']->path(_XCONTENT_PATH_PHP_HEADER);

$GLOBALS['xoopsTpl']->assign('passkey', xcontent_passkey());
if ($GLOBALS['xoopsModuleConfig']['force_jquery']) $GLOBALS['xoTheme']->addScript(XOOPS_URL._XCONTENT_PATH_JS_JQUERY);
if ($GLOBALS['xoopsModuleConfig']['json']) $GLOBALS['xoTheme']->addScript( XOOPS_URL._XCONTENT_PATH_JS_CORE );
$GLOBALS['xoTheme']->addStylesheet( XOOPS_URL._XCONTENT_PATH_CSS_INDEX );

$xcontent_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_XCONTENT, _XCONTENT_DIRNAME);

if (!empty($storyid)&&$xcontent_handler->getCount(new Criteria('storyid', $storyid))!=0) {
	if ($xcontent = $xcontent_handler->getContent($storyid)) {

		if (!$gperm_handler->checkRight(_XCONTENT_PERM_MODE_VIEW._XCONTENT_PERM_TYPE_XCONTENT,$xcontent['xcontent']->getVar('storyid'),$groups, $modid))
			redirect_header(XOOPS_URL, 10, _XCONTENT_NOPERMISSIONS);
		elseif ( !$gperm_handler->checkRight(_XCONTENT_PERM_MODE_VIEW._XCONTENT_PERM_TYPE_CATEGORY,$xcontent['xcontent']->getVar('catid'),$groups, $modid)
				&& $GLOBALS['xoopsModuleConfig']['security'] != _XCONTENT_SECURITY_BASIC )
			redirect_header(XOOPS_URL, 10, _XCONTENT_NOPERMISSIONS);
		else {
			
			if ($GLOBALS['xoopsModuleConfig']['htaccess'])
				if (strpos($_SERVER['REQUEST_URI'], 'odules/')>0) {
					$category_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_CATEGORY, _XCONTENT_DIRNAME);
					$category = $category_handler->getCategory($xcontent['xcontent']->getVar('catid'));
					if ($category['text']->getVar('title')!='') {
						header( "HTTP/1.1 301 Moved Permanently" ); header('Location: '.XOOPS_URL.'/'.$GLOBALS['xoopsModuleConfig']['baseurl'].'/'.xoops_sef($category['text']->getVar('title')).'/'.xoops_sef($xcontent['text']->getVar('ptitle')).'/'.$xcontent['xcontent']->getVar('storyid').','.$xcontent['xcontent']->getVar('catid').$GLOBALS['xoopsModuleConfig']['endofurl']);
					} else {
						header( "HTTP/1.1 301 Moved Permanently" ); header('Location: '.XOOPS_URL.'/'.$GLOBALS['xoopsModuleConfig']['baseurl'].'/'.xoops_sef($xcontent['text']->getVar('ptitle')).'/'.$xcontent['xcontent']->getVar('storyid').','.$xcontent['xcontent']->getVar('catid').$GLOBALS['xoopsModuleConfig']['endofurl']);
					}
					exit(0);
				}
			
			if ($xcontent['xcontent']->getVar('link')==1&&$xcontent['xcontent']->getVar('address')!='http://') {
				header( "HTTP/1.1 301 Moved Permanently" ); header('Location: '.$xcontent['xcontent']->getVar('address'));
				exit(0);
			}
			
			if ($xcontent['xcontent']->getVar('storyid')>0&&$xcontent['xcontent']->getVar('visible')==1) {
				
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
				
				$member_handler =& xoops_gethandler('member');
				$author = $member_handler->getUser($xcontent['xcontent']->getVar('uid'));
				$GLOBALS['xoopsTpl']->assign('xoAuthor', $author->toArray());
				$GLOBALS['xoopsTpl']->assign('xoPubdate', date(_SHORTDATESTRING, $xcontent['xcontent']->getVar('date')));
				$GLOBALS['xoopsTpl']->assign('xoXcontent', array_merge($xcontent['xcontent']->toArray(), $xcontent['text']->toArray(), $xcontent['perms']));
				$GLOBALS['xoopsTpl']->assign('xoModule', $GLOBALS['xoopsModule']->toArray());
				$GLOBALS['xoopsTpl']->assign('xoConfig', $GLOBALS['xoopsModuleConfig']);			
				$GLOBALS['xoopsTpl']->assign('breadcrumb', xcontent_getBreadCrumb($xcontent['xcontent']->getVar('storyid')));
				$GLOBALS['xoopsTpl']->assign('xoops_pagetitle', xcontent_getPageTitle($xcontent['xcontent']->getVar('storyid')));
				$GLOBALS['xoTheme']->addMeta( 'meta', 'keywords', xcontent_getMetaKeywords($xcontent['xcontent']->getVar('storyid')));
				$GLOBALS['xoTheme']->addMeta( 'meta', 'description', xcontent_getMetaDescription($xcontent['xcontent']->getVar('storyid')));
	
				$nohtml = ($xcontent['xcontent']->getVar('nohtml'))?0:1;
				$nosmiley = ($xcontent['xcontent']->getVar('nosmiley'))?0:1;
				$nobreaks = ($xcontent['xcontent']->getVar('nobreaks'))?0:1;
	
				$GLOBALS['xoopsTpl']->assign('catid', $xcontent['xcontent']->getVar('catid'));
				$GLOBALS['xoopsTpl']->assign('xcontent_pagetitle', $xcontent['text']->getVar('ptitle'));
				$GLOBALS['xoopsTpl']->assign('xcontent_text', $myts->displayTarea(clear_unicodeslashes($xcontent['text']->getVar('text')), $nohtml, $nosmiley, 1, 1, $nobreaks));
	
				if (file_exists($GLOBALS['xoops']->path("/modules/tag/include/tagbar.php"))) {
					include_once XOOPS_ROOT_PATH."/modules/tag/include/tagbar.php";
					$GLOBALS['xoopsTpl']->assign('tagbar', tagBar($xcontent['xcontent']->getVar('storyid'), $catid = 0));
				}
			} else {
				redirect_header(XOOPS_URL, 10, _XCONTENT_NOTVISIBLE);
			}
		}
	}
} else {
	if ($xcontent = $xcontent_handler->getHompage()) {

		if (!$gperm_handler->checkRight(_XCONTENT_PERM_MODE_VIEW._XCONTENT_PERM_TYPE_XCONTENT,$xcontent['xcontent']->getVar('storyid'),$groups, $modid))
			redirect_header(XOOPS_URL, 10, _XCONTENT_NOPERMISSIONS);
		elseif (!$gperm_handler->checkRight(_XCONTENT_PERM_MODE_VIEW._XCONTENT_PERM_TYPE_CATEGORY,$xcontent['xcontent']->getVar('catid'),$groups, $modid)
				&& $GLOBALS['xoopsModuleConfig']['security'] != _XCONTENT_SECURITY_BASIC )
			redirect_header(XOOPS_URL, 10, _XCONTENT_NOPERMISSIONS);
		else {

			if ($xcontent['xcontent']->getVar('link')==1&&$xcontent['xcontent']->getVar('address')!='http://') {
				header( "HTTP/1.1 301 Moved Permanently" ); header('Location: '.$xcontent['xcontent']->getVar('address'));
				exit(0);
			}

			if ($xcontent['xcontent']->getVar('storyid')>0) {
				header( "HTTP/1.1 301 Moved Permanently" ); header('Location: '.XOOPS_URL.'/modules/xcontent/?storyid='.$xcontent['xcontent']->getVar('storyid'));
				exit(0);
			}
		}
	}
}
include $GLOBALS['xoops']->path('/include/comment_view.php');
include_once $GLOBALS['xoops']->path(_XCONTENT_PATH_PHP_FOOTER);
?>