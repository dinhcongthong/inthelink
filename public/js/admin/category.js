$(document).ready(function(){
    
    var  table_products ;
    var flag_sub = false , flag_products = false;
    
    //table categoryoverview
    var dataTables = function(table, columns, ajax, invisibleCol = [], callback = ''){
        $(table).DataTable({
            processing: true,
            serverSide: true,
            ajax,
            columns,
            columnDefs:[{
                "orderable": false,
                "targets": [0,4],
            }],
            order: [[ 0, 'desc' ]],
            responsive:true,
            initComplete:function(settings){
                $('[data-toggle="title"]').tooltip();
                // createIndexColumn(settings.oInstance.api());
            }
        });
    }

    //table category
    let indexColumns = [
        { data: "id" },
        { data: "name"  },
        { data: "is_show" , render:function(data){ return data == 1 ? 'Yes' : 'No'} },
        { data: "updated_at" },
        {
            data: "id", render:function(data){
                return `<a class="btn btn-social-icon btn-facebook pointer btn-xs" href="${baseUrl}/admin/ecommerce/category/update/${data}"><i class="la la-pencil" data-toggle="title" title="Edit category" ></i></div></a>`;
            }
        },
    ];
    var ajaxIndex = {
        url: baseUrl + '/admin/ecommerce/category/over-view-table',
        type:'post',
    };
    dataTables('#table_category', indexColumns, ajaxIndex);

    //table category detail
    let detailColumn =  [
        // {
        //     data: null,
        //     width: 20,
        // },
        { data: "id" },
        { data: "name" },
        { data: "parent_name"  },
        { data: "subcat" , render:function(data){ return `<a href="#">${data}</a>`} },
        { data: "products" },
        { data: "is_show" },
        { data: "updated_at" },
        {
            
            data: "id", render:function(data){
                return `<a class="btn btn-social-icon btn-facebook pointer btn-xs" href="${baseUrl}/admin/ecommerce/category/update/${data}"><i class="la la-pencil" data-toggle="title" title="Edit category" ></i></div></a>`;
            }
        },
    ];
    // dataTables('#table_category_index', detailColumn , ajaxDetail);

    //table subcategory
    let columnsSubCategory = [
        { data: "id" },
        { data: "name"  },
        { data: "parent_name" },
        { data: "is_show" },
        { data: "updated_at" },
        {
            data: "id", render:function(data){
                return `<a class="btn btn-social-icon btn-facebook pointer btn-xs" href="${baseUrl}/admin/ecommerce/category/update/${data}"><i class="la la-pencil" data-toggle="title" title="Edit category"></i></div></a>`;
            }
        },
    ];
    var ajaxSubCategory = {
        url: baseUrl + '/admin/ecommerce/category/sub-cate-table',
        type:'post',
    };
    dataTables('#table_category_sub', columnsSubCategory, ajaxSubCategory);

    //for products tab in last-products category
    $('button[data-toggle="pill"]').on('shown.bs.tab', function (e) {
        if($(e.currentTarget).attr('href')=="#sub" && flag_sub!=true){
            
            flag_sub = true;
        }
        else if($(e.currentTarget).attr('href') == '#products' && flag_products == false){
            table_products = $('#table_products').DataTable({
                data: products,
                columns: [
                    {
                        data: null,
                        width:20,
                    },
                    { data: "name" },
                    { data: "updated_at"  },
                    { data: "price" , render:function(data){ return formatNumber(data); }},
                    { data: "seller" },
                    { data: "seller_id" },
                    {
                        data: "id", render:function(data){
                            return `<a href="${baseUrl+'/admin/ecommerce/category/product'}">View detail</a>`;
                        }
                    },
                ],
                columnDefs:[{
                    "orderable": false,
                    "targets": [0,6],
                }],
                order: [[ 1, 'asc' ]],
                responsive:true,
                initComplete:function(settings){
                    createIndexColumn(settings.oInstance.api());
                }
                
            });
            flag_products = true;
        }
    });
   
});