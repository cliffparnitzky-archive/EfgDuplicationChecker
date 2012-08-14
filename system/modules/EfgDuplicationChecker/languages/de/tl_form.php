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
$GLOBALS['TL_LANG']['tl_form']['duplicationCheckingActive'] = array('Duplikate prüfen', 'Wenn Sie diese Option wählen, wird beim Speichern der Daten (im Backend-Modul "Formular-Daten") geprüft, ob bereits ein Datensatz mit den übergebenen Werten vorhanden ist.');
$GLOBALS['TL_LANG']['tl_form']['duplicationCheckingFields'] = array('Schlüsselfelder', 'Wählen Sie die Felder des Formulars aus, die <u>gemeinsam</u> den einzigartigen Schlüssel für die Duplikatsprüfung bilden.');

// legends
$GLOBALS['TL_LANG']['tl_form']['duplication_legend'] = "(EFG) Duplikatprüfung";
 
?>
