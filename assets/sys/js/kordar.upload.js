(function($) {

    $.fn.kordar_upload = function(options) {


        var defaults = {
            form: "SingleUploadForm[file]",
            url: "",
            syn: true,
            iframeObj: null,
            upload_load: function(json) {
                console.log(json);
            },
            filename_callback: function () {
                return '';
            }
        };

        var settings = $.extend(defaults, options);

        if (!(window.File || window.FileReader || window.FileList || window.Blob || window.FormData)) {
            console.log('Browser Does Not Support');
            settings.iframeObj = $('<iframe name=\'kordar-upload-iframe\' id=\'kordar-upload-iframe\' class=\'hidden\'></iframe>').appendTo('body');
            $(this).before('<input type="hidden" name="filename">');
        }


        $(this).change(function() {

            if (settings.iframeObj !== null) {

                var form = $(this).parents('form');
                var action = form.attr('action');
                var name = $(this).attr('name');
                $(this).attr('name', settings.form);
                form.attr('target', 'kordar-upload-iframe').attr('action', settings.url).submit();
                $(':hidden[name="filename"]').val($(':hidden[name="' + name + '"]').val());

                settings.iframeObj.on('load', function() {
                    var result = $(this).contents().find('body').html();
                    var json = $.parseJSON(result);
                    settings.upload_load(json);
                });

                form.removeAttr('target');
                form.attr('action', action);
                $(this).attr('name', name);

                return true;
            }

            var fileData = this.files[0];
            var val = $(this).val();

            if (fileData) {

                // FormData Object
                var formData = new FormData();
                formData.append(settings.form, fileData);
                formData.append('filename', settings.filename_callback());

                // XMLHttpRequest
                var xhr = new XMLHttpRequest();
                xhr.open("POST", settings.url, settings.syn);
                xhr.onload = function() {
                    var json = $.parseJSON(xhr.responseText);
                    settings.upload_load(json);
                };

                xhr.send(formData);
            }
        });


    }


})(jQuery);