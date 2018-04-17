'use strict';

function addSource(e) {
    let inputs = $('.source-inputs');
    $('#editor-sources').append(inputs[inputs.length-1].outerHTML);
    $(e).remove();
}