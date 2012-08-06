<?php

/*
Module: xContent

Version: 2.01

Description: Multilingual Content Module with tags and lists with search functions

Author: Written by Simon Roberts aka. Wishcraft (simon@chronolabs.coop)

Owner: Chronolabs

License: See /docs - GPL 2.0
*/



if (!defined('XOOPS_ROOT_PATH')) {
	exit();
}
/**
 * Class for Blue Room xContent
 * @author Simon Roberts <simon@xoops.org>
 * @copyright copyright (c) 2009-2003 XOOPS.org
 * @package kernel
 */
class XcontentText extends XoopsObject
{

    function XcontentText($id = null)
    {
        $this->initVar('xcontentid', XOBJ_DTYPE_INT, null, false);
        $this->initVar('storyid', XOBJ_DTYPE_INT, null, false);
		$this->initVar('catid', XOBJ_DTYPE_INT, null, false);
		$this->initVar('blockid', XOBJ_DTYPE_INT, null, false);		
		$this->initVar('type', XOBJ_DTYPE_ENUM, 'xcontent', false, false, false, array('xcontent','category','block'));
        $this->initVar('language', XOBJ_DTYPE_TXTBOX, $GLOBALS['xoopsConfig']['language'], true, 32);
		$this->initVar('title', XOBJ_DTYPE_TXTBOX, null, true, 255); // Removed Unicode in 2.10
		$this->initVar('ptitle', XOBJ_DTYPE_TXTBOX, null, false, 255); // Removed Unicode in 2.10
		$this->initVar('text', XOBJ_DTYPE_OTHER, null, false); // Removed Unicode in 2.10
		$this->initVar('rss', XOBJ_DTYPE_OTHER, null, false); // Removed Unicode in 2.10
		$this->initVar('keywords', XOBJ_DTYPE_OTHER, null, false); // Removed Unicode in 2.10
		$this->initVar('page_description', XOBJ_DTYPE_OTHER, null, false); // Removed Unicode in 2.10
    }

}


/**
* XOOPS policies handler class.
* This class is responsible for providing data access mechanisms to the data source
* of XOOPS user class objects.
*
* @author  Simon Roberts <simon@chronolabs.coop>
* @package kernel
*/
class XcontentTextHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db) 
    {
		$this->db = $db;
        parent::__construct($db, _XCONTENT_TABLE_TEXT, 'XcontentText', "xcontentid", "title");
    }
}

?>