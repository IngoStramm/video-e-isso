<?php

add_filter('qsm_retake_quiz_text', 'vei_retake_button_text');

function vei_retake_button_text ($text) {
    $text = __('Refazer Quiz', 'vei');
    return $text;
}