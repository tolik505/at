/**
 * Created by walter on 17.12.15.
 */

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

$(function(){
    $(document).on('click', 'a.ajax-link', function (event) {
        event.preventDefault();
        var that = this;
        if($(that).data('confirm') && !confirm($(that).data('confirm'))) {
            return false;
        }
        jQuery.ajax({'cache': false, 'type': 'POST', 'dataType': 'json', 'data':$(that).data('params'), 'success': function (response) {
            parseResponse(response);
        }, 'error': function (response) {
            alert(response.responseText);
        }, 'beforeSend': function() {

        }, 'complete': function() {

        }, 'url': that.href});
        return false;
    });
});