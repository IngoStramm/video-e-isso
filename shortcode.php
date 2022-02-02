<?php

add_shortcode('vei_calc', 'vei_calc_shortcode');

function vei_calc_shortcode($atts)
{
    $output = '';
    $output .= '
    <div class="vei-calc" data-id="vei-calc">
        <textarea name="vei-calc-text" id="vei-calc-text" cols="50" rows="4" class="vei-calc-text" data-id="vei-calc-text"></textarea>
        <h4 class="vei-calc-title">' . __('Quantidade de palavras:', 'vei') . ' <span class="vei-calc-qtd" data-id="vei-calc-qtd">0</span></h4>';
    // $output .= '
    //     <p><a href="#" class="vei-calc-btn" data-id="vei-calc-btn">' . __('Calcular tempo') . '</a></p>';
    $output .= '
        <h4 class="vei-calc-title">' . __('Tempo estimado:', 'vei') . ' <span class="vei-cal-tempo" data-id="vei-calc-tempo">0 minutos</span></h4>
    </div>
    <!-- /.vei-calc -->';

    $output .= '
    <script>
    </script>
    ';

    return $output;
}
