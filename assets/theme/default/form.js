// document ready function
$(document).ready(function () {
    $(document).on('change', '.dflt_hideshow', function () {
        var ids = $(this).attr('id');
        var item = $(this).attr('value');
        $('.' + ids).hide();
        $('.' + ids + '_' + item).show();

        if (item == '') {
            $('.default_' + ids).show();
        }
    });

    $(document).on('change', '.dfltfloat', function () {
        var vals = parseFloat($(this).val());
        if (!isNaN(vals)) {
            $(this).val(vals);
        } else {
            $(this).val('');
        }
    });

    $(document).on('change', '.dfltint', function () {
        var vals = parseInt($(this).val());
        if (!isNaN(vals)) {
            $(this).val(vals);
        } else {
            $(this).val('');
        }
    });

    $(document).on('change', '.sum_weight', function () {
        var total = 0;
        $('.sum_weight').each(function () {
            total = parseFloat(dfltFloat(total)) + parseFloat(dfltFloat($(this).val()));
        });
        if (total <= 100) {
            $('.total_weight').val(number_format(total, 2, '.', ','));
        } else {
            $(this).val(0);
            total = 0;
            $('.sum_weight').each(function () {
                total = parseFloat(dfltFloat(total)) + parseFloat(dfltFloat($(this).val()));
            });
            $('.total_weight').val(number_format(total, 2, '.', ','));
        }
    });

});//End document ready functions

//Save Message
function dfltsave_messages(event) {
    $(this).attr('disabled', true);
    var ids = $(this).attr('id');
    var id_arr = ids.split('_');
    var post_data = {};
    $('.' + id_arr[0]).each(function (i) {
        var id_arr2 = $(this).attr('id').split('_');
        post_data[id_arr2[1]] = $(this).val();
    });
    var id2 = event.data.id;
    post_data['id'] = id2;
    if (!isEmpty(event.data.item)) {
        post_data['item'] = event.data.item;
    }
    var load_action = event.data.load_action;
    var resulttohtml = event.data.resulttohtml;

    $.ajax({
        url: event.data.action,
        type: 'POST',
        data: post_data,
        success: function (result) {
            $('#' + ids).attr('disabled', false);
            var results = $.parseJSON(result);
            if (results['id']) {
                clearFields(true, id_arr[0]);
                load_dfltpage({'action': load_action, 'id': id2, 'resulttohtml': resulttohtml});
            }
        }
    });

    // var result=$.ajax({				
    // url: event.data.action,
    // type: 'POST',
    // async: false,
    // dataType:"json",
    // data: post_data
    // }).responseText;
    // alert(result)
}


function dfltFloat(number) {
    var vals = parseFloat(number);
    if (!isNaN(vals) && vals > 0) {
        return vals;
    } else {
        return 0;
    }
}

function number_format(number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

//Load Approval Form
function dflt_approvalform(event) {
    var ids = $(this).attr('id');
    var item = $(this).attr('value');
    var post_data = {};
    if (!isEmpty(event.data.id)) {
        post_data['id'] = event.data.id;
    }
    if (!isEmpty(event.data.redirect)) {
        post_data['redirect'] = event.data.redirect;
    }
    if (!isEmpty(item)) {
        post_data['item'] = item;
    }
    $('#dfltmodal_content').html("");
    $.ajax({
        url: event.data.action,
        type: 'POST',
        data: post_data,
        success: function (result) {
            $('#dfltmodal_content').html(result);
        }
    });

    // var result=$.ajax({				
    // url: event.data.action,
    // type: 'POST',
    // async: false,
    // dataType:"json",
    // data: post_data
    // }).responseText;
    // $('#dfltmodal_content').html(result);
}

//Load Action No load
function load_dfltactionnoload(event) {
    var ids = $(this).attr('id');
    var post_data = {};
    post_data['id'] = event.data.id;
    $.ajax({
        url: event.data.action,
        type: 'POST',
        data: post_data,
        success: function (result) {
        }
    });
}

//Load Action
function load_dfltaction(event) {
    var ids = $(this).attr('id');
    var item = $(this).attr('value');
    var resulttohtml = event.data.resulttohtml;
    $("#qLoverlay").fadeIn(100);
    $("#qLbar").fadeIn(100);
    var post_data = {};

    if (ids)
        if (!isEmpty(event.data.formdata)) {
            var id_arr = ids.split('_');
            $('.' + id_arr[0]).each(function (i) {
                var id_arr2 = $(this).attr('id').split('_');
                post_data[id_arr2[1]] = $(this).val();
            });

            $('.' + id_arr[0] + '_radio').each(function (i) {
                var id_arr2 = $(this).attr('id').split('_');
                post_data[id_arr2[1]] = null;
                if (!isEmpty($('input[name=' + $(this).attr('id') + ']:checked').val())) {
                    post_data[id_arr2[1]] = $('input[name=' + $(this).attr('id') + ']:checked').val();
                }
            });

            $('.' + id_arr[0] + '_checkbox').each(function (i) {
                var id_arr2 = $(this).attr('id').split('_');
                post_data[id_arr2[1]] = {};
                post_data[id_arr2[1]] = $("input[name=" + $(this).attr('id') + "]:checked").map(function () {
                    return $(this).val();
                }).get();
                if (jQuery.isEmptyObject(post_data[id_arr2[1]])) {
                    post_data[id_arr2[1]] = null;
                }
            });

        }

    if (!isEmpty(event.data.checkbox)) {
        post_data['check'] = $(this).prop('checked') ? true : false;
    }

    if (!isEmpty(event.data.getElementValue)) {
        for (arr in event.data.getElementValue) {
            post_data[arr] = $(event.data.getElementValue[arr]).val();
        }
    }

    if (!isEmpty(event.data.id)) {
        post_data['id'] = event.data.id;
    }
    if (!isEmpty(item)) {
        post_data['item'] = item;
    }
    if (!isEmpty(event.data.item)) {
        post_data['item2'] = event.data.item;
    }
    if (!isEmpty(event.data.redirect)) {
        post_data['redirect'] = event.data.redirect;
    }
    $.ajax({
        url: event.data.action,
        type: 'POST',
        data: post_data,
        success: function (result) {
            if (!isEmpty(resulttohtml)) {
                $(resulttohtml).html(result)
            }
            $("#qLoverlay").fadeOut(250);
            $("#qLbar").fadeOut(250);
        }
    });
}

//Item
function dflt_checkitem(event) {
    var ids = $(this).attr('id');
    var item = $(this).attr('value');
    var url_redirect = event.data.redirect;
    if (showConfirmMessage(event.data.conMessage, ids)) {
        $("#qLoverlay").fadeIn(100);
        $("#qLbar").fadeIn(100);
        var post_data = {};
        if (!isEmpty(event.data.id)) {
            post_data['id'] = event.data.id;
        }
        if (!isEmpty(item)) {
            post_data['item'] = item;
        }
        post_data['selected'] = $("input[name=checkbox]:checked").map(function () {
            return $(this).val();
        }).get();
        $.ajax({
            url: event.data.action,
            type: 'POST',
            data: post_data,
            success: function (result) {
                $("#qLoverlay").fadeOut(250);
                $("#qLbar").fadeOut(250);
                var results = $.parseJSON(result);
                if (results['id']) {
                    redirect(url_redirect, '', '');
                }
            }
        });

        // var result=$.ajax({				
        // url: event.data.action,
        // type: 'POST',
        // async: false,
        // dataType:"json",
        // data: post_data
        // }).responseText;
        // alert(result);	
    }
}

//dfltaction_item Item
function dfltaction_item(event) {
    var ids = $(this).attr('id');
    var item = $(this).attr('value');
    var url_redirect = event.data.redirect;
    if (showConfirmMessage(event.data.conMessage, ids)) {
        $("#qLoverlay").fadeIn(100);
        $("#qLbar").fadeIn(100);
        var post_data = {};
        if (!isEmpty(event.data.id)) {
            post_data['id'] = event.data.id;
        }
        if (!isEmpty(item)) {
            post_data['item'] = item;
        }
        $.ajax({
            url: event.data.action,
            type: 'POST',
            data: post_data,
            success: function (result) {
                $("#qLoverlay").fadeOut(250);
                $("#qLbar").fadeOut(250);
                var results = $.parseJSON(result);
                if (results['id']) {
                    redirect(url_redirect, '', '');
                }
            }
        });

        // var result=$.ajax({				
        // url: event.data.action,
        // type: 'POST',
        // async: false,
        // dataType:"json",
        // data: post_data
        // }).responseText;
        // $('#testview').html(result);
        // $("#qLoverlay").fadeOut(250);
        // $("#qLbar").fadeOut(250);		
        // redirect(url_redirect,'','');
    }
}

//Popup Form
function load_dfltpopform(event) {
    var ids = $(this).attr('id');
    var item = $(this).attr('value');
    var post_data = {};
    if (!isEmpty(event.data.type)) {
        post_data['type'] = event.data.type;
    }
    if (!isEmpty(event.data.id)) {
        post_data['id'] = event.data.id;
    }
    if (!isEmpty(event.data.item)) {
        post_data['item2'] = event.data.item;
    }
    if (!isEmpty(event.data.redirect)) {
        post_data['redirect'] = event.data.redirect;
    }
    if (!isEmpty(item)) {
        post_data['item'] = item;
    }
    if (!isEmpty(ids)) {
        post_data['ids'] = $(this).attr('id');
    }
    $('#dfltmodallg_content').html("");
    $.ajax({
        url: event.data.action,
        type: 'POST',
        data: post_data,
        success: function (result) {
            $('#dfltmodallg_content').html(result);
        }
    });

    // var result=$.ajax({				
    // url: event.data.action,
    // type: 'POST',
    // async: false,
    // dataType:"json",
    // data: post_data
    // }).responseText;
    // alert(result);
    // $('#dfltmodal_content').html(result);
}

//multiform
function delete_multiform(event) {
    var ids = $(this).attr('id');
    var id_arr = ids.split('_');
    var val = $(this).attr('value');
    $('#' + id_arr[0] + "_item_" + val).remove();
}

function add_multiform(event) {
    var ids = $(this).attr('id');
    var id_arr = ids.split('_');
    if (!isEmpty(event.data.action)) {
        var post_data = {};
        post_data['prefix'] = id_arr[0];
        post_data['count'] = $('.' + id_arr[0] + "_item").length;
        $.ajax({
            url: event.data.action,
            type: 'POST',
            data: post_data,
            success: function (result) {
                $('#' + id_arr[0] + "_content").append(result);
            }
        });
    }
}
//arrform
function delete_arrform(event) {
    var a = event.data.prefix;
    $(this).parent().parent().parent().remove();
    arrform_renumber(a);
}

function add_arrform(event) {
    var a = event.data.prefix;
    if (!isEmpty(event.data.action) && !isEmpty(a)) {
        var post_data = {};
        post_data['prefix'] = a;
        post_data['count'] = $('.' + a + "form_item").length;
        $.ajax({
            url: event.data.action,
            type: 'POST',
            data: post_data,
            success: function (result) {
                $('#' + a + "form_main").append($.parseHTML(result));
                arrform_renumber(a);
            }
        });
    }
}

function arrform_renumber(a) {
    $('.' + a + "form_label").each(function (i) {
        $(this).html(i + 1);
    });
}

//take camera
function load_camera() {
    window.addEventListener("DOMContentLoaded", function () {
        // Grab elements, create settings, etc.
        var canvas = document.getElementById("formcam_canvas"),
                context = canvas.getContext("2d"),
                video = document.getElementById("video"),
                videoObj = {"video": true},
        errBack = function (error) {
            console.log("Video capture error: ", error.code);
        };

        // Put video listeners into place
        if (navigator.getUserMedia) { // Standard
            navigator.getUserMedia(videoObj, function (stream) {
                video.src = stream;
                video.play();
            }, errBack);
        } else if (navigator.webkitGetUserMedia) { // WebKit-prefixed
            navigator.webkitGetUserMedia(videoObj, function (stream) {
                video.src = window.webkitURL.createObjectURL(stream);
                video.play();
            }, errBack);

        } else {
            alert("Not Supported");
        }

        // Trigger photo take
        document.getElementById("formcam_snap").addEventListener("click", function () {
            if (video.videoWidth != 0) {
                context.drawImage(video, 0, 0, 314, 223);
                $("#formcam_save").show();
            } else {
                alert("Error");
            }
        });
    }, false);
}

function save_camera(event) {
    var ids = $(this).attr('id');
    var id_arr = ids.split('_');
    if (showConfirmMessage(event.data.conMessage, ids)) {
        $("#qLoverlay").fadeIn(100);
        $("#qLbar").fadeIn(100);
        var canvas1 = document.getElementById('formcam_canvas');
        var context = canvas1.getContext('2d');
        var dataURL = canvas1.toDataURL('image/png');
        var post_data = {};
        if (!isEmpty(event.data.id)) {
            post_data['id'] = event.data.id;
        }

        post_data['image_data'] = dataURL;
        $.ajax({
            url: event.data.action,
            type: 'POST',
            data: post_data,
            success: function (result) {
                $("#qLoverlay").fadeOut(250);
                $("#qLbar").fadeOut(250);
                $('#' + ids).attr('disabled', false);
                $('#' + ids).hide();
                var results = $.parseJSON(result);
                $('.' + id_arr[0] + '_alert').html("");
                if (results['message_alert']) {
                    $('.' + id_arr[0] + '_alert').html(results['message_alert']).fadeIn(200);
                    var a = Math.max(100, parseInt($('.' + id_arr[0] + 'alert').scrollTop() / 3));
                    $('html, body').animate({scrollTop: 0}, a);
                }
                if (results['id']) {
                    redirect(event.data.redirect, event.data.redirect_id, results['id']);
                }
            }
        });
    }
}

//Upload Data
var upload_id = '';
var upload_redirect = '';
function save_upload(event) {
    var ids = $(this).attr('id');
    var id_arr = ids.split('_');
    if (showConfirmMessage(event.data.conMessage, ids)) {
        $('.progressbar_div').show();
        upload_id = ids;
        upload_redirect = event.data.redirect;
        $('.' + id_arr[0] + '_alert').html('');
        var file = $("#" + id_arr[0] + "_file")[0].files[0];
        var formdata = new FormData();
        $('.' + id_arr[0]).each(function (i) {
            var id_arr2 = $(this).attr('id').split('_');
            formdata.append(id_arr2[1], $(this).val());
        });
        formdata.append("file", file);
        formdata.append("id", event.data.id);

        var ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progressHandler, false);
        ajax.addEventListener("load", completeHandler, false);
        ajax.addEventListener("error", errorHandler, false);
        ajax.addEventListener("abort", abortHandler, false);
        ajax.open("POST", event.data.action);
        ajax.send(formdata);
        
        console.log(ajax);
    }
}

function progressHandler(event) {
    var percent = (event.loaded / event.total) * 100;
    percent = Math.round(percent);
    $('.progressbar_upload_label').html(percent);
    $('#progressbar_upload').attr('data-percent', percent);
    $('#progressbar_upload').find('.bar').attr('style', 'width:' + percent + '%');
}
function completeHandler(event) {
    $('#' + upload_id).attr('disabled', false);
    $('.progressbar_div').hide();
    $('#progressbar_upload').attr('data-percent', '');
    $('#progressbar_upload').find('.bar').attr('style', 'width:0%');

    result = event.target.responseText;
    // alert(result);
    var results = $.parseJSON(result);
    var id_arr = upload_id.split('_');
    $('.' + id_arr[0] + '_alert').html(results['message_alert']);
    var a = Math.max(100, parseInt($("html").scrollTop() / 3));
    $('html, body').animate({scrollTop: 0}, a);
    upload_id = '';

    if (!isEmpty(upload_redirect) && results['id']) {
        redirect(upload_redirect, '', '');
    }
    clearFields(true, id_arr[0]);
}
function errorHandler(event) {
    $('#' + upload_id).attr('disabled', false);
    $('.progressbar_div').hide();
    upload_id = '';
    alert("Upload Failed");

}
function abortHandler(event) {
    $('#' + upload_id).attr('disabled', false);
    $('.progressbar_div').hide();
    upload_id = '';
    alert("Upload Aborted");
}

//Save Data
function save_form(event) {
    var ids = $(this).attr('id');
    var id_arr = ids.split('_');

    if (showConfirmMessage(event.data.conMessage, ids)) {
        $("#qLoverlay").fadeIn(100);
        $("#qLbar").fadeIn(100);
        var post_data = {};
        $('.' + id_arr[0]).each(function (i) {
            var id_arr2 = $(this).attr('id').split('_');
            post_data[id_arr2[1]] = $(this).val();
        });

        $('.' + id_arr[0] + '_tinymce').each(function (i) {
            var id_arr2 = $(this).attr('id').split('_');
            post_data[id_arr2[1]] = tinymce.get($(this).attr('id')).getContent();
        });

        $('.' + id_arr[0] + '_radio').each(function (i) {
            var id_arr2 = $(this).attr('id').split('_');
            post_data[id_arr2[1]] = "";
            if (!isEmpty($('input[name=' + $(this).attr('id') + ']:checked').val())) {
                post_data[id_arr2[1]] = $('input[name=' + $(this).attr('id') + ']:checked').val();
            }
        });

        $('.' + id_arr[0] + '_checkbox').each(function (i) {
            var id_arr2 = $(this).attr('id').split('_');
            post_data[id_arr2[1]] = "";
            post_data[id_arr2[1]] = $("input[name=" + $(this).attr('id') + "]:checked").map(function () {
                return $(this).val();
            }).get();
        });



        $('.' + id_arr[0] + '_arr').each(function (i) {
            var id_arr2 = $(this).attr('id').split('_');
            if ($(this).val() == 'text') {
                post_data[id_arr2[1]] = $("input[name='" + $(this).attr('id') + "[]']").map(function () {
                    return $(this).val()
                }).get();
            } else if ($(this).val() == 'select') {
                post_data[id_arr2[1]] = $("select[name='" + $(this).attr('id') + "[]']").map(function () {
                    return $(this).val()
                }).get();
            } else if ($(this).val() == 'textarea') {
                post_data[id_arr2[1]] = $("textarea[name='" + $(this).attr('id') + "[]']").map(function () {
                    return $(this).val()
                }).get();
            }
        });

        if (!isEmpty(event.data.arrform)) {
            event.data.arrform_prefix.forEach(function (i) {
                $('.' + i + 'form_field').each(function (x) {
                    var val_arr = $(this).val().split('_');
                    if (val_arr[0] == 'text') {
                        post_data[val_arr[1]] = $("input[name='" + i + "form_" + val_arr[1] + "[]']").map(function () {
                            return $(this).val()
                        }).get();
                    } else if (val_arr[0] == 'select') {
                        post_data[val_arr[1]] = $("select[name='" + i + "form_" + val_arr[1] + "[]']").map(function () {
                            return $(this).val()
                        }).get();
                    } else if (val_arr[0] == 'textarea') {
                        post_data[val_arr[1]] = $("textarea[name='" + i + "form_" + val_arr[1] + "[]']").map(function () {
                            return $(this).val()
                        }).get();
                    } else if (val_arr[0] == 'file') {
                        post_data[val_arr[1]] = $("textarea[name='" + i + "form_" + val_arr[1] + "[]']").map(function () {
                            return $(this).val()
                        }).get();
                    }
                });
            });

        }

        if (!isEmpty(event.data.id)) {
            post_data['id'] = event.data.id;
        }

        if (!isEmpty(event.data.item)) {
            post_data['item'] = event.data.item;
        }

        $.ajax({
            url: event.data.action,
            type: 'POST',
            data: post_data,
            success: function (result) {
                $('#' + ids).attr('disabled', false);
                var results = $.parseJSON(result);
                $('.' + id_arr[0] + '_alert').html("");
                if (results['message_alert']) {
                    $('.' + id_arr[0] + '_alert').html(results['message_alert']).fadeIn(200);
                    var a = Math.max(100, parseInt($('.' + id_arr[0] + 'alert').scrollTop() / 3));
                    $('html, body').animate({scrollTop: 0}, a);
                }
                if (results['id']) {
                    redirect(event.data.redirect, event.data.redirect_id, results['id']);
                    clearFields(event.data.clear, id_arr[0]);
                }
                $("#qLoverlay").fadeOut(250);
                $("#qLbar").fadeOut(250);
            }
        });

        // var result=$.ajax({				
        // url: event.data.action,
        // type: 'POST',
        // async: false,
        // dataType:"json",
        // data: post_data
        // }).responseText;
        // alert(result);
        // $('#'+ids).attr('disabled',false);
        // $("#qLoverlay").fadeOut(250);
        // $("#qLbar").fadeOut(250);
        // $('#testview').html(result);	
    }
}

//Save Data Using split('|')
function save_form_v1(event) {
    var ids = $(this).attr('id');
    var id_arr = ids.split('-');
    if (showConfirmMessage(event.data.conMessage, ids)) {
        $("#qLoverlay").fadeIn(100);
        $("#qLbar").fadeIn(100);
        var post_data = {};
        $('.' + id_arr[0]).each(function (i) {
            var id_arr2 = $(this).attr('id').split('-');
            post_data[id_arr2[1]] = $(this).val();
            console.log(post_data);
        });

        $('.' + id_arr[0] + '_tinymce').each(function (i) {
            var id_arr2 = $(this).attr('id').split('-');
            post_data[id_arr2[1]] = tinymce.get($(this).attr('id')).getContent();
        });

        $('.' + id_arr[0] + '_radio').each(function (i) {
            var id_arr2 = $(this).attr('id').split('-');
            post_data[id_arr2[1]] = "";
            if (!isEmpty($('input[name=' + $(this).attr('id') + ']:checked').val())) {
                post_data[id_arr2[1]] = $('input[name=' + $(this).attr('id') + ']:checked').val();
            }
        });

        $('.' + id_arr[0] + '_checkbox').each(function (i) {
            var id_arr2 = $(this).attr('id').split('-');
            post_data[id_arr2[1]] = "";
            post_data[id_arr2[1]] = $("input[name=" + $(this).attr('id') + "]:checked").map(function () {
                return $(this).val();
            }).get();
        });



        $('.' + id_arr[0] + '_arr').each(function (i) {
            var id_arr2 = $(this).attr('id').split('-');
            if ($(this).val() == 'text') {
                post_data[id_arr2[1]] = $("input[name='" + $(this).attr('id') + "[]']").map(function () {
                    return $(this).val()
                }).get();
            } else if ($(this).val() == 'select') {
                post_data[id_arr2[1]] = $("select[name='" + $(this).attr('id') + "[]']").map(function () {
                    return $(this).val()
                }).get();
            } else if ($(this).val() == 'textarea') {
                post_data[id_arr2[1]] = $("textarea[name='" + $(this).attr('id') + "[]']").map(function () {
                    return $(this).val()
                }).get();
            }
        });

        if (!isEmpty(event.data.arrform)) {
            event.data.arrform_prefix.forEach(function (i) {
                $('.' + i + 'form_field').each(function (x) {
                    var val_arr = $(this).val().split('|');
                    if (val_arr[0] == 'text') {
                        post_data[val_arr[1]] = $("input[name='" + i + "form_" + val_arr[1] + "[]']").map(function () {
                            return $(this).val()
                        }).get();
                    } else if (val_arr[0] == 'select') {
                        post_data[val_arr[1]] = $("select[name='" + i + "form_" + val_arr[1] + "[]']").map(function () {
                            return $(this).val()
                        }).get();
                    } else if (val_arr[0] == 'textarea') {
                        post_data[val_arr[1]] = $("textarea[name='" + i + "form_" + val_arr[1] + "[]']").map(function () {
                            return $(this).val()
                        }).get();
                    }
                });
            });

        }

        if (!isEmpty(event.data.id)) {
            post_data['id'] = event.data.id;
        }

        if (!isEmpty(event.data.item)) {
            post_data['item'] = event.data.item;
        }
//        //for purchase requisition details
//        if (!isEmpty($('input[name=budget_status]:checked').val())) {
//            post_data['budget_status'] = $('input[name=budget_status]:checked').val();
//        }
//
//        if (!isEmpty($('input[name=document_status]:checked').val())) {
//            post_data['document_status'] = $('input[name=document_status]:checked').val();
//        }

        $.ajax({
            url: event.data.action,
            type: 'POST',
            data: post_data,
            success: function (result) {
                $('#' + ids).attr('disabled', false);
                var results = $.parseJSON(result);
                $('.' + id_arr[0] + '_alert').html("");
                if (results['message_alert']) {
                    $('.' + id_arr[0] + '_alert').html(results['message_alert']).fadeIn(200);
                    var a = Math.max(100, parseInt($('.' + id_arr[0] + 'alert').scrollTop() / 3));
                    $('html, body').animate({scrollTop: 0}, a);
                }
                if (results['id']) {
                    redirect(event.data.redirect, event.data.redirect_id, results['id']);
                    clearFields(event.data.clear, id_arr[0]);
                }
                $("#qLoverlay").fadeOut(250);
                $("#qLbar").fadeOut(250);
            }
        });
    }
}

function redirect(a, b, c) {
    if (!isEmpty(a)) {
        if (!isEmpty(b)) {
            window.location.replace(a + '/' + c);
        } else {
            window.location.replace(a);
        }
    }
}

function clearFields(a, field) {
    if (!isEmpty(a)) {
        $('.' + field).val('');
        $('.' + field + '_option').attr('checked', false);
        $('.' + field + '_option').closest('.checker > span').removeClass('checked');
        $('.' + field + '_option').closest('span').removeClass('checked');
        $('.selector span').html('');
        $('.select2-choice span').html('');
        // $('.'+field).closest('span').html('');
    }
}

function showConfirmMessage(a, b) {
    if (isEmpty(a)) {
        a = "Are you sure?";
    }

    if (!isEmpty(b)) {
        $('#' + b).attr('disabled', true);
    }
    if (confirm(a)) {
        return true;
    } else {
        if (!isEmpty(b)) {
            $('#' + b).attr('disabled', false);
        }
    }
    return false;
}

function isEmpty(a) {
    a = typeof a !== 'undefined' ? a : null;
    if (a === undefined || a === null) {
        return true;
    }
    return false;
}

function decode_id(key) {
    if (key) {
        var key_arr = split("__", key);
        if (!empty(key_arr[0])) {
            return (int)((key_arr[0] - 100) / 1234567890) / 2;
        }
    }
    return 0;

}

function encode_id(id) {
    if (id)
        return (((id + id) * 1234567890) + 100) + "__" + getmd(Math.random($.now('Ymdhis')));
    return "";
}

function load_dfltconfirmation(event) {
    var ids = $(this).attr('id');
    var item = $(this).attr('value');
    var post_data = {};
    if (!isEmpty(event.data.type)) {
        post_data['type'] = event.data.type;
    }
    if (!isEmpty(event.data.id)) {
        post_data['id'] = event.data.id;
    }
    if (!isEmpty(event.data.item)) {
        post_data['item2'] = event.data.item;
    }
    if (!isEmpty(event.data.message)) {
        post_data['message'] = event.data.message;
    }
    if (!isEmpty(item)) {
        post_data['item'] = item;
    }
    if (!isEmpty(ids)) {
        post_data['ids'] = $(this).attr('id');
    }
    if (!isEmpty(event.data.action)) {
        post_data['action'] = event.data.action;
    }
    if (!isEmpty(event.data.action)) {
        post_data['redirect'] = event.data.redirect;
    }
    $('#dfltmodal_content').html("");

    $.ajax({
        url: event.data.template,
        type: 'POST',
        data: post_data,
        success: function (result) {
            $('#dfltmodal_content').html(result);
        }
    });
}

function save_default_form(event) {
    var ids = $(this).attr('id');
    var id_arr = ids.split('_');
    var post_data = {};
    $('.' + id_arr[0]).each(function (i) {
        var id_arr2 = $(this).attr('id').split('_');
        post_data[id_arr2[1]] = $(this).val();
    });
    $('.' + id_arr[0] + '_tinymce').each(function (i) {
        var id_arr2 = $(this).attr('id').split('_');
        post_data[id_arr2[1]] = tinymce.get($(this).attr('id')).getContent();
    });
    $('.' + id_arr[0] + '_radio').each(function (i) {
        var id_arr2 = $(this).attr('id').split('_');
        post_data[id_arr2[1]] = "";
        if (!isEmpty($('input[name=' + $(this).attr('id') + ']:checked').val())) {
            post_data[id_arr2[1]] = $('input[name=' + $(this).attr('id') + ']:checked').val();
        }
    });
    $('.' + id_arr[0] + '_checkbox').each(function (i) {
        var id_arr2 = $(this).attr('id').split('_');
        post_data[id_arr2[1]] = "";
        post_data[id_arr2[1]] = $("input[name=" + $(this).attr('id') + "]:checked").map(function () {
            return $(this).val();
        }).get();
    });
    $('.' + id_arr[0] + '_arr').each(function (i) {
        var id_arr2 = $(this).attr('id').split('_');
        if ($(this).val() == 'text') {
            post_data[id_arr2[1]] = $("input[name='" + $(this).attr('id') + "[]']").map(function () {
                return $(this).val()
            }).get();
        } else if ($(this).val() == 'select') {
            post_data[id_arr2[1]] = $("select[name='" + $(this).attr('id') + "[]']").map(function () {
                return $(this).val()
            }).get();
        } else if ($(this).val() == 'textarea') {
            post_data[id_arr2[1]] = $("textarea[name='" + $(this).attr('id') + "[]']").map(function () {
                return $(this).val()
            }).get();
        }
    });
    if (!isEmpty(event.data.arrform)) {
        event.data.arrform_prefix.forEach(function (i) {
            $('.' + i + 'form_field').each(function (x) {
                var val_arr = $(this).val().split('_');
                if (val_arr[0] == 'text') {
                    post_data[val_arr[1]] = $("input[name='" + i + "form_" + val_arr[1] + "[]']").map(function () {
                        return $(this).val()
                    }).get();
                } else if (val_arr[0] == 'select') {
                    post_data[val_arr[1]] = $("select[name='" + i + "form_" + val_arr[1] + "[]']").map(function () {
                        return $(this).val()
                    }).get();
                } else if (val_arr[0] == 'textarea') {
                    post_data[val_arr[1]] = $("textarea[name='" + i + "form_" + val_arr[1] + "[]']").map(function () {
                        return $(this).val()
                    }).get();
                } else if (val_arr[0] == 'file') {
                    post_data[val_arr[1]] = $("textarea[name='" + i + "form_" + val_arr[1] + "[]']").map(function () {
                        return $(this).val()
                    }).get();
                }
            });
        });
    }
    if (!isEmpty(event.data.id)) {
        post_data['id'] = event.data.id;
    }
    if (event.data.item !== "") {
        post_data['item'] = event.data.item;
    }

    if (event.data.redirect !== '') {
        post_data['redirect'] = event.data.redirect;
    }
    $.ajax({
        url: event.data.action,
        type: 'POST',
        data: post_data,
        success: function (result) {
            var type, title;
            $('#' + ids).attr('disabled', false);
            var results = $.parseJSON(result);
            console.log(results);
            $('.' + id_arr[0] + '_alert').html("");
            if (results['message_alert']) {
                /*var a = Math.max(100, parseInt($('.' + id_arr[0] + 'alert').scrollTop() / 3));
                $('html, body').animate({scrollTop: 0}, a);*/
                $('button[data-dismiss=modal]').trigger("click");
                if (results['status'] === 'error') {
                   /* icon = 'picon icon24 typ-icon-cancel white';*/
                    type = "error";
                    title = 'Sorry!';
                    elementclass = "bg-danger";
                } else {
                    /*icon = 'picon icon16 iconic-icon-check-alt white';*/
                    type = "success";
                    title = 'Success';
                    elementclass = "bg-success";
                }
                

                new PNotify({
                  title: title,
                  text: results['message_alert'],
                  type: type,
                  addclass: elementclass
              });
              /*  $.pnotify({
                    type: results['status'],
                    title: title,
                    text: results['message_alert'],
                    icon: icon,
                    opacity: 0.95,
                    history: false,
                    sticker: false
                });*/
                if (results['status'] === 'success') {
                    setTimeout(function () {
                        window.location = results['redirect'];
                    }, 1500);
                }
            }
        }
    });
}

