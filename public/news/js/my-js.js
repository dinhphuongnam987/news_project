$(document).ready(function () {
    $.get($('#box-gold').data('url'), function (data) {
        $('#box-gold').html(data);
    }, 'html');

    $.get($('#box-coin').data('url'), function (data) {
        $('#box-coin').html(data);
    }, 'html');

    $('.main_nav_list > li > a').each(function (index, ele) {
        typeMenu = $(ele).attr('type-menu');
        link = $(ele).attr('href');
        currentPath = window.location.href;
        
        switch(typeMenu) {
            case 'category_article':
                classActive = (currentPath.includes('chuyen-muc')) ? true : false;
                break;
            default:
                classActive = (link == currentPath) ? true : false;
                break;
        }

        if(classActive) {
            $(ele).addClass('active');
        }
    })
});


