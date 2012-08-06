<?php


	function xoops_kernel_block_plugin_xcontent()
	{
		return intval($_GET['storyid']);
	}

	function xoops_kernel_block_list_plugin_xcontent()
	{
		$xcontent_handler =& xoops_getmodulehandler('xcontent', 'xcontent');
		$xcontents = $xcontent_handler->getObjects(NULL, true);
		foreach($xcontents as $storyid => $xcontent) {
			$data = $xcontent_handler->getContent($storyid);
			$ret[$storyid] = $data['text']->getVar('title').' - '.$data['text']->getVar('ptitle');
		}
		return $ret;
	}

?>