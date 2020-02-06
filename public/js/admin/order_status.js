$(document).ready(function () {
    try {
        changeOrderStatus();
        dateRangeFilter();
        loadDataTables();
    }
    catch (err) {
        alert(err.message);
    }
});

function changeOrderStatus() {
    $('body').on('change', '.change-status', function (ev) {
        //change status of order
        let status = $(ev.target).val();
        let id = $(ev.target).data('orderid');
        $.ajax({
            url: baseUrl + '/admin/payment/update-orderstatus',
            type: 'POST',
            data: {
                id,
                status,
            },
            success: function (res) {
                if (status == 3) {
                    $(`.change-status[data-orderid="${id}"`).replaceWith('Delivered');
                }
                if (status == 4) {
                    $(`.change-status[data-orderid="${id}"`).replaceWith('Cancelled');
                }
                $('.change-status[data-orderid="' + id + '"]').closest('tr').find('td:nth-child(7)').html(res.updated_at);
                showAlert('success', 'Change order status successful');
            },
            fail: function (res) {
                showAlert('danger', 'Change order status denied. Please try again.');
            }
        })
    });
}

function dateRangeFilter() {
    //filter daterange
    $('input[name="dates"]').on('cancel.daterangepicker', function (ev, picker) {
        let id = $(this).closest('.page-table--wrap').find('table').attr('id');
        switch (id) {
            case 'table_all': {
                destroyDataTables();
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
            case 'table_all': {
                destroyDataTables();
                loadDataTables(dateFromFilter, dateToFilter);
                break;
            }
            // case 'table_new': {
            //     filterByDateRange('#table_new', 'single', dateToFilter, dateFromFilter, 6);
            //     break;
            // }
            // case 'table_cancelled': {
            //     filterByDateRange('#table_cancelled', 'single', dateToFilter, dateFromFilter, 6);
            //     break;
            // }
            // case 'table_ongoing': {
            //     filterByDateRange('#table_ongoing', 'single', dateToFilter, dateFromFilter, 6);
            //     break;
            // }
            // case 'table_delivered': {
            //     filterByDateRange('#table_delivered', 'single', dateToFilter, dateFromFilter, 6);
            //     break;
            // }
        }
    });
}

function loadDataTables(startDate, endDate) {
    let flagPending, flagCancelled, flagOngoing, flagDelivered, flagConfirmed = false;

    let ajaxAll = {
        url: baseUrl + '/admin/order/datatable',
        type: 'POST',
        data: {
            startDate: startDate,
            endDate: endDate
        }
    };
    let ajaxPending = {
        url: baseUrl + '/admin/order/datatable/pending',
        type: 'POST',
    };
    let ajaxCancelled = {
        url: baseUrl + '/admin/order/datatable/cancelled',
        type: 'POST',
    };
    let ajaxOngoing = {
        url: baseUrl + '/admin/order/datatable/on-going',
        type: 'POST',
    };
    let ajaxDelivered = {
        url: baseUrl + '/admin/order/datatable/delivered',
        type: 'POST',
    };
    let ajaxConfirmed = {
        url: baseUrl + '/admin/order/datatable/confirmed',
        type: 'POST',
    };
    let columns = [
        { data: "id", className: 'row-detail', render: function (data) { return `<span class="row-detail">&nbsp;${data}</span>` } },
        { data: "customer" },
        { data: "product_name" },
        { data: "order_date" },
        { data: "total", render: function (data, type, row) { return formatNumber(data) } },
        { data: "payment_method", render: function (data, type, row) { return data == 0 ? 'Banking' : data == 1 ? 'Momo' : 'Zalo Pay' } },
        { data: "updated_at" },
        {
            data: "status",
            render: function (data, type, row) {

                html = `<span class="d-none">${data == 0 ? 'Pending' : data == 1 ? 'Confirmed' : data == 2 ? 'On going' : data == 3 ? 'Delivered' : 'Cancelled'}</span>`
                if (data == 3) {
                    return html += 'Delivered';
                }
                if (data == 4) {
                    return html += '<span class="text-danger">Cancelled</span>';
                }
                return html += `<select class="form-control change-status" value="${data}" data-orderid=${row.id}>
                    <option value="0">Pending</option>
                    <option value="1">Confirmed</option>
                    <option value="2">On going</option>
                    <option value="3">Delivered</option>
                    <option value="4">Cancelled</option>
                </select>`
            }
        },
    ];
    var dataTables = function (table, ajax, columns, invisibleCol = [], callback = '') {
        $(table).DataTable({
            processing: true,
            serverSide: true,
            ajax,
            columns,
            columnDefs: [{
                "visible": false,
                "targets": invisibleCol,
            }],
            order: [[0, 'desc']],
            responsive: true,
            rowCallback: function (row, data) {
                $(row).find('select').val(data.status);
                $(row).next('.child').find('select').val(data.status);
                console.log(row);
                $(row).css('cursor', 'pointer');
                $(row).on('click', function (ev) {
                    if ($(ev.target).hasClass('change-status') || $(ev.target).hasClass('change-order-status') || $(ev.target).hasClass('row-detail')) {
                        // ev.preventDefault();
                        // ev.stopPropagation();
                    }
                    else
                        window.location.href = baseUrl + '/admin/payment/influencer/detail/' + data.id;
                })
            },
            initComplete: function (settings) {

                // createIndexColumn(settings.oInstance.api());
            }
        });
    }
    dataTables('#table_all', ajaxAll, columns)
    $('button[data-toggle="pill"]').on('shown.bs.tab', function () {
        self = $(this).attr('href');
        destroyDataTables();
        switch (self) {
            case '#pending': {
                if (!flagPending) {
                    dataTables('#table_pending', ajaxPending, columns);
                    dateTo = '';
                    flagPending = true;
                }
                break;
            }
            case '#confirmed': {
                if (!flagConfirmed) {
                    dataTables('#table_confirmed', ajaxConfirmed, columns);
                    dateTo = '';
                    flagConfirmed = true;
                }
                break;
            }
            case '#cancelled': {
                if (!flagCancelled) {
                    dataTables('#table_cancelled', ajaxCancelled, columns);
                    dateTo = '';

                    flagCancelled = true;
                }
                break;
            }
            case '#ongoing': {
                if (!flagOngoing) {
                    dataTables('#table_ongoing', ajaxOngoing, columns);
                    dateTo = '';

                    flagOngoing = true;
                }
                break;
            }
            case '#delivered': {
                if (!flagDelivered) {
                    dataTables('#table_delivered', ajaxDelivered, columns);
                    dateTo = '';
                    flagDelivered = true;
                }
                break;
            }
        }
    });
}

function destroyDataTables() {
    $('#table_all').DataTable().destroy();
    $('#table_pending').DataTable().destroy();
    $('#table_confirmed').DataTable().destroy();
    $('#table_cancelled').DataTable().destroy();
    $('#table_ongoing').DataTable().destroy();
    $('#table_delivered').DataTable().destroy();
}