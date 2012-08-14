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
 * @copyright  Cliff Parnitzky 2012
 * @author     Cliff Parnitzky
 * @package    EfgDuplicationChecker
 * @license    LGPL
 */

/**
 * Class EfgDuplicationChecker
 *
 * @copyright  Cliff Parnitzky 2012
 * @author     Cliff Parnitzky
 */
class EfgDuplicationChecker extends Backend
{
	/**
	 * Execute Hook: validateFormField to check for duplicates
	 */
	public function checkForDuplicates(Widget $objWidget, $strFormId, $arrData)
	{
		$this->import('Database');
		$this->import('Input');
		
		$arrDuplicationCheckingFields = deserialize($arrData['duplicationCheckingFields']);
		if ($arrData['duplicationCheckingActive'] && in_array($objWidget->name, $arrDuplicationCheckingFields)) {
			$arrParams = array();
			$arrParams[] = $arrData['id'];
			foreach ($arrDuplicationCheckingFields as $fieldName) {
				$arrParams[] = $this->Input->postRaw($fieldName);
			}

			$records = $this->Database->prepare($this->buildQueryString($arrDuplicationCheckingFields))->execute($arrParams);
			if ($records->next()) {
				$fields = array();
				foreach ($arrDuplicationCheckingFields as $fieldName) {
					$dbField = $fieldName . "_label";
					$fields[] = $records->$dbField;
				}
			
				$objWidget->addError(sprintf($GLOBALS['TL_LANG']['ERR']['duplicateError'], implode(", ", $fields)));
			}
		}
	    return $objWidget;
	}

	/**
	 * build the sql query
	 */
	private function buildQueryString ($arrDuplicationCheckingFields) {
		$queryString = "SELECT ";
		
		$fields = array();
		foreach ($arrDuplicationCheckingFields as $fieldName) {
			$fields[] = "fdd_" . $fieldName . ".ff_label as " . $fieldName . "_label ";
		}
		
		$queryString .= implode(", ", $fields);
		$queryString .= "FROM tl_form f ";
		
		$queryString .= "JOIN tl_formdata fd ON fd.form = f.title ";
		
		foreach ($arrDuplicationCheckingFields as $fieldName) {
			$queryString .= "JOIN tl_formdata_details fdd_" . $fieldName . " ON fdd_" . $fieldName . ".pid = fd.id ";
		}
		
		$queryString .= "WHERE f.id = ? ";
		
		foreach ($arrDuplicationCheckingFields as $fieldName) {
			$queryString .= "AND fdd_" . $fieldName . ".ff_name = '" . $fieldName . "' AND fdd_" . $fieldName . ".value = ? ";
		}
		$queryString .= "ORDER BY fd.tstamp DESC";
		
		return $queryString;
	}
	
	/**
	 * Return all possible form fields as array
	 * @return array
	 */
	public function getAllFormFields()
	{
		$fields = array();

		// Get all form fields which can be used
		$objFields = $this->Database->prepare("SELECT name,label FROM tl_form_field WHERE pid=? ORDER BY name ASC")
							->execute($this->Input->get('id'));

		while ($objFields->next())
		{
			$name = $objFields->name;
			$label = $objFields->label;

			if (strlen($name)) {
				$label = strlen($label) ? $label.' ['.$name.']' : $name;
				$fields[$name] = $label;
			}
		}

		return $fields;
	}
}

?>