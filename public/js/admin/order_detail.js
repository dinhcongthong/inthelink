let ajax = {
    url: baseUrl + '/admin/payment/influencer/detail/' + 206,
    type: 'post',
};

let columns = [
    { data: "id" },
    { data: "customer"  },
    { data: "product_name" },
    { data: "order_date" },
    { data: "total" , render:function(data,type,row){ return formatNumber(data)}},
    { data: "payment_method" },
    { data: "updated_at" },
    { data: "status" , 
        render:function(data,type,row){
            return data == 0 ? 'New' : data == 1 ? 'Preparation' : data == 2 ? 'Delievering' : 'Delivered'
        }    
    },
];