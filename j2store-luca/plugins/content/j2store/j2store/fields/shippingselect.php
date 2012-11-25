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

// No direct access to this file
defined('_JEXEC') or die;
 
// import the list field type
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');
 
/**
 * TaxSelect Form Field class for the J2Store component
 */
class JFormFieldShippingSelect extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var		string
	 */
	protected $type = 'ShippingSelect';
	
	protected function getInput()
	 {

		$lists = $this->_getSelectShipMethods($this->name, $this->id,$this->value);
		
		return $lists;
	
	}
	
	function _getSelectShipMethods($var, $id, $default) {
		
		$db = &JFactory::getDBO();
		$option ='';
		
		$query = 'select id as value, shipping_method_name as text from #__j2store_shippingmethods order by id';		
		$db->setQuery( $query );
		$taxprofiles = $db->loadObjectList();
		
		$types[] 		= JHTML::_('select.option',  '0', '- '. JText::_( 'J2STORE_PLG_CONTENT_SELECT_SHIPPING' ) .' -' );
		foreach( $taxprofiles as $item )
		{
			$types[] = JHTML::_('select.option',  $item->value, JText::_( $item->text ) );
		}		
		
		$lists 	= JHTML::_('select.genericlist',  $types, $var, 'class="inputbox" size="1" '.$option.'', 'value', 'text', $default );
	
		return $lists;
	
	}
}
