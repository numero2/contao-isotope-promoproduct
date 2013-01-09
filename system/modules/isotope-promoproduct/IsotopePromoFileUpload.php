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


class IsotopePromoFileUpload extends Widget implements uploadable {


	/**
	 * Submit user input
	 * @var boolean
	 */
	protected $blnSubmitInput = true;


	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'be_widget';

	
	/**
	 * Validate input and set value
	 * @param mixed
	 * @return string
	 */
	protected function validator($varInput) {
	
		$file = array();
		
		// check if we've been used by MultiColumnWizard
		if( preg_match_all('|([^\[]+)\[([^\[]+)\]\[([^\[]+)\]|',$this->strName,$aBuffer) ) {
			
			$file = array(
				'name'		=> $_FILES[ $aBuffer[1][0] ]['name'][ $aBuffer[2][0] ][ $aBuffer[3][0] ]
			,	'type'		=> $_FILES[ $aBuffer[1][0] ]['type'][ $aBuffer[2][0] ][ $aBuffer[3][0] ]
			,	'tmp_name'	=> $_FILES[ $aBuffer[1][0] ]['tmp_name'][ $aBuffer[2][0] ][ $aBuffer[3][0] ]
			,	'error'		=> $_FILES[ $aBuffer[1][0] ]['error'][ $aBuffer[2][0] ][ $aBuffer[3][0] ]
			,	'size'		=> $_FILES[ $aBuffer[1][0] ]['size'][ $aBuffer[2][0] ][ $aBuffer[3][0] ]
			);
		} else {
		
			$file = $_FILES[$this->strName];
		}

		if( empty($file['tmp_name']) )
			return $varInput;
		
		// check if upload was successfull
		if( !empty($file) && !$file['error'] ) {

            if( !is_dir(TL_ROOT . '/' . $this->path) )
                mkdir( TL_ROOT . '/' . $this->path, 0777, true );
        
			// store the file if the upload folder exists
			if( strlen($this->path) && is_dir(TL_ROOT . '/' . $this->path) ) {

				// generate a unique file name
				$newFileName = "";
				$newFileName = md5($file['name'].time()).'.'.substr(strrchr($file['name'], '.'), 1);

				// upload file
				$this->import('Files');
                
				$this->Files->move_uploaded_file($file['tmp_name'], $this->path . '/' . $newFileName);
				$this->Files->chmod($this->path . '/' . $file['name'], 0777);

				return $this->path . '/' . $newFileName;
			}
		}
		
		return '';
	}
	

	/**
	 * Generate the widget and return it as string
	 * @return string
	 */
	public function generate() {
	
		if( !empty($this->varValue) ) {
	
			return $this->replaceInsertTags(
				sprintf(
					'<div style="overflow:hidden;"><a href="%s" rel="lightbox" data-lightbox="promo%s" style="display:block; float:left; margin-right: 8px;">{{image::%s?width=80&height=50&mode=crop}}</a><input type="hidden" name="%s" value="%s" /> <input type="file" name="%s" id="ctrl_%s" class="tl_upload%s" style="width: 110px; display:block; float:left; margin-top: 16px; margin-right: 5px;" onfocus="Backend.getScrollOffset();" /></div>'
				,	specialchars($this->varValue)
				,	uniqid()
				,	specialchars($this->varValue)
				,	$this->strName
				,	specialchars($this->varValue)
				,	$this->strName
				,	$this->strId
				,	(strlen($this->strClass) ? ' ' . $this->strClass : '')
				,	specialchars($this->varValue)
				)
			);

		} else {

			return sprintf(
				'<input type="hidden" name="%s" value="%s" /> <input type="file" name="%s" id="ctrl_%s" class="tl_upload%s" onfocus="Backend.getScrollOffset();" style="width: 110px; display:block; float:left; margin-right: 5px;" />'
			,	$this->strName
			,	specialchars($this->varValue)
			,	$this->strName
			,	$this->strId
			,	(strlen($this->strClass) ? ' ' . $this->strClass : '')
			);
		}
	}
}

?>