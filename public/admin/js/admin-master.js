$(function () {
    'use strict';
    let link,url,navItem;
    $(document).on('click','.admin-nav-link', function (e) {
        $('.content-section').animate({
            opacity: 0
        }, 200);
        e.preventDefault();
        // e.stopPropagation();
        link = $(this);
        url = link.attr('href');
        navItem = link.closest('.link-element');
        let state = {
            'url': url,
            'navItemID': navItem.attr('id'),
        }

        $('.link-element').removeClass('active');
        $('.link-element ul').not(link.closest('ul')).removeClass('in');
        $('ul li').not(navItem).removeClass('active');
        navItem.addClass('active');

        let ajx = $.ajax({
            asynct:true,
            type: 'GET',
            url: url,
            // dataType: 'json',
            success: function (data) {
                // console.log(JSON.stringify(data.content_css))

                // $('.content-css').detach();

                // $.each(data.content_css, function (index, path) {
                //     if (path) {
                //         let content_css = `<link class="content-css" rel="stylesheet" href="${data.content_css}">`;
                //         $('head').append(content_css);
                //     }
                // });

                $('.content-section').html(data.html);
                // console.log($(data).find('.ajax-content'));
                // console.log(data.html);

                // $.each(data.content_js, function (index, path) {
                //     if (path) {
                //         $.getScript(path);
                //     }
                // });

                history.pushState(state, null, url);
            },
        })
        $.when(ajx.done(() => {
            $('.content-section').animate({
                opacity: 1
            }, 300);
            $('.content-section').fadeIn()
        }))

    });

    $(window).on('popstate', function (e) {
        var state = e.originalEvent.state;
        if (state) {
            $.ajax({
                type: 'GET',
                url: state.url,
                success: function (data) {
                    // $.each(data.content_css, function (index, path) {
                    //     let content_css = `<link class="content-css" rel="stylesheet" href="${data.content_css}">`;
                    //     $('head').append(content_css);
                    // });

                    $('.content-section').html(data.html);
                    $('.link-element').removeClass('active');
                    $('ul.collapse').removeClass('in');
                    $('ul.collapse li').removeClass('active');
                    $('#' + state.navItemID).addClass('active');
                    $('a').blur(); //un-focus 
                    console.log(state.anchor);
                    // $.each(data.content_js, function (index, path) {
                    //     $.getScript(path);
                    // });
                }
            });
        }
    });

});