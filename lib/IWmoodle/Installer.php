<?php

/**
 * PostNuke Application Framework
 *
 * @copyright (c) 2002, PostNuke Development Team
 * @link http://www.postnuke.com
 * @version $Id: pninit.php 22139 2007-06-01 10:57:16Z markwest $
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @package PostNuke_Value_Addons
 * @subpackage Webbox
 */

/**
 * initialise the IWmoodle module creating module tables and module vars
 * @author Albert Pérez Monfort (aperezm@xtec.cat)
 * @return bool true if successful, false otherwise
 */
function IWmoodle_init() {
    $dom = ZLanguage::getModuleDomain('IWmoodle');
    // Checks if module iw_main is installed. If not returns error
    $modid = ModUtil::getIdFromName('iw_main');
    $modinfo = ModUtil::getInfo($modid);

    if ($modinfo['state'] != 3) {
        return LogUtil::registerError(__('Module iw_main is needed. You have to install the iw_main module before to install it.', $dom));
    }

    // Check if the version needed is correct
    $versionNeeded = '2.0';
    if (!ModUtil::func('iw_main', 'admin', 'checkVersion', array('version' => $versionNeeded))) {
        return false;
    }


    // Create module table
    if (!DBUtil::createTable('IWmoodle'))
        return false;

    //Create module vars
    ModUtil::setVar('IWmoodle', 'moodleurl', '../moodle2');
    ModUtil::setVar('IWmoodle', 'newwindow', 1);
    ModUtil::setVar('IWmoodle', 'guestuser', 'guest');
    ModUtil::setVar('IWmoodle', 'dbprefix', 'm2');

    ModUtil::setVar('IWmoodle', 'dfl_description', 'User description');
    ModUtil::setVar('IWmoodle', 'dfl_language', 'en_utf8');
    ModUtil::setVar('IWmoodle', 'dfl_country', 'ES');
    ModUtil::setVar('IWmoodle', 'dfl_city', 'City name');
    ModUtil::setVar('IWmoodle', 'dfl_gtm', '99');
    return true;
}

/**
 * Delete the IWmoodle module
 * @author Albert Pérez Monfort (aperezm@xtec.cat)
 * @return bool true if successful, false otherwise
 */
function IWmoodle_delete() {

    // Delete module table
    DBUtil::dropTable('IWmoodle');

    //Delete module vars
    ModUtil::delVar('IWmoodle', 'moodleurl');
    ModUtil::delVar('IWmoodle', 'newwindow');
    ModUtil::delVar('IWmoodle', 'guestuser');
    ModUtil::delVar('IWmoodle', 'dbprefix');
    ModUtil::delVar('IWmoodle', 'dfl_description');
    ModUtil::delVar('IWmoodle', 'dfl_language');
    ModUtil::delVar('IWmoodle', 'dfl_country');
    ModUtil::delVar('IWmoodle', 'dfl_city');
    ModUtil::delVar('IWmoodle', 'dfl_gtm');
    return true;
}

/**
 * Update the IWmoodle module
 * @author Albert Pérez Monfort (aperezm@xtec.cat)
 * @return bool true if successful, false otherwise
 */
function IWmoodle_upgrade($oldversion) {
    return true;
}

?>
