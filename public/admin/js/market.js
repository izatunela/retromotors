$(function () {
    $('.footable').footable();
    $('.model-delete').on('click',  function (e) {
        if(!confirm('Potvrdi')) return;
        let cat = $(this).attr('data-category');
        let id = $(this).attr('data-model-id');
        let tr = $(this).closest('tr').addClass('kkk');
        // tr.fadeOut();
        // $('.content-section').animate({
        //     opacity: 0
        // }, 200);
        $.ajax({
            url: '/market/delete',
            data: { 'cat': cat, 'id': id },
            success: function (data) {
                $.ajax({
                    type: 'GET',
                    url: window.location.href,
                    // dataType: 'html',
                    success: function (data) {
                        // console.log(data.html)
                        // console.log($(data.html).find('.izbrisani'))
                        $('#ajax-content').html(data.html);
                        // $('#ajax-content').append($(data.html));
                        // $('.content-section').animate({
                        //     opacity: 1
                        // }, 300);
                        // $('.content-section').fadeIn()
                    },
                });
                // $('.table-del').append($('.kkk'));
                // console.log(data);
                // let response = data[0]
                // let row = 
                // `
                // <tr class="izbrisani">
                //     <td>${response.title}</td>
                //     <td>${response.price}</td>
                //     <td>${response.user.name}</td>
                //     <td>${response.brand.name}</td>
                //     <td>${response.model.name}</td>
                //     <td>${response.city}</td>
                //     <td>${response.country.name}</td>
                //     <td>${response.created_at}</td>
                //     <td>
                //         <button class="btn custom-button model-restore" type="button" data-category="automobile" data-model-id="${response.id}"><i class="icon-red fas fa-times"></i> Restore</button>
                //     </td>
                //     <td>${response.description}</td>
                //     <td>${response.deleted_at}</td>
                // </tr>
                // `;
            },
            error: function (error) {

            },
        });
    });

    $('.model-restore').on('click', function (e) {
        if (!confirm('Potvrdi')) return;
        let cat = $(this).attr('data-category');
        let id = $(this).attr('data-model-id');
        $.ajax({
            url: '/market/restore',
            data: { 'cat': cat, 'id': id },
            success: function (response) {
                $.ajax({
                    type: 'GET',
                    url: window.location.href,
                    // dataType: 'json',
                    success: function (data) {
                        $('.content-section').html(data.html);
                        
                    },
                });
            },
            error: function (error) {

            }
        });
    });
});