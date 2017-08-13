$(document).ready(function () {
    $('a[data-link]').unbind("click");
    $('a[data-back-link]').unbind("click");

    $('a[data-link]').on('click', function () {
        var loader = "<center><img src='" + baseURL + "assets/images/animal.gif" + "' ></center>";
        $('.current').removeClass("current");
        $("#loader").html(loader);
        $(this).addClass("current");

        var new_url = $(this).attr("data-link");
        $.ajax({
            url: new_url,
            type: 'POST',
            success: function (data) {
                $("#def_body").html(data);
            }
        });
        window.history.pushState('page2', 'Title', new_url);
    });

    $('a[data-back-link]').on('click', function () {
        var loader = "<center><img src='" + baseURL + "assets/images/animal.gif" + "' ></center>";
        $("#back_loader").html(loader);
        var new_url = $(this).attr("data-back-link");
        $.ajax({
            url: new_url,
            type: 'POST',
            success: function (data) {
                $("#back_body").html(data);
            }
        });
        window.history.pushState('page2', 'Title', new_url);
    });
    //$("#clearflash").css("min-height", "calc(100vh - 49px)");

});