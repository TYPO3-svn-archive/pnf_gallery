<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 Plan Net <technique@in-cite.net>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */


class tx_pnfgallery_sources_manager {
	private static $tempSources = array();
	private static $sources = null;
	
	function subscribe($class) {
		self::$tempSources[] = $class;
	}
	
	function getSubscribers() {
		if (!is_array(self::$sources)) self::initSources();
		return self::$sources;
	}
	
	protected function initSources() {
		if (is_array(self::$tempSources)) {
			self::$sources = array();
			foreach (self::$tempSources as $class) {
				if ($class && class_exists($class)) {
					$obj = t3lib_div::makeInstance($class);
					if (TYPO3_MODE == 'FE') $obj->cObj = t3lib_div::makeInstance('tslib_cObj');
					$key = $obj->getKey();
					self::$sources[$key] = $obj;
				}
			}
		}
	}
}

?>