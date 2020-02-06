$(document).ready(function (){
    loadCategoryChilds();
    datatables();
});

function datatables() {
    $('#table_products').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: baseUrl + '/admin/ecommerce/product/load-data-table',
            dataType: "json",
            type: 'POST'
        },
        // data: products,
        "columns":[
            {
                'data': 'id',
                'defaultContent':'',
                'width':20,
    
            },
            {
                'data': 'name',
                render:function(data, type, row){
                    return `<a href="${baseUrl}/admin/ecommerce/product/detail/${row.id}">${data}</a>`
                }
            },
            {
                'data': 'price',
                render:function(data){
                    return formatNumber(data)
                }
            },
            {
                'data': 'inthelink_commission',
                render:function(data){
                    return data + '%'
                }
            },
            {
                'data':'category',
            },
            {
                'data':'author',
            },
            {
                'data':'updated_at',
            },
        ],
        // pageLength : 10,
        "responsive": true,
        "lengthChange": true,
        "columnDefs": [{
            "orderable": false,
            "targets": [],
        }],
        'order': [[ 0, 'desc' ]]
    });    
}

function loadCategoryChilds() {
    var loc = window.location;
    let lastSegmet = loc.href.substring(loc.href.lastIndexOf('/') + 1);

    // last segmet != update is update action because of id
    if (lastSegmet == 'update') {
        $('#sub-cate').attr('disabled', true);
    }
    $('#cate').off('change').on('change', function (e) {
        $('#sub-cate').attr('disabled', false);
        e.preventDefault();
        $.ajax({
            url: baseUrl + '/admin/ecommerce/category/get-childs',
            method: 'GET',
            data: {
                id: $(this).val()
            }
        })
        .done(function (res) {
            var html = '';
            $('select[name="category_id"] option[value="0"]').remove();
            $('#sub-cate').empty();
            if (res.length > 0) {
                $.each(res, function (i, value) {
                    html += '<option value="' + value.id + '">' + value.name + '</option>';
                });
                $('#sub-cate').append(html);
            }
            else{
                $('select[name="sub_category"]').append(`<option value="0">None</option>`)
            }
        })
        .fail(function (xhr, status, errors) {
            console.log(xhr.responseText);
            console.log(status);
            console.log(errors);
            if (status == 404) {
                console.log('error');
            }
        })
    })
}