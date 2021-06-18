$(document).ready(function () {
    'use strict';
    $(document).ready(function () {
        $('#imageGallery').lightSlider({
            gallery: true,
            item: 1,
            loop: true,
            thumbItem: 8,
            pager: true,
            currentPagerPosition: 'left',
            mode: 'fade',
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        thumbItem: 5,
                        mode: 'slide'
                    }
                }
            ]
        });
    });
    // let uauth = $('input[name="uauth"]').val();
    let commentsSection = $('#comments-section')[0];
    let commentsContainer = $('.comments-container');
    throttleScroll(commentsSection);
    $('#submit-comment-form').submit(function (e) {
        e.preventDefault();
        let fData = $(this).serializeArray();
        fData.push({ name: 'tlastreq', value: tnow });
        let url = $(this).attr('action');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            type: "POST",
            url: url,
            data: $.param(fData),
            dataType: 'json',
            beforeSend: function () {
                $('.loader-sm').addClass('loader-v');
            },
            success: function (data) {
                loadComments();
                $('.loader-sm').removeClass('loader-v');
                $('.post-fail').hide();
                $('.post-success').show();
                $('.comments-section-empty').remove();
                $('.comment-body-input').val('');
                setTimeout(() => {
                    $('.post-success').fadeOut();
                }, 1000);
            },
            error: function (data) {
                $('.loader-sm').removeClass('loader-v');
                $('.post-fail').css('display', 'flex');
                $.each(data.responseJSON.errors, function (i, val) {
                    $('.err-msg').html(val);
                });
            }
        });
    });
    let replyBtn = $('.comment-reply-btn');
    let sourceEl = $('.comment-body');
    let inputEl = $('.comment-create');
    $(document).on('click', '.comment-reply-btn', function (e) {
        e.stopPropagation();
        $('.comment-body > .comment-create').remove();
        let parent = $(this).closest('.comment-container');
        let parentBody = $(this).parent().siblings('.comment-body');
        let replyForm = inputEl.clone().appendTo(parentBody).addClass('reply-to-comment');
        parent.find('.comment-create').attr('id', parent.attr('id'));

        $(parent).find('form').submit(function (e) {
            e.preventDefault();
            let fData = $(this).serializeArray();
            let url = $(this).attr('action');
            let parentID = $(this).parent().attr('id').match(/.*?-(.*)/)[1];
            fData.push({ name: 'parent_id', value: parentID }, { name: 'tlastreq', value: tnow });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                type: "POST",
                url: url,
                data: $.param(fData),
                dataType: 'json',
                success: function (data) {
                    replyForm.remove();
                    loadComments();
                },
                error: function (data) {
                    $('.reply-to-comment .post-fail').css('display', 'flex');
                    $.each(data.responseJSON.errors, function (i, val) {
                        $('.reply-to-comment .err-msg').html(val);
                    });
                }
            });
        });
    });
    $(document).on('click', '.guest-comment-btn', function () {
        $.ajax({
            type: 'GET',
            url: './sessioncomment',
            data: $.param({ gallery_id: $('input[name="gallery_id"]').val(), comment: $('.guest-comment-body').val() }),
            dataType: 'json',
            success: function (data) {
            },
            error: function (data) {
            }
        });
    });
    $(document).on('click', '.comment-expander', function () {
        $(this).closest('.comment-container').toggleClass('comment-collapse');
        $('> .comment-caret', this).toggleClass('comment-caret-collapse');
    });
    let once = true;
    function throttleScroll(element) {
        $(window).on('scroll load', function () {
            if (once) {
                if (isScrolledIntoView(element)) {
                    loadComments();
                    once = false;
                }
            }
        });

    }
    function isScrolledIntoView(element) {
        let rect = element.getBoundingClientRect();
        let elementTop = rect.top;
        let elementBot = rect.bottom;
        let visible = elementTop < window.innerHeight && elementBot >= 0;

        return visible;
    }
    let tnow = 0;
    function loadComments() {
        $.ajax({
            type: "GET",
            url: '../comments',
            data: { gallery_id: $('input[name="gallery_id"]').val() },
            dataType: 'json',
            beforeSend: function () {
                $('.gallery-loader').addClass('loader-v');
                $('.comments-container').css({ opacity: 0.67 });
            },
            success: function (data) {
                $('.comments-count').html(data.total);
                tnow = data.tnow;
                $.each(data.comments, function (index, comment) {
                    if (!comment.parent_id) {
                        commentsContainer.append($(commentTemplate(comment)).addClass('root-comment'));
                    }
                    else {
                        $('#cid-' + comment.parent_id).append($(commentTemplate(comment)).addClass('comment-reply wewara'));
                    }
                });
            },
            complete: function () {
                $('.gallery-loader').removeClass('loader-v');
                $('.comments-container').css({ opacity: 1 });
                $('.root-comment').each((i, el) => {
                    function walk(el, depth = 0) {
                        $(el).children('.comment-reply').addClass('indent-comment');
                        depth++;
                        $(el).children().each(function (i, ele) {
                            if (depth < 3) {
                                walk(ele, depth)
                            }
                            else {

                            }
                        })
                    }
                    walk(el);
                });
            },
            error: function (data) {
            }
        });
    }
    function commentTemplate(comment) {
        let template =
            `<div id="cid-${comment.id}" class="comment-container">
            <div class="comment-box">
                <div class="comment-expander">
                    <i class="comment-caret fas fa-caret-down"></i>
                    <div class="comment-fence">
                        <div class="comment-fence-y"></div>
                    </div>
                </div>
                <div class="comment">
                    <div class="comment-head">
                        <a href="#" class="username">${comment.user.name}</a>
                        <div class="timestamp">${comment.relative_cdate} - ${comment.formated_cdate}</div>
                    </div>
                    <div class="comment-main">
                        <div class="comment-body">
                            <p>${comment.body}</p>
                        </div>
                        <div id="pid-${comment.id}" class="reply-btn-wrap">
                            <span class="comment-reply-btn"><i class="fas fa-reply"></i> Odgovori</span>
                        </div>
                        <hr class="comment-split">
                    </div>
                </div>
            </div>
        </div>`;
        return template;
    }
});
