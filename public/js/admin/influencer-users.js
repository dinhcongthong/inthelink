$(document).ready(function () {
    // init table
    table_influencers('#table_influencers', ajaxInit, [7]);
    filterByStatus();
});

// ajax list
let ajaxInit = {
    url: baseUrl + '/admin/users/influencer-table/all',
    type: 'post',
}

let ajaxWaiting = {
    url: baseUrl + '/admin/users/influencer-table/waiting',
    type: 'post',
}
let ajaxAccepted = {
    url: baseUrl + '/admin/users/influencer-table/accepted',
    type: 'post',
}
let ajaxDeclined = {
    url: baseUrl + '/admin/users/influencer-table/declined',
    type: 'post',
}

var table_influencers = function (table, ajax, invisibleCol = [], callback = '') {
    $(table).DataTable({
        processing: true,
        serverSide: true,
        ajax,
        columns: [
            {
                data: 'id', className: 'row-detail'
            },
            {
                data: 'name',
                render: function (data, type, row) {
                    return `<a href="${baseUrl}/admin/users/influencer/detail/${row.id}">${data}</a>`
                }
            },
            {
                data: 'phone_number',
            },
            {
                data: 'email',
            },
            {
                data: 'join_date',
            },
            {
                data: 'commission',
                className: 'text-center',
                render: function (data) {
                    return `${formatNumber(data)}`
                }
            },
            {
                data: 'status',
                className: 'text-center',
                render: function (data) {
                    html = `<span class="d-none"> ${data == null ? 'Waiting' : data == 1 ? 'Accepted' : 'Declined'}</span>`;
                    return html += data == 0 ? `<div class="btn-yellow">Waiting</div>` : data == 1 ? 'Accepted' : 'Declined';
                }
            },
        ],
        pageLength: 10,
        responsive: true,
        lengthChange: true,
        order: [[0, 'desc']],
        initComplete: function (settings) {
        },
        rowCallback: function (row, data) {
            $(row).css('cursor', 'pointer');
            $(row).on('click', function (ev) {
                if ($(ev.target).hasClass('change-payment') || $(ev.target).hasClass('change-order-status') || $(ev.target).hasClass('row-detail')) {
                }
                else
                    window.location.href = baseUrl + '/admin/users/influencer/detail/' + data.id;
            })
        }
    });
}


// filter by influencer status
function filterByStatus() {
    $('button[data-toggle="pill"]').on('shown.bs.tab', function () {
        var self = $(this).attr('href');
        destroyDataTables();

        switch (self) {
            case '#all': {
                table_influencers('#table_influencers', ajaxInit);
                break;
            }
            case '#waiting': {
                table_influencers('#table_influencers_waiting', ajaxWaiting);
                break;
            }
            case '#accepted': {
                table_influencers('#table_influencers_accepted', ajaxAccepted);
                break;
            }
            case '#declined': {
                table_influencers('#table_influencers_declined', ajaxDeclined);
                break;
            }
        }
    });
}

function destroyDataTables() {
    $('#table_influencers').DataTable().destroy();
    $('#table_influencers_waiting').DataTable().destroy();
    $('#table_influencers_accepted').DataTable().destroy();
    $('#table_influencers_declined').DataTable().destroy();
}