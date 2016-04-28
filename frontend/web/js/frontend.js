function parseResponse(response) {
    if (response.replaces instanceof Array) {
        for (var i = 0, ilen = response.replaces.length; i < ilen; i++) {
            $(response.replaces[i].what).replaceWith(response.replaces[i].data);
        }
    }
    if (response.append instanceof Array) {
        for (i = 0, ilen = response.append.length; i < ilen; i++) {
            $(response.append[i].what).append(response.append[i].data);
        }
    }
    if (response.content instanceof Array) {
        for (i = 0, ilen = response.content.length; i < ilen; i++) {
            $(response.content[i].what).html(response.content[i].data);
        }
    }
    if (response.js) {
        $("body").append(response.js);
    }
    if (response.refresh) {
        window.location.reload(true);
    }
    if (response.redirect) {
        window.location.href = response.redirect;
    }
}
$(function () {
    $(document).on("click", '.go-back', function (event) {
        event.preventDefault();
        window.history.back();
    });
    $(document).on("click", '.ajax-link', function (event) {
        event.preventDefault();
        var that = this;
        var url = $(that).attr('href');
        var data = $('meta[name=csrf-param]').attr("content") + '=' + $('meta[name=csrf-token]').attr("content");
        executeAjaxRequest(url, data);
    });
    $(document).on('submit', 'form.ajax-form', function (event) {
        event.preventDefault();
        var that = this;
        jQuery.ajax({
            'cache': false,
            'type': 'POST',
            'dataType': 'json',
            'data': $(that).serialize(),
            'success': function (response) {
                parseResponse(response);
            },
            'error': function (response) {
                alert(response.responseText);
            },
            'beforeSend': function () {
            },
            'complete': function () {
            },
            'url': this.action
        });
        return false;
    });
    $(document).on("click", ".form-submit", function (e) {
        e.preventDefault();
        $(this).parents('form').submit();
        return false;
    });
    $(document).on('change', '.dependent', function (event) {
        event.preventDefault();
        var that = this;
        var url = $(that).data('url');
        var name = $(that).data('name');
        var data = $('meta[name=csrf-param]').attr("content") + '=' + $('meta[name=csrf-token]').attr("content");
        jQuery.ajax({
            'cache': false,
            'type': 'POST',
            'dataType': 'json',
            'data': data + '&' + name + '=' + that.value,
            'success': function (response) {
                parseResponse(response);
            },
            'error': function (response) {
                alert(response.responseText);
            },
            'beforeSend': function () {
            },
            'complete': function () {
            },
            'url': url
        });
    });
});
function executeAjaxRequest(url, data, completeCallback) {
    var postData = '';
    postData = data ? postData + data : postData;
    jQuery.ajax({
        'cache': false, 'type': 'POST', 'dataType': 'json', 'data': postData, 'success': function (response) {
            parseResponse(response);
        }, 'error': function (response) {
            alert(response.responseText);
        }, 'beforeSend': function () {
        }, 'complete': completeCallback ? completeCallback : function () {
        }, 'url': url
    });
}
function showPopup() {
    if ($('.popup').length) {
        $(".popup").addClass("show");
        $(".mask").addClass("mask_active");
    }
}
function initButtonClosePopup(){
    $(".close, .mask, .sasha-style-button-close-thanks-popup").click(function(){
        $(".popup").removeClass("show");
        $(".mask").removeClass("mask_active");
    });
}