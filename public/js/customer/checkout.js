
$(document).ready(function () {
    settingCss();
    addNewAddress();
    changeAddress();
    changeDeliveryUnit();
    setPriceByQuantity();
    loadAccountNumber();
    validateCheckoutForm();
    changePaymentMethod();
});

function settingCss() {
    $('.payment-wrap').on('click', function () {
        $('.payment-wrap').not(this).removeClass('active');
        $(this).addClass('active');
    });
    $('.sidenav').remove();
    $('nav').css('padding-left', '25px');

    $('#addr-list-table tbody').on('click', 'tr', function () {
        $('input[name="check"]:checked').prop('checked', false);
        $(this).find('input[name="check"]').prop('checked', true);
    })
}

function addNewAddress() {
    // ajax add new delivery addresss
    $('#add-addr-form').on('submit', function (e) {
        e.preventDefault();
        let self = this;
        let formData = $(this).serializeArray();
        var setDefault = $('#set').prop('checked');
        $.ajax({
            method: 'POST',
            url: baseUrl + '/customer/post-address',
            data: {
                // id = 0 because this action is create new address
                id: 0,
                name: formData[0].value,
                phone: formData[1].value,
                address: formData[2].value,
                default: setDefault
            }
        })
            .done(function (response) {
                console.log(response);
                if (response.status != 200) {
                    BootstrapDialog.show({
                        title: 'Add New Address',
                        message: response.result,
                        type: BootstrapDialog.TYPE_DANGER
                    });
                } else {
                    // handle append data to table here()
                    $('.custom-control-label').find('.badge').html('');
                    if (response.deliver.set_default) {
                        $('input[name="check"]:checked').prop('checked', false);
                    }
                    $(`
                    <div class="d-block custom-control custom-radio mr-1 mb-2">
                                <input type="radio" name="customer1" class="custom-control-input addr-def" id="customRadio-${response.deliver.id}" ${response.deliver.set_default == true ? 'checked' : ''} data-id="${response.deliver.id}">
                                <label class="custom-control-label w-100" for="customRadio-${response.deliver.id}">
                                    <b>${response.deliver.name + ' ' + response.deliver.phone}</b>
                                    <span>${response.deliver.address}</span>
                                    <span class="ml-2 badge badge-secondary" ${response.deliver.set_default == true ? 'd-block' : 'd-none'}>Default</span>
                                </label>
                            </div>
                    `).insertBefore($('.btn-choose-address'))
                    $(self).closest('#modalAddress').modal('hide');
                    // reset default value
                    $('input[name="name"]').val('');
                    $('input[name="phone"]').val('');
                    $('input[name="address"]').val('');
                }
            })
            .fail(function (xhr, status, errors) {
                console.log(xhr.responseText);
                console.log(status);
                console.log(errors);
            })
    });
}

function changeAddress() {
    // ajax edit delivery address default
    $('#addr-def').on('click', function (e) {
        let id = $(this).prev().find('input[name="check"]:checked').data('id');
        $.ajax({
            method: 'GET',
            url: baseUrl + '/customer/address-default',
            data: {
                deliveryId: id
            }
        })
            .done(function (response) {
                console.log(response);
                if (response.status != 200) {
                    BootstrapDialog.show({
                        title: 'Update Delivery Address',
                        message: response.result,
                        type: BootstrapDialog.TYPE_DANGER
                    });
                } else {
                    $('#addr-info').replaceWith(response.html);
                }
            })
            .fail(function (xhr, status, errors) {
                console.log(this.url);
                console.log(errors);
                console.log(xhr.responseText);
            })
    });
}

function changeDeliveryUnit() {
    // set input id for delivery unit
    $('.check-delivery').off('click').on('click', function (e) {
        // console.log('voday');
        let id = $(this).data('id');
        $('#delivery-unit-id').val(id);

        let html = '';
        let date = moment().add($(this).data('est'), 'days');
        let dateEst = date.format('YYYY-MM-DD');

        html = `<div id="delivery-unit-info">
                    <h6 class="my-0">Delivery unit</h6>
                    <p>${$(this).data('name')}</p>
                    <p class="mb-1">Receiving on ${dateEst}</p>
                </div>`;

        // set date data est for order
        $('#date_est').val(dateEst);

        $('#delivery-unit-info').replaceWith(html);
    });
}

function setPriceByQuantity() {
    // load price when change quantity
    var priceOrigin = $('#price').text();
    // format price
    $('#price').text(formatNumber(priceOrigin));
    // get price
    $('.price-total').val(priceOrigin);
    $('.price-total').text(formatNumber(priceOrigin) + ' VND');

    setTotal(priceOrigin, $('#qty-product').val());
    $('#qty-product').off('change').on('change', function (e) {
        setTotal(priceOrigin, $(this).val());
    });
}

function setTotal(price, quantity) {

    let priceTotal = $('.price-total');
    let total = quantity * price;
    let delivery_price = 20000;
    $('.price-total-demo').text(formatNumber(total) + ' VND');
    priceTotal.text(formatNumber(total + delivery_price) + ' VND');
    priceTotal.val(total + delivery_price);

    // set text for modal confirm
    $('.total-confirm').text(formatNumber(total + delivery_price) + ' VND');
    $('.qty-confirm').text(quantity);
}

function loadAccountNumber() {
    $('#payment_method').off('change').on('change', function (e) {
        let payment_method = $(this).val();
        $.ajax({
            method: 'POST',
            url: baseUrl + '/customer/load-acc-number',
            data: {
                payment_method: payment_method
            }
        })
            .done(function (res) {
                $('#acc_number').text(res);
            })
            .fail(function (xhr, status, errors) {
                console.log(xhr.responseText);
            })
    });
}

function validateCheckoutForm() {
    $('#modalConfirmCheckout').modal('hide');
    $('.btn-checkout').on('click', function (e) {
        if ($('#delivery_addr_id').val() == '') {
            BootstrapDialog.show({
                title: 'Checkout',
                message: 'Please pick your address or add new address!',
                type: BootstrapDialog.TYPE_DANGER
            });
        } else {
            $('#modalConfirmCheckout').modal('show');
        }
    });
}

function changePaymentMethod() {
    // banking = 0, momo = 1
    $('input[name="payment_method"]'). on('click', function (e) {
        if ($(this).val() == 1) {
            $('#payment_momo').removeClass('d-none')
            $('#payment_banking').addClass('d-none');
        } else {
            $('#payment_momo').addClass('d-none')
            $('#payment_banking').removeClass('d-none');
        }
    });
}