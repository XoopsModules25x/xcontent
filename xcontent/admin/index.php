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
	
	xoops_loadlanguage('main', 'xcontent');
	
	switch ($op){
	default:
	case _XCONTENT_URL_OP_DASHBOARD:

		xoops_cp_header();
		$indexAdmin = new ModuleAdmin();
		echo $indexAdmin->addNavigation(basename($_SERVER['PHP_SELF']).'?op='.$op);	
		
		$category_handler = xoops_getmodulehandler('category', 'xcontent');
		$xcontent_handler = xoops_getmodulehandler('xcontent', 'xcontent');
	 	$indexAdmin = new ModuleAdmin();
	    $indexAdmin->addInfoBox(_XCONTENT_ADMIN_COUNTS);
	    $indexAdmin->addInfoBoxLine(_XCONTENT_ADMIN_COUNTS, "<label>"._XCONTENT_ADMIN_THEREARE_CATEGORIES."</label>", $category_handler->getCount(NULL), 'Green');
	    $indexAdmin->addInfoBoxLine(_XCONTENT_ADMIN_COUNTS, "<label>"._XCONTENT_ADMIN_THEREARE_ARTICLES."</label>", $xcontent_handler->getCount(NULL), 'Green');
	    echo $indexAdmin->renderIndex();
		xoops_cp_footer();		
		break;				
	    	
	case _XCONTENT_URL_OP_ABOUT:
		xoops_cp_header();
		$indexAdmin = new ModuleAdmin();
		echo $indexAdmin->addNavigation(basename($_SERVER['PHP_SELF']).'?op='.$op);	
		
		$paypalitemno='VOD106';
		$aboutAdmin = new ModuleAdmin();
		$about = $aboutAdmin->renderabout($paypalitemno, false);
		$donationform = array(	0 => '<form name="donation" id="donation" action="http://www.chronolabs.coop/modules/xpayment/" method="post" onsubmit="return xoopsFormValidate_donation();">',
								1 => '<table class="outer" cellspacing="1" width="100%"><tbody><tr><th colspan="2">'.constant('_XCONTENT_ABOUT_MAKEDONATE').'</th></tr><tr align="left" valign="top"><td class="head"><div class="xoops-form-element-caption-required"><span class="caption-text">Donation Amount</span><span class="caption-marker">*</span></div></td><td class="even"><select size="1" name="item[A][amount]" id="item[A][amount]" title="Donation Amount"><option value="5">5.00 AUD</option><option value="10">10.00 AUD</option><option value="20">20.00 AUD</option><option value="40">40.00 AUD</option><option value="60">60.00 AUD</option><option value="80">80.00 AUD</option><option value="90">90.00 AUD</option><option value="100">100.00 AUD</option><option value="200">200.00 AUD</option></select></td></tr><tr align="left" valign="top"><td class="head"></td><td class="even"><input class="formButton" name="submit" id="submit" value="'._SUBMIT.'" title="'._SUBMIT.'" type="submit"></td></tr></tbody></table>',
								2 => '<input name="op" id="op" value="createinvoice" type="hidden"><input name="plugin" id="plugin" value="donations" type="hidden"><input name="donation" id="donation" value="1" type="hidden"><input name="drawfor" id="drawfor" value="Chronolabs Co-Operative" type="hidden"><input name="drawto" id="drawto" value="%s" type="hidden"><input name="drawto_email" id="drawto_email" value="%s" type="hidden"><input name="key" id="key" value="%s" type="hidden"><input name="currency" id="currency" value="AUD" type="hidden"><input name="weight_unit" id="weight_unit" value="kgs" type="hidden"><input name="item[A][cat]" id="item[A][cat]" value="XDN%s" type="hidden"><input name="item[A][name]" id="item[A][name]" value="Donation for %s" type="hidden"><input name="item[A][quantity]" id="item[A][quantity]" value="1" type="hidden"><input name="item[A][shipping]" id="item[A][shipping]" value="0" type="hidden"><input name="item[A][handling]" id="item[A][handling]" value="0" type="hidden"><input name="item[A][weight]" id="item[A][weight]" value="0" type="hidden"><input name="item[A][tax]" id="item[A][tax]" value="0" type="hidden"><input name="return" id="return" value="http://www.chronolabs.coop/modules/donations/success.php" type="hidden"><input name="cancel" id="cancel" value="http://www.chronolabs.coop/modules/donations/success.php" type="hidden"></form>',																'D'=>'',
								3 => '',
								4 => '<!-- Start Form Validation JavaScript //-->
<script type="text/javascript">
<!--//
function xoopsFormValidate_donation() { var myform = window.document.donation; 
var hasSelected = false; var selectBox = myform.item[A][amount];for (i = 0; i < selectBox.options.length; i++ ) { if (selectBox.options[i].selected == true && selectBox.options[i].value != \'\') { hasSelected = true; break; } }if (!hasSelected) { window.alert("Please enter Donation Amount"); selectBox.focus(); return false; }return true;
}
//--></script>
<!-- End Form Validation JavaScript //-->');
	$paypalform = array(	0 => '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">',
								1 => '<input name="cmd" value="_s-xclick" type="hidden">',
								2 => '<input name="hosted_button_id" value="%s" type="hidden">',
								3 => '<img alt="" src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" height="1" border="0" width="1">',
								4 => '<input src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!" border="0" type="poster">',
								5 => '</form>');
		for($key=0;$key<=4;$key++) {
			switch ($key) {
				case 2:
					$donationform[$key] =  sprintf($donationform[$key], $GLOBALS['xoopsConfig']['sitename'] . ' - ' . (strlen($GLOBALS['xoopsUser']->getVar('name'))>0?$GLOBALS['xoopsUser']->getVar('name'). ' ['.$GLOBALS['xoopsUser']->getVar('uname').']':$GLOBALS['xoopsUser']->getVar('uname')), $GLOBALS['xoopsUser']->getVar('email'), XOOPS_LICENSE_KEY, strtoupper($GLOBALS['xcontentModule']->getVar('dirname')),  strtoupper($GLOBALS['xcontentModule']->getVar('dirname')). ' '.$GLOBALS['xcontentModule']->getVar('name'));
					break;
			}
		}
		
		$istart = strpos($about, ($paypalform[0]), 1);
		$iend = strpos($about, ($paypalform[5]), $istart+1)+strlen($paypalform[5])-1;
		echo (substr($about, 0, $istart-1));
		echo implode("\n", $donationform);
		echo (substr($about, $iend+1, strlen($about)-$iend-1));
		xoops_cp_footer();		
		break;				

	case _XCONTENT_URL_OP_SAVE:
		switch($fct) {
		case _XCONTENT_URL_FCT_PAGES:
			
			foreach($_POST as $id => $val)
				${$id} = $val;
			
			$xcontent_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_XCONTENT, _XCONTENT_DIRNAME);
			
			foreach($catid as $storyid => $val) {
				$xcontent = $xcontent_handler->get($storyid);
				
				$xcontent->setVar('catid', $catid[$storyid]);
				$xcontent->setVar('parent_id', $parent_id[$storyid]);
				$xcontent->setVar('submenu', $submenu[$storyid]);
				$xcontent->setVar('weight', $weight[$storyid]);

				if ($homepage[$storyid]==true) {
					$sql = "UPDATE ".$GLOBALS['xoopsDB']->prefix(_XCONTENT_TABLE_XCONTENT).' SET homepage=0';
					@$GLOBALS['xoopsDB']->queryF($sql);
				}			
				
				$xcontent->setVar('homepage', $homepage[$storyid]);
				
				@$xcontent_handler->insert($xcontent);
			}
			
			redirect_header('index.php?op='._XCONTENT_URL_OP_MANAGE.'&fct='._XCONTENT_URL_FCT_XCONTENT, 7, _XCONTENT_MSG_XCONTENTSAVED);
				
			exit(0);
			break;		

		case _XCONTENT_URL_FCT_CATEGORIES:
		
			foreach($_POST as $id => $val)
				${$id} = $val;
		
			$category_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_CATEGORY, _XCONTENT_DIRNAME);
		
			foreach($parent_id as $catid => $val) {
				$category = $category_handler->get($catid);
				
				$category->setVar('parent_id', $parent_id[$catid]);
				$category->setVar('rssenabled', (isset($rssenabled[$catid])?true:false));
								
				@$category_handler->insert($category);
			}

			redirect_header('index.php?op='._XCONTENT_URL_OP_MANAGE.'&fct='._XCONTENT_URL_FCT_CATEGORIES, 7, _XCONTENT_MSG_XCONTENTSAVED);
			exit(0);
			break;		

		case _XCONTENT_URL_FCT_BLOCKS:

			foreach($_POST as $id => $val)
				${$id} = $val;
					
			$block_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_BLOCK, _XCONTENT_DIRNAME);

			if ($blockid==0) 
				$block = $block_handler->createnew();
			else
				$block = $block_handler->getBlock($blockid, $language);

			if ($block['block']->isNew())
				$block['block']->setVar('created', time());
			$block['block']->setVar('uid', $GLOBALS['xoopsUser']->getVar('uid'), true);

			if ($block_handler->insert($block['block'])) {
				$text_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_TEXT, _XCONTENT_DIRNAME);
				$block['text']->setVar('type', _XCONTENT_ENUM_TYPE_BLOCK);
				$block['text']->setVar('blockid', $block['block']->getVar('blockid'));
				if (!empty($language))
				$block['text']->setVar('language', $language);
				if (!empty($title))
				$block['text']->setVar('title', $title);
				if (!empty($ptitle))
				$block['text']->setVar('ptitle', $ptitle);
				if (!empty($text))
				$block['text']->setVar('text', $text);
				if (!empty($keywords))
				$block['text']->setVar('keywords', $keywords);
				if (!empty($rss))
				$block['text']->setVar('rss', $rss);
				if (!empty($page_description))
				$block['text']->setVar('page_description', $page_description);
				if ($text_handler->insert($block['text'])) {
					redirect_header('index.php?op='._XCONTENT_URL_OP_MANAGE.'&fct='._XCONTENT_URL_FCT_BLOCKS, 6, 	_XCONTENT_MSG_BLOCKSAVED);
				} else {
					redirect_header('index.php?op='._XCONTENT_URL_OP_MANAGE.'&fct='._XCONTENT_URL_FCT_BLOCKS, 6, 	_XCONTENT_MSG_BLOCKNOTSAVED);
				}			
			}else
				redirect_header('index.php?op='._XCONTENT_URL_OP_MANAGE.'&fct='._XCONTENT_URL_FCT_BLOCKS, 6, 	_XCONTENT_MSG_BLOCKNOTSAVED);
			exit(0);
			break;
			
		case _XCONTENT_URL_FCT_CATEGORY:

			foreach($_POST as $id => $val)
				${$id} = $val;
					
			$category_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_CATEGORY, _XCONTENT_DIRNAME);

			if ($catid==0) 
				$category = $category_handler->createnew();
			else
				$category = $category_handler->getCategory($catid, $language);

			if (!empty($rssenabled))
				$category['cat']->setVar('rssenabled', $rssenabled);
			if (!empty($parent_id))
				$category['cat']->setVar('parent_id', $parent_id, true);
			else 
				$category['cat']->setVar('parent_id', false, true);
				
			if ($category_handler->insert($category['cat'])) {
				$text_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_TEXT, _XCONTENT_DIRNAME);
				$category['text']->setVar('type', _XCONTENT_ENUM_TYPE_CATEGORY);
				$category['text']->setVar('catid', $category['cat']->getVar('catid'));
				if (!empty($language))
				$category['text']->setVar('language', $language);
				if (!empty($title))
				$category['text']->setVar('title', $title);
				if (!empty($ptitle))
				$category['text']->setVar('ptitle', $ptitle);
				if (!empty($text))
				$category['text']->setVar('text', $text);
				if (!empty($keywords))
				$category['text']->setVar('keywords', $keywords);
				if (!empty($rss))
				$category['text']->setVar('rss', $rss);
				if (!empty($page_description))
				$category['text']->setVar('page_description', $page_description);
				if ($text_handler->insert($category['text'])) {
					redirect_header('index.php?op='._XCONTENT_URL_OP_MANAGE.'&fct='._XCONTENT_URL_FCT_CATEGORIES, 6, 	_XCONTENT_MSG_CATEGORYSAVED);
				} else {
					redirect_header('index.php?op='._XCONTENT_URL_OP_MANAGE.'&fct='._XCONTENT_URL_FCT_CATEGORIES, 6, 	_XCONTENT_MSG_CATEGORYNOTSAVED);
				}			
			}else
				redirect_header('index.php?op='._XCONTENT_URL_OP_MANAGE.'&fct='._XCONTENT_URL_FCT_CATEGORIES, 6, 	_XCONTENT_MSG_CATEGORYNOTSAVED);
			exit(0);
			break;
			
		case _XCONTENT_URL_FCT_XCONTENT:
			
			foreach($_POST as $id => $val)
				${$id} = $val;
			
			if ($homepage==true) {
				$sql = "UPDATE ".$GLOBALS['xoopsDB']->prefix(_XCONTENT_TABLE_XCONTENT).' SET homepage=0';
				@$GLOBALS['xoopsDB']->queryF($sql);
			}
			
			$xcontent_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_XCONTENT, _XCONTENT_DIRNAME);
			$text_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_TEXT, _XCONTENT_DIRNAME);
			
			if ($storyid==0) {
				$xcontent = $xcontent_handler->createnew();
			} else {
				$xcontent = $xcontent_handler->getContent($storyid, $language);
			}
			
			$xcontent['xcontent']->setVar('uid', $GLOBALS['xoopsUser']->getVar('uid'));
			$xcontent['xcontent']->setVar('parent_id', $parent_id);
			$xcontent['xcontent']->setVar('blockid', $blockid);
			$xcontent['xcontent']->setVar('catid', $catid);
			$xcontent['xcontent']->setVar('weight', $weight);
			$xcontent['xcontent']->setVar('visible', $visible);
			$xcontent['xcontent']->setVar('homepage', $homepage);
			$xcontent['xcontent']->setVar('nohtml', $nohtml);
			$xcontent['xcontent']->setVar('nosmiley', $nosmiley);
			$xcontent['xcontent']->setVar('nobreaks', $nobreaks);
			$xcontent['xcontent']->setVar('nocomments', $nocomments);
			$xcontent['xcontent']->setVar('link', $link);
			if (!empty($address))
			$xcontent['xcontent']->setVar('address', $address);
			$xcontent['xcontent']->setVar('submenu', $submenu);
			$xcontent['xcontent']->setVar('date', time());
			$xcontent['xcontent']->setVar('assoc_module', $assoc_module);
			if (!empty($password)&&$passset&&$password==$password_confirm)
				$xcontent['xcontent']->setVar('password', md5($password));
			elseif (empty($password)&&$passset)
				$xcontent['xcontent']->setVar('password', '');
			
			if ($publishset) {
				$xcontent['xcontent']->setVar('publish', strtotime($publish['date'])+$publish['time']);
				$xcontent['xcontent']->setVar('publish_storyid', $publish_storyid);
			} else {
				$xcontent['xcontent']->setVar('publish', 0);
				$xcontent['xcontent']->setVar('publish_storyid', 0);
			}
			if ($expireset) {
				$xcontent['xcontent']->setVar('expire', strtotime($expire['date'])+$expire['time']);
				$xcontent['xcontent']->setVar('expire_storyid', $expires_storyid);
			} else {
				$xcontent['xcontent']->setVar('expire', 0);
				$xcontent['xcontent']->setVar('expire_storyid', 0);
			}
			

			if (!empty($tags))
			$xcontent['xcontent']->setVar('tags', $tags);
			
			if ($xcontent['xcontent']->isNew())
				$newObject = true;
			else
				$newObject = false;
			
			if ($xcontent_handler->insert($xcontent['xcontent']))
			{
				
				$xcontent['text']->setVar('type', _XCONTENT_ENUM_TYPE_XCONTENT);
				$xcontent['text']->setVar('storyid', $xcontent['xcontent']->getVar('storyid'));
				if (!empty($language))
				$xcontent['text']->setVar('language', $language);
				if (!empty($title))
				$xcontent['text']->setVar('title', $title);
				if (!empty($ptitle))
				$xcontent['text']->setVar('ptitle', $ptitle);
				if (!empty($text))
				$xcontent['text']->setVar('text', $text);
				if (!empty($keywords))
				$xcontent['text']->setVar('keywords', $keywords);
				if (!empty($rss))
				$xcontent['text']->setVar('rss', $rss);
				if (!empty($page_description))
				$xcontent['text']->setVar('page_description', $page_description);
				if ($text_handler->insert($xcontent['text'])) {
					$values['innerhtml']['forms'] = xcontent_addxcontent($xcontent['xcontent']->getVar('storyid'), $language);
				}
				
			}
			
			if (file_exists($GLOBALS['xoops']->path('/modules/tag/class/tag.php'))&&$GLOBALS['xoopsModuleConfig']['tags']) {
				$tag_handler = xoops_getmodulehandler('tag', 'tag');
				$tag_handler->updateByItem($_POST['tags'], $xcontent['xcontent']->getVar('storyid'), $GLOBALS['xoopsModule']->getVar("dirname"), $xcontent['xcontent']->getVar('catid'));
			}
			
			if ($newObject==true) {
				$groupperm =& xoops_gethandler('groupperm');
				$criteria = new Criteria('gperm_name', _XCONTENT_PERM_TEMPLATE_VIEW_XCONTENT);
				$groupperms = $groupperm->getObjects($criteria);
				foreach ($groupperms as $id => $perm) {
					$newperm = $groupperm->create();
					$newperm->setVar('gperm_groupid', $perm->getVar('gperm_groupid'));
					$newperm->setVar('gperm_itemid', $xcontent['xcontent']->getVar('storyid'));
					$newperm->setVar('gperm_modid', $GLOBALS['xoopsModule']->getVar('mid'));
					$newperm->setVar('gperm_name', _XCONTENT_PERM_MODE_VIEW._XCONTENT_PERM_TYPE_XCONTENT);
					@$groupperm->insert($newperm);
				}
			}
			
			redirect_header('index.php?op='._XCONTENT_URL_OP_EDIT.'&fct='._XCONTENT_URL_FCT_XCONTENT.'&storyid='.$xcontent['xcontent']->getVar('storyid').'&language='.$xcontent['text']->getVar('language'), 7, _XCONTENT_MSG_XCONTENTSAVED);
			exit(0);
			
			break;
			
		}
		break;
	case _XCONTENT_URL_OP_EDIT:
		switch ($fct){
			case _XCONTENT_URL_FCT_XCONTENT:
				xoops_cp_header();
				$indexAdmin = new ModuleAdmin();
			   	echo $indexAdmin->addNavigation(basename($_SERVER['PHP_SELF']).'?op='.$op.'&fct='.$fct);
				if ($GLOBALS['xoopsModuleConfig']['json']) $GLOBALS['xoTheme']->addScript( XOOPS_URL._XCONTENT_PATH_JS_CORE );
				if ($GLOBALS['xoopsModuleConfig']['force_cpanel_jquery']) $GLOBALS['xoTheme']->addScript(XOOPS_URL._XCONTENT_PATH_JS_JQUERY);
				
				$GLOBALS['contentTpl'] = new XoopsTpl();
				$GLOBALS['contentTpl']->assign('passkey', xcontent_passkey());
				$GLOBALS['contentTpl']->assign('xoConfig', $GLOBALS['xoopsModuleConfig']);
				$GLOBALS['contentTpl']->assign('xoModule', $GLOBALS['xoopsModule']->toArray());
				$xcontent_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_XCONTENT, _XCONTENT_DIRNAME);

                if (isset($_GET['language'])){
                  $xcontent = $xcontent_handler->getContent($storyid, $_GET['language']);
				  $GLOBALS['contentTpl']->assign('form', xcontent_addxcontent($storyid, $_GET['language']));
                 } else {
                    $xcontent = $xcontent_handler->getContent($storyid, $GLOBALS['xoopsConfig']['language']);
                  $GLOBALS['contentTpl']->assign('form', xcontent_addxcontent($storyid, $GLOBALS['xoopsConfig']['language']));
                 }
				$GLOBALS['contentTpl']->assign('xcontent', array_merge($xcontent['xcontent']->toArray(), $xcontent['text']->toArray()));
				if (!$GLOBALS['xoopsModuleConfig']['json'])
					$GLOBALS['contentTpl']->display('db:'._XCONTENT_TEMPLATE_CPANEL_ADDEDITPAGE);
				else
					$GLOBALS['contentTpl']->display('db:'._XCONTENT_TEMPLATE_CPANEL_JSON_ADDEDITPAGE);
				xoops_cp_footer();
				break;
			case _XCONTENT_URL_FCT_CATEGORY:
				xoops_cp_header();
				$indexAdmin = new ModuleAdmin();
			   	echo $indexAdmin->addNavigation(basename($_SERVER['PHP_SELF']).'?op='.$op.'&fct='.$fct);	
							
				if ($GLOBALS['xoopsModuleConfig']['json']) $GLOBALS['xoTheme']->addScript( XOOPS_URL._XCONTENT_PATH_JS_CORE );
				if ($GLOBALS['xoopsModuleConfig']['force_cpanel_jquery']) $GLOBALS['xoTheme']->addScript(XOOPS_URL._XCONTENT_PATH_JS_JQUERY);
				
				$GLOBALS['contentTpl'] = new XoopsTpl();
				$GLOBALS['contentTpl']->assign('passkey', xcontent_passkey());
				$GLOBALS['contentTpl']->assign('xoConfig', $GLOBALS['xoopsModuleConfig']);
				$GLOBALS['contentTpl']->assign('xoModule', $GLOBALS['xoopsModule']->toArray());
				$category_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_CATEGORY, _XCONTENT_DIRNAME);
                if (isset($_GET['language'])) {
                    $category = $category_handler->getCategory($catid, $_GET['language']);
                } else {
                    $category = $category_handler->getCategory($catid, $GLOBALS['xoopsConfig']['language']);
                }
				$GLOBALS['contentTpl']->assign('category', array_merge($category['cat']->toArray(), $category['text']->toArray()));
				$GLOBALS['contentTpl']->assign('form', xcontent_addcategory($catid, $language));
				if (!$GLOBALS['xoopsModuleConfig']['json'])
					$GLOBALS['contentTpl']->display('db:'._XCONTENT_TEMPLATE_CPANEL_ADDEDITCATEGORY);
				else
					$GLOBALS['contentTpl']->display('db:'._XCONTENT_TEMPLATE_CPANEL_JSON_ADDEDITCATEGORY);
					
				xoops_cp_footer();		
				break;

			case _XCONTENT_URL_FCT_BLOCKS:
				xoops_cp_header();
				
				$indexAdmin = new ModuleAdmin();
			   	echo $indexAdmin->addNavigation(basename($_SERVER['PHP_SELF']).'?op='.$op.'&fct='.$fct);	
							
				if ($GLOBALS['xoopsModuleConfig']['json']) $GLOBALS['xoTheme']->addScript( XOOPS_URL._XCONTENT_PATH_JS_CORE );
				if ($GLOBALS['xoopsModuleConfig']['force_cpanel_jquery']) $GLOBALS['xoTheme']->addScript(XOOPS_URL._XCONTENT_PATH_JS_JQUERY);
				
				$GLOBALS['contentTpl'] = new XoopsTpl();
				$GLOBALS['contentTpl']->assign('passkey', xcontent_passkey());
				$GLOBALS['contentTpl']->assign('xoConfig', $GLOBALS['xoopsModuleConfig']);
				$GLOBALS['contentTpl']->assign('xoModule', $GLOBALS['xoopsModule']->toArray());
				$block_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_BLOCK, _XCONTENT_DIRNAME);
                if (isset($_GET['language'])) {
                    $block = $block_handler->getBlock($blockid, $_GET['language']);
                } else {
                    $block = $block_handler->getBlock($blockid, $GLOBALS['xoopsConfig']['language']);
                }
				$GLOBALS['contentTpl']->assign('block', array_merge($block['block']->toArray(), $block['text']->toArray()));
				$GLOBALS['contentTpl']->assign('form', xcontent_addblock($blockid, $language));
				if (!$GLOBALS['xoopsModuleConfig']['json'])
					$GLOBALS['contentTpl']->display('db:'._XCONTENT_TEMPLATE_CPANEL_ADDEDITBLOCK);
				else
					$GLOBALS['contentTpl']->display('db:'._XCONTENT_TEMPLATE_CPANEL_JSON_ADDEDITBLOCK);
				xoops_cp_footer();		
				break;

		}
		break;

	case _XCONTENT_URL_OP_ADD:
		switch ($fct){
			case _XCONTENT_URL_FCT_XCONTENT:
				$category_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_CATEGORY, _XCONTENT_DIRNAME);
				if ($category_handler->getCount(NULL)==0) {
					redirect_header('index.php?op='._XCONTENT_URL_OP_ADD.'&fct='._XCONTENT_URL_FCT_CATEGORIES, 6, _XCONTENT_NEEDCATEGORIES);
					exit(0);
				}
				
				xoops_cp_header();
			   	$indexAdmin = new ModuleAdmin();
			   	echo $indexAdmin->addNavigation(basename($_SERVER['PHP_SELF']).'?op='.$op.'&fct='.$fct);	

			   	if ($GLOBALS['xoopsModuleConfig']['json']) $GLOBALS['xoTheme']->addScript( XOOPS_URL._XCONTENT_PATH_JS_CORE );
				if ($GLOBALS['xoopsModuleConfig']['force_cpanel_jquery']) $GLOBALS['xoTheme']->addScript(XOOPS_URL._XCONTENT_PATH_JS_JQUERY);
				
				$GLOBALS['contentTpl'] = new XoopsTpl();
				$GLOBALS['contentTpl']->assign('passkey', xcontent_passkey());
				$GLOBALS['contentTpl']->assign('xoConfig', $GLOBALS['xoopsModuleConfig']);
				$GLOBALS['contentTpl']->assign('xoModule', $GLOBALS['xoopsModule']->toArray());
				$GLOBALS['contentTpl']->assign('form', xcontent_addxcontent($storyid, $language));
				if (!$GLOBALS['xoopsModuleConfig']['json'])
					$GLOBALS['contentTpl']->display('db:'._XCONTENT_TEMPLATE_CPANEL_ADDEDITPAGE);
				else
					$GLOBALS['contentTpl']->display('db:'._XCONTENT_TEMPLATE_CPANEL_JSON_ADDEDITPAGE);
				xoops_cp_footer();	
				break;
			case _XCONTENT_URL_FCT_CATEGORIES:
				xoops_cp_header();
			   	$indexAdmin = new ModuleAdmin();
			   	echo $indexAdmin->addNavigation(basename($_SERVER['PHP_SELF']).'?op='.$op.'&fct='.$fct);	
				
			   	if ($GLOBALS['xoopsModuleConfig']['json']) $GLOBALS['xoTheme']->addScript( XOOPS_URL._XCONTENT_PATH_JS_CORE );
				if ($GLOBALS['xoopsModuleConfig']['force_cpanel_jquery']) $GLOBALS['xoTheme']->addScript(XOOPS_URL._XCONTENT_PATH_JS_JQUERY);
				
				$GLOBALS['contentTpl'] = new XoopsTpl();
				$GLOBALS['contentTpl']->assign('passkey', xcontent_passkey());
				$GLOBALS['contentTpl']->assign('xoConfig', $GLOBALS['xoopsModuleConfig']);
				$GLOBALS['contentTpl']->assign('xoModule', $GLOBALS['xoopsModule']->toArray());
				$GLOBALS['contentTpl']->assign('form', xcontent_addcategory($catid, $language));
				if (!$GLOBALS['xoopsModuleConfig']['json']) {
					$GLOBALS['contentTpl']->display('db:'._XCONTENT_TEMPLATE_CPANEL_ADDEDITCATEGORY);
				} else
					$GLOBALS['contentTpl']->display('db:'._XCONTENT_TEMPLATE_CPANEL_JSON_ADDEDITCATEGORY);
				xoops_cp_footer();		
				break;

			case _XCONTENT_URL_FCT_BLOCKS:
				xoops_cp_header();
			   	$indexAdmin = new ModuleAdmin();
			   	echo $indexAdmin->addNavigation(basename($_SERVER['PHP_SELF']).'?op='.$op.'&fct='.$fct);	
				
				if ($GLOBALS['xoopsModuleConfig']['json']) $GLOBALS['xoTheme']->addScript( XOOPS_URL._XCONTENT_PATH_JS_CORE );
				if ($GLOBALS['xoopsModuleConfig']['force_cpanel_jquery']) $GLOBALS['xoTheme']->addScript(XOOPS_URL._XCONTENT_PATH_JS_JQUERY);
				
				$GLOBALS['contentTpl'] = new XoopsTpl();
				$GLOBALS['contentTpl']->assign('passkey', xcontent_passkey());
				$GLOBALS['contentTpl']->assign('xoConfig', $GLOBALS['xoopsModuleConfig']);
				$GLOBALS['contentTpl']->assign('xoModule', $GLOBALS['xoopsModule']->toArray());
				$GLOBALS['contentTpl']->assign('form', xcontent_addblock($blockid, $language));

				if (!$GLOBALS['xoopsModuleConfig']['json'])
					$GLOBALS['contentTpl']->display('db:'._XCONTENT_TEMPLATE_CPANEL_ADDEDITBLOCK);
				else
					$GLOBALS['contentTpl']->display('db:'._XCONTENT_TEMPLATE_CPANEL_JSON_ADDEDITBLOCK);
					
				xoops_cp_footer();		
				break;				
		}
		break;
	case _XCONTENT_URL_OP_DELETE:
		switch ($fct){
			case _XCONTENT_URL_FCT_XCONTENT:
				if (empty($_POST['confirmed'])) {
					xoops_cp_header();
					
					xoops_confirm(array('confirmed' => true, 'op' => _XCONTENT_URL_OP_DELETE, 'fct' => _XCONTENT_URL_FCT_XCONTENT, 'storyid' => $storyid), $_SERVER['REQUEST_URI'], sprintf(_XCONTENT_AD_CONFIRM_DELETE, xcontent_getTitle($storyid)));
					xoops_cp_footer();
					exit(0);
				}
				$sql[0] = "DELETE FROM ".$GLOBALS['xoopsDB']->prefix(_XCONTENT_TABLE_XCONTENT)." WHERE storyid = '".$storyid."'";
				$sql[1] = "DELETE FROM ".$GLOBALS['xoopsDB']->prefix(_XCONTENT_TABLE_TEXT)." WHERE type = '"._XCONTENT_ENUM_TYPE_XCONTENT."' and storyid = '".$storyid."'";
				@$GLOBALS['xoopsDB']->queryF($sql[0]);
				@$GLOBALS['xoopsDB']->queryF($sql[1]);
				redirect_header('index.php?op='._XCONTENT_URL_OP_MANAGE.'&fct='._XCONTENT_URL_FCT_XCONTENT, 7, _XCONTENT_AD_MSG_DELETE);
				break;

			case _XCONTENT_URL_FCT_CATEGORY:
				if (empty($_POST['confirmed'])) {
					xoops_cp_header();
					xoops_confirm(array('confirmed' => true, 'op' => _XCONTENT_URL_OP_DELETE, 'fct' => _XCONTENT_URL_FCT_CATEGORY, 'catid' => $catid), $_SERVER['REQUEST_URI'], sprintf(_XCONTENT_AD_CONFIRM_DELETE, xcontent_getCatTitle($catid)));
					xoops_cp_footer();
					exit(0);
				}
				$sql[0] = "DELETE FROM ".$GLOBALS['xoopsDB']->prefix(_XCONTENT_TABLE_CATEGORY)." WHERE catid = '".$catid."'";
				$sql[1] = "DELETE FROM ".$GLOBALS['xoopsDB']->prefix(_XCONTENT_TABLE_TEXT)." WHERE type = '"._XCONTENT_ENUM_TYPE_CATEGORY."' and catid = '".$catid."'";
				@$GLOBALS['xoopsDB']->queryF($sql[0]);
				@$GLOBALS['xoopsDB']->queryF($sql[1]);
				redirect_header('index.php?op='._XCONTENT_URL_OP_MANAGE.'&fct='._XCONTENT_URL_FCT_CATEGORIES, 7, _XCONTENT_AD_MSG_DELETE);
				break;

			case _XCONTENT_URL_FCT_BLOCKS:
				if (empty($_POST['confirmed'])) {
					xoops_cp_header();
					xoops_confirm(array('confirmed' => true, 'op' => _XCONTENT_URL_OP_DELETE, 'fct' => _XCONTENT_URL_FCT_BLOCKS, 'blockid' => $blockid), $_SERVER['REQUEST_URI'], sprintf(_XCONTENT_AD_CONFIRM_DELETE, xcontent_getBlockTitle($blockid)));
					xoops_cp_footer();
					exit(0);
				}
				$sql[0] = "DELETE FROM ".$GLOBALS['xoopsDB']->prefix(_XCONTENT_TABLE_BLOCK)." WHERE blockid = '".$blockid."'";
				$sql[1] = "DELETE FROM ".$GLOBALS['xoopsDB']->prefix(_XCONTENT_TABLE_TEXT)." WHERE type = '"._XCONTENT_ENUM_TYPE_BLOCK."' and blockid = '".$blockid."'";
				@$GLOBALS['xoopsDB']->queryF($sql[0]);
				@$GLOBALS['xoopsDB']->queryF($sql[1]);
				redirect_header('index.php?op='._XCONTENT_URL_OP_MANAGE.'&fct='._XCONTENT_URL_FCT_BLOCKS, 7, _XCONTENT_AD_MSG_DELETE);
				break;

			}

	case _XCONTENT_URL_OP_COPY:
		switch ($fct){
			default:
			case _XCONTENT_URL_FCT_XCONTENT:
				if (empty($_POST['confirmed'])) {
					xoops_cp_header();
					xoops_confirm(array('confirmed' => true, 'op' => _XCONTENT_URL_OP_COPY, 'fct' => _XCONTENT_URL_FCT_XCONTENT, 'storyid' => $storyid), $_SERVER['REQUEST_URI'], sprintf(_XCONTENT_AD_CONFIRM_COPY, xcontent_getTitle($storyid)));
					xoops_cp_footer();
					exit(0);
				}
				
				$xcontent_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_XCONTENT, _XCONTENT_DIRNAME);
				$text_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_TEXT, _XCONTENT_DIRNAME);
				$criteria = new CriteriaCompo(new Criteria('storyid', $storyid));
				$criteria->add(new Criteria('type', _XCONTENT_ENUM_TYPE_XCONTENT));
				$xcontent = $xcontent_handler->get($storyid);
				$texts = $text_handler->getObjects($criteria);
				$xcontentb = $xcontent_handler->create();
				$xcontentb->setVar('storyid', 0);
				$xcontentb->setVar('parent_id', $xcontent->getVar('parent_id'), true);
				$xcontentb->setVar('blockid', $xcontent->getVar('blockid'), true);
				$xcontentb->setVar('catid', $xcontent->getVar('catid'), true);
				$xcontentb->setVar('visible', $xcontent->getVar('visible'), true);
				$xcontentb->setVar('homepage', $xcontent->getVar('homepage'), true);
				$xcontentb->setVar('nohtml', $xcontent->getVar('nohtml'), true);
				$xcontentb->setVar('nosmiley', $xcontent->getVar('nosmiley'), true);
				$xcontentb->setVar('nobreaks', $xcontent->getVar('nobreaks'), true);
				$xcontentb->setVar('nocomments', $xcontent->getVar('nocomments'), true);
				$xcontentb->setVar('link', $xcontent->getVar('link'), true);
				$xcontentb->setVar('address', $xcontent->getVar('address'), true);
				$xcontentb->setVar('submenu', $xcontent->getVar('submenu'), true);
				$xcontentb->setVar('date', time(), true);
				$xcontentb->setVar('assoc_module', $xcontent->getVar('assoc_module'), true);
				$xcontentb->setVar('tags', $xcontent->getVar('tags'), true);
				if ($xcontent_handler->insert($xcontentb)){
					$page++;
					foreach($texts as $id => $text) {
						$textb = $text_handler->create();
						$textb->setVar('storyid', $xcontentb->getVar('storyid'), true);
						$textb->setVar('type', $text->getVar('type'), true);
						$textb->setVar('language', $text->getVar('language'), true);
						$textb->setVar('title', $text->getVar('title'), true);
						$textb->setVar('ptitle', $text->getVar('ptitle'), true);
						$textb->setVar('text', $text->getVar('text'), true);
						$textb->setVar('rss', $text->getVar('rss'), true);
						$textb->setVar('keywords', $text->getVar('keywords'), true);
						$textb->setVar('page_description', $text->getVar('page_description'), true);						
						if ($text_handler->insert($textb))
							$page++;
					}
				} else {
					xoops_cp_header();
					echo loadModuleAdminMenu(1, "");			
					echo xoops_error(implode("<br/>",$xcontentb->getErrors()).'<pre>'.print_r($xcontentb, true).'</pre>');
					xoops_cp_footer();
					exit(0);
				}
				
				redirect_header('index.php?op='._XCONTENT_URL_OP_MANAGE.'&fct='._XCONTENT_URL_FCT_XCONTENT, 7, sprintf(_XCONTENT_AD_MSG_COPY, $page));
				break;

			case _XCONTENT_URL_FCT_BLOCKS:
				if (empty($_POST['confirmed'])) {
					xoops_cp_header();
					xoops_confirm(array('confirmed' => true, 'op' => _XCONTENT_URL_OP_COPY, 'fct' => _XCONTENT_URL_FCT_BLOCKS, 'blockid' => $blockid), $_SERVER['REQUEST_URI'], sprintf(_XCONTENT_AD_CONFIRM_COPY, xcontent_getBlockTitle($blockid)));
					xoops_cp_footer();
					exit(0);
				}
				
				$block_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_BLOCK, _XCONTENT_DIRNAME);
				$text_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_TEXT, _XCONTENT_DIRNAME);
				$criteria = new CriteriaCompo(new Criteria('blockid', $blockid));
				$criteria->add(new Criteria('type', _XCONTENT_ENUM_TYPE_BLOCK));
				$block = $block_handler->get($blockid);
				$texts = $text_handler->getObjects($criteria);
				$blockb = $block_handler->create();
				$blockb->setVar('blockid', 0);
				$blockb->setVar('created', time(), true);
				$blockb->setVar('uid', $block->getVar('uid'), true);
				if ($block_handler->insert($blockb)){
					$page++;
					foreach($texts as $id => $text) {
						$textb = $text_handler->create();
						$textb->setVar('blockid', $blockb->getVar('blockid'), true);
						$textb->setVar('type', $text->getVar('type'), true);
						$textb->setVar('language', $text->getVar('language'), true);
						$textb->setVar('title', $text->getVar('title'), true);
						$textb->setVar('ptitle', $text->getVar('ptitle'), true);
						$textb->setVar('text', $text->getVar('text'), true);
						$textb->setVar('rss', $text->getVar('rss'), true);
						$textb->setVar('keywords', $text->getVar('keywords'), true);
						$textb->setVar('page_description', $text->getVar('page_description'), true);						
						if ($text_handler->insert($textb))
							$page++;
					}
				} else {
					xoops_cp_header();
					echo xoops_error(implode("<br/>",$categoryb->getErrors()).'<pre>'.print_r($categoryb, true).'</pre>');
					xoops_cp_footer();
					exit(0);
				}
				
				redirect_header('index.php?op='._XCONTENT_URL_OP_MANAGE.'&fct='._XCONTENT_URL_FCT_BLOCKS, 7, sprintf(_XCONTENT_AD_MSG_COPY, $page));
				break;

			case _XCONTENT_URL_FCT_CATEGORY:
				if (empty($_POST['confirmed'])) {
					xoops_cp_header();
					xoops_confirm(array('confirmed' => true, 'op' => _XCONTENT_URL_OP_COPY, 'fct' => _XCONTENT_URL_FCT_CATEGORY, 'catid' => $catid), $_SERVER['REQUEST_URI'], sprintf(_XCONTENT_AD_CONFIRM_COPY, xcontent_getCatTitle($catid)));
					xoops_cp_footer();
					exit(0);
				}
				
				$category_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_CATEGORY, _XCONTENT_DIRNAME);
				$text_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_TEXT, _XCONTENT_DIRNAME);
				$criteria = new CriteriaCompo(new Criteria('catid', $catid));
				$criteria->add(new Criteria('type', _XCONTENT_ENUM_TYPE_CATEGORY));
				$category = $category_handler->get($catid);
				$texts = $text_handler->getObjects($criteria);
				$categoryb = $category_handler->create();
				$categoryb->setVar('catid', 0);
				$categoryb->setVar('parent_id', $category->getVar('parent_id'), true);
				$categoryb->setVar('rssenabled', $category->getVar('rssenabled'), true);
				if ($category_handler->insert($categoryb)){
					$page++;
					foreach($texts as $id => $text) {
						$textb = $text_handler->create();
						$textb->setVar('catid', $categoryb->getVar('catid'), true);
						$textb->setVar('type', $text->getVar('type'), true);
						$textb->setVar('language', $text->getVar('language'), true);
						$textb->setVar('title', $text->getVar('title'), true);
						$textb->setVar('ptitle', $text->getVar('ptitle'), true);
						$textb->setVar('text', $text->getVar('text'), true);
						$textb->setVar('rss', $text->getVar('rss'), true);
						$textb->setVar('keywords', $text->getVar('keywords'), true);
						$textb->setVar('page_description', $text->getVar('page_description'), true);						
						if ($text_handler->insert($textb))
							$page++;
					}
				} else {
					xoops_cp_header();
					echo xoops_error(implode("<br/>",$categoryb->getErrors()).'<pre>'.print_r($categoryb, true).'</pre>');
					xoops_cp_footer();
					exit(0);
				}
				
				redirect_header('index.php?op='._XCONTENT_URL_OP_MANAGE.'&fct='._XCONTENT_URL_FCT_CATEGORIES, 7, sprintf(_XCONTENT_AD_MSG_COPY, $page));
				break;

			}
	case _XCONTENT_URL_OP_MANAGE:
		switch ($fct){
			case _XCONTENT_URL_FCT_XCONTENT:
				xoops_cp_header();
			   	$indexAdmin = new ModuleAdmin();
			   	echo $indexAdmin->addNavigation(basename($_SERVER['PHP_SELF']).'?op='.$op.'&fct='.$fct);
                $indexAdmin->addItemButton(_XCONTENT_XCONTENT_ADMENU2, "index.php?op="._XCONTENT_URL_OP_ADD."&fct="._XCONTENT_URL_FCT_XCONTENT, 'add' , '');
                echo $indexAdmin->renderButton('right', '');
				echo xcontent_listxcontent();
				xoops_cp_footer();
				break;
			case _XCONTENT_URL_FCT_BLOCKS:
				xoops_cp_header();
			   	$indexAdmin = new ModuleAdmin();
			   	echo $indexAdmin->addNavigation(basename($_SERVER['PHP_SELF']).'?op='.$op.'&fct='.$fct);
                $indexAdmin->addItemButton(_XCONTENT_XCONTENT_ADMENU6, "index.php?op="._XCONTENT_URL_OP_ADD."&fct="._XCONTENT_URL_FCT_BLOCKS, 'add' , '');
                echo $indexAdmin->renderButton('right', '');
				echo xcontent_listblock();
				xoops_cp_footer();
				break;				
			case _XCONTENT_URL_FCT_CATEGORIES:
				xoops_cp_header();
			   	$indexAdmin = new ModuleAdmin();
			   	echo $indexAdmin->addNavigation(basename($_SERVER['PHP_SELF']).'?op='.$op.'&fct='.$fct);
                $indexAdmin->addItemButton(_XCONTENT_XCONTENT_ADMENU4, "index.php?op="._XCONTENT_URL_OP_ADD."&fct="._XCONTENT_URL_FCT_CATEGORIES, 'add' , '');
                echo $indexAdmin->renderButton('right', '');
				echo xcontent_listcategory();
				xoops_cp_footer();		
				break;
		}
		break;
	case _XCONTENT_URL_OP_PERMISSIONS:
		xoops_cp_header();
	   	$indexAdmin = new ModuleAdmin();
	   	echo $indexAdmin->addNavigation(basename($_SERVER['PHP_SELF']).'?op='.$op.'&fct='._XCONTENT_URL_FCT_TEMPLATE.'&mode='._XCONTENT_PERM_MODE_ALL);
		
		include_once $GLOBALS['xoops']->path(_XCONTENT_PATH_PHP_GROUPPERMS);
			
		foreach ($_POST as $k => $v) {
			${$k} = $v;
		} 
		
		foreach ($_GET as $k => $v) {
			${$k} = $v;
		} 
		
		echo '<div style="float:right; clear:both;"><form name="perms"><select name="permlinks" onChange="window.location=document.perms.permlinks.options[document.perms.permlinks.selectedIndex].value">';
		if ($GLOBALS['xoopsModuleConfig']['security'] == _XCONTENT_SECURITY_BASIC) {
			echo '<option value="'.XOOPS_URL.'/modules/xcontent/admin/index.php?op='._XCONTENT_URL_OP_PERMISSIONS.'&fct='._XCONTENT_URL_FCT_TEMPLATE.'&mode='._XCONTENT_PERM_MODE_ALL.'"';
			if ($fct==_XCONTENT_URL_FCT_TEMPLATE) echo ' selected="selected">'._XCONTENT_PERM_DEFAULT_TEMPLATE.'</option>'; else echo '>'._XCONTENT_PERM_DEFAULT_TEMPLATE.'</option>';
			if ($fct==_XCONTENT_URL_FCT_CATEGORIES && $_GET['mode']==_XCONTENT_PERM_MODE_VIEW) echo ' selected="selected">'._XCONTENT_PERM_VIEW_CATEGORY.'</option>'; else echo '>'._XCONTENT_PERM_VIEW_CATEGORY.'</option>';
			echo '<option value="'.XOOPS_URL.'/modules/xcontent/admin/index.php?op='._XCONTENT_URL_OP_PERMISSIONS.'&fct='._XCONTENT_URL_FCT_XCONTENT.'&mode='._XCONTENT_PERM_MODE_VIEW.'"';
			if ($fct==_XCONTENT_URL_FCT_XCONTENT && $_GET['mode']==_XCONTENT_PERM_MODE_VIEW) echo ' selected="selected">'._XCONTENT_PERM_VIEW_XCONTENT.'</option>'; else echo '>'._XCONTENT_PERM_VIEW_XCONTENT.'</option>';
		} elseif ($GLOBALS['xoopsModuleConfig']['security'] == _XCONTENT_SECURITY_INTERMEDIATE) {
			echo '<option value="'.XOOPS_URL.'/modules/xcontent/admin/index.php?op='._XCONTENT_URL_OP_PERMISSIONS.'&fct='._XCONTENT_URL_FCT_TEMPLATE.'&mode='._XCONTENT_PERM_MODE_ALL.'"';
			if ($fct==_XCONTENT_URL_FCT_TEMPLATE && $_GET['mode']==_XCONTENT_PERM_MODE_ALL) echo ' selected="selected">'._XCONTENT_PERM_DEFAULT_TEMPLATE.'</option>'; else echo '>'._XCONTENT_PERM_DEFAULT_TEMPLATE.'</option>';
			echo '<option value="'.XOOPS_URL.'/modules/xcontent/admin/index.php?op='._XCONTENT_URL_OP_PERMISSIONS.'&fct='._XCONTENT_URL_FCT_CATEGORIES.'&mode='._XCONTENT_PERM_MODE_VIEW.'"';
			if ($fct==_XCONTENT_URL_FCT_CATEGORIES && $_GET['mode']==_XCONTENT_PERM_MODE_VIEW) echo ' selected="selected">'._XCONTENT_PERM_VIEW_CATEGORY.'</option>'; else echo '>'._XCONTENT_PERM_VIEW_CATEGORY.'</option>';
			echo '<option value="'.XOOPS_URL.'/modules/xcontent/admin/index.php?op='._XCONTENT_URL_OP_PERMISSIONS.'&fct='._XCONTENT_URL_FCT_XCONTENT.'&mode='._XCONTENT_PERM_MODE_VIEW.'"';
			if ($fct==_XCONTENT_URL_FCT_XCONTENT && $_GET['mode']==_XCONTENT_PERM_MODE_VIEW) echo ' selected="selected">'._XCONTENT_PERM_VIEW_XCONTENT.'</option>'; else echo '>'._XCONTENT_PERM_VIEW_XCONTENT.'</option>';
			echo '<option value="'.XOOPS_URL.'/modules/xcontent/admin/index.php?op='._XCONTENT_URL_OP_PERMISSIONS.'&fct='._XCONTENT_URL_FCT_BLOCKS.'&mode='._XCONTENT_PERM_MODE_VIEW.'"';
			if ($fct==_XCONTENT_URL_FCT_BLOCKS && $_GET['mode']==_XCONTENT_PERM_MODE_VIEW) echo ' selected="selected">'._XCONTENT_PERM_VIEW_BLOCK.'</option>'; else echo '>'._XCONTENT_PERM_VIEW_BLOCK.'</option>';
			if ($fct==_XCONTENT_URL_FCT_CATEGORIES && $_GET['mode']==_XCONTENT_PERM_MODE_ADD) echo ' selected="selected">'._XCONTENT_PERM_ADD_XCONTENT.'</option>'; else echo '>'._XCONTENT_PERM_EDIT_BLOCK.'</option>';
		} else {
			
			echo '<option value="'.XOOPS_URL.'/modules/xcontent/admin/index.php?op='._XCONTENT_URL_OP_PERMISSIONS.'&fct='._XCONTENT_URL_FCT_TEMPLATE.'&mode='._XCONTENT_PERM_MODE_ALL.'"';
			if ($fct==_XCONTENT_URL_FCT_TEMPLATE && $_GET['mode']==_XCONTENT_PERM_MODE_ALL) echo ' selected="selected">'._XCONTENT_PERM_DEFAULT_TEMPLATE.'</option>'; else echo '>'._XCONTENT_PERM_DEFAULT_TEMPLATE.'</option>';
			
			echo '<option value="'.XOOPS_URL.'/modules/xcontent/admin/index.php?op='._XCONTENT_URL_OP_PERMISSIONS.'&fct='._XCONTENT_URL_FCT_CATEGORIES.'&mode='._XCONTENT_PERM_MODE_VIEW.'"';
			if ($fct==_XCONTENT_URL_FCT_CATEGORIES && $_GET['mode']==_XCONTENT_PERM_MODE_VIEW) echo ' selected="selected">'._XCONTENT_PERM_VIEW_CATEGORY.'</option>'; else echo '>'._XCONTENT_PERM_VIEW_CATEGORY.'</option>';
			
			echo '<option value="'.XOOPS_URL.'/modules/xcontent/admin/index.php?op='._XCONTENT_URL_OP_PERMISSIONS.'&fct='._XCONTENT_URL_FCT_XCONTENT.'&mode='._XCONTENT_PERM_MODE_VIEW.'"';
			if ($fct==_XCONTENT_URL_FCT_XCONTENT && $_GET['mode']==_XCONTENT_PERM_MODE_VIEW) echo ' selected="selected">'._XCONTENT_PERM_VIEW_XCONTENT.'</option>'; else echo '>'._XCONTENT_PERM_VIEW_XCONTENT.'</option>';
			
			echo '<option value="'.XOOPS_URL.'/modules/xcontent/admin/index.php?op='._XCONTENT_URL_OP_PERMISSIONS.'&fct='._XCONTENT_URL_FCT_BLOCKS.'&mode='._XCONTENT_PERM_MODE_VIEW.'"';
			if ($fct==_XCONTENT_URL_FCT_BLOCKS && $_GET['mode']==_XCONTENT_PERM_MODE_VIEW) echo ' selected="selected">'._XCONTENT_PERM_VIEW_BLOCK.'</option>'; else echo '>'._XCONTENT_PERM_VIEW_BLOCK.'</option>';
			
			echo '<option value="'.XOOPS_URL.'/modules/xcontent/admin/index.php?op='._XCONTENT_URL_OP_PERMISSIONS.'&fct='._XCONTENT_URL_FCT_CATEGORIES.'&mode='._XCONTENT_PERM_MODE_EDIT.'"';
			if ($fct==_XCONTENT_URL_FCT_CATEGORIES && $_GET['mode']==_XCONTENT_PERM_MODE_EDIT) echo ' selected="selected">'._XCONTENT_PERM_EDIT_CATEGORY.'</option>'; else echo '>'._XCONTENT_PERM_EDIT_CATEGORY.'</option>';
			
			echo '<option value="'.XOOPS_URL.'/modules/xcontent/admin/index.php?op='._XCONTENT_URL_OP_PERMISSIONS.'&fct='._XCONTENT_URL_FCT_XCONTENT.'&mode='._XCONTENT_PERM_MODE_EDIT.'"';
			if ($fct==_XCONTENT_URL_FCT_XCONTENT && $_GET['mode']==_XCONTENT_PERM_MODE_EDIT) echo ' selected="selected">'._XCONTENT_PERM_EDIT_XCONTENT.'</option>'; else echo '>'._XCONTENT_PERM_EDIT_XCONTENT.'</option>';
			
			echo '<option value="'.XOOPS_URL.'/modules/xcontent/admin/index.php?op='._XCONTENT_URL_OP_PERMISSIONS.'&fct='._XCONTENT_URL_FCT_BLOCKS.'&mode='._XCONTENT_PERM_MODE_EDIT.'"';
			if ($fct==_XCONTENT_URL_FCT_BLOCKS && $_GET['mode']==_XCONTENT_PERM_MODE_EDIT) echo ' selected="selected">'._XCONTENT_PERM_EDIT_BLOCK.'</option>'; else echo '>'._XCONTENT_PERM_EDIT_BLOCK.'</option>';
			
			echo '<option value="'.XOOPS_URL.'/modules/xcontent/admin/index.php?op='._XCONTENT_URL_OP_PERMISSIONS.'&fct='._XCONTENT_URL_FCT_XCONTENT.'&mode='._XCONTENT_PERM_MODE_ADD.'"';
			if ($fct==_XCONTENT_URL_FCT_XCONTENT && $_GET['mode']==_XCONTENT_PERM_MODE_ADD) echo ' selected="selected">'._XCONTENT_PERM_ADD_XCONTENT.'</option>'; else echo '>'._XCONTENT_PERM_ADD_XCONTENT.'</option>';

		}			

		echo '</select>&nbsp;<input type="button" name="go" value="'._SUBMIT.'" onClick="window.location=document.perms.permlinks.options[document.perms.permlinks.selectedIndex].value"> </form></div>';

		switch ($fct) {
		case _XCONTENT_URL_FCT_CATEGORIES:
		default:
			// View Categories permissions
			$item_list_view = array();
			$block_view = array(); 
		 
			$result_view = $GLOBALS['xoopsDB']->query("SELECT catid FROM ".$GLOBALS['xoopsDB']->prefix(_XCONTENT_TABLE_CATEGORY)." ");
			if ($GLOBALS['xoopsDB']->getRowsNum($result_view)) {
				while ($myrow_view = $GLOBALS['xoopsDB']->fetcharray($result_view)) {
					$item_list_view['cid'] = $myrow_view['catid'];
					$item_list_view['title'] = xcontent_getCatTitle($myrow_view['catid']);
					$form_view = new XoopsGroupPermForm("", $GLOBALS['xoopsModule']->getVar('mid'), $mode._XCONTENT_PERM_TYPE_CATEGORY, "<img id='toptableicon' src=".XOOPS_URL."/modules/".$GLOBALS['xoopsModule']->dirname()."/images/close12.gif alt='' /></a>"._XCONTENT_PERMISSIONS_CATEGORY."</h3><div id='toptable'><span style=\"color: #567; margin: 3px 0 0 0; font-size: small; display: block; \">".ucfirst($mode)."</span>");
					$block_view[] = $item_list_view;
					foreach ($block_view as $itemlists) {
						$form_view->addItem($itemlists['cid'], $itemlists['title']);
					} 
				} 
				echo $form_view->render();
			} else {
				echo "<img id='toptableicon' src=".XOOPS_URL."/modules/".$GLOBALS['xoopsModule']->dirname()."/images/close12.gif alt='' /></a>&nbsp;"._XCONTENT_PERMISSIONSVIEWCATEGORY."</h3><div id='toptable'><span style=\"color: #567; margin: 3px 0 0 0; font-size: small; display: block; \">"._XCONTENT_NOPERMSSET."</span>";
	
			} 
			echo "</div>";
			break;
			
		case _XCONTENT_URL_FCT_XCONTENT:

			// View Categories permissions
			$item_list_view = array();
			$block_view = array(); 
		 
			if ($mode==_XCONTENT_PERM_MODE_ADD){
				$result_view = $GLOBALS['xoopsDB']->query("SELECT catid FROM ".$GLOBALS['xoopsDB']->prefix(_XCONTENT_TABLE_CATEGORY)." ");
				if ($GLOBALS['xoopsDB']->getRowsNum($result_view)) {
					while ($myrow_view = $GLOBALS['xoopsDB']->fetcharray($result_view)) {
						$item_list_view['cid'] = $myrow_view['catid'];
						$item_list_view['title'] = xcontent_getCatTitle($myrow_view['catid']);
						$form_view = new XoopsGroupPermForm("", $GLOBALS['xoopsModule']->getVar('mid'), $mode._XCONTENT_PERM_TYPE_XCONTENT, "<img id='toptableicon' src=".XOOPS_URL."/modules/".$GLOBALS['xoopsModule']->dirname()."/images/close12.gif alt='' /></a>"._XCONTENT_PERMISSIONS_XCONTENT."</h3><div id='toptable'><span style=\"color: #567; margin: 3px 0 0 0; font-size: small; display: block; \">".ucfirst($mode)."</span>");
						$block_view[] = $item_list_view;
						foreach ($block_view as $itemlists) {
							$form_view->addItem($itemlists['cid'], $itemlists['title']);
						} 
					} 
					echo $form_view->render();
				} else {
					echo "<img id='toptableicon' src=".XOOPS_URL."/modules/".$GLOBALS['xoopsModule']->dirname()."/images/close12.gif alt='' /></a>&nbsp;"._XCONTENT_PERMISSIONS_XCONTENT."</h3><div id='toptable'><span style=\"color: #567; margin: 3px 0 0 0; font-size: small; display: block; \">"._XCONTENT_NOPERMSSET."</span>";
				}				
			} else {
				$result_view = $GLOBALS['xoopsDB']->query("SELECT storyid FROM ".$GLOBALS['xoopsDB']->prefix(_XCONTENT_TABLE_XCONTENT)." ");
				if ($GLOBALS['xoopsDB']->getRowsNum($result_view)) {
					while ($myrow_view = $GLOBALS['xoopsDB']->fetcharray($result_view)) {
						$item_list_view['cid'] = $myrow_view['storyid'];
						$item_list_view['title'] = xcontent_getTitle($myrow_view['storyid']);
						$form_view = new XoopsGroupPermForm("", $GLOBALS['xoopsModule']->getVar('mid'), $mode._XCONTENT_PERM_TYPE_XCONTENT, "<img id='toptableicon' src=".XOOPS_URL."/modules/".$GLOBALS['xoopsModule']->dirname()."/images/close12.gif alt='' /></a>"._XCONTENT_PERMISSIONS_XCONTENT."</h3><div id='toptable'><span style=\"color: #567; margin: 3px 0 0 0; font-size: small; display: block; \">".ucfirst($mode)."</span>");
						$block_view[] = $item_list_view;
						foreach ($block_view as $itemlists) {
							$form_view->addItem($itemlists['cid'], $itemlists['title']);
						} 
					} 
					echo $form_view->render();
				} else {
					echo "<img id='toptableicon' src=".XOOPS_URL."/modules/".$GLOBALS['xoopsModule']->dirname()."/images/close12.gif alt='' /></a>&nbsp;"._XCONTENT_PERMISSIONS_XCONTENT."</h3><div id='toptable'><span style=\"color: #567; margin: 3px 0 0 0; font-size: small; display: block; \">"._XCONTENT_NOPERMSSET."</span>";
				}		
			} 
			echo "</div>";
			break;

		case _XCONTENT_URL_FCT_BLOCKS:

			// View Categories permissions
			$item_list_view = array();
			$block_view = array(); 
		 
			$result_view = $GLOBALS['xoopsDB']->query("SELECT blockid FROM ".$GLOBALS['xoopsDB']->prefix(_XCONTENT_TABLE_BLOCK)." ");
			if ($GLOBALS['xoopsDB']->getRowsNum($result_view)) {
				while ($myrow_view = $GLOBALS['xoopsDB']->fetcharray($result_view)) {
					$item_list_view['cid'] = $myrow_view['blockid'];
					$item_list_view['title'] = xcontent_getBlockTitle($myrow_view['blockid']);
					$form_view = new XoopsGroupPermForm("", $GLOBALS['xoopsModule']->getVar('mid'), $mode._XCONTENT_PERM_TYPE_BLOCK, "<img id='toptableicon' src=".XOOPS_URL."/modules/".$GLOBALS['xoopsModule']->dirname()."/images/close12.gif alt='' /></a>"._XCONTENT_PERMISSIONS_BLOCKS."</h3><div id='toptable'><span style=\"color: #567; margin: 3px 0 0 0; font-size: small; display: block; \">".ucfirst($mode)."</span>");
					$block_view[] = $item_list_view;
					foreach ($block_view as $itemlists) {
						$form_view->addItem($itemlists['cid'], $itemlists['title']);
					} 
				} 
				echo $form_view->render();
			} else {
				echo "<img id='toptableicon' src=".XOOPS_URL."/modules/".$GLOBALS['xoopsModule']->dirname()."/images/close12.gif alt='' /></a>&nbsp;"._XCONTENT_PERMISSIONS_BLOCKS."</h3><div id='toptable'><span style=\"color: #567; margin: 3px 0 0 0; font-size: small; display: block; \">"._XCONTENT_NOPERMSSET."</span>";
	
			} 
			echo "</div>";
			break;

		case _XCONTENT_URL_FCT_TEMPLATE:

			$permtypes = array(	_XCONTENT_PERM_TEMPLATE_ADD_XCONTENT => _XCONTENT_PERM_TEMPLATE_ADD_XCONTENT_DESC,
								_XCONTENT_PERM_TEMPLATE_ADD_CATEGORY => _XCONTENT_PERM_TEMPLATE_ADD_CATEGORY_DESC,
								_XCONTENT_PERM_TEMPLATE_ADD_BLOCK => _XCONTENT_PERM_TEMPLATE_ADD_BLOCK_DESC,
								_XCONTENT_PERM_TEMPLATE_EDIT_XCONTENT => _XCONTENT_PERM_TEMPLATE_EDIT_XCONTENT_DESC,
								_XCONTENT_PERM_TEMPLATE_EDIT_CATEGORY => _XCONTENT_PERM_TEMPLATE_EDIT_CATEGORY_DESC,
								_XCONTENT_PERM_TEMPLATE_EDIT_BLOCK => _XCONTENT_PERM_TEMPLATE_EDIT_BLOCK_DESC,
								_XCONTENT_PERM_TEMPLATE_VIEW_XCONTENT => _XCONTENT_PERM_TEMPLATE_VIEW_XCONTENT_DESC,
								_XCONTENT_PERM_TEMPLATE_VIEW_CATEGORY => _XCONTENT_PERM_TEMPLATE_VIEW_CATEGORY_DESC,
								_XCONTENT_PERM_TEMPLATE_VIEW_BLOCK => _XCONTENT_PERM_TEMPLATE_VIEW_BLOCK_DESC,
								_XCONTENT_PERM_TEMPLATE_COPY_XCONTENT => _XCONTENT_PERM_TEMPLATE_COPY_XCONTENT_DESC,
								_XCONTENT_PERM_TEMPLATE_COPY_CATEGORY => _XCONTENT_PERM_TEMPLATE_COPY_CATEGORY_DESC,
								_XCONTENT_PERM_TEMPLATE_COPY_BLOCK => _XCONTENT_PERM_TEMPLATE_COPY_BLOCK_DESC,
								_XCONTENT_PERM_TEMPLATE_DELETE_XCONTENT => _XCONTENT_PERM_TEMPLATE_DELETE_XCONTENT_DESC,
								_XCONTENT_PERM_TEMPLATE_DELETE_CATEGORY => _XCONTENT_PERM_TEMPLATE_DELETE_CATEGORY_DESC,
								_XCONTENT_PERM_TEMPLATE_DELETE_BLOCK => _XCONTENT_PERM_TEMPLATE_DELETE_BLOCK_DESC,
								_XCONTENT_PERM_TEMPLATE_MANAGE_XCONTENT => _XCONTENT_PERM_TEMPLATE_MANAGE_XCONTENT_DESC,
								_XCONTENT_PERM_TEMPLATE_MANAGE_CATEGORY => _XCONTENT_PERM_TEMPLATE_MANAGE_CATEGORY_DESC,
								_XCONTENT_PERM_TEMPLATE_MANAGE_BLOCK => _XCONTENT_PERM_TEMPLATE_MANAGE_BLOCK_DESC,
								_XCONTENT_PERM_TEMPLATE_PERMISSIONS => _XCONTENT_PERM_TEMPLATE_PERMISSIONS_DESC);
								
			$form_view = new XoopsGroupPermForm("", $GLOBALS['xoopsModule']->getVar('mid'), $mode._XCONTENT_PERM_TYPE_TEMPLATE, "<img id='toptableicon' src=".XOOPS_URL."/modules/".$GLOBALS['xoopsModule']->dirname()."/images/close12.gif alt='' /></a>"._XCONTENT_PERMISSIONS_DEFAULT."</h3><div id='toptable'><span style=\"color: #567; margin: 3px 0 0 0; font-size: small; display: block; \">".ucfirst($mode)."</span>");
			foreach ($permtypes as $id => $title) {
				$form_view->addItem($id, $title);
			} 
			echo $form_view->render();
			echo "</div>";
			break;

		} 

		xoops_cp_footer();
		break;			

	}

?>