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
class XcontentBlock extends XoopsObject
{

    function XcontentBlock($id = null)
    {
        $this->initVar('blockid', XOBJ_DTYPE_INT, null, false);
		$this->initVar('created', XOBJ_DTYPE_INT, null, false);
		$this->initVar('uid', XOBJ_DTYPE_INT, null, false);
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
class XcontentBlockHandler extends XoopsPersistableObjectHandler
{
    function __construct(&$db) 
    {
		$this->db = $db;
        parent::__construct($db, _XCONTENT_TABLE_BLOCK, 'XcontentBlock', "blockid", "created");
    }

	function createnew() 
	{
		$ret = array();
		$text_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_TEXT, _XCONTENT_DIRNAME);
		$ret['text'] = $text_handler->create();
		$ret['block'] = $this->create();
		return $ret;
	}
	
	function getBlock($blockid = 0, $language = '')
	{
		$ret = array();
		if (empty($language)) {
			$language = $GLOBALS['xoopsConfig']['language'];
		}
		$text_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_TEXT, _XCONTENT_DIRNAME);
		$criteria = new CriteriaCompo(new Criteria('blockid', $blockid));
		$criteria->add(new Criteria('type', _XCONTENT_ENUM_TYPE_BLOCK));
		$criteria->add(new Criteria('language', $language));
		if ($texts = $text_handler->getObjects($criteria)) {
			$ret['text'] = $texts[0];
			$ret['block'] = $this->get($blockid);
			return $ret;
		}

		$ret["text"] = $text_handler->create();
		$ret["text"]->setVar('language', $language);
		$ret['block'] = $this->get($blockid);	
		return $ret;
	}
	
}

?>