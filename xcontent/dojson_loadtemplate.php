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
$GLOBALS['xoopsLogger']->activated = false;
include ($GLOBALS['xoops']->path(_XCONTENT_PATH_PHP_JSON));

$json = new services_JSON();

$values = array();
$submit = true;
if ($passkey!=xcontent_passkey())
{
	ob_start();
	xoops_error(_XCONTENT_MSG_SECURITYTOKEN);
	$msg = ob_get_xcontents();
	ob_end_clean();
}

	switch($form){
	case _XCONTENT_URL_FORM_XCONTENT:
		if (!$msg) {
			if (file_exists($GLOBALS['xoops']->path(_XCONTENT_PATH_PREDEFINED_RSS) . $_GET['template'])) {
				$_GET['rss'] = file_get_contents($GLOBALS['xoops']->path(_XCONTENT_PATH_PREDEFINED_RSS) . $_GET['template']);
				$_GET['text'] = file_get_contents($GLOBALS['xoops']->path(_XCONTENT_PATH_PREDEFINED_HTML) . $_GET['template']);
				$values['innerhtml']['forms'] = xcontent_addxcontent($storyid, $_GET['language']);
			} else {
				$_GET['rss'] = '';
				$_GET['text'] = '';			
				$values['innerhtml']['forms'] = xcontent_addxcontent($storyid, $_GET['language']);
			}
		} else {
			$values['val']['rss'] = $msg;
			$values['val']['text'] = $msg;
		}
		break;
	}

print $json->encode($values);
?>