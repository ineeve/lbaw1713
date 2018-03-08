function signIn(){
    event.preventDefault();
    console.log("Sign in pressed");
    document.location.href = "index_signed_in.html";
}

if($(window).width() > 768){
    $("#sections_list").addClass('show');
}

$(function () {
    $("div.news_box").slice(0, 7).show();
    $("div.news_box_forYou").slice(0, 7).show();
    if ($('div.news_box[style="display: none;"]').length == 0) {
        $(".loadMore").hide();
    }

    $(".loadMore").on('click', function (e) {
      console.log("entrou");
        e.preventDefault();
        $('div.news_box[style="display: none;"]').slice(0, 4).slideDown();
        if ($('div.news_box[style="display: none;"]').length == 0) {
            $(".loadMore").fadeOut('slow');
        }
        $('html,body').animate({
            scrollTop: $(this).offset().top
        }, 1500);
    });

    $(".loadMoreForYou").on('click', function (e) {
      console.log("entrou");
        e.preventDefault();
        $('div.news_box_forYou[style="display: none;"]').slice(0, 4).slideDown();
        if ($('div.news_box_forYou[style="display: none;"]').length == 0) {
            $(".loadMoreForYou").fadeOut('slow');
        }
        $('html,body').animate({
            scrollTop: $(this).offset().top
        }, 1500);
    });
});

$('a[href="#top"]').click(function () {
    $('html, body').animate({
        scrollTop: 0
    }, 600);
    return false;
});

$(window).scroll(function () {
    if ($(this).scrollTop() > 200) {
        $('p.totop > a').fadeIn();
        console.log("em baixo");
    } else {
      console.log("em cima");
        $('p.totop > a').fadeOut();
    }
});
