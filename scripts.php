<?php

add_action('wp_enqueue_scripts', 'vei_frontend_scripts');

function vei_frontend_scripts()
{

    $min = (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1', '10.0.0.3'))) ? '' : '.min';

    if (empty($min)) :
        wp_enqueue_script('vei-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true);
    endif;

    wp_register_script('vei-script', VEI_URL . 'assets/js/video-e-isso' . $min . '.js', array('jquery'), '1.0.0', true);

    wp_enqueue_script('vei-script');

    wp_localize_script('vei-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    wp_enqueue_style('vei-style', VEI_URL . 'assets/css/video-e-isso.css', array(), false, 'all');
}
