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


class IsotopePromoProduct extends Frontend {


	private $cookieName = 'ISOTOPE_PROMO';


	public function setLastCheckoutCookie( IsotopeOrder $oOrder=NULL, IsotopeCart $oCart=NULL ) {
	
		// got a cookie from last checkout? reset it
		if( $this->Input->cookie($this->cookieName) ) {
		
			$this->setCookie( $this->cookieName, null, 0 );
			return;
		}
		
		$promoProduct = NULL;
		
		// find product with biggest quantity
		foreach( $oCart->getProducts() as $p ) {
		
			if( !$promoProduct || $promoProduct->quantity_requested < $p->quantity_requested )
				$promoProduct = $p;
		}
		
		// store product category in cookie
		if( $promoProduct ) {
		
			$page = $promoProduct->pages[ (count($promoProduct->pages)-1) ];
			$this->setCookie( $this->cookieName, $page, strtotime('1 year') );
		}
	}
}

?>