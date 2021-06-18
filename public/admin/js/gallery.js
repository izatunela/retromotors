$(function(){
    $('.footable').footable();

    $('.gallery-delete').on('click', function () {
        if (!confirm('Potvrdi')) return;
        let id = this.dataset.galleryId;
        $.ajax({
            url: '/gallery/delete/' + id,
            success: function () {
                $.ajax({
                    type: 'GET',
                    url: window.location.href,
                    // dataType: 'json',
                    success: function (data) {
                        $('.content-section').html(data.html);

                    },
                });
            }
        });
    });

    $('.gallery-restore').on('click', function () {
        if (!confirm('Potvrdi')) return;
        let id = this.dataset.galleryId;
        $.ajax({
            url: '/gallery/restore',
            data: { 'id': id },
            success: function () {
                $.ajax({
                    type: 'GET',
                    url: window.location.href,
                    // dataType: 'json',
                    success: function (data) {
                        $('.content-section').html(data.html);

                    },
                });
            }
        });
    });
});