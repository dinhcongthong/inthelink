$(document).ready(function () {
    // do somethings
    settingCss();
    loadMoreComments();
});

function settingCss() {

    $(".touchspin").TouchSpin({ min: 1, max: 1000 });

    // remove footer sidebar for influencer
    $('.footer-mobile').remove();

    let stars = $('span[data-stars]').data('stars');
    generateStars($('#info-rate'), stars, '22px');

    $('.rated').each(function (i, e) {
        generateStars($(e).prev().find('.desc--rate'), $(e).data('rated'));
    });
}

function loadMoreComments() {
    var pageNumber = 2;
    $('#load_more').on('click', function (e) {
        e.preventDefault();
        var self = $(this);
        self.siblings('div').removeClass('d-none');

        $.ajax({
            url: window.location.href + '&page=' + pageNumber,
            method: 'GET',
        })
            .done(function (res) {
                // console.log(res);
                $.each(res, function (i, val) {
                    html = `<div class="media">
                                <span class="media-left m-auto">
                                    <img alt="users" class="media-object"
                                        src="${val.avatarUrl}" style="width: 64px;height: 64px;" />
                                </span>
                                <div class="media-body">
                                    <div class="rate float-right">
                                        <div class="desc--rate pt-2 pb-2"></div>
                                    </div>
                                    <span class="rated" data-rated="${val.stars}"></span>

                                    <h5 class="media-heading mb-0 text-bold-600">${val.user_name}</h5>
                                    <div class="media-notation mb-1">${val.updated_at}</div>
                                    ${val.content}
                                </div>
                            </div>`;
                    $('.media-bordered').append(html);
                    if (val.nextPageUrl == '' || val.nextPageUrl == null) {
                        $('#load_more').hide();
                    }
                });
                settingCss();
                pageNumber++;

                // hide spiner
                self.siblings('div').addClass('d-none');
            })
            .fail(function (xhr, status, errors) {
                console.log(xhr);
                console.log(status);
                console.log(errors);
            })
    })
}