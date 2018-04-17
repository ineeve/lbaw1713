'use strict';

function addSource(e) {
    let inputs = $('#source-inputs');
    $('#editor-sources').append(inputs[0].outerHTML);
    $(e).remove();
}