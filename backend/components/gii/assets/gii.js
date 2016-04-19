yii.giiAdvanced = (function ($) {
    return {
        init: function () {
            // model generator: hide class name input when table name input contains *
            $('#generator-tablename').change(function () {
                $('.field-generator-modelclass').toggle($(this).val().indexOf('*') == -1);
            });

            // model generator: translate table name to model class
            $('#generator-tablename').on('blur', function () {
                var tableName = $(this).val();
                if ($('#generator-modelclass').val()=='' && tableName && tableName.indexOf('*') === -1){
                    var modelClass='';
                    $.each(tableName.split('_'), function() {
                        if(this.length>0)
                            modelClass+=this.substring(0,1).toUpperCase()+this.substring(1);
                    });
                    $('#generator-modelclass').val(modelClass);

                    var baseModelClass = $('#generator-basemodelclass');

                    if (baseModelClass.length && baseModelClass.val() == '') {
                        baseModelClass.val('common\\models\\' + modelClass);
                    }
                }
            });

            // model generator: toggle query fields
            $('form #generator-createbasemodel').change(function () {
                $('form .field-generator-hideexistingbasemodel').toggle($(this).is(':checked'));
            });

            // hack
            $('.field-generator-modelclass').toggle($('#generator-tablename').val().indexOf('*') == -1);
            $('form .field-generator-hideexistingbasemodel').toggle($('form #generator-createbasemodel').is(':checked'));
        }
    };
})(jQuery);
