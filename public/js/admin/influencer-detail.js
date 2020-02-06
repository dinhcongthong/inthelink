let products_columns = [
    {
        data: 'id', className:'row-detail',
    },
    {
        data: 'customer',
    },
    {
        data: 'quantity',
    },
    {
        data: 'total_amount',
        render: function (data) {
            return formatNumber(data);
        }
    },
    {
        data: 'commission_money',
        render: function (data, type, row) {
            return formatNumber(data) + ' (' + row.commission + '%)' ;
        }
    },
    {
        data: 'payment_date',
        className:'payment-date'
    },

];


let payment_columns = [
    // {
    //     data: null,
    //     orderable: false,
    //     defaultContent: '',
    //     className: 'row-detail p-0 pr-1 pl-1',
    //     width: 10,
    // },
    {
        data: 'id', className:'row-detail',
        render: function (data, type, row) {
            return `<a href="${baseUrl}/admin/users/influencer/detail/payment" >${data}</a>`;
        }
    },
    {
        data: 'order_status',
        className: '',
        render:function(data){
            return data == 0 ? 'Pending' : data == 1 ? 'Confirmed' : data == 2 ? 'On going' : data == 3 ? 'Delivered' : '<span class="text-danger">Cancelled</span>';
        }
    },
    {
        data: 'total_amount',
        render: function (data) {
            return formatNumber(data);
        }
    },
    {
        data: 'commission',
        render: function (data) {
            return formatNumber(data);
        }
    },
    {
        data: 'payment_status',
        className: 'text-center',
        render: function (data, type, row) {
            // html = `<span class="d-none"> ${data == 0 ? 'Pending' : 'Completed'}</span>`;
            let html = '';
            if(data == 0 ){
                return html + `<select class="form-control change-payment" data-orderid="${row.id}" data-orderstatus="${row.order_status}">
                <option value="0">Pending</option>
                <option value="1">Completed</option>
                </select>`
            }
            else if (data == 1){
                return 'Completed';
            }
            else {
                return '<span class="text-danger">Cancelled</span>';
            }
        }
    },
    {
        data: 'payment_date',
        className:'payment-date'

    }
];

var table_init = function (table, ajax, columns, colAdjust = [], callback = '') {
    $(table).DataTable({
        processing: true,
        serverSide: true,
        ajax,
        columns,
        pageLength: 10,
        responsive: true,
        lengthChange: true,
        order: [[colAdjust, 'desc']],
        initComplete: function (settings) {
            if (table != '#table_payment') {
                createIndexColumn(settings.oInstance.api());
            }
        },
        rowCallback: function (row, data) {
            if (table == '#table_payment') {
                data.payment_status == 0 ? $(row).find('select').val() : 'Completed';
                $(row).css('cursor', 'pointer');
                $(row).on('click', function (ev) {
                    if ($(ev.target).hasClass('change-payment') || $(ev.target).hasClass('change-order-status') || $(ev.target).hasClass('row-detail')) {
                        // ev.preventDefault();
                        // ev.stopPropagation();
                    }
                    else
                        window.location.href = baseUrl + '/admin/payment/influencer/detail/' + data.id;
                });
            }
        },
        footerCallback: function (row, data, start, end, display) {
            if (table.indexOf('#table_product_') != -1) {
                var api = this.api(), data, total = 0;
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                // Total over all pages
                amount = api
                    .column(3)
                    .data();
                commission = api.column(5).data();
                // .reduce(function (a, b) {
                //     // return intVal(a) + intVal(b);
                //     console.log(a,b);
                // }, 0 );

                for (var i = 0; i < api.rows()[0].length; i++) {
                    money = commission[i] / 100 * amount[i];
                    total += money;
                }
                // Total over this page
                pageTotal = api
                    .column(5, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(5).footer()).html(
                    formatNumber(total) + ' VND'
                );
            }
        }
    });
}
let influencer_id = $('input[name="influencer_id"]').val().trim();
let ajaxPayment = {
    url: baseUrl + '/admin/users/influencer-payment-table/' + influencer_id,
    type: "post",
};
let flagSale, flagPayment = false;
$('button[data-toggle="pill"]').on('shown.bs.tab', function () {
    self = $(this).attr('href');
    switch (self) {
        case '#sale': {
            if (!flagSale) {
                // table_init('#table_product_1', ajaxSale , products_columns);
                $.each($('table[id^="table_product_"]'), function (i, e) {
                    let ajaxSale = {
                        url: baseUrl + '/admin/users/influencer-order-table',
                        type: "post",
                        data: {
                            product_id: $(e).data('id'),
                            influencer_id,
                        }
                    }
                    table_init('#' + $(e).attr('id'), ajaxSale, products_columns, 0);
                    dateTo = '';
                })
                flagSale = true;
            }
            break;
        }
        case '#payment': {
            if (!flagPayment) {
                table_init('#table_payment', ajaxPayment, payment_columns, 1);
                $('#table_payment').DataTable().draw();
                dateTo = '';
                flagPayment = true;
            }
            break;
        }
    }
});

$(document).ready(function () {
    closeModalPaymentSuccess();
    // able/disable 
    $('#others-block').on('click', function () {
        if ($(this).prop('checked')) {
            $(this).parent().next().prop('disabled', false);
        }
        else {
            $(this).parent().next().prop('disabled', true);
        }
    });

    $('#modalBlock').on('hidden.bs.modal', function () {
        $('#switch-user').find('input').prop('checked', true);
    })

    //deactive user  
    $('.submit-block').on('click', function () {
        let modal = $(this).closest('.modal');
        let id = modal.data('userid');
        let reason_block = '';
        if ($(this).closest('.modal').find('input:checked').length == 0) {
            modal.find('.alert').css('display', 'block');
            return;
        }
        else {
            modal.find('.alert').css('display', 'none');
        }
        $(this).closest('.modal').find('input:checked').each(function (i, e) {
            if ($(e).attr('id') == 'others-block') {
                reason_block += modal.find('.text-others').val();
            }
            else {
                reason_block += $(e).next().html().trim().concat(', ');
            }
        })
        if (reason_block[reason_block.length - 2] === ",") {
            reason_block = reason_block.slice(0, -2);
        };

        $.ajax({
            type: 'POST',
            url: baseUrl + '/admin/users/influencer/approved',
            data: {
                id,
                status: 2,
                commission: $('.select-commission').val() == null ? 0 : $('.select-commission').val(),
                reason_block,
            },
            success: function (res) {
                $('#modalBlock').modal('hide');
                $('.influencer-warning').remove();
                $('.influencer-general').prepend(`
                <div class="row influencer-warning">
                    <div class=" w-100">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div class="">
                            <p>
                                You blocked this influencer at ${res.updated_at}.
                            </p>
                            <p class="mb-0">
                                The reason: ${res.reason}
                            </p>
                        </div>
                    </div>
                </div>
                `);
                $('#modalBlock').on('hidden.bs.modal', function () {
                    $('#switch-user').find('input').prop('checked', false);
                })
                $('.influencer-general').addClass('blocked');
                showAlert('success', 'User has been blocked');
                $('#switch-user').closest('.influencer-banner').removeClass('active');
                $('#switch-user').closest('.common-page').find('.row-info').addClass('blocked');
            }
        })
    })


    let tab_id = $(this).closest('.tab-pane');
    $('[data-toggle="pill"]').on('shown.bs.tab', function () {
        tab_id = $(this).attr('href');
    })
    //active/deactive user
    $('#switch-user').on('change', function () {
        let self = $(this);
        let checked = $(this).find('input').prop('checked');
        let id = $(this).data('userid');
        if (checked) {
            $.ajax({
                type: 'POST',
                url: baseUrl + '/admin/users/influencer/approved',
                data: {
                    id,
                    commission: $('.select-commission').val(),
                    status: 1,
                    reason_block: '',
                },
                success: function (res) {
                    console.log(res);
                    $('.influencer-general').removeClass('blocked');
                    showAlert('success', 'User has been reactivated');
                    self.closest('.influencer-banner').addClass('active');
                    self.closest('.common-page').find('.row-info').removeClass('blocked');
                }
            })

        }
        else {
            openModalBlock(id, event);
        }
    });
    $('input[name="dates"]').on('cancel.daterangepicker', function (ev, picker) {
        switch (tab_id) {
            case '#payment': {
                filterByDateRange('#table_payment', 'single', '');
                break;
            }
            case '#sale': {
                $.each($('table[id^="table_product_"]'), function (i, e) {
                    filterByDateRange('#' + $(e).attr('id'), 'single', '');
                })
                break;
            }
        }
    });
    $('input[name="dates"]').on('apply.daterangepicker', function (ev, picker) {
        let dateRangeFilter = picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD');
        let dateFromFilter = Date.parse(picker.startDate.format('YYYY-MM-DD'));
        let dateToFilter = Date.parse(picker.endDate.format('YYYY-MM-DD'));
        switch (tab_id) {
            case '#payment': {
                filterByDateRange('#table_payment', 'single', dateToFilter, dateFromFilter, 2);
                break;
            }
            case '#sale': {
                $.each($('table[id^="table_product_"]'), function (i, e) {
                    filterByDateRange('#' + $(e).attr('id'), 'single', dateToFilter, dateFromFilter, 5);
                })
                break;
            }
        }
    });

    // change payment status for order
    $('body').on('change', '.change-payment', function (ev) {
        if($(ev.target).data('orderstatus') == 0 ){
            $(ev.target).val(0);
            showAlert('warning',"You can't change payment status of pending order");
            return;
        }
        
        let status = $(ev.target).val();
        let orderId = $(ev.target).data('orderid');
        $('#modalPaymentComplete').modal('show');
        $('#modalPaymentComplete').attr('data-orderid', orderId);

    });

    $('#modalPaymentComplete').on('click','.btn-accept', function(){
        changeStatusPaymentComplete(1 , $(this).closest('.modal').attr('data-orderid') , influencer_id);
    })

    //change permission percent
    $('.select-commission').on('change', function () {
        let influencer_id = $(this).data('userid');
        let commission = $(this).val();
        $.ajax({
            type: 'post',
            url: baseUrl + '/admin/users/influencer/commission',
            data: {
                influencer_id,
                commission,
            },
            success: function (res) {
                showAlert('success', 'Change commission percent successful');

            },
            fail: function (res) {
                showAlert('danger', 'Change commission denied. Please try again');
            }
        })
    })
    // able/disable textarea of orthers input
    $('#others').on('click', function () {
        if ($(this).prop('checked')) {
            $(this).parent().next().prop('disabled', false);
        }
        else {
            $(this).parent().next().prop('disabled', true);
        }
    })

    //aprove influencer
    $('.btn-approve').on('click', function (e) {
        e.preventDefault();
        let id = $(this).data('userid');
        $.ajax({
            method: 'post',
            url: baseUrl + '/admin/users/influencer/approved',
            data: {
                id,
                commission: $(".select-commission[data-userid='" + id + "']").val(),
                status: 1,
                reason_block: '',
            },
            success: function (res) {
                window.location.reload();
            },
            fail: function (xhr) {
                showAlert('danger', 'Have error when proccessing');
            }
        })
    })
    $('.btn-decline').on('click', function (e) {
        e.preventDefault();
        let modal = $(this).closest('.modal');
        let id = $('[name="influencer_id"]').val();
        let reason_block = '';
        if ($(this).closest('.modal').find('input:checked').length == 0) {
            modal.find('.alert').css('display', 'block');
            return;
        }
        else {
            modal.find('.alert').css('display', 'none');
        }
        modal.find('input:checked').each(function (i, e) {
            if ($(e).attr('id') == 'others') {
                reason_block += modal.find('textarea').val();
            }
            else {
                reason_block += $(e).next().html().trim().concat(', ');
            }
        })
        if (reason_block[reason_block.length - 2] === ",") {
            reason_block = reason_block.slice(0, -2);
        };
        $.ajax({
            method: 'post',
            url: baseUrl + '/admin/users/influencer/approved',
            data: {
                id,
                commission: 0,
                status: 2,
                reason_block: reason_block,
            },
            success: function (res) {
                $('#modalDecline').modal('hide');
                showAlert('success','This influencer has been declined');
                window.location.reload();
            },
            fail:function(res){
                $('#modalDecline').modal('hide');
                showAlert('danger','There are some errors. Please try again');
            }
        })
    })
    $('.select-commission').val($('.select-commission').attr('value'));
    // $('[data-toggle="popover"]').popover({
    //     html: true,
    //     content: function () {
    //         return `<p class="sub-blue mb-0 pointer enable-edit">View detail</p>`;
    //     }
    // });
    // $('[data-toggle="popover"]').on('shown.bs.popover', function () {
    //     var $pop = $(this);
    //     setTimeout(function () {
    //         $pop.popover('hide');
    //     }, 4000);
    // });
    $('body').on('click', '.la-pencil', function () {
        $('.select-commission').prop('disabled', false);
    })
})