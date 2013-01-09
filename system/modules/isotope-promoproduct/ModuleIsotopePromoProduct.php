<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

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


class ModuleIsotopePromoProduct extends Module {


	private $cookieName = 'ISOTOPE_PROMO';


	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_iso_promo_product';
	
	
	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate() {

		if( TL_MODE == 'BE' ) {

			$objTemplate = new BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ISOTOPE PROMO PRODUCT ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}
		
		return parent::generate();
	}
	
	
	/**
	 * Generate module
	 */
	protected function compile() {

		// initialize defaults
		$headline = $this->iso_promo_headline;
		$caption = $this->iso_promo_caption;
		$link = $this->iso_promo_link;
		$image = $this->iso_promo_image;
		
		// try to get product from cookie
		if( $this->Input->cookie($this->cookieName) ) {
		
			$objPage = NULL;
			$objPage = $this->Database->prepare("SELECT * FROM tl_page WHERE id = ?;")->execute( $this->Input->cookie($this->cookieName) );
			
			$aSettings = array();
			$aSettings = unserialize( $objPage->iso_promo_product );
			
			if( !empty($aSettings) ) {
			
				$setting = $aSettings[ rand(0,(count($aSettings)-1)) ];
				
				$image = $setting['image'];
				$headline = $setting['head'];
				$caption = $setting['caption'];
				$link = $objPage->id;
			}
		}

		$this->Template->headline = $headline;
		$this->Template->caption = $caption;
		$this->Template->image = $image;

		// generate link
		$objLink = NULL;
		$objLink = $this->Database->prepare("SELECT * FROM tl_page WHERE id = ?;")->execute($link);

		$this->Template->link = $this->generateFrontendUrl(
			$objLink->fetchAssoc()
		,	null
		);
	}

}

?>