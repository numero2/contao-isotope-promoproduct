<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  2012
 * @author     numero2 - Agentur für Internetdienstleistungen
 * @package    Isotope eCommerce
 * @license    LGPL
 * @filesource
 */
 
 
/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_page']['palettes']['regular'] = str_replace( 'iso_setReaderJumpTo', 'iso_setReaderJumpTo,iso_promo_product', $GLOBALS['TL_DCA']['tl_page']['palettes']['regular'] );


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['iso_promo_product'] = array(
	'label'						=> &$GLOBALS['TL_LANG']['tl_page']['iso_promo_product']
,	'exclude' 					=> true
,	'inputType' 				=> 'multiColumnWizard'
,	'eval' 						=> array(
		'columnFields' => array(
			'image' => array(
				'label'			=> &$GLOBALS['TL_LANG']['tl_page']['iso_promo_product_image']
			,	'inputType'   	=> 'isoPromoFileUpload'
			,	'eval'        	=> array( 'path'=>'isotope/promo/', 'extensions'=>'png,jpg,jpeg', 'style'=>'width:195px' )
			,	'doNotSaveEmpty'=> true
			)
		,	'head' => array(
				'label'			=> &$GLOBALS['TL_LANG']['tl_page']['iso_promo_product_head']
			,	'exclude'		=> false
			,	'inputType'		=> 'text'
			,	'eval'			=> array( 'mandatory'=>false, 'style'=>'width:180px' )
			)
		,	'caption' => array(
				'label'			=> &$GLOBALS['TL_LANG']['tl_page']['iso_promo_product_caption']
			,	'exclude'		=> false
			,	'inputType'		=> 'text'
			,	'eval'			=> array( 'mandatory'=>false, 'style'=>'width:180px' )
			)
		)
	)
);

?>