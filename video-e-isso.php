<?php

/**
 * Plugin Name: Vídeo é Isso
 * Plugin URI: https://agencialaf.com
 * Description: Descrição do Vídeo é Isso.
 * Version: 0.0.4
 * Author: Ingo Stramm
 * Text Domain: vei
 * License: GPLv2
 */

defined('ABSPATH') or die('No script kiddies please!');

define('VEI_DIR', plugin_dir_path(__FILE__));
define('VEI_URL', plugin_dir_url(__FILE__));

function vei_debug($debug)
{
    echo '<pre>';
    var_dump($debug);
    echo '</pre>';
}

require_once 'tgm/tgm.php';
require_once 'classes/classes.php';
require_once 'scripts.php';
require_once 'shortcode.php';

require 'plugin-update-checker-4.10/plugin-update-checker.php';
$updateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://raw.githubusercontent.com/IngoStramm/video-e-isso/master/info.json',
    __FILE__,
    'vei'
);
