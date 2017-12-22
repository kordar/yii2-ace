function bootboxWarning(msg, title) {
    bootbox.alert({
        message: msg,
        title: "<span class=\"text-danger\"><i class=\"ace-icon fa fa-exclamation-triangle bigger-120\"></i> " + title + "</span>"
    });
}

function bootboxImageView(src, title) {
    bootbox.alert({
        message: "<img src='" + src + "' class='img-responsive'>",
        title: "<span class=\"text-info\"><i class=\"ace-icon fa fa-eye bigger-120\"></i> " + title + "</span>"
    });
}

function bootboxSuccess(msg, title) {
    bootbox.alert({
        message: msg,
        title: "<span class=\"text-success\"><i class=\"ace-icon fa fa-flag bigger-120\"></i> " + title + "</span>"
    });
}


(function ($) {

})(jQuery);