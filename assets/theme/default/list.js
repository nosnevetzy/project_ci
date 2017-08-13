// document ready function
$(document).ready(function () {

});//End document ready functions

//date picker search

//Load Ajax
function load_dfltpage(event) {
    var post_data = {};
    if (!isEmpty(event['datas'])) {
        post_data = event['datas'];
    }
    if (!isEmpty(event['id'])) {
        post_data['id'] = event['id'];
    }
    if (!isEmpty(event['item'])) {
        post_data['item'] = event['item'];
    }
    $.ajax({
        url: event['action'],
        type: 'POST',
        data: post_data,
        success: function (result) {
            if (!isEmpty(event['resulttohtml'])) {
                $(event['resulttohtml']).html(result)
            }
        }
    });
    // var result=$.ajax({				
    // url: event['action'],
    // type: 'POST',
    // async: false,
    // dataType:"json",
    // data: post_data
    // }).responseText;
    // $(event['resulttohtml']).html(result)
}


var actionList = '';
var actionListId = '';
var actionListType = '';
function load_datalist(event) {
//    var loader = "<center><img src='" + baseURL + "assets/images/animal.gif" + "' ></center>";
//    $("#containerList").html(loader);
    actionList = event['action'];
    if (!isEmpty(event['id'])) {
        actionListId = event['id'];
    }
    if (!isEmpty(event['type'])) {
        actionListType = event['type'];
    }

    var page = '';
    if (!isEmpty(event['page'])) {
        page = event['page'];
    }
    var search = '';
    if (!isEmpty(event['search'])) {
        search = event['search'];
    }
    var sort = '';
    if (!isEmpty(event['sort'])) {
        sort = event['sort'];
    }
    var display = '';
    if (!isEmpty(event['display'])) {
        display = event['display'];
    }

    load_list(page, search, sort, display);
}

$("#containerList").on('click', '.listasc', function () {
    $('.sort_default').removeClass('listdesc');
    $('.sort_default').addClass('listasc');
    $('.sort_default').attr('name', $(this).attr('name'));

    var data = {};
    data['sort_type'] = 'ASC';
    data['sort_by'] = $(this).attr('name');
    var search = get_search();
    var display = $('.listdisplay').val();
    load_list('', search, data, display);
});

$("#containerList").on('click', '.listdesc', function () {
    $('.sort_default').removeClass('listasc');
    $('.sort_default').addClass('listdesc');
    $('.sort_default').attr('name', $(this).attr('name'));

    var data = {};
    data['sort_type'] = 'DESC';
    data['sort_by'] = $(this).attr('name');
    var search = get_search();
    var display = $('.listdisplay').val();
    load_list('', search, data, display);
});

$("#containerList").on('click', '.listbutton', function () {
    var search = get_search();
    var sort = get_sort();
    var display = $('.listdisplay').val();
    load_list($(this).attr('value'), search, sort, display);
});


$("#containerList").on('change', '.listsearch', function () {
    var search = get_search();
    var sort = get_sort();
    var display = $('.listdisplay').val();
    load_list('', search, sort, display);
});

$("#containerList").on('change', '.listdisplay', function () {
    var search = get_search();
    var sort = get_sort();
    load_list('', search, sort, $(this).val());
});

function get_sort() {
    if ($('.listsort').hasClass('listdesc')) {
        var data = {};
        data['sort_type'] = 'DESC';
        data['sort_by'] = $('.listsort').attr('name');
    } else if ($('.listsort').hasClass('listasc')) {
        var data = {};
        data['sort_type'] = 'ASC';
        data['sort_by'] = $('.listsort').attr('name');
    } else {
        var data = '';
    }
    return data;
}

function get_search() {
    var data = {};
    $('.listsearch').each(function () {
        data[$(this).attr('id')] = $(this).val();
    });
    return data;
}

function load_list(page, search, sort, display) {
    var post_data = {};
    post_data['page'] = page;
    post_data['search'] = search;
    post_data['sort'] = sort;
    post_data['display'] = display;
    post_data['id'] = actionListId;
    post_data['type'] = actionListType;
    $.ajax({
        url: actionList,
        type: 'POST',
        data: post_data,
        success: function (result) {
            $("#containerList").html(result);
        }
    });

    // var result=$.ajax({				
    // url: actionList,
    // type: 'POST',
    // async: false,
    // dataType:"json",
    // data: post_data
    // }).responseText;
    // $("#containerList").html(result);	
}


