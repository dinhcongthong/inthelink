
$(document).ready(function(){
    
    $('body').on('click','.share',function(e){
        e.preventDefault();
    });
    
    $('.dropdown-menu').on('click',function(e){
        if($(this).hasClass('filter')){
            e.stopPropagation();
            
        };
    });
    $('.clear').on('click',function(){
        var arrCheckbox = $(this).parents('.filter').find('input');
        arrCheckbox.each(function(i,e){
            $(e).prop('checked',false);
        });
        $('.filter-input').html('Filter');
    })
    $('.dropdown-menu').on('click','.save',function(e){
        var arr = $(e.delegateTarget).find('input');
        var text = "";
        arr.each(function(i,element){
            if($(element).prop('checked')==false){
                return;
            }
            else
            text += $(element).parent().find('span:first-of-type').html().trim()+ ', ';
        });
        if(text !=''){
            $('.filter-input').html(text);
        }
        $(this).closest('.dropdown').dropdown('toggle');
    });
})