jQuery(document).ready(function () {
    (function ($) {
        $('.comment-like-btn').click(function () {
            var btnlike = $(this);
            var numlike = $(this).parent('.comment-like').find('.num_like');
            var stt_login = $(this).parent('.comment-like').find('.stt_login');
            $('.comment-like .stt_login').html('');
            $.ajax({
                type: 'POST',
                url: ajaxParams.ajaxurl,
                dataType: 'json',
                data: {
                    action: 'comment_like_action',
                    comment_id: $(this).attr('comment-id'),
                    author_id: $(this).attr('author-id'),
                    author_name: $(this).attr('author-name')
                },
                success: function (data) {
                    if (data.stt_login === 1) {
                        numlike.html(data.num_like);
                        btnlike.html('Dislike');
                    } else if (data.stt_login === 3) {
                        numlike.html(data.num_like);
                        btnlike.html('Like');
                    } else {
                        stt_login.html(data.num_like);
                    }
                }
            });
            return false;
        });

        $('#comment-rank #comment-newest').click(function (e) {
            e.preventDefault();
            $('ol.commentlist').html('Loading..........');
            $.ajax({
                type: 'POST',
                url: ajaxParams.ajaxurl,
                data: {
                    action: 'comment_rank_action',
                    post_id: $(this).attr('post-id'),
                    rank: 'new'
                },
                success: function (data) {
                    $('ol.commentlist').html(data);
                    $('.comment-like-btn').click(function () {
                        var btnlike = $(this);
                        var numlike = $(this).parent('.comment-like').find('.num_like');
                        var stt_login = $(this).parent('.comment-like').find('.stt_login');
                        $('.comment-like .stt_login').html('');
                        $.ajax({
                            type: 'POST',
                            url: ajaxParams.ajaxurl,
                            dataType: 'json',
                            data: {
                                action: 'comment_like_action',
                                comment_id: $(this).attr('comment-id'),
                                author_id: $(this).attr('author-id'),
                                author_name: $(this).attr('author-name')
                            },
                            success: function (data) {
                                if (data.stt_login === 1) {
                                    numlike.html(data.num_like);
                                    btnlike.html('Dislike');
                                } else if (data.stt_login === 3) {
                                    numlike.html(data.num_like);
                                    btnlike.html('Like');
                                } else {
                                    stt_login.html(data.num_like);
                                }
                            }
                        });
                        return false;
                    });
                }
            });
        });
        $('#comment-rank #comment-most-like').click(function (e) {
            e.preventDefault();
            $('ol.commentlist').html('Loading..........');
            $.ajax({
                type: 'POST',
                url: ajaxParams.ajaxurl,
                data: {
                    action: 'comment_rank_action',
                    post_id: $(this).attr('post-id'),
                    rank: 'like'
                },
                success: function (data) {
                    $('ol.commentlist').html(data);
                    $('.comment-like-btn').click(function () {
                        var btnlike = $(this);
                        var numlike = $(this).parent('.comment-like').find('.num_like');
                        var stt_login = $(this).parent('.comment-like').find('.stt_login');
                        $('.comment-like .stt_login').html('');
                        $.ajax({
                            type: 'POST',
                            url: ajaxParams.ajaxurl,
                            dataType: 'json',
                            data: {
                                action: 'comment_like_action',
                                comment_id: $(this).attr('comment-id'),
                                author_id: $(this).attr('author-id'),
                                author_name: $(this).attr('author-name')
                            },
                            success: function (data) {
                                if (data.stt_login === 1) {
                                    numlike.html(data.num_like);
                                    btnlike.html('Dislike');
                                } else if (data.stt_login === 3) {
                                    numlike.html(data.num_like);
                                    btnlike.html('Like');
                                } else {
                                    stt_login.html(data.num_like);
                                }
                            }
                        });
                        return false;
                    });
                }
            });
        });
    })(jQuery);
});
