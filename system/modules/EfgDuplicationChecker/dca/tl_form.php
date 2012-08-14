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

// fields
$GLOBALS['TL_DCA']['tl_form']['fields']['duplicationCheckingActive'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_form']['duplicationCheckingActive'],
	'exclude'                 => true,
	'filter'                  => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('submitOnChange'=>true)
);

$GLOBALS['TL_DCA']['tl_form']['fields']['duplicationCheckingFields'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_form']['duplicationCheckingFields'],
	'exclude'                 => true,
	'filter'                  => false,
	'inputType'               => 'checkbox',
	'options_callback'        => array('EfgDuplicationChecker', 'getAllFormFields'),
	'eval'                    => array('mandatory'=>true, 'multiple'=>true, 'tl_class'=>'w50')
);

// Palettes
$GLOBALS['TL_DCA']['tl_form']['palettes']['__selector__'][] = 'duplicationCheckingActive';

$GLOBALS['TL_DCA']['tl_form']['palettes']['default'] =  str_replace(array('{expert_legend:hide}'), array('{duplication_legend:hide},duplicationCheckingActive;{expert_legend:hide}'), $GLOBALS['TL_DCA']['tl_form']['palettes']['default'] );

// Subpalettes
array_insert($GLOBALS['TL_DCA']['tl_form']['subpalettes'], count($GLOBALS['TL_DCA']['tl_form']['subpalettes']),
	array('duplicationCheckingActive' => 'duplicationCheckingFields')
);

?>