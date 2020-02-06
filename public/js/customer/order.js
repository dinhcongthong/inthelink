
$(document).ready(function () {
    cssSetting();
    DateFilter();
});

function cssSetting() {
    $('body').on('click', '.btn-reason', function (ev) {
        if ($(ev.target).hasClass('active')) {
            $(ev.target).removeClass('active');
        } else
            $(ev.target).addClass('active');

    });
    $(".rates").raty({
        readOnly: false,
        score: 5,
        click: function(score, evt){
            let rating = score;
            if (rating < 3) {
                $('.reasons-bad').css('display', 'flex');
                $('.reasons-good').css('display', 'none');
            } else {
                $('.reasons-bad').css('display', 'none');
                $('.reasons-good').css('display', 'flex');
            }
        }
    });
}

function evaluation(orderId, productId, productImg, productName , ev) {
    ev.stopPropagation();
    
    $('#modalEvaluation').modal('show');
    $('#modalEvaluation .evaluation-note').find('.btn-reason').each((i, e) => $(e).not('.btn-reason-first').removeClass('active'));
    $('#modalEvaluation').find('.evaluation-product img').attr('src', productImg);
    $('#modalEvaluation').find('.product-name').html(productName);
    $('#modalEvaluation').find('.evaluation-buttons .submit').attr('id', 'eval-post' + orderId);
    // $('#modalEvaluation').find('.evaluation-note .rates').addClass(`rate-${orderId}`);
    $('#modalEvaluation').find('.evaluation-note textarea').val('').attr('id', `content${orderId}`);

    $('#eval-post' + orderId).on('click', function (e) {
        e.preventDefault();

        let rate = 0;
        // if ($('.rates').hasClass('rate-' + orderId)) {
        //     rate = $('.rate-' + orderId).rateYo('rating');
        // }
        rate = $('#modalEvaluation').find('.rates').raty('score'); 
        let arr = '';
        let basicReason = $('.reasons-bad').css('display') == 'none' ?
            $('#modalEvaluation').find('.reasons-good').find('.btn-reason.active').each(function (i, e) { arr += $(e).html().trim().concat(', ') }) :
            $('#modalEvaluation').find('.reasons-bad').find('.btn-reason.active').each(function (i, e) { arr += $(e).html().trim().concat(', ') })
        if (!$('#content' + orderId).val()) {
            if (arr[arr.length - 2] === ",") {
                arr = arr.slice(0, -2);
            };
            basicReason = arr;
        }
        else {
            basicReason = arr + $('#content' + orderId).val();
        }
        $.ajax({
            method: 'POST',
            url: baseUrl + '/customer/order/post-evaluation',
            data: {
                orderId: orderId,
                productId: productId,
                content: basicReason,
                starRate: rate
            }
        })
            .done(function (response) {
                if (response == 1) {
                    $('.btn-' + orderId).closest('.pull-up').find('.order-status').removeClass('text-info').addClass('text-success').html('Delivered');
                    $('.btn-' + orderId).replaceWith('<i class="gray">You have successfully evaluated</i>');
                    showAlert('success', 'Thank you for evalute products. Have a good day');
                } else {
                    showAlert('danger', "Your review hasn't been added. Please try again");
                    BootstrapDialog.show({
                        title: 'Evaluation Product',
                        message: 'Have Errors when proccessing!',
                        type: BootstrapDialog.TYPE_DANGER
                    });
                }
            })
            .fail(function (xhr, status, errors) {
                showAlert('danger', "Your review hasn't been added. Please try again");
                console.log(xhr);
                console.log(status);
                console.log(errors);
            })
    });
}

function DateFilter() {
    $('input[name="dates"]').on('apply.daterangepicker', function (ev, picker) {
        var startDate = picker.startDate.format('YYYY-MM-DD');
        var endDate = picker.endDate.format('YYYY-MM-DD');

        $.ajax({
            url: baseUrl + '/customer/ordered',
            method: 'GET',
            data: {
                startDate: startDate,
                endDate: endDate
            }
        })
            .done(function (response) {
                // console.log(response);
                $('#order-index').replaceWith(response);

                //daterangepicker
                $('input[name="dates"]').daterangepicker({
                    showDropdowns: true,
                    locale: {
                        format: 'YYYY-MM-DD'
                    },
                    autoUpdateInput: false,
                });

                $('input[name="dates"]').on('apply.daterangepicker', function (ev, picker) {
                    $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
                });
                $('input[name="dates"]').on('cancel.daterangepicker', function (ev, picker) {
                    $(this).val('');
                });
                DateFilter();
            })
            .fail(function (xhr, status, errors) {
                console.log(xhr.responseText);
                console.log(errors);
                console.log(status);
            })
    });
}

function cancelOrder(orderId , el) {
    $('#modalCancelOrder').modal('show');
    $('.btn-accept-cancel').off('click').on('click', function (e) {
        $.ajax({
            method: 'POST',
            url: baseUrl + '/customer/order/cancel/' + orderId,
            data: {
                orderId
            }
        })
            .done(function (res) {
                if(res!=0){
                    $(el).hide();
                    $(el).closest('.pull-up').find('.order-status').addClass('red').html('Cancelled');
                    showAlert('success', 'have been successfully cancelled', '#' + orderId);
                    // $('.orders__customer').replaceWith(res.view)
                    $('#payment' + orderId).remove();
                    $('#modalCancelOrder').modal('hide');
                }
                else{
                    showAlert('danger', 'There are some errors. Please try again');
                }
            })
            .fail(function (xhr, status, errors) {
                showAlert('danger', 'There are some errors. Please try again');
                console.log(xhr.responseText);
                console.log(status);
                console.log(errors);
            })
    });
}
