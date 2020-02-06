$(document).ready(function () {
    addSelectedItem();
    linkSharing();
});

function addSelectedItem() {
    $('body').on('click', '.product-heart , .btn-product-heart', function (e) {
        e.preventDefault();
        let productId = $(this).data('product');
        let name = $(this).data('name');
        var self = $(this);
        $.ajax({
            method: 'POST',
            url: baseUrl + '/influencer/update-selected-list',
            data: {
                productId,
            },
            
        })
        .done(function (res) {
            if (res.result == 1) {
                $(self.closest('div').find('i')[0]).removeClass('ft-heart').addClass('la la-heart');
                showAlert('success', 'have been added to you selected list successful', name);
               
                if (self.hasClass('btn-product-heart')) {
                    self.find('span.d-block').html('Remove from your Selected');
                }
            }
            else {
                $(self.closest('div').find('i')[0]).removeClass('la la-heart').addClass('ft-heart');
                showAlert('danger', 'have been remove from your selected list successful', name);
                if (!self.hasClass('btn-product-heart')) {
                    self.tooltip('hide');
                    self.closest('.selected').remove();
                }
                else if (self.hasClass('btn-product-heart')) {
                    self.find('span.d-block').html('Add to you Selected');
                }
            }
        })
        .fail(function (xhr, status, errors) {
            console.log(xhr.responseText);
            console.log(status);
            console.log(errors);
        })
    });
}

function linkSharing() {
    $('.ref-link').on('click', function (e) {
        e.preventDefault();
        let url = $(this).data('url');
        $('#modalPost').modal();
        $('body').find('#modalPost #ref-link-text').val(url);
    });
}