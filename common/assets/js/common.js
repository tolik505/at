yii.melon = (function ($) {
    var pub = {
        isActive: true,
        init: function () {
            initHandlers();
            initParseResponse();
        },
        parseResponse: function (response) {
            if (response === undefined) {
                return ;
            }
            if (response.replace instanceof Array) {
                for (var i = 0, ilen = response.replace.length; i < ilen; i++) {
                    $(response.replace[i].what).replaceWith(response.replace[i].data);
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
        },
        parseError: function (response, error) {
            if (response && response.name && response.message) {
                alert(error + "\n" + response.name + "\n" + response.message);
            }
            if (error) {
                //alert(error);
            }
        },
        handleAction: function ($e) {
            var href = $e.attr('href') || $e.data('href'),
                params = $e.data('params') || {},
                disable = $e.data('disable') || [],
                dataType = $e.data('data-type') || 'json',
                type = $e.data('type') || 'POST',
                xAction = $e.data('xaction');

            $.ajax({
                'cache': false,
                'type': type,
                'dataType': dataType,
                'data': params,
                'beforeSend': function () {
                    $e.attr('disabled', true);
                    $e.addClass('disabled');
                },
                'complete': function () {
                    $e.attr('disabled', false);
                    $e.removeClass('disabled');
                },
                'url': href,
                'xaction': xAction
            });
        }
    };

    function initHandlers() {
        var handler = function (event) {

            var $this = $(this),
                href = $this.attr('href') || $this.data('href'),
                ajax = $this.data('ajax'),
                message = $this.data('confirm-text');

            if (message !== undefined) {
                if (!confirm(message)) {
                    return false;
                }
            }

            if (href === undefined || ajax === undefined) {
                return true;
            }

            pub.handleAction($this);

            event.stopImmediatePropagation();
            return false;
        };
        $(document).on('click.melon', yii.clickableSelector, handler)
            .on('change.melon', yii.changeableSelector, handler);

        $(document).on('submit', 'form.ajax-form', function (event) {
            event.preventDefault();

            var $this = $(this);
            jQuery.ajax({
                'cache': false,
                'type': 'POST',
                'dataType': 'json',
                'data':$this.serialize(),
                'url': $this.attr('action')
            });

            return false;
        });
    }

    function initParseResponse() {
        $(document).ajaxComplete(function (event, xhr, settings) {
            var response = xhr.responseJSON || xhr.response;
            pub.parseResponse(response);
        });
        $(document).ajaxError(function (event, xhr, settings, error) {
            var response = xhr.responseJSON || xhr.response;
            pub.parseError(response, error);
        });
    }

    return pub;
})(jQuery);
