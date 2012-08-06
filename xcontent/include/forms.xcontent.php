<?php

/*
Module: xContent

Version: 2.01

Description: Multilingual Content Module with tags and lists with search functions

Author: Written by Simon Roberts aka. Wishcraft (simon@chronolabs.coop)

Owner: Chronolabs

License: See /docs - GPL 2.0
*/


	function xcontent_listblock()
	{
		$block_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_BLOCK, _XCONTENT_DIRNAME);
		$text_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_TEXT, _XCONTENT_DIRNAME);
		$user_handler =& xoops_gethandler('user');
		
		$start = (isset($_GET['start']))?intval($_GET['start']):0;
		$limit = (isset($_GET['limit']))?intval($_GET['limit']):30;
		
		$ttl = $block_handler->getCount(NULL);
		$pagenav = new XoopsPageNav($ttl, $limit, $start, 'start', 'op='._XCONTENT_URL_OP_MANAGE.'&fct='._XCONTENT_URL_FCT_BLOCKS.'&limit='.$limit.'');
		
		$criteria = new Criteria('1', '1');
		$criteria->setStart($start);
		$criteria->setLimit($limit);
		
		$ret = '<div style="float:right; clear:both;">'.$pagenav->renderNav().'</div>';
		$ret .= '<form method="post" action="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_SAVE.'&fct='._XCONTENT_URL_FCT_BLOCK.'" enctype="multipart/form-data">';
		$ret .= '<table width="100%">';
		$ret .= '<tr class="head">';
		$ret .= '<td>'._XCONTENT_AD_TITLE.'</td>';
		$ret .= '<td>'._XCONTENT_AD_CREATED.'</td>';
		$ret .= '<td>'._XCONTENT_AD_MADEBY.'</td>';
		$ret .= '<td>'._XCONTENT_AD_ACTIONS.'</td>';
		$ret .= '</tr>';
		if ($blocks = $block_handler->getObjects($criteria, true)) {
			$class = 'odd';
			foreach($blocks as $blockid => $block) {
				$class = ($class == 'odd')?'even':'odd';
				$ret .= '<tr class="'.$class.'">';
				$ret .= '<td>'.xcontent_getBlockTitle($blockid).'</a></td>';
				$ret .= '<td>'.date(_DATESTRING, $block->getVar('created')).'</td>';
				$ret .= '<td>'.$user_handler->getUnameFromId($block->getVar('uid')).'</td>';
				$ret .= '<td><a href="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_EDIT.'&fct='._XCONTENT_URL_FCT_BLOCKS.'&blockid='.$blockid.'"><img src="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/images/edit.png"></a>&nbsp;<a href="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_DELETE.'&fct='._XCONTENT_URL_FCT_BLOCKS.'&blockid='.$blockid.'"><img src="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/images/delete.png"></a>&nbsp;<a href="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_COPY.'&fct='._XCONTENT_URL_FCT_BLOCKS.'&blockid='.$blockid.'"><img src="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/images/copy.png"></a></td>';
				$ret .= '</tr>';
			}
		
		}

		$ret .= '<tr class="foot">';
		$ret .= '<td colspan="3"></td>';
		$ret .= '<td><!--<input type="submit" value="'._SUBMIT.'">--></td>';
		$ret .= '</tr>';
		$ret .= '</table>';
		$ret .= '</form>';
		
		return $ret;
		
	}

	function xcontent_listcategory()
	{
		$category_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_CATEGORY, _XCONTENT_DIRNAME);
		$text_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_TEXT, _XCONTENT_DIRNAME);
		
		$start = (isset($_GET['start']))?intval($_GET['start']):0;
		$limit = (isset($_GET['limit']))?intval($_GET['limit']):30;
		
		$ttl = $category_handler->getCount(NULL);
		$pagenav = new XoopsPageNav($ttl, $limit, $start, 'start', 'op='._XCONTENT_URL_OP_MANAGE.'&fct='._XCONTENT_URL_FCT_CATEGORIES.'&limit='.$limit.'');
		
		$criteria = new Criteria('1', '1');
		$criteria->setStart($start);
		$criteria->setLimit($limit);
		
		$ret = '<div style="float:right; clear:both;">'.$pagenav->renderNav().'</div>';
		$ret .= '<form method="post" action="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_SAVE.'&fct='._XCONTENT_URL_FCT_CATEGORIES.'" enctype="multipart/form-data">';
		$ret .= '<table width="100%">';
		$ret .= '<tr class="head">';
		$ret .= '<td>'._XCONTENT_AD_CATEGORY.'</td>';
		$ret .= '<td>'._XCONTENT_AD_PARENT.'</td>';
		$ret .= '<td>'._XCONTENT_AD_RSSENABLED.'</td>';
		$ret .= '<td>'._XCONTENT_AD_ACTIONS.'</td>';
		$ret .= '</tr>';
		if ($categories = $category_handler->getObjects($criteria, true)) {
			$class = 'odd';
			foreach($categories as $catid => $category) {
				$class = ($class == 'odd')?'even':'odd';
				$ret .= '<tr class="'.$class.'">';
				$ret .= '<td>'.xcontent_getCatTitle($catid).'</a></td>';
				$formobj_catid = new XoopsFormSelectCategories('', 'parent_id['.$catid.']', $category->getVar('parent_id'), 1, false, $catid);
				$ret .= '<td>'.$formobj_catid->render().'</td>';
				$formobj_rssenabled = new XoopsFormRadioYN('','rssenabled['.$catid.']',$category->getVar('rssenabled'));
				$ret .= '<td>'.$formobj_rssenabled->render().'</td>';
				$ret .= '<td><a href="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_EDIT.'&fct='._XCONTENT_URL_FCT_CATEGORY.'&catid='.$catid.'"><img src="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/images/edit.png"></a>&nbsp;<a href="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_DELETE.'&fct='._XCONTENT_URL_FCT_CATEGORY.'&catid='.$catid.'"><img src="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/images/delete.png"></a>&nbsp;<a href="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_COPY.'&fct='._XCONTENT_URL_FCT_CATEGORY.'&catid='.$catid.'"><img src="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/images/copy.png"></a></td>';
				$ret .= '</tr>';
			}
		
		}

		$ret .= '<tr class="foot">';
		$ret .= '<td colspan="3"></td>';
		$ret .= '<td><input type="submit" value="'._SUBMIT.'"></td>';
		$ret .= '</tr>';
		$ret .= '</table>';
		$ret .= '</form>';
		
		return $ret;
		
	}

	function xcontent_addcategory($catid=0, $language = '')
	{
		$category_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_CATEGORY, _XCONTENT_DIRNAME);
		
		if ($catid>0)
			$category = $category_handler->getCategory($catid, $language);
		else
			$category = $category_handler->createnew();
		
		if ($catid>0)
			$sform = new XoopsThemeForm(_XCONTENT_AD_EDITCATEGORY, 'category', XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_SAVE.'&fct='._XCONTENT_URL_FCT_CATEGORY, 'post');
		else
			$sform = new XoopsThemeForm(_XCONTENT_AD_NEWCATEGORY, 'category', XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_SAVE.'&fct='._XCONTENT_URL_FCT_CATEGORY, 'post');
			
		$sform->setExtra('enctype="multipart/form-data"');	
		
		$formobj = array();	
		$eletray = array();
		$sformobj = array();
		
		if ($GLOBALS['xoopsModuleConfig']['multilingual']&&$GLOBALS['xoopsModuleConfig']['json']) {
			$sformobj['language']['sel'] = new XoopsFormSelectLanguages('', 'language', (!empty($language))?$language:$category['text']->getVar('language'));
			$sformobj['language']['sel']->setExtra('onChange="javascript:doJSON_LoadPageForm();"');
			$sformobj['language']['submit'] = new XoopsFormButton('', 'submit_change', _SUBMIT);
			$sformobj['language']['submit']->setExtra('onClick="javascript:doJSON_LoadPageForm();"');
			$formobj['language'] = new XoopsFormElementTray(_XCONTENT_AD_CAT_LANGUAGE, '&nbsp;');
			$formobj['language']->addElement($sformobj['language']['sel']);
			$formobj['language']->addElement($sformobj['language']['submit']);
		} elseif ($GLOBALS['xoopsModuleConfig']['multilingual']&&!$GLOBALS['xoopsModuleConfig']['json']) {
			$sformobj['language']['sel'] = new XoopsFormSelectLanguages('', 'language', (!empty($language))?$language:$category['text']->getVar('language'));
			$sformobj['language']['sel']->setExtra('onChange="window.location=\''.$_SERVER['PHP_SELF'].'?op='.$_REQUEST['op'].'&fct='.$_REQUEST['fct'].'&catid='.$_REQUEST['catid'].'&language=\'+document.category.language.options[document.category.language.selectedIndex].value"');
			$sformobj['language']['submit'] = new XoopsFormButton('', 'submit_change', _SUBMIT);
			$sformobj['language']['submit']->setExtra('onClick="window.location=\''.$_SERVER['PHP_SELF'].'?op='.$_REQUEST['op'].'&fct='.$_REQUEST['fct'].'&catid='.$_REQUEST['catid'].'&language=\'+document.category.language.options[document.category.language.selectedIndex].value"');
			$formobj['language'] = new XoopsFormElementTray(_XCONTENT_AD_CAT_LANGUAGE, '&nbsp;');
			$formobj['language']->addElement($sformobj['language']['sel']);
			$formobj['language']->addElement($sformobj['language']['submit']);
		} else {
			$sform->addElement(new XoopsFormHidden('language', (!empty($language))?$language:$category['text']->getVar('language')));			
		}
				
		$formobj['title'] = new XoopsFormText(_XCONTENT_AD_CAT_MENUTITLE, 'title', 45, 128, clear_unicodeslashes($category['text']->getVar('title')));
		$formobj['ptitle'] = new XoopsFormText(_XCONTENT_AD_CAT_PAGETITLE, 'ptitle', 45, 128, clear_unicodeslashes($category['text']->getVar('ptitle')));
		$formobj['parent_id'] = new XoopsFormSelectCategories(_XCONTENT_AD_CAT_CATEGORYPARENT, 'parent_id', clear_unicodeslashes($category['cat']->getVar('parent_id')));
		$formobj['keywords'] = new XoopsFormTextArea(_XCONTENT_AD_CAT_KEYWORDS, 'keywords', clear_unicodeslashes($category['text']->getVar('keywords')), 5, 45);
		$formobj['page_description'] = new XoopsFormTextArea(_XCONTENT_AD_CAT_PAGEDESCRIPTION, 'page_description', clear_unicodeslashes($category['text']->getVar('page_description')), 5, 45);
				
		$page_desc_configs = array();
		$page_desc_configs['name'] = 'rss';
		$page_desc_configs['value'] = clear_unicodeslashes($category['text']->getVar('rss'));
		$page_desc_configs['rows'] = 35;
		$page_desc_configs['cols'] = 60;
		$page_desc_configs['width'] = "100%";
		$page_desc_configs['height'] = "400px";
		
		$formobj['rss'] = new XoopsFormEditor(_XCONTENT_AD_CAT_RSSDESCRIPTION, $GLOBALS['xoopsModuleConfig']['editor'], $page_desc_configs);

		$page_desc_configs = array();
		$page_desc_configs['name'] = 'text';
		$page_desc_configs['value'] = clear_unicodeslashes($category['text']->getVar('text'));
		$page_desc_configs['rows'] = 35;
		$page_desc_configs['cols'] = 60;
		$page_desc_configs['width'] = "100%";
		$page_desc_configs['height'] = "400px";
		
		$formobj['text'] = new XoopsFormEditor(_XCONTENT_AD_CAT_TEXT, $GLOBALS['xoopsModuleConfig']['editor'], $page_desc_configs);

		$eletray['options'] = new XoopsFormElementTray(_XCONTENT_AD_CAT_OPTIONS, '<br/>');
		$eletray['options']->addElement(new XoopsFormRadioYN(_XCONTENT_AD_CAT_RSSENABLED,'rssenabled',$category['cat']->getVar('rssenabled')));

		$formobj['options'] = $eletray['options'];

		$eletray['buttons'] = new XoopsFormElementTray('', '&nbsp;');
		$sformobj['buttons']['save'] = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
		$eletray['buttons']->addElement($sformobj['buttons']['save']);
		$sformobj['buttons']['cancel'] = new XoopsFormButton('', 'cancel', _CANCEL);
		$sformobj['buttons']['cancel']->setExtra('onClick="javascript:doJSON_LoadPageForm();"');
		$eletray['buttons']->addElement($sformobj['buttons']['cancel']);
		$formobj['buttons'] = $eletray['buttons'];
				
		$required = array('title', 'ptitle');
		
		foreach($formobj as $id => $obj)			
			if (in_array($id, $required))
				$sform->addElement($formobj[$id], true);			
			else
				$sform->addElement($formobj[$id], false);

		$sform->addElement(new XoopsFormHidden('catid', $category['cat']->getVar('catid')));	
		$sform->addElement(new XoopsFormHidden('xcontentid', $category['text']->getVar('xcontentid')));
		$sform->addElement(new XoopsFormHidden('op', _XCONTENT_URL_OP_SAVE));
		$sform->addElement(new XoopsFormHidden('fct', _XCONTENT_URL_FCT_CATEGORY));
		
		return $sform->render();
		
	}

	function xcontent_listxcontent()
	{
		$xcontent_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_XCONTENT, _XCONTENT_DIRNAME);
		$text_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_TEXT, _XCONTENT_DIRNAME);
		
		$start = (isset($_GET['start']))?intval($_GET['start']):0;
		$limit = (isset($_GET['limit']))?intval($_GET['limit']):30;
		
		$ttl = $xcontent_handler->getCount(NULL);
		$pagenav = new XoopsPageNav($ttl, $limit, $start, 'start', 'op='._XCONTENT_URL_OP_MANAGE.'&fct='._XCONTENT_URL_FCT_XCONTENT.'&limit='.$limit.'');
		
		$criteria = new Criteria('1', '1');
		$criteria->setStart($start);
		$criteria->setLimit($limit);
		$criteria->setSort('weight');
		
		$ret = '<div style="float:right; clear:both;">'.$pagenav->renderNav().'</div>';
		$ret .= '<form method="post" action="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_SAVE.'&fct='._XCONTENT_URL_FCT_PAGES.'" enctype="multipart/form-data">';
		$ret .= '<table width="100%">';
		$ret .= '<tr class="head">';
		$ret .= '<td>'._XCONTENT_AD_PAGE.'</td>';
		$ret .= '<td>'._XCONTENT_AD_CATEGORY.'</td>';
		$ret .= '<td>'._XCONTENT_AD_PARENT.'</td>';
		$ret .= '<td>'._XCONTENT_AD_SUBMENUS.'</td>';
		$ret .= '<td>'._XCONTENT_AD_HOMEPAGE.'</td>';
		$ret .= '<td>'._XCONTENT_AD_WEIGHT.'</td>';
		$ret .= '<td>'._XCONTENT_AD_ACTIONS.'</td>';
		$ret .= '</tr>';
		if ($xcontents = $xcontent_handler->getObjects($criteria, true)) {
			$class = 'odd';
			foreach($xcontents as $storyid => $xcontent) {
				$class = ($class == 'odd')?'even':'odd';
				$cntarray = $xcontent->toArray();
				$ret .= '<tr class="'.$class.'">';
				$ret .= '<td><a href="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/?storyid='.$storyid.'">'.xcontent_getTitle($storyid).'</a></td>';
				$formobj_catid[$storyid] = new XoopsFormSelectCategories('', 'catid['.$storyid.']', $xcontent->getVar('catid'));
				$ret .= '<td>'.$formobj_catid[$storyid]->render().'</td>';
				$formobj_parent_id[$storyid] = new XoopsFormSelectPages('', 'parent_id['.$storyid.']', $xcontents[$storyid]->getVar('parent_id'), 1, false, $storyid);
				$ret .= '<td>'.$formobj_parent_id[$storyid]->render().'</td>';
				$formobj_submenu[$storyid] = new XoopsFormRadioYN('','submenu['.$storyid.']', $xcontents[$storyid]->getVar('submenu'));
				$ret .= '<td>'.$formobj_submenu[$storyid]->render().'</td>';
				$formobj_homepage[$storyid] = new XoopsFormRadioYN('','homepage['.$storyid.']', $xcontents[$storyid]->getVar('homepage'));
				$ret .= '<td>'.$formobj_homepage[$storyid]->render().'</td>';
				$formobj_weight[$storyid] = new XoopsFormText('','weight['.$storyid.']', 4, 5, $xcontents[$storyid]->getVar('weight'));
				$ret .= '<td>'.$formobj_weight[$storyid]->render().'</td>';

				$ret .= '<td><a href="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_EDIT.'&fct='._XCONTENT_URL_FCT_XCONTENT.'&storyid='.$storyid.'"><img src="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/images/edit.png"></a>&nbsp;<a href="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_DELETE.'&fct='._XCONTENT_URL_FCT_XCONTENT.'&storyid='.$storyid.'"><img src="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/images/delete.png"></a>&nbsp;<a href="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_COPY.'&fct='._XCONTENT_URL_FCT_XCONTENT.'&storyid='.$storyid.'"><img src="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/images/copy.png"></a></td>';
				$ret .= '</tr>';
			}
		
		}

		$ret .= '<tr class="foot">';
		$ret .= '<td colspan="6"></td>';
		$ret .= '<td><input type="submit" value="'._SUBMIT.'"></td>';
		$ret .= '</tr>';
		$ret .= '</table>';
		$ret .= '</form>';
		
		return $ret;
		
	}

	function xcontent_addxcontent($storyid = 0, $language = '') {
		
		$xcontent_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_XCONTENT, _XCONTENT_DIRNAME);
		
		if ($storyid>0)
			$xcontent = $xcontent_handler->getContent($storyid, $language);
		else
			$xcontent = $xcontent_handler->createnew();
		
		if ($storyid>0)
			$sform = new XoopsThemeForm(_XCONTENT_AD_EDITXCONTENT, 'xcontent', XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_SAVE.'&fct='._XCONTENT_URL_FCT_XCONTENT, 'post');
		else
			$sform = new XoopsThemeForm(_XCONTENT_AD_NEWXCONTENT, 'xcontent', XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_SAVE.'&fct='._XCONTENT_URL_FCT_XCONTENT, 'post');
			
		$sform->setExtra('enctype="multipart/form-data"');	
		
		$formobj = array();	
		$eletray = array();
		$sformobj = array();
			
		if ($GLOBALS['xoopsModuleConfig']['multilingual']&&$GLOBALS['xoopsModuleConfig']['json']) {
			$sformobj['language']['sel'] = new XoopsFormSelectLanguages('', 'language', (!empty($language))?$language:$xcontent['text']->getVar('language'));
			$sformobj['language']['sel']->setExtra('onChange="javascript:doJSON_LoadPageForm();"');
			$sformobj['language']['submit'] = new XoopsFormButton('', 'submit_change', _SUBMIT);
			$sformobj['language']['submit']->setExtra('onClick="javascript:doJSON_LoadPageForm();"');
			$formobj['language'] = new XoopsFormElementTray(_XCONTENT_AD_LANGUAGE, '&nbsp;');
			$formobj['language']->addElement($sformobj['language']['sel']);
			$formobj['language']->addElement($sformobj['language']['submit']);
		} elseif ($GLOBALS['xoopsModuleConfig']['multilingual']&&!$GLOBALS['xoopsModuleConfig']['json']) {
			$sformobj['language']['sel'] = new XoopsFormSelectLanguages('', 'language', (!empty($language))?$language:$xcontent['text']->getVar('language'));
			$sformobj['language']['sel']->setExtra('onChange="window.location=\''.$_SERVER['PHP_SELF'].'?op='.$_REQUEST['op'].'&fct='.$_REQUEST['fct'].'&storyid='.$_REQUEST['storyid'].'&language=\'+document.xcontent.language.options[document.xcontent.language.selectedIndex].value"');
			$sformobj['language']['submit'] = new XoopsFormButton('', 'submit_change', _SUBMIT);
			$sformobj['language']['submit']->setExtra('onClick="window.location=\''.$_SERVER['PHP_SELF'].'?op='.$_REQUEST['op'].'&fct='.$_REQUEST['fct'].'&storyid='.$_REQUEST['storyid'].'&language=\'+document.xcontent.language.options[document.xcontent.language.selectedIndex].value"');
			$formobj['language'] = new XoopsFormElementTray(_XCONTENT_AD_LANGUAGE, '&nbsp;');
			$formobj['language']->addElement($sformobj['language']['sel']);
			$formobj['language']->addElement($sformobj['language']['submit']);
		} else {
			$sform->addElement(new XoopsFormHidden('language', (!empty($language))?$language:$xcontent['text']->getVar('language')));
		}

		$formobj['weight'] = new XoopsFormText(_XCONTENT_AD_WEIGHT, 'weight', 10, 4, (isset($_GET['weight']))?$_GET['weight']:clear_unicodeslashes($xcontent['xcontent']->getVar('weight')));
				
		$formobj['title'] = new XoopsFormText(_XCONTENT_AD_MENUTITLE, 'title', 45, 128, (isset($_GET['title']))?$_GET['title']:clear_unicodeslashes($xcontent['text']->getVar('title')));
		
		$formobj['ptitle'] = new XoopsFormText(_XCONTENT_AD_PAGETITLE, 'ptitle', 45, 128, (isset($_GET['ptitle']))?$_GET['ptitle']:clear_unicodeslashes($xcontent['text']->getVar('ptitle')));

		$formobj['parent_id'] = new XoopsFormSelectPages(_XCONTENT_AD_PARENT, 'parent_id', (isset($_GET['parent_id']))?$_GET['parent_id']:$xcontent['xcontent']->getVar('parent_id'), 1, false,$xcontent['xcontent']->getVar('story_id'));
		$formobj['catid'] = new XoopsFormSelectCategories(_XCONTENT_AD_CATEGORY, 'catid', (isset($_GET['catid']))?$_GET['catid']:$xcontent['xcontent']->getVar('catid'));
		$formobj['blockid'] = new XoopsFormSelectBlocks(_XCONTENT_AD_INHERITBLOCK, 'blockid', (isset($_GET['blockid']))?$_GET['blockid']:$xcontent['xcontent']->getVar('blockid'));
		$formobj['keywords'] = new XoopsFormTextArea(_XCONTENT_AD_KEYWORDS, 'keywords', (isset($_GET['keywords']))?$_GET['keywords']:clear_unicodeslashes($xcontent['text']->getVar('keywords')), 5, 45);
		$formobj['page_description'] = new XoopsFormTextArea(_XCONTENT_AD_PAGEDESCRIPTION, 'page_description', (isset($_GET['page_description']))?$_GET['page_description']:clear_unicodeslashes($xcontent['text']->getVar('page_description')), 5, 45);
	
		if (class_exists('XoopsFormTag')) {
			$formobj['tags'] = new XoopsFormTag("tags", 60, 255, $xcontent['xcontent']->getVar('storyid'), $xcontent['xcontent']->getVar('catid'));
		} else
			$formobj['tags'] = new XoopsFormHidden("tags", $xcontent['xcontent']->getVar('tags'));
				
//		if ($xcontent['text']->isNew()&&$GLOBALS['xoopsModuleConfig']['json']) {
//			$formobj['template'] = new XoopsFormSelectTemplates(_XCONTENT_AD_TEMPLATES, 'template', $_GET['template']);
//			$formobj['template']->setExtra('onChange="javascript:doJSON_LoadPageTemplate();"');
//		} elseif ($xcontent['text']->isNew()&&!$GLOBALS['xoopsModuleConfig']['json']&&$GLOBALS['xoopsModuleConfig']['multilingual']) {
//			$formobj['template'] = new XoopsFormSelectTemplates(_XCONTENT_AD_TEMPLATES, 'template', $_GET['template']);
//			$formobj['template']->setExtra('onChange="window.location=\''.$_SERVER['PHP_SELF'].'?op='.$_REQUEST['op'].'&fct='.$_REQUEST['fct'].'&storyid='.$_REQUEST['storyid'].'&template=\'+document.xcontent.template.options[document.xcontent.template.selectedIndex].value+\'&language=\'+document.xcontent.language.options[document.xcontent.language.selectedIndex].value"');
//		} elseif ($xcontent['text']->isNew()&&!$GLOBALS['xoopsModuleConfig']['json']&&!$GLOBALS['xoopsModuleConfig']['multilingual']) {
//			$formobj['template'] = new XoopsFormSelectTemplates(_XCONTENT_AD_TEMPLATES, 'template', $_GET['template']);
//			$formobj['template']->setExtra('onChange="window.location=\''.$_SERVER['PHP_SELF'].'?op='.$_REQUEST['op'].'&fct='.$_REQUEST['fct'].'&storyid='.$_REQUEST['storyid'].'&template=\'+document.xcontent.template.options[document.xcontent.template.selectedIndex].value"');
//
//		}

//mb I am not sure how the templates should work?
//		if (file_exists($GLOBALS['xoops']->path(_XCONTENT_PATH_PREDEFINED_RSS) . $_GET['template'])) {
//			$_GET['rss'] = file_get_contents($GLOBALS['xoops']->path(_XCONTENT_PATH_PREDEFINED_RSS) . $_GET['template']);
//			$_GET['text'] = file_get_contents($GLOBALS['xoops']->path(_XCONTENT_PATH_PREDEFINED_HTML) . $_GET['template']);
//		}
						
		$page_desc_configs = array();
		$page_desc_configs['name'] = 'rss';
		$page_desc_configs['value'] = ($xcontent['text']->getVar('rss')=='')?$_GET['rss']:clear_unicodeslashes($xcontent['text']->getVar('rss'));
		$page_desc_configs['rows'] = 35;
		$page_desc_configs['cols'] = 60;
		$page_desc_configs['width'] = "100%";
		$page_desc_configs['height'] = "400px";
		
		$formobj['rss'] = new XoopsFormEditor(_XCONTENT_AD_RSS, $GLOBALS['xoopsModuleConfig']['editor'], $page_desc_configs);

		$page_desc_configs = array();
		$page_desc_configs['name'] = 'text';
		$page_desc_configs['value'] = ($xcontent['text']->getVar('text')=='')?$_GET['text']:clear_unicodeslashes($xcontent['text']->getVar('text'));
		$page_desc_configs['rows'] = 35;
		$page_desc_configs['cols'] = 60;
		$page_desc_configs['width'] = "100%";
		$page_desc_configs['height'] = "400px";
		
		$formobj['text'] = new XoopsFormEditor(_XCONTENT_AD_TEXT, $GLOBALS['xoopsModuleConfig']['editor'], $page_desc_configs);

		$eletray['url'] = new XoopsFormElementTray(_XCONTENT_AD_URL, '&nbsp;');
		$sformobj['url']['txt'] = new XoopsFormText(_XCONTENT_AD_URLADDRESS,'address', 45, 198, (isset($_GET['address']))?$_GET['address']:$xcontent['xcontent']->getVar('address'));
		$sformobj['url']['radio'] = new XoopsFormRadioYN(_XCONTENT_AD_REDIRECTLINK,'link',(isset($_GET['link']))?$_GET['link']:$xcontent['xcontent']->getVar('link'));
		$eletray['url']->addElement($sformobj['url']['txt']);
		$eletray['url']->addElement($sformobj['url']['radio']);
		$formobj['url'] = $eletray['url'];
		
		$eletray['password'] = new XoopsFormElementTray(_XCONTENT_AD_PASSWORD, '&nbsp;');
		$sformobj['password']['txtbox'] = new XoopsFormPassword('', 'password', 18, 60);
		$sformobj['password']['confirm'] = new XoopsFormPassword(_XCONTENT_AD_PASSWORD_CONFIRM, 'password_confirm', 18, 60);
		$sformobj['password']['set'] = new XoopsFormRadioYN(_XCONTENT_AD_SET,'passset',0);
		$eletray['password']->addElement($sformobj['password']['txtbox']);
		$eletray['password']->addElement($sformobj['password']['confirm']);
		$eletray['password']->addElement($sformobj['password']['set']);
		$formobj['password'] = $eletray['password'];
		
		$eletray['publish'] = new XoopsFormElementTray(_XCONTENT_AD_PUBLISH, '&nbsp;');
		$sformobj['publish']['date'] = new XoopsFormDateTime(_XCONTENT_AD_PUBlISHDATETIME, 'publish', 15, (isset($_GET['publish']))?$_GET['publish']:$xcontent['xcontent']->getVar('publish'));
		$sformobj['publish']['page'] = new XoopsFormSelectPages(_XCONTENT_AD_REDIRECTPAGE, 'publish_storyid', (isset($_GET['publish_storyid']))?$_GET['publish_storyid']:$xcontent['xcontent']->getVar('publish_storyid'), 1, false, $xcontent['xcontent']->getVar('story_id'));
		$sformobj['publish']['set'] = new XoopsFormRadioYN(_XCONTENT_AD_SET,'publishset',($xcontent['xcontent']->getVar('publish')>0)?1:0);
		$eletray['publish']->addElement($sformobj['publish']['date']);
		$eletray['publish']->addElement($sformobj['publish']['page']);
		$eletray['publish']->addElement($sformobj['publish']['set']);
		$formobj['publish'] = $eletray['publish'];

		$eletray['expire'] = new XoopsFormElementTray(_XCONTENT_AD_EXPIRE, '&nbsp;');
		$sformobj['expire']['date'] = new XoopsFormDateTime(_XCONTENT_AD_EXPIREDATETIME, 'expire', 15, (isset($_GET['expire']))?$_GET['expire']:$xcontent['xcontent']->getVar('expire'));
		$sformobj['expire']['page'] = new XoopsFormSelectPages(_XCONTENT_AD_REDIRECTPAGE, 'expire_storyid', (isset($_GET['expire_storyid']))?$_GET['expire_storyid']:$xcontent['xcontent']->getVar('expire_storyid'), 1, false, $xcontent['xcontent']->getVar('story_id'));
		$sformobj['expire']['set'] = new XoopsFormRadioYN(_XCONTENT_AD_SET,'expireset',($xcontent['xcontent']->getVar('expire')>0)?1:0);
		$eletray['expire']->addElement($sformobj['expire']['date']);
		$eletray['expire']->addElement($sformobj['expire']['page']);
		$eletray['expire']->addElement($sformobj['expire']['set']);
		$formobj['expire'] = $eletray['expire'];

		$eletray['options'] = new XoopsFormElementTray(_XCONTENT_AD_OPTIONS, '<br/>');
		$eletray['options']->addElement(new XoopsFormRadioYN(_XCONTENT_AD_VISIBLE,'visible',(isset($_GET['visible']))?$_GET['visible']:$xcontent['xcontent']->getVar('visible')));
		$eletray['options']->addElement(new XoopsFormRadioYN(_XCONTENT_AD_HOMEPAGE,'homepage',(isset($_GET['homepage']))?$_GET['homepage']:$xcontent['xcontent']->getVar('homepage')));
		$eletray['options']->addElement(new XoopsFormRadioYN(_XCONTENT_AD_NOHTML,'nohtml',(isset($_GET['nohtml']))?$_GET['nohtml']:$xcontent['xcontent']->getVar('nohtml')));
		$eletray['options']->addElement(new XoopsFormRadioYN(_XCONTENT_AD_NOSMILEY,'nosmiley',(isset($_GET['nosmiley']))?$_GET['nosmiley']:$xcontent['xcontent']->getVar('nosmiley')));
		$eletray['options']->addElement(new XoopsFormRadioYN(_XCONTENT_AD_NOBREAKS,'nobreaks',(isset($_GET['nobreaks']))?$_GET['nobreaks']:$xcontent['xcontent']->getVar('nobreaks')));
		$eletray['options']->addElement(new XoopsFormRadioYN(_XCONTENT_AD_NOCOMMENTS,'nocomments',(isset($_GET['nocomments']))?$_GET['nocomments']:$xcontent['xcontent']->getVar('nocomments')));
		$eletray['options']->addElement(new XoopsFormRadioYN(_XCONTENT_AD_SUBMENU,'submenu',(isset($_GET['submenu']))?$_GET['submenu']:$xcontent['xcontent']->getVar('submenu')));
		$formobj['options'] = $eletray['options'];
		
		$eletray['buttons'] = new XoopsFormElementTray('', '&nbsp;');
		$sformobj['buttons']['save'] = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
		$eletray['buttons']->addElement($sformobj['buttons']['save']);
		if ($GLOBALS['xoopsModuleConfig']['json']) {
			$sformobj['buttons']['cancel'] = new XoopsFormButton('', 'cancel', _CANCEL);
			$sformobj['buttons']['cancel']->setExtra('onClick="javascript:doJSON_LoadPageForm();"');
			$eletray['buttons']->addElement($sformobj['buttons']['cancel']);
		}
		$formobj['buttons'] = $eletray['buttons'];
		
		if (isset($formobj['language']) && is_object($formobj['language']))
			$formobj['language']->setDescription(_XCONTENT_AD_LANGUAGE_DESC);
		if (is_object($formobj['expire']))	
			$formobj['expire']->setDescription(_XCONTENT_AD_EXPIRE_DESC);
		if (is_object($formobj['publish']))	
			$formobj['publish']->setDescription(_XCONTENT_AD_PUBLISH_DESC);
		if (is_object($formobj['url']))	
			$formobj['url']->setDescription(_XCONTENT_AD_URL_DESC);
		if (is_object($formobj['text']))	
			$formobj['text']->setDescription(_XCONTENT_AD_TEXT_DESC);
		if (is_object($formobj['rss']))	
			$formobj['rss']->setDescription(_XCONTENT_AD_RSS_DESC);
		if (is_object($formobj['title']))	
			$formobj['title']->setDescription(_XCONTENT_AD_TITLE_DESC);
		if (is_object($formobj['ptitle']))	
			$formobj['ptitle']->setDescription(_XCONTENT_AD_PAGETITLE_DESC);
		if (is_object($formobj['keywords']))	
			$formobj['keywords']->setDescription(_XCONTENT_AD_KEYWORDS_DESC);
		if (is_object($formobj['page_description']))	
			$formobj['page_description']->setDescription(_XCONTENT_AD_PAGEDESCRIPTION_DESC);
		if (is_object($formobj['tags']))	
			$formobj['tags']->setDescription(_XCONTENT_AD_TAGS_DESC);
		if (is_object($formobj['parent_id']))	
			$formobj['parent_id']->setDescription(_XCONTENT_AD_PARENTPAGE_DESC);
		if (is_object($formobj['catid']))	
			$formobj['catid']->setDescription(_XCONTENT_AD_CATEGORY_DESC);
		if (isset($formobj['template']) && is_object($formobj['template']))
			$formobj['template']->setDescription(_XCONTENT_AD_TEMPLATE_DESC);
		if (is_object($formobj['blockid']))	
			$formobj['blockid']->setDescription(_XCONTENT_AD_INHERITBLOCK_DESC);
		if (is_object($formobj['password']))	
			$formobj['password']->setDescription(_XCONTENT_AD_PASSWORD_DESC);
		
		$required = array('title', 'ptitle', 'weight', 'catid');
		
		foreach($formobj as $id => $obj)			
			if (in_array($id, $required))
				$sform->addElement($formobj[$id], true);			
			else
				$sform->addElement($formobj[$id], false);

		$sform->addElement(new XoopsFormHidden('xcontentid', (isset($_GET['xcontentid']))?$_GET['xcontentid']:$xcontent['text']->getVar('xcontentid')));
		$sform->addElement(new XoopsFormHidden('storyid', (isset($_GET['storyid']))?$_GET['storyid']:$xcontent['xcontent']->getVar('storyid')));
		$sform->addElement(new XoopsFormHidden('op', _XCONTENT_URL_OP_SAVE));
		$sform->addElement(new XoopsFormHidden('fct', _XCONTENT_URL_FCT_XCONTENT));
		

		return $sform->render();
	}
	
	function xcontent_passwordform($storyid = 0) {
		
		$sform = new XoopsThemeForm(_XCONTENT_MF_ENTERPASSWORD, 'password');
		$sform->setExtra('enctype="multipart/form-data"');	
		
		$formobj = array();	
		$eletray = array();
		$sformobj = array();
			
		$eletray['password'] = new XoopsFormElementTray(_XCONTENT_MF_PASSWORD, '&nbsp;');
		$sformobj['password']['txtbox'] = new XoopsFormPassword('', 'password', 32, 60);
		$eletray['password']->addElement($sformobj['password']['txtbox']);
		$formobj['password'] = $eletray['password'];
				
		$eletray['buttons'] = new XoopsFormElementTray('', '&nbsp;');
		$sformobj['buttons']['save'] = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
		$eletray['buttons']->addElement($sformobj['buttons']['save']);
		$formobj['buttons'] = $eletray['buttons'];

		if (is_object($formobj['password']))	
			$formobj['password']->setDescription(_XCONTENT_MF_PASSWORD_DESC);
		
		$required = array('password');
		
		foreach($formobj as $id => $obj)			
			if (in_array($id, $required))
				$sform->addElement($formobj[$id], true);			
			else
				$sform->addElement($formobj[$id], false);

		$sform->addElement(new XoopsFormHidden('storyid', (isset($_GET['storyid']))?$_GET['storyid']:$storyid));	
		

		return $sform->render();
	}
	
	function xcontent_addblock($blockid = 0, $language = '') {
		
		$block_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_BLOCK, _XCONTENT_DIRNAME);
		
		if ($blockid>0)
			$block = $block_handler->getBlock($blockid, $language);
		else
			$block = $block_handler->createnew();
		
		if ($blockid>0)
			$sform = new XoopsThemeForm(_XCONTENT_AD_EDITBLOCK, 'block', XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_SAVE.'&fct='._XCONTENT_URL_FCT_BLOCKS, 'post');
		else
			$sform = new XoopsThemeForm(_XCONTENT_AD_NEWBLOCK, 'block', XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_SAVE.'&fct='._XCONTENT_URL_FCT_BLOCKS, 'post');
			
		$sform->setExtra('enctype="multipart/form-data"');	
		
		$formobj = array();	
		$eletray = array();
		$sformobj = array();
			
		if ($GLOBALS['xoopsModuleConfig']['multilingual']&&$GLOBALS['xoopsModuleConfig']['json']) {
			$sformobj['language']['sel'] = new XoopsFormSelectLanguages('', 'language', (!empty($language))?$language:$category['text']->getVar('language'));
			$sformobj['language']['sel']->setExtra('onChange="javascript:doJSON_LoadPageForm();"');
			$sformobj['language']['submit'] = new XoopsFormButton('', 'submit_change', _SUBMIT);
			$sformobj['language']['submit']->setExtra('onClick="javascript:doJSON_LoadPageForm();"');
			$formobj['language'] = new XoopsFormElementTray(_XCONTENT_AD_CAT_LANGUAGE, '&nbsp;');
			$formobj['language']->addElement($sformobj['language']['sel']);
			$formobj['language']->addElement($sformobj['language']['submit']);
		} elseif ($GLOBALS['xoopsModuleConfig']['multilingual']&&!$GLOBALS['xoopsModuleConfig']['json']) {
			$sformobj['language']['sel'] = new XoopsFormSelectLanguages('', 'language', (!empty($language))?$language:$category['text']->getVar('language'));
			$sformobj['language']['sel']->setExtra('onChange="window.location=\''.$_SERVER['PHP_SELF'].'?op='.$_REQUEST['op'].'&fct='.$_REQUEST['fct'].'&blockid='.$_REQUEST['blockid'].'&language=\'+document.block.language.options[document.block.language.selectedIndex].value"');
			$sformobj['language']['submit'] = new XoopsFormButton('', 'submit_change', _SUBMIT);
			$sformobj['language']['submit']->setExtra('onClick="window.location=\''.$_SERVER['PHP_SELF'].'?op='.$_REQUEST['op'].'&fct='.$_REQUEST['fct'].'&blockid='.$_REQUEST['blockid'].'&language=\'+document.block.language.options[document.block.language.selectedIndex].value"');
			$formobj['language'] = new XoopsFormElementTray(_XCONTENT_AD_CAT_LANGUAGE, '&nbsp;');
			$formobj['language']->addElement($sformobj['language']['sel']);
			$formobj['language']->addElement($sformobj['language']['submit']);
		} else {
			$sform->addElement(new XoopsFormHidden('language', (!empty($language))?$language:$category['text']->getVar('language')));			
		}				
		$formobj['title'] = new XoopsFormText(_XCONTENT_AD_OPENDESCRIPTION, 'title', 45, 128, (isset($_GET['title']))?$_GET['title']:clear_unicodeslashes($block['text']->getVar('title')));
		//$formobj['title']->setExtra('onChange="javascript:doJSON_CheckForm();"');
		
		$page_desc_configs = array();
		$page_desc_configs['name'] = 'text';
		$page_desc_configs['value'] = (isset($_GET['text']))?$_GET['text']:clear_unicodeslashes($block['text']->getVar('text'));
		$page_desc_configs['rows'] = 35;
		$page_desc_configs['cols'] = 60;
		$page_desc_configs['width'] = "100%";
		$page_desc_configs['height'] = "400px";
		
		$formobj['text'] = new XoopsFormEditor(_XCONTENT_AD_BLOCKHTML, $GLOBALS['xoopsModuleConfig']['editor'], $page_desc_configs);
		
		$eletray['buttons'] = new XoopsFormElementTray('', '&nbsp;');
		$sformobj['buttons']['save'] = new XoopsFormButton('', 'submit', _SUBMIT, 'submit');
		$eletray['buttons']->addElement($sformobj['buttons']['save']);
		if ($GLOBALS['xoopsModuleConfig']['json']) {
			$sformobj['buttons']['cancel'] = new XoopsFormButton('', 'cancel', _CANCEL);
			$sformobj['buttons']['cancel']->setExtra('onClick="javascript:doJSON_LoadPageForm();"');
			$eletray['buttons']->addElement($sformobj['buttons']['cancel']);
		}
		$formobj['buttons'] = $eletray['buttons'];
		
		if (is_object($formobj['language']))	
			$formobj['language']->setDescription(_XCONTENT_AD_LANGUAGE_DESC);
		if (is_object($formobj['text']))	
			$formobj['text']->setDescription(_XCONTENT_AD_BLOCKHTML_DESC);
		if (is_object($formobj['title']))	
			$formobj['title']->setDescription(_XCONTENT_AD_OPENDESCRIPTION_DESC);
		
		$required = array('title', 'text');
		
		foreach($formobj as $id => $obj)			
			if (in_array($id, $required))
				$sform->addElement($formobj[$id], true);			
			else
				$sform->addElement($formobj[$id], false);

		$sform->addElement(new XoopsFormHidden('xcontentid', (isset($_GET['xcontentid']))?$_GET['xcontentid']:$block['text']->getVar('xcontentid')));
		$sform->addElement(new XoopsFormHidden('blockid', (isset($_GET['blockid']))?$_GET['blockid']:$block['block']->getVar('blockid')));	
		$sform->addElement(new XoopsFormHidden('op', _XCONTENT_URL_OP_SAVE));
		$sform->addElement(new XoopsFormHidden('fct', _XCONTENT_URL_FCT_BLOCKS));
		

		return $sform->render();
	}
	
	function xcontent_listuserblock()
	{
		$block_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_BLOCK, _XCONTENT_DIRNAME);
		$text_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_TEXT, _XCONTENT_DIRNAME);
		$user_handler =& xoops_gethandler('user');
		
		$start = (isset($_GET['start']))?intval($_GET['start']):0;
		$limit = (isset($_GET['limit']))?intval($_GET['limit']):30;
		
		$ttl = $block_handler->getCount(NULL);
		$pagenav = new XoopsPageNav($ttl, $limit, $start, 'start', 'op='._XCONTENT_URL_OP_MANAGE.'&fct='._XCONTENT_URL_FCT_BLOCKS.'&limit='.$limit.'');
		
		$criteria = new Criteria('1', '1');
		$criteria->setStart($start);
		$criteria->setLimit($limit);
		
		$ret = '<div style="float:right; clear:both;">'.$pagenav->renderNav().'</div>';
		$ret .= '<form method="post" action="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_SAVE.'&fct='._XCONTENT_URL_FCT_BLOCK.'" enctype="multipart/form-data">';
		$ret .= '<table width="100%">';
		$ret .= '<tr class="head">';
		$ret .= '<td>'._XCONTENT_AD_TITLE.'</td>';
		$ret .= '<td>'._XCONTENT_AD_CREATED.'</td>';
		$ret .= '<td>'._XCONTENT_AD_MADEBY.'</td>';
		$ret .= '<td>'._XCONTENT_AD_ACTIONS.'</td>';
		$ret .= '</tr>';
		if ($blocks = $block_handler->getObjects($criteria, true)) {
			$class = 'odd';
			foreach($blocks as $blockid => $block) {
				$class = ($class == 'odd')?'even':'odd';
				$ret .= '<tr class="'.$class.'">';
				$ret .= '<td>'.xcontent_getBlockTitle($blockid).'</a></td>';
				$ret .= '<td>'.date(_DATESTRING, $block->getVar('created')).'</td>';
				$ret .= '<td>'.$user_handler->getUnameFromId($block->getVar('uid')).'</td>';
				$ret .= '<td><a href="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_EDIT.'&fct='._XCONTENT_URL_FCT_BLOCKS.'&blockid='.$blockid.'"><img src="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/images/edit.png"></a>&nbsp;<a href="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_DELETE.'&fct='._XCONTENT_URL_FCT_BLOCKS.'&blockid='.$blockid.'"><img src="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/images/delete.png"></a>&nbsp;<a href="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_COPY.'&fct='._XCONTENT_URL_FCT_BLOCKS.'&blockid='.$blockid.'"><img src="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/images/copy.png"></a></td>';
				$ret .= '</tr>';
			}
		
		}

		$ret .= '<tr class="foot">';
		$ret .= '<td colspan="3"></td>';
		$ret .= '<td><!--<input type="submit" value="'._SUBMIT.'">--></td>';
		$ret .= '</tr>';
		$ret .= '</table>';
		$ret .= '</form>';
		
		return $ret;
		
	}

	function xcontent_listusercategory()
	{
		$category_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_CATEGORY, _XCONTENT_DIRNAME);
		$text_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_TEXT, _XCONTENT_DIRNAME);
		
		$start = (isset($_GET['start']))?intval($_GET['start']):0;
		$limit = (isset($_GET['limit']))?intval($_GET['limit']):30;
		
		$ttl = $category_handler->getCount(NULL);
		$pagenav = new XoopsPageNav($ttl, $limit, $start, 'start', 'op='._XCONTENT_URL_OP_MANAGE.'&fct='._XCONTENT_URL_FCT_CATEGORIES.'&limit='.$limit.'');
		
		$criteria = new Criteria('1', '1');
		$criteria->setStart($start);
		$criteria->setLimit($limit);
		
		$ret = '<div style="float:right; clear:both;">'.$pagenav->renderNav().'</div>';
		$ret .= '<form method="post" action="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_SAVE.'&fct='._XCONTENT_URL_FCT_CATEGORIES.'" enctype="multipart/form-data">';
		$ret .= '<table width="100%">';
		$ret .= '<tr class="head">';
		$ret .= '<td>'._XCONTENT_AD_CATEGORY.'</td>';
		$ret .= '<td>'._XCONTENT_AD_PARENT.'</td>';
		$ret .= '<td>'._XCONTENT_AD_RSSENABLED.'</td>';
		$ret .= '<td>'._XCONTENT_AD_ACTIONS.'</td>';
		$ret .= '</tr>';
		if ($categories = $category_handler->getObjects($criteria, true)) {
			$class = 'odd';
			foreach($categories as $catid => $category) {
				$class = ($class == 'odd')?'even':'odd';
				$ret .= '<tr class="'.$class.'">';
				$ret .= '<td>'.xcontent_getCatTitle($catid).'</a></td>';
				$formobj_catid = new XoopsFormSelectCategories('', 'parent_id['.$catid.']', $category->getVar('parent_id'), 1, false, $catid);
				$ret .= '<td>'.$formobj_catid->render().'</td>';
				$formobj_rssenabled = new XoopsFormRadioYN('','rssenabled['.$catid.']',$category->getVar('rssenabled'));
				$ret .= '<td>'.$formobj_rssenabled->render().'</td>';
				$ret .= '<td><a href="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_EDIT.'&fct='._XCONTENT_URL_FCT_CATEGORY.'&catid='.$catid.'"><img src="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/images/edit.png"></a>&nbsp;<a href="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_DELETE.'&fct='._XCONTENT_URL_FCT_CATEGORY.'&catid='.$catid.'"><img src="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/images/delete.png"></a>&nbsp;<a href="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_COPY.'&fct='._XCONTENT_URL_FCT_CATEGORY.'&catid='.$catid.'"><img src="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/images/copy.png"></a></td>';
				$ret .= '</tr>';
			}
		
		}

		$ret .= '<tr class="foot">';
		$ret .= '<td colspan="3"></td>';
		$ret .= '<td><input type="submit" value="'._SUBMIT.'"></td>';
		$ret .= '</tr>';
		$ret .= '</table>';
		$ret .= '</form>';
		
		return $ret;
		
	}
	
	function xcontent_listuserxcontent()
	{
		$xcontent_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_XCONTENT, _XCONTENT_DIRNAME);
		$text_handler =& xoops_getmodulehandler(_XCONTENT_CLASS_TEXT, _XCONTENT_DIRNAME);
		
		$start = (isset($_GET['start']))?intval($_GET['start']):0;
		$limit = (isset($_GET['limit']))?intval($_GET['limit']):30;
		
		$ttl = $xcontent_handler->getCount(NULL);
		$pagenav = new XoopsPageNav($ttl, $limit, $start, 'start', 'op='._XCONTENT_URL_OP_MANAGE.'&fct='._XCONTENT_URL_FCT_XCONTENT.'&limit='.$limit.'');
		
		$criteria = new Criteria('1', '1');
		$criteria->setStart($start);
		$criteria->setLimit($limit);
		
		$ret = '<div style="float:right; clear:both;">'.$pagenav->renderNav().'</div>';
		$ret .= '<form method="post" action="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_SAVE.'&fct='._XCONTENT_URL_FCT_PAGES.'" enctype="multipart/form-data">';
		$ret .= '<table width="100%">';
		$ret .= '<tr class="head">';
		$ret .= '<td>'._XCONTENT_AD_PAGE.'</td>';
		$ret .= '<td>'._XCONTENT_AD_CATEGORY.'</td>';
		$ret .= '<td>'._XCONTENT_AD_PARENT.'</td>';
		$ret .= '<td>'._XCONTENT_AD_SUBMENUS.'</td>';
		$ret .= '<td>'._XCONTENT_AD_HOMEPAGE.'</td>';
		$ret .= '<td>'._XCONTENT_AD_ACTIONS.'</td>';
		$ret .= '</tr>';
		if ($xcontents = $xcontent_handler->getObjects($criteria, true)) {
			$class = 'odd';
			foreach($xcontents as $storyid => $xcontent) {
				$class = ($class == 'odd')?'even':'odd';
				$cntarray = $xcontent->toArray();
				$ret .= '<tr class="'.$class.'">';
				$ret .= '<td><a href="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/?storyid='.$storyid.'">'.xcontent_getTitle($storyid).'</a></td>';
				$formobj_catid[$storyid] = new XoopsFormSelectCategories('', 'catid['.$storyid.']', $xcontent->getVar('catid'), 1, false, $story_id);
				$ret .= '<td>'.$formobj_catid[$storyid]->render().'</td>';
				$formobj_parent_id[$storyid] = new XoopsFormSelectPages('', 'parent_id['.$storyid.']', $xcontents[$storyid]->getVar('parent_id'));
				$ret .= '<td>'.$formobj_parent_id[$storyid]->render().'</td>';
				$formobj_submenu[$storyid] = new XoopsFormRadioYN('','submenu['.$storyid.']', $xcontents[$storyid]->getVar('submenu'));
				$ret .= '<td>'.$formobj_submenu[$storyid]->render().'</td>';
				$formobj_homepage[$storyid] = new XoopsFormRadioYN('','homepage['.$storyid.']', $xcontents[$storyid]->getVar('homepage'));
				$ret .= '<td>'.$formobj_homepage[$storyid]->render().'</td>';

				$ret .= '<td><a href="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_EDIT.'&fct='._XCONTENT_URL_FCT_XCONTENT.'&storyid='.$storyid.'"><img src="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/images/edit.png"></a>&nbsp;<a href="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_DELETE.'&fct='._XCONTENT_URL_FCT_XCONTENT.'&storyid='.$storyid.'"><img src="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/images/delete.png"></a>&nbsp;<a href="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.xcontent_getpostinglocal().'?op='._XCONTENT_URL_OP_COPY.'&fct='._XCONTENT_URL_FCT_XCONTENT.'&storyid='.$storyid.'"><img src="'.XOOPS_URL.'/modules/'._XCONTENT_DIRNAME.'/images/copy.png"></a></td>';
				$ret .= '</tr>';
			}
		
		}

		$ret .= '<tr class="foot">';
		$ret .= '<td colspan="5"></td>';
		$ret .= '<td><input type="submit" value="'._SUBMIT.'"></td>';
		$ret .= '</tr>';
		$ret .= '</table>';
		$ret .= '</form>';
		
		return $ret;
		
	}
	
?>
