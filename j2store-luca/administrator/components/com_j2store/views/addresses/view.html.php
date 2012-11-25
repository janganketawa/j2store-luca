<?php
/*------------------------------------------------------------------------
# com_j2store - J2 Store v 1.0
# ------------------------------------------------------------------------
# author    Sasi varna kumar - Weblogicx India http://www.weblogicxindia.com
# copyright Copyright (C) 2012 Weblogicxindia.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://j2store.org
# Technical Support:  Forum - http://j2store.org/forum/index.html
-------------------------------------------------------------------------*/


// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

class J2StoreViewAddresses extends JView
{

	function display($tpl = null) {
		
		$mainframe = &JFactory::getApplication();
		$option = 'com_j2store';

		$db		=& JFactory::getDBO();
		$uri	=& JFactory::getURI();
		
		$filter_order		= $mainframe->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'a.id',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );
		
		$search				= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',				'string' );
		if (strpos($search, '"') !== false) {
			$search = str_replace(array('=', '<'), '', $search);
		}
		$search = JString::strtolower($search);

		// Get data from the model
		$items		= & $this->get( 'Data');
		$total		= & $this->get( 'Total');
		$pagination = & $this->get( 'Pagination' );

		$javascript 	= 'onchange="document.adminForm.submit();"';
		
		// table ordering
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;

		// search filter
		$lists['search']= $search;

		$this->assignRef('lists',		$lists);
		$this->assignRef('items',		$items);
		$this->assignRef('pagination',	$pagination);

		$model = &$this->getModel();

		$params = &JComponentHelper::getParams('com_j2store');
		
		$this->addToolBar();
		J2StoreSubmenuHelper::addSubmenu($vName = 'addresses');		
		parent::display($tpl);
	}
	
	public function addToolBar() {
		JToolBarHelper::title(JText::_('User Address Manager'),'j2store-logo');
		//JToolBarHelper::addNewX();
		//JToolBarHelper::editListX();
		JToolBarHelper::deleteList();
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
	}

}
