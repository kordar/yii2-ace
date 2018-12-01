$(function () {
    $('a[ace-method="post"]').click(function() {

        var url = $(this).attr('href');

        var message = $(this).attr('ace-confirm');

        var ok = confirm(message);

        if (ok) {
            $.post(url, {}, function (data) {
                if (data === 'success') {
                    window.location.reload()
                } else {
                    alert('操作失败');
                }
            })
        }

        return false;
    });
})