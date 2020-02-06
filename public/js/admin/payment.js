
$(document).ready(function () {
    closeModalPaymentSuccess();
    loadDataTables();
    dateRangeFilter();
    changePaymentStatus();
});

function loadDataTables(startDate, endDate) {
    var table_payment = function (table, ajax, columns, invisibleCol = [], callback = '') {
        $(table).DataTable({
            columns,
            processing: true,
            serverSide: true,
            ajax,
            columnDefs: callback,
            order: [[0, 'desc']],
            responsive: true,
            initComplete: function (settings) {
                if (table != '#table_payment_influencer') {
                    // createIndexColumn(settings.oInstance.api());
                }
            },
            rowCallback: function (row, data) {
                if (table == '#table_payment_influencer') {
                    $(row).find('select').val(data.payment_status);
                }
                $(row).css('cursor', 'pointer');
                $(row).on('click', function (ev) {
                    if ($(ev.target).hasClass('change-payment') || $(ev.target).hasClass('change-order-status') || $(ev.target).hasClass('row-detail')) {
                        // ev.preventDefault();
                        // ev.stopPropagation();
                    }
                    else
                        window.location.href = baseUrl + '/admin/payment/influencer/detail/' + data.order_id;
                });
            },
        });
    }

    //table payment-influencer
    let columnsPaymentInfluencer = [
        {
            data: 'order_id', className: 'row-detail'
        },
        {
            data: 'order_status',
            className: '',
            render: function (data) {
                return data == 0 ? 'Pending' : data == 1 ? 'Confirmed' : data == 2 ? 'On going' : data == 3 ? 'Delivered' : '<span class="text-danger">Cancelled</span>';
            }
        },
        {
            data: 'influencer',
        },
        {
            data: 'customer',
        },
        {
            data: 'commission',
            render: function (data, type, row) {
                return formatNumber(row.profit) + ' (' + formatNumber(data) + '%)';
            }
        },
        {
            data: 'order_date',
        },
        {
            data: 'total_amount',
            render: function (data) {
                return formatNumber(data);
            }
        },
        {
            data: 'payment_status',
            className: 'm-auto text-center',
            render: function (data, type, row) {
                html = ``;
                if (data == 1) {
                    return html = 'Completed';
                } else if (data == 2) {
                    return html = '<span class="text-danger">Cancelled</span>';
                }
                else {
                    return html + `<select style="width:140px;" value="${data}" class="m-auto form-control change-payment" data-influ_id = "${row.influencer_id}" data-orderid="${row.order_id}" data-orderstatus="${row.order_status}">
                                        <option value="0">Pending</option>
                                        <option value="1">Completed</option>
                                    </select>`
                }
            }
        },
        {
            data: 'payment_date',
            className: 'payment-date',
        }
    ];

    let ajaxInfluencers = {
        url: baseUrl + '/admin/payment/revenue-tables/influencer',
        type: "post",
    };
    table_payment('#table_payment_influencer', ajaxInfluencers, columnsPaymentInfluencer, '', '');

    //table payment-revenue
    let ajaxRevenue = {
        url: baseUrl + '/admin/payment/revenue-tables',
        type: "post",
        data: {
            startDate: startDate,
            endDate: endDate
        }
    };
    let columnsRevenue = [
        {
            data: 'order_id', className: 'row-detail'
        },
        {
            data: 'order_status',
            className: '',
            render: function (data) {
                if (data == 'Cancelled') {
                    return data = '<span class="text-danger">Cancelled</span>';
                } else {
                    return data;
                }
            }
        },
        {
            data: 'product',
        },
        {
            data: 'customer',
        },
        {
            data: 'commission',
            render: function (data, type, row) {
                return formatNumber(row.profit) + ' (' + formatNumber(data) + '%)';
            }
        },
        {
            data: 'order_date',
        },
        {
            data: 'total_amount',
            render: function (data) {
                return formatNumber(data);
            }
        },
    ];
    table_payment('#table_revenue', ajaxRevenue, columnsRevenue, '', '');
}

function dateRangeFilter() {
    //filter daterange
    $('input[name="dates"]').on('cancel.daterangepicker', function (ev, picker) {
        let id = $(this).closest('.page-table--wrap').find('table').attr('id');
        switch (id) {
            case 'table_revenue': {
                $('#table_revenue').DataTable().destroy();
                loadDataTables();
                break;
            }
        }
    });
    $('input[name="dates"]').on('apply.daterangepicker', function (ev, picker) {
        let dateRangeFilter = picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD');
        let dateFromFilter = moment(picker.startDate._d).format('YYYY-MM-DD');
        let dateToFilter = moment(picker.endDate._d).format('YYYY-MM-DD');
        let id = $(this).closest('.page-table--wrap').find('table').attr('id');
        switch (id) {
            case 'table_revenue': {
                $('#table_revenue').DataTable().destroy();
                loadDataTables(dateFromFilter, dateToFilter);
                break;
            }
        }
    });
}

function changePaymentStatus() {
    // change payment status for influencers
    $('body').on('change', '.change-payment', function (ev) {
        let status = $(ev.target).val();
        let orderId = $(ev.target).data('orderid');
        let influencer_id = $(ev.target).data('influ_id');
        if ($(ev.target).data('orderstatus') == 0) {
            $(ev.target).val(0);
            showAlert('warning', "You can't change payment status of pending order");
            return;
        }
        $('#modalPaymentComplete').modal('show');
        $('#modalPaymentComplete').attr('data-orderid', orderId);
        $('#modalPaymentComplete').attr('data-influencer_id', influencer_id);

    });
    $('#modalPaymentComplete').on('click', '.btn-accept', function () {
        changeStatusPaymentComplete(1, $(this).closest('.modal').attr('data-orderid'), $(this).closest('.modal').attr('data-influencer_id'));
    });
}