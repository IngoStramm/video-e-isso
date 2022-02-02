document.addEventListener('DOMContentLoaded', function () {
    const vei_calc = document.querySelectorAll('[data-id="vei-calc"]');
    for (i = 0; i < vei_calc.length; i++) {
        const vei_textarea = vei_calc[i].querySelector('[data-id="vei-calc-text"]');
        const vei_qtd = vei_calc[i].querySelector('[data-id="vei-calc-qtd"]');
        const vei_tempo = vei_calc[i].querySelector('[data-id="vei-calc-tempo"]');

        vei_textarea.onkeyup = function () {
            var text = vei_textarea.value;
            text = text.replace(/(\r\n|\n|\r)/gm, ' ');
            var words = text.split(' ');
            words = words.filter(function (a) { return a; });
            var total_words = words.length;
            vei_qtd.innerHTML = total_words;
            var tempo = Math.ceil(parseInt(total_words) / 3);
            vei_tempo.innerHTML = tempo === 1 ? tempo + ' minuto' : tempo + ' minutos';
        };
    }
});