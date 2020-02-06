$(document).ready(function () {
    datatable();
});

function datatable() {
    let columns = [
        {
            data: null,
            className: 'control',
            orderable: false,
            defaultContent:'',
        },
        {
            data: "order_id"
        },
        {
            data: "product_name"
        },
        {
            data: "customer"
        },
        {
            data: "phone"
        },
        {
            data: "quantity", render: function (data, type, row) {
                return formatNumber(data)
            }
        },
        {
            data: "total_amount"
        },
        {
            data: "commission"
        },
        {
            data: "order_status", render: function (data, type, row) {
                var html = '';
                if (data == 0) {
                    html = '<h2 class="font-weight-bold badge badge-warning badge-lg">Pending</h2>';
                } else if (data == 1) {
                    html = '<h2 class="font-weight-bold badge badge-info badge-lg">Confirmed</h2>';
                } else if (data == 2) {
                    html = '<h2 class="font-weight-bold badge badge-info badge-lg">On going</h2>';
                } else if (data == 3) {
                    html = '<h2 class="font-weight-bold badge badge-success badge-lg">Delivered</h2>';
                } else if (data == 4) {
                    html = '<h2 class="font-weight-bold badge badge-danger badge-lg">Cancelled</h2>';
                }
                return html;
            }
        },
        {
            data: "payment_status", render: function (data, type, row) {
                // show status name
                var html = '';
                if (data == 0) {
                    html = '<h2 class="font-weight-bold badge badge-warning badge-lg">Pending</h2>';
                } else if (data == 1) {
                    html = '<h2 class="font-weight-bold badge badge-success badge-lg">Completed</h2>';
                } else {
                    html = '<h2 class="font-weight-bold badge badge-danger badge-lg">Cancelled</h2>';
                }
                return html;
            },
            className: 'text-center'
        },
        {
            data: "sold_date"
        },
        {
            data: "payment_date"
        },
    ];

    var dataTables = function (table, columns, invisibleCol = [], callback = '') {
        $(table).DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: baseUrl + '/influencer/sell-history-table',
                type: 'GET',
            },
            columns,
            order: [[ 1, 'desc']],
            responsive: true,
        });
    }
    dataTables('#table_total', columns);
}