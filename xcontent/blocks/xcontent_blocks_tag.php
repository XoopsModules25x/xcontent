<?php

/*
Module: xContent

Version: 2.01

Description: Multilingual Content Module with tags and lists with search functions

Author: Written by Simon Roberts aka. Wishcraft (simon@chronolabs.coop)

Owner: Chronolabs

License: See /docs - GPL 2.0
*/


function xcontent_tag_block_cloud_show($options)
{
    include_once XOOPS_ROOT_PATH."/modules/tag/blocks/block.php";
    return tag_block_cloud_show($options, $module_dirname);
}
function xcontent_tag_block_cloud_edit($options)
{
    include_once XOOPS_ROOT_PATH."/modules/tag/blocks/block.php";
    return tag_block_cloud_edit($options);
}
function xcontent_tag_block_top_show($options)
{
    include_once XOOPS_ROOT_PATH."/modules/tag/blocks/block.php";
    return tag_block_top_show($options, $module_dirname);
}
function xcontent_tag_block_top_edit($options)
{
    include_once XOOPS_ROOT_PATH."/modules/tag/blocks/block.php";
    return tag_block_top_edit($options);
}

?>