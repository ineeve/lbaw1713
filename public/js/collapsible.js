function asBreakpoint(width) {
    if (width >= 1200) {
        return 'xl';
    } else if (width >= 992) {
        return 'lg';
    } else if (width >= 768) {
        return 'md';
    } else if (width >= 576) {
        return 'sm';
    } else {
        return 'xs';
    }
}

function getBootstrapDeviceSize() {
    let viewportWidth = $(window).width();
    return asBreakpoint(viewportWidth);
}

$(document).ready(function() {
    let maxSize = getBootstrapDeviceSize();
    if (maxSize == 'md' || maxSize == 'lg' || maxSize == 'xl') {
        $('div#sections_list').addClass('show');
    } else {
        $('div#sections_list').removeClass('show');
    }
})