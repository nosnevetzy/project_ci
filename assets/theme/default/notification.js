// document ready function
$(document).ready(function () {

});//End document ready functions
$(setInterval(function () {
    $('li.dropdown ul.notifications').load(adminURL + 'notifications/modules_notification'); //this means that the items loaded by display.php will be prompted into the class refresh 
$.ajax({
        url: adminURL + 'notifications/count_notifications'
    }).done(function (data) {
        $('span.notification').html(data);
    });
}, 60000));

function update_seen(id) {
    //update notification as seen
    $.ajax({
        url: adminURL + 'notifications/method/update_notification',
        type: 'POST',
        data: {'id': id}
    }).done(function (data) {
        console.log(data);
        //check notification count
        $('span.notification').html(data);
    });
}