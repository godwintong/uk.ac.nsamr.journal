<?php

/**
 * @file classes/file/PKPFileDAO.inc.php
 *
 * Copyright (c) 2014-2016 Simon Fraser University Library
 * Copyright (c) 2003-2016 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class PKPFileDAO
 * @ingroup file
 * @see PKPFile
 *
 * @brief Abstract base class for retrieving and modifying PKPFile
 * objects and their decendents
 */

define('INLINEABLE_TYPES_FILE', Core::getBaseDir() . DIRECTORY_SEPARATOR . PKP_LIB_PATH . DIRECTORY_SEPARATOR . 'registry' . DIRECTORY_SEPARATOR . 'inlineTypes.txt');

class PKPFileDAO extends DAO {
	/**
	 * @var array a private list of MIME types that can be shown inline
	 *  in the browser
	 */
	var $_inlineableTypes;

	/**
	 * Constructor
	 */
	function __construct() {
		return parent::__construct();
	}


	//
	// Public methods
	//
	/**
	 * Check whether a file may be displayed inline.
	 * @param $pkpFile PKPFile
	 * @return boolean
	 */
	function isInlineable($file) {
		// Retrieve MIME types.
		if (!isset($this->_inlineableTypes)) {
			$this->_inlineableTypes = array_filter(file(INLINEABLE_TYPES_FILE), create_function('&$a', 'return ($a = trim($a)) && !empty($a) && $a[0] != \'#\';'));
		}

		// Check the MIME type of the file.
		return in_array($file->getFileType(), $this->_inlineableTypes);
	}
}

?>