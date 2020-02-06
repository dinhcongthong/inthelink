$(document).ready(function () {
    postAddress();
});

function deleteAddress(element, id = 0) {
    if ($('.address-delete ').length == 1) {
        showAlert('danger', 'You must has at least one address');
        return;
    }
    $('#addr-delModal').modal('show');
    $('#btn-del').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            method: 'POST',
            url: baseUrl + '/customer/address-delete',
            data: {
                id: id
            }
        })
            .done(function (res) {
                $('.app-content').replaceWith(res.view);
            })
            .fail(function (xhr, status, errors) {
                console.log(xhr.responseText);
                console.log(status);
                console.log(errors);
                showAlert('danger', 'There are some errors. Please try again.');
            })
    })
}

function openModalAddress(type, id = '', name = '', phone = '', addr = '', setDefault = '') {
    $('#modalAddress').modal('show');
    $('#modalAddress').find('form').removeClass('was-validated');
    $('#modalAddress').attr('data-id', id);
    $('#set').prop('checked', false);
    $('#set').prop('disabled', false);

    if (type == 'edit') {
        if (setDefault == true) {
            $('#set').prop('checked', true);
            $('#set').prop('disabled', true);
        }
    }
    $('input[name="name"]').val(name);
    $('input[name="phone"]').val(phone);
    $('input[name="address"]').val(addr);
};

function setDefault(id) {
    $.ajax({
        method: 'GET',
        url: baseUrl + '/customer/address-default',
        data: {
            deliveryId: id
        }
    })
        .done(function (res) {
            if (res.status == 200) {
                $('.app-content').replaceWith(res.view);
            }
        })
        .fail(function (xhr, status, errors) {
            showAlert('danger', 'There are some error. Please try again');
            console.log(xhr.responseText);
        })
}

function postAddress() {
    $('#addr-save').on('click', function (ev) {
        ev.preventDefault();
        ev.stopPropagation();

        let form = $(this).closest('form');
        var setDefault = form.find('#set').prop('checked');
        let id = $('#modalAddress').attr('data-id');
        var name = form.find('input[name="name"]').val();
        var phone = form.find('input[name="phone"]').val();
        var address = form.find('input[name="address"]').val();
        if (name == null || name == '' || phone == null || phone == '' || address == '' || address == null) {
            form.addClass('was-validated');
        }
        else {
            $.ajax({
                method: 'POST',
                url: baseUrl + '/customer/post-address',
                data: {
                    id,
                    name,
                    phone,
                    address,
                    default: setDefault
                }
            })
                .done(function (res) {
                    $('#modalAddress').modal('hide');
                    $('.app-content').replaceWith(res.view);
                })
                .fail(function (xhr, status, errors) {
                    showAlert('danger', 'There are some error. Please try again');
                    console.log(xhr.responseText);
                    console.log(status);
                    console.log(errors);
                });
        }
    });
}