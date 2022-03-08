<?php

add_filter('qsm_retake_quiz_text', 'vei_retake_button_text');

function vei_retake_button_text($text)
{
    $text = __('Refazer Quiz', 'vei');
    return $text;
}

if (function_exists('mlw_qmn_variable_question_answers')) {
    remove_filter('mlw_qmn_template_variable_results_page', 'mlw_qmn_variable_question_answers');
    add_filter('mlw_qmn_template_variable_results_page', 'vei_qmn_variable_question_answers', 10, 2);
}

function vei_qmn_variable_question_answers($content, $mlw_quiz_array)
{
    global $mlwQuizMasterNext;
    $logic_rules      = $mlwQuizMasterNext->pluginHelper->get_quiz_setting('logic_rules');
    $logic_rules      = qmn_sanitize_input_data($logic_rules);
    $hidden_questions = isset($mlw_quiz_array['hidden_questions']) ? $mlw_quiz_array['hidden_questions'] : array();
    if (empty($hidden_questions)) {
        $hidden_questions = isset($mlw_quiz_array['results']['hidden_questions']) ? $mlw_quiz_array['results']['hidden_questions'] : array();
    }
    // Checks if the variable is present in the content.
    while (strpos($content, '%QUESTIONS_ANSWERS%') !== false || strpos($content, '%QUESTIONS_ANSWERS_EMAIL%') !== false) {
        global $wpdb;
        $display = '';
        if (strpos($content, '%QUESTIONS_ANSWERS_EMAIL%') !== false) {
            if (isset($mlw_quiz_array['quiz_settings']) && !empty($mlw_quiz_array['quiz_settings'])) {
                $quiz_text_settings           = isset($mlw_quiz_array['quiz_settings']['quiz_text']) ? qmn_sanitize_input_data($mlw_quiz_array['quiz_settings']['quiz_text'], true) : array();
                $qmn_question_answer_template = isset($quiz_text_settings['question_answer_email_template']) ? apply_filters('qsm_section_setting_text', $quiz_text_settings['question_answer_email_template']) : $mlwQuizMasterNext->pluginHelper->get_section_setting('quiz_text', 'question_answer_email_template', '%QUESTION%<br/>' . __('Resposta', 'vei') . ': %USER_ANSWER%<br/>');
            } else {
                $qmn_question_answer_template = $mlwQuizMasterNext->pluginHelper->get_section_setting('quiz_text', 'question_answer_email_template', '%QUESTION%<br/>' . __('Resposta', 'vei') . ': %USER_ANSWER%<br/>');
            }
        } else {
            if (isset($mlw_quiz_array['quiz_settings']) && !empty($mlw_quiz_array['quiz_settings'])) {
                $quiz_text_settings           = isset($mlw_quiz_array['quiz_settings']['quiz_text']) ? qmn_sanitize_input_data($mlw_quiz_array['quiz_settings']['quiz_text'], true) : array();
                $qmn_question_answer_template = isset($quiz_text_settings['question_answer_template']) ? apply_filters('qsm_section_setting_text', $quiz_text_settings['question_answer_template']) : $mlwQuizMasterNext->pluginHelper->get_section_setting('quiz_text', 'question_answer_template', '%QUESTION%<br/>%USER_ANSWERS_DEFAULT%');
            } else {
                $qmn_question_answer_template = $mlwQuizMasterNext->pluginHelper->get_section_setting('quiz_text', 'question_answer_template', '%QUESTION%<br/>%USER_ANSWERS_DEFAULT%');
            }
        }
        $questions     = QSM_Questions::load_questions_by_pages($mlw_quiz_array['quiz_id']);
        $qmn_questions = array();
        foreach ($questions as $question) {
            $qmn_questions[$question['question_id']] = $question['question_answer_info'];
        }

        // Cycles through each answer in the responses.
        $total_question_cnt = count($mlw_quiz_array['question_answers_array']);
        $qsm_question_cnt   = 1;
        foreach ($mlw_quiz_array['question_answers_array'] as $answer) {
            if (in_array($answer['id'], $hidden_questions, true)) {
                continue;
            }
            $display .= qsm_questions_answers_shortcode_to_text($mlw_quiz_array, $qmn_question_answer_template, $questions, $qmn_questions, $answer, $qsm_question_cnt, $total_question_cnt);
            $qsm_question_cnt++;
        }
        $display = "<div class='qsm_questions_answers_section'>{$display}</div>";
        $content = str_replace('%QUESTIONS_ANSWERS%', $display, $content);
        $content = str_replace('%QUESTIONS_ANSWERS_EMAIL%', $display, $content);
    }
    return $content;
}
