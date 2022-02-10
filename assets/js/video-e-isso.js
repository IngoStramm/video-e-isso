document.addEventListener('DOMContentLoaded', function () {
    const vei_calc = document.querySelectorAll('[data-id="vei-calc"]');
    for (i = 0; i < vei_calc.length; i++) {
        const vei_textarea = vei_calc[i].querySelector('[data-id="vei-calc-text"]');
        const vei_qtd_caracteres = vei_calc[i].querySelector('[data-id="vei-calc-qtd-caracteres"]');
        const vei_qtd_palavras = vei_calc[i].querySelector('[data-id="vei-calc-qtd-palavras"]');
        const vei_tempo = vei_calc[i].querySelector('[data-id="vei-calc-tempo"]');

        vei_textarea.onkeyup = function () {
            var text = vei_textarea.value;
            text = text.replace(/(\r\n|\n|\r)/gm, ' ');
            var words = text.split(' ');
            words = words.filter(function (a) { return a; });
            const total_words = words.length;
            vei_qtd_palavras.innerHTML = total_words;
            vei_qtd_caracteres.innerHTML = text.length;
            var tempo = Math.ceil(parseInt(total_words) / 2.15);
            var msg = tempo === 1 ? tempo + ' segundo' : tempo + ' segundos';
            if (tempo > 60) {
                const minutos = Math.floor(tempo / 60);
                const segundos = tempo - minutos * 60;
                msg = minutos + 'min ' + segundos + 'sec';
            }
            vei_tempo.innerHTML = msg;
        };
    }
});