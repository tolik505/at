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

//Multi-upload widget
$(function(){
    $(document).ready(function(){
        initImageSorting();
        fixMultiUploadImageCropUrl();
        checkTabErrors();
    });

    $(document).on('click', '.save-cropped', function(){
        event.preventDefault();
        var that = this;
        var url = $(that).attr('href');
        var data = {
            startX: $('#dataX').val(),
            startY: $('#dataY').val(),
            width: $('#dataWidth').val(),
            height: $('#dataHeight').val(),
            fileId: $('#fileId').val()
        };

        jQuery.ajax({
            'cache': false,
            'type': 'POST',
            'dataType': 'json',
            'data':'data='+JSON.stringify(data),
            'success':
                function (response) {
                    parseResponse(response);
                }, 'error': function (response) {
                alert(response.responseText);
            }, 'beforeSend': function () {
            }, 'complete': function () {
            }, 'url': url});

    });

    $(document).on('click', '.cancel-crop', function(){
        event.preventDefault();

        hideModal('.modal');
    });

    $('.modal').on('hidden.bs.modal', function (e) {
        $(this).removeData('bs.modal');
    });

    $('.modal').on('shown.bs.modal', function (e) {
        var $dataX = $("#dataX"),
            $dataY = $("#dataY"),
            $dataHeight = $("#dataHeight"),
            $dataWidth = $("#dataWidth");

        $(".img-container > img").cropper({
            aspectRatio: $('.actual-aspect-ratio').val(),
            preview: ".img-preview",
            crop: function(data) {
                $dataX.val(Math.round(data.x));
                $dataY.val(Math.round(data.y));
                $dataHeight.val(Math.round(data.height));
                $dataWidth.val(Math.round(data.width));
            }
        });
    });

    $(document).on('click', '.crop-link', function(){
        var aspectRatio = $('.actual-aspect-ratio');
        var value = $(this).parents('div.form-group').find('.aspect-ratio').val();
        if (!aspectRatio.length){
            $('.container').append('<input type="hidden" name="aspectRatio" class="actual-aspect-ratio" value="'+ value +'">');
        } else {
            aspectRatio.val(value);
        }

    });

    $('.template-builder').sortable({
        handle: ".btn-template-mover",
        items: ".content-append",
        cancel: ''
    });

});

function hideModal(elem)
{
    $(elem).modal('hide');
}

function initImageSorting()
{
    if ($('.file-preview-thumbnails').length) {
        $('.file-preview-thumbnails').sortable({
            update: function (event, ui) {
                saveSort();
            }
        });
    }
}

function saveSort()
{
    var url = $('#urlForSorting').val();
    var data = $(".kv-file-remove.btn").map(
        function () {return $(this).data('key');}
    ).get().join(",");


    jQuery.ajax({
        'cache': false,
        'type': 'POST',
        'dataType': 'json',
        'data': 'sort='+data,
        'success':
            function (response) {
                parseResponse(response);
            }, 'error': function (response) {
            alert(response.responseText);
        }, 'beforeSend': function () {
        }, 'complete': function () {
        }, 'url': url});
}

function fixMultiUploadImageCropUrl()
{
    $('.crop-link').each(function(){
        var href = $(this).attr('href');
        var key = $(this).data('key');
        var isKeyAdded = parseInt(href.match(/\d+/));

        if (key && isNaN(isKeyAdded)) {
            $(this).attr('href', href + key);
        }
    });
}
//Multi-upload widget

function addClassForNewAdminStyle()
{
    if (!$('.grid-view').hasClass('table-responsive')) {
        $('.grid-view').addClass('table-responsive')
    }
    $('.grid-view .filters .form-control').addClass('form-control-filters');
    if ($('.glyphicon.glyphicon-pencil').length) {
        $('.grid-view .table').addClass('vertical-options');
    }

    if (!$('.grid-view .filters td input').length) {
        $('.grid-view table').addClass('no-filters');
    }

    if ($('.grid-view .filters td').length) {
        $('.grid-view .filters td').addClass('form-group');
    }

    if ($('li.active a[href="/configuration/configuration/index"]').length) {
        $('.grid-view .table').addClass('l-height');
    }
}

addClassForNewAdminStyle();

$(function () {
    $(document).on('pjax:success', function(event, data) {
        addClassForNewAdminStyle();
        customSelect2();
    });
	//For checkbox in gridView (index page)
	$(document).on('click', '.ajax-checkbox', function(){
		var that = $(this);
		jQuery.ajax({
			'cache': false,
			'type': 'POST',
			'data': {'modelId': that.data('id'), 'modelName': that.data('modelname'), 'attribute': that.data('attribute')},
			'url': '/site/ajax-checkbox'});
	});

	//For file deleting in forms
	$(document).on('click', '.delete-file', function(){
		var that = $(this);
		jQuery.ajax({
			'cache': false,
			'type': 'POST',
			'data': {
				'modelId': that.data('modelid'),
				'modelName': that.data('modelname'),
				'attribute': that.data('attribute'),
				'language': that.data('language')
			},
			'success':
				function (response) {
					if (response.error) {
						alert('Не удалось удалить файл');
					} else {
						that.parent('.file-name').remove();
					}
				}, 'error': function (response) {
				alert(response.responseText);
			},
			'url': '/site/delete-file'});
	});

	//For changing configuration form
	$(document).on('change', '.config-type', function (event) {
		event.preventDefault();
		var that = this;
		var url = $(that).data('url');
		var form = $(this).parents('form');
		var action = form.attr('action');

		jQuery.ajax({
			'cache': false,
			'type': 'POST',
			'dataType': 'json',
			'data': form.serialize()+'&action='+action,
			'success':
				function (response) {
					parseResponse(response);
				}, 'error': function (response) {
				alert(response.responseText);
			}, 'beforeSend': function () {
			}, 'complete': function () {
                addClassForNewAdminStyle();
                customSelect2();
			}, 'url': url});
	});

    if ($('.s_name').length) {
        $('#main-form').liTranslit();
    }
});

function checkTabErrors() {
    var tabs = $('.tab-content .tab-pane');
	if (tabs.length) {
        tabs.each(function(index, el){
            var that = $(el);
            if (that.find('.has-error').length) {
                var id = that.attr('id');
                $('a[href="#' + id + '"]').click();
            }
        });
    }
}
