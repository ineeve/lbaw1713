function signIn(){
    event.preventDefault();
    console.log("Sign in pressed");
    document.location.href = "index_signed_in.html";
}

$(function () {
    $("div.news_box").slice(0, 5).show();
    $(".loadMore").on('click', function (e) {
      console.log("entrou");
        e.preventDefault();
        $('div.news_box[style="display: none;"]').slice(0, 5).slideDown();
        if ($("div.news_box:hidden").length == 0) {
            $(".load").fadeOut('slow');
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
