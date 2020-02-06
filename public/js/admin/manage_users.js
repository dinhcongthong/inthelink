function activeUser(id,el,ev){
    ev.stopPropagation();

    $.ajax({
        type:'POST',
        url: baseUrl + '/admin/users/update-status',
        data:{
            id,
        },
        success:function(res){
            $(el).css('color','#04BE04');
            $(el).attr('onclick',`openModalBlock(${id} , event )`);
            showAlert('success','User has been reactivated');

        },
        fail:function(res){
            showAlert('danger','Change status is denied. Please try again');
        }
    })
}
$(document).ready(function() {
    // able/disable 
    $('#others').on('click',function(){
        if($(this).prop('checked')){
            $(this).parent().next().prop('disabled',false);
        }
        else{
            $(this).parent().next().prop('disabled',true);
        }
    })
    // change role
    $('body').on('focus', '.change-role', function () {
        //Store the current value on focus and on change
        previous = this.value;
    }).on('change','.change-role',function(ev) {
        //change role
        let role = $(ev.target).val();
        let id = $(ev.target).attr('data-userid');
        $.ajax({
            url: baseUrl+'/admin/users/change-role',
            type: 'POST',
            data:{
                id,
                role,
            },
            success:function(res){
                showAlert('success','Change level successful');
            },
            fail:function(res){
                showAlert('danger','Change level denied. Please try again');
            }
        })
        // Make sure the previous value is updated
        previous = this.value;
    });

    //deactive user
    $('.submit-block').on('click',function(){
        let modal = $(this).closest('.modal');
        let id = modal.attr('data-userid');
        let reason_block = '';
        if($(this).closest('.modal').find('input:checked').length == 0){
            modal.find('.alert').css('display','block');
            return;
        }
        else{
            modal.find('.alert').css('display','none');
        }
        $(this).closest('.modal').find('input:checked').each(function(i,e){
            if($(e).attr('id') == 'others'){
                reason_block += modal.find('.text-others').val();
            }
            else{
                reason_block += $(e).next().html().trim().concat(', ');
            }
        })
        if (reason_block[reason_block.length-2] === ","){
            reason_block = reason_block.slice(0,-2);
        };

        $.ajax({
            type:'post',
            url: baseUrl+ '/admin/users/update-status',
            data:{
                id,
                reason_block,
            },
            success:function(res){
                $("#modalBlock").modal('hide');
                $('i[data-id="'+ id + '"').css('color','#a4a4a4');
                $('i[data-id="'+ id + '"').attr('onclick',`activeUser(${id},this,event)`);
                showAlert('success',"Block user successful");
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                $("#modalBlock").modal('hide');
                showAlert('danger',"You can't block this user. Please try again");
            }  
        })
    })

    //table users
    var table_users = $("#table_users").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            type:'post',
            url: baseUrl+'/admin/users/datatables',
        },
        columns: [
            {
                data: 'id', className: 'row-detail'
            },
            { data: "user_name" },
            { data: "phone" },
            { data: "email" },
            { data: "gender" ,
                render:function(data,type,row){
                    if(data){
                        return 'Male'
                    }
                    else return 'Female'
                }
            },
            { data: "join_date",  width:80},
            { data: "level", width:120,
                render:function(data,type,row){
                    return data == 'influencer' ? 'Influencer' : `
                    <span class="d-none">${data}</span>
                    <select class="form-control change-role" data-userid="${row.id}" style="width:120px">
                        <option value="2">Admin</option>
                        <option value="0">Customer</option>
                    </select>`
                }
            },
            {
                data: "active",
                className: "text-center",
                render: function(data,type,row) {
                    return `<i data-id="${row.id}" ${
                        data == true
                            ? 'data-toggle="tooltip" title="When blocked this account. They can not access the system or operate any function."'
                            : ""
                    } class="la la-power-off pointer" data-id="${row.id}" style="padding:20px;color: ${
                        data == true ? "#04BE04" : "#A4A4A4"
                    }" ${data == true ? `onclick="openModalBlock(${row.id} , event )"` : `onclick="activeUser(${row.id}, this, event)"` }><span class="d-none">${data}</span></i>`;
                }
            },
        ],
        rowCallback: function (row, data) {
            $(row).find('select').val(data.level == 'customer' ? 0 : data.level == 'influencer' ? 1 : 2);
            $(row).css('cursor','pointer');
            $(row).on('click', function(ev){
                if($(ev.target).hasClass('change-role') || $(ev.target).hasClass('change-order-status') || $(ev.target).hasClass('row-detail')){
                    // ev.preventDefault();
                    // ev.stopPropagation();
                }
                else if (data.level == 'influencer'){
                    window.location.href= baseUrl+'/admin/users/influencer/detail/' + data.influencer_id;
                }
                else 
                    window.location.href= baseUrl+'/admin/users/customer/detail/' + data.id;
            })
        },
        order: [[0, "desc"]],
        responsive: true,
        initComplete: function(settings) {
            // createIndexColumn(settings.oInstance.api());
            $('[data-toggle="tooltip"]').tooltip();
        }
    });

    var table_block = $("#table_block").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            type: 'post',
            url: baseUrl+'/admin/users/datatables/block',
        },
        columns: [
            {
                data: 'id',
                width: 10,
                className: 'row-detail',
            },
            { data: "user_name" },
            { data: "phone" },
            { data: "email" },
            { data: "reason_block" },
            { data: "gender" },
            { data: "join_date", width:80},
            { data: "level", width:120,
                render:function(data,type,row){
                    return data == 'influencer' ? 'Influencer' : `
                    <span class="d-none">${data}</span>
                    <select class="form-control change-role" data-userid="${row.id}"  style="width:120px">
                        <option value="2">Admin</option>
                        <option value="0">Customer</option>
                    </select>`
                }
            },
            {
                data: "active",
                className: "text-center",
                render: function(data,type,row) {
                    return `<i  ${
                        data == true
                            ? 'data-toggle="tooltip" title="When blocked this account. They can not access the system or operate any function."'
                            : ""
                    } class="la la-power-off pointer" data-id="${row.id}" style="color: ${
                        data == true ? "#04BE04" : "#A4A4A4"
                    }" ${data == true ? `onclick="openModalBlock(${row.id} , event )"` : `onclick="activeUser(${row.id}, this , event)"` }><span class="d-none">${data}</span></i>`;
                }
            },
        ],
        columnDefs: [
            {
                orderable: false,
                targets: []
            }
        ],
        order: [[0, "desc"]],
        responsive: true,
        rowCallback: function (row, data) {
            $(row).find('select').val(data.level == 'customer' ? 0 : data.level == 'influencer' ? 1 : 2);
        },
        initComplete: function(settings) {
            // createIndexColumn(settings.oInstance.api());
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
});
