<?php
/**
 * generate an WebApp file for Prism / WebRunner
 *
 * @see http://wiki.mozilla.org/Prism
 */

/**
 *
 */
define('PMA_MINIMUM_COMMON', true);
require_once './libraries/common.inc.php';
require_once './libraries/zip.lib.php';

// ini file
$parameters = [
    'id'        => 'phpMyAdmin@' . $_SERVER['HTTP_HOST'],
    'uri'       => $_SESSION['PMA_Config']->get('PmaAbsoluteUri'),
    'status'    => 'yes',
    'location'  => 'no',
    'sidebar'   => 'no',
    'navigation' => 'no',
    'icon'      => 'phpMyAdmin',
];

// dom sript file
// none need yet

// icon
$icon = 'favicon.ico';

// name
$name = 'phpMyAdmin.webapp';

$ini_file = "[Parameters]\n";
foreach ($parameters as $key => $value) {
    $ini_file .= $key . '=' . $value . "\n";
}

$zip = new zipfile;
$zip->addFile($ini_file, 'webapp.ini');
$zip->addFile(file_get_contents($icon), 'phpMyAdmin.ico');

header('Content-Type: application/webapp');
header('Content-Disposition: attachment; filename="' . $name . '"');
echo $zip->file();
?>
