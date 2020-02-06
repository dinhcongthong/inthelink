
// ajax setup
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    // beforeSend: function(){
    //     $("#loader-spinner").css('display','flex');
    // },
    // complete: function(){
    //     $("#loader-spinner").css('display','none');
    // }
});

function changeStatusPaymentComplete(status, orderId, influencer_id) {
    $.ajax({
        url: baseUrl + '/admin/users/influencer-payment-status',
        type: 'POST',
        data: {
            orderId,
            status,
            influencer_id,
        },
        success: function (res) {
            if (res.status == 1) {
                showAlert('success', "Order's status has been change to completed");
                $('.change-payment[data-orderid="' + orderId + '"]').closest('tr').find('td.payment-date').html(res.payment_date);
                $('.change-payment[data-orderid="' + orderId + '"]').replaceWith('Completed');
            }
            else {
                showAlert('success', "Order has removed status of completion");
            }
            $('#modalPaymentComplete').modal('hide');
            
        },
        fail: function (res) {
            showAlert('danger', "Order status hasn't been change. Please try again");
        }
    })
}

function closeModalPaymentSuccess() {
    $('#modalPaymentComplete').on('hidden.bs.modal', function () {
        $('select[data-orderid=' + parseInt($(this).attr('data-orderid')) + ']').val(0);
    });
}

function openModalBlock(id, ev) {
    ev.stopPropagation();
    $('#modalBlock').modal('show');
    $('#modalBlock').find('input[type="checkbox"]').each((i, e) => $(e).prop('checked', false));
    $('#modalBlock').find('textarea').val('');
    $('#modalBlock').find('.alert').css('display', 'none');
    
    $('#modalBlock').attr('data-userid', id);
}

function limitNumber(e, number) {
    var element = $(e).val();
    if ($.isNumeric(element) == true) {
        $(e).val(element.substr(0, number));
    } else {
        if (number == 1) {
            $(e).val(element.substr(number, number + 1));
        }
    }
}

//generate select date month year selectbox
function generateDateSelectbox() {
    let birthday = $('.select-group').data('birthday') != undefined ? $('.select-group').data('birthday') : '';
    if (birthday != '') {
        birthday = birthday.split('-');
    }
    let i, month, date, year;
    var currentYear = (new Date).getFullYear();
    year = $('select[name="year"]').val();
    
    for (i = 1; i < 32; i++) {
        $('select[name="date"]').append(`<option value="${i}">${i}</option>`);
    }
    for (i = 1; i < 13; i++) {
        $('select[name="month"]').append(`<option value="${i}">${i}</option>`);
    }
    for (i = currentYear; i > currentYear - 140; i--) {
        $('select[name="year"]').append(`<option value="${i}">${i}</option>`);
    }
    if (birthday != '') {
        $('select[name="date"]').val(parseInt(birthday[2]));
        $('select[name="month"]').val(parseInt(birthday[1]));
        $('select[name="year"]').val(parseInt(birthday[0]));
    }
    
    //date-month-year populate
    $('select[name="date"').on('change', function () {
        $(this).closest('.form-group').find('.invalid-feedback-date').css('display', 'none');
    })
    $('select[name="month"]').on('change', function () {
        month = Number($(this).val());
        date = $('select[name="date"]').val();
        
        switch (month) {
            case 4: case 6: case 9: case 11: {
                $(this).closest('.form-group').find('.invalid-feedback-date').css('display', 'none');
                $('select[name="date"]').empty();
                if (date == '31') {
                    $('select[name="date"]').prepend('<option disabled hidden selected  value="0">Choose date</option>');
                    $(this).closest('.form-group').find('.invalid-feedback-date').css('display', 'block').html('Please choose date again');
                    for (i = 1; i < 31; i++) {
                        $('select[name="date"]').append(`<option value="${i}">${i}</option>`);
                    }
                }
                else {
                    for (i = 1; i < 31; i++) {
                        $('select[name="date"]').append(`<option value="${i}">${i}</option>`);
                    }
                    $('select[name="date"]').val(date);
                }
                break;
            }
            case 2: {
                $(this).closest('.form-group').find('.invalid-feedback-date').css('display', 'none');
                $('select[name="date"]').empty();
                
                if (date > 29) {
                    $('select[name="date"]').prepend('<option disabled hidden selected value>Choose date</option>');
                    $(this).closest('.form-group').find('.invalid-feedback-date').css('display', 'block').html('Please choose date again');
                    for (i = 1; i < 30; i++) {
                        $('select[name="date"]').append(`<option value="${i}">${i}</option>`);
                    }
                    date = 0;
                }
                else {
                    for (i = 1; i < 30; i++) {
                        $('select[name="date"]').append(`<option value="${i}">${i}</option>`);
                    }
                    $('select[name="date"]').val(date);
                }
                if (year) {
                    
                    if (!leapYear(year)) {
                        for (i = 1; i < 29; i++) {
                            $('select[name="date"]').append(`<option value="${i}">${i}</option>`);
                        }
                    }
                    else {
                        for (i = 1; i < 30; i++) {
                            $('select[name="date"]').append(`<option value="${i}">${i}</option>`);
                        }
                    }
                    $('select[name="date"]').val(date);
                }
                break;
            }
            case 1: case 3: case 5: case 7: case 8: case 10: case 12: {
                $(this).closest('.form-group').find('.invalid-feedback-date').css('display', 'none');
                $('select[name="date"]').empty();
                
                for (i = 1; i < 32; i++) {
                    $('select[name="date"]').append(`<option value=${i}>${i}</option>`);
                }
                $('select[name="date"]').val(date);
                
            }
        }
        if (!date) {
            $('select[name="date"]').prepend('<option value selected hidden disable>Choose date</option>');
        }
    })
    $('select[name="year"]').on('change', function () {
        date = $('select[name="date"]').val();
        month = $('select[name="month"]').val();
        year = $(this).val();
        if (month == 2) {
            if (leapYear(year)) {
                $('select[name="date"]').append('<option value="29">29</option>');
            }
            else {
                if (date == 29) {
                    $('select[name="date"]').prepend('<option disabled hidden selected value>Choose date</option>');
                    $(this).closest('.form-group').find('.invalid-feedback-date').css('display', 'block').html('Please choose date again');
                }
                $('select[name="date"] option[value="29"]').remove();
            }
        }
    });
    
}

//remove item in array
function removeItemInArray(arr, removeItem) {
    return arr = $.grep(arr, function (value) {
        return value != removeItem;
    });
}

//navigation
function bindEventToNavigation() {
    $.each($("#navigation_links > li > a"), function (index, element) {
        $(element).click(function (event) {
            breadcrumbStateSaver($(this).attr('href'), $(this).text());
            showBreadCrumb();
        });
    });
}

function breadcrumbStateSaver(link, text) {
    if (typeof (Storage) != "undefined") {
        if (sessionStorage.breadcrumb) {
            var breadcrumb = sessionStorage.breadcrumb;
            sessionStorage.breadcrumb = breadcrumb + " >> <a href='" + link + "'>" + text + "</a>";
        } else {
            sessionStorage.breadcrumb = "<a href='" + link + "'>" + text + "</a>";
        }
    }
}

function showBreadCrumb() {
    $("#breadcrumb").html(sessionStorage.breadcrumb);
}

function Cal(e) {
    if (e.className == 'decrease') {
        if (e.nextElementSibling.value > 1) {
            e.nextElementSibling.value = parseInt(e.nextElementSibling.value) - 1;
        }
    } else {
        e.previousElementSibling.value = parseInt(e.previousElementSibling.value) + 1;
    }
}

//change 1000 to 1,000
function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,', '000')
}

function changeIcon(e) {
    e.querySelector('i').classList.toggle('fa-chevron-up');
}

//filter table by daterange
var dateTo, dateFrom, dateRange;
function filterByDateRange(table, type = 'single', dateToFilter = '', dateFromFilter = '', columnIndex = '', dateRangeFilter = '') {
    dateTo = dateToFilter;
    dateFrom = dateFromFilter;
    dateRange = dateRangeFilter;
    
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        var date;
        
        if (dateTo == '') {
            return true;
        }
        
        if (type == 'range') {
            date = data[columnIndex];
            if (date == dateRange) {
                return true;
            }
            else {
                return false;
            }
        }
        else {
            date = Date.parse(data[columnIndex]);
            if (date <= dateTo && date >= dateFrom) {
                return true;
            }
            else return false;
        }
        
    });
    
    $(table).DataTable().draw();
    // arr = table.rows({search:'applied'}).data();
    // arr.length == 0 ? arr = 0 : arr = arr.map(obj => obj.amount).reduce((a,b) => a+ b);
}
function openNav() {
    $('.sidenav').addClass('slidenav');
    $(".slidenav").css('width', "250px");
}

function toggleNavAdmin() {
    $('body').toggleClass('open-sidebar');
}

function toggleNavOverview() {
    $("body").toggleClass('open-sidebar');
}

function leapYear(year) {
    return ((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0);
}

function generateStars(el, numb , size=12, isReadonly = true) {
    el.raty({
        readOnly: isReadonly,
        score: numb,
        // starType: 'i'
    });
}

//index column for datatable
function createIndexColumn(table, column = 0) {
    table.on('order.dt search.dt', function () {
        table.column(column, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
}

//copy to clipboard
function copyToClipboard(el) {
    /* Get the text field */
    let copyText = $(el).closest('.modal').find('#ref-link-text')[0];   
    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /*For mobile devices*/
    
    /* Copy the text inside the text field */
    document.execCommand("copy");
    
    let tooltip = $(el).children();
    tooltip.html("Your link have been copied");
}

//remove copy to clipboard
function removeCopy(el) {
    let tooltip = $(el).children();
    
    $(tooltip).html("Copy to clipboard");
}

function showAlert(type, message, title = '', haveCancel = true, callback = '') {
    let alert = $(`<div class="alert alert-bg-white alert-${type}">
    ${haveCancel == true ? `<button type="button" class="close" data-dismiss="alert">&times;</button>` : ``}
    <strong>${title}</strong> ${message}.
    </div>`);
    $('.alert-group').append(alert);
    setTimeout(() => {
        $(alert).remove();
    }, 3000);
}

function stickyNavbar(){
    $(window).on('scroll',function(){
        if($(window).scrollTop() > 69){
            $('#sticky-wrapper').css('position','fixed');
        }
        else{
            $('#sticky-wrapper').css('position','sticky');
        }
    })
}

//set value for selectbox in rowdetail
function changeValueInSelectboxRowDetail(){
    // Add event listener for opening and closing details
    $('.dataTables_wrapper').on('click', '.control , .row-detail', function () {
        let table = $(this).closest('table').DataTable();
        let tr = $(this).closest('tr');
        let row = table.row(tr);
        if ( row.child.isShown() ) {
            let tr_child = $(this).closest('tr').next('.child');
            $(tr_child).find('select').val($(tr_child).find('select').attr('value'));
        }
    } );
}

$(document).ready(function () {
    changeValueInSelectboxRowDetail();
    // stickyNavbar(); 

    //popup modal
    if (!window.location.pathname.endsWith('login') && !window.location.pathname.endsWith('login/influencer') && !window.location.pathname.endsWith('login/customer')) {
        localStorage.removeItem('is_redirect');
    };
    $(document).on('scroll', function () {
        if ($(this).scrollTop() > 0) {
            $('.team__nav').addClass('scroll');
        }
        else {
            $('.team__nav').removeClass('scroll');
            
        }
    });
    
    //prevent click after submit
    $('form:not(.needs-validation)').on('submit', function () {
        if($(this).find('#modalConfirmCheckout').length != 0){
            return;
        }
        $(this).find('button[type="submit"]').attr('style', 'pointer-events:none');
        $(this).find('button.submit').attr('style', 'pointer-events:none');
    });
    
    $('form.needs-validation').submit(function (event) {
        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            $(this).addClass('was-validated');
        }
        else {
            if ($(this).closest('.modal').length == 0) {
                $(this).find('button[type="submit"]').attr('style', 'pointer-events:none');
                $(this).find('button.submit').attr('style', 'pointer-events:none');
            }
        }
    })
    
    //admin
    //add mini-sidebar to body when screen is smaller
    if ($(window).width() < 769) {
        $('body').addClass('mini-sidebar');
    }
    else {
        $('body').addClass('open-sidebar');
    }
    
    // //month picker
    // $("input[name='month']").daterangepicker({
    //     single: true,
    //     periods: ['month'],
    //     callback: function (startDate, endDate, period) {
    //         $(this).val(startDate.format('YYYY-MM'));
    //     }
    // });
    
    // daterangepicker
    $('.showdropdowns').daterangepicker({
        showDropdowns: true,
        locale: {
            format: 'YYYY-MM-DD'
        },
        autoUpdateInput: false,
    });
    
    // //signle date picker
    // $("input[name='date']").daterangepicker({
    //     singleDatePicker: true,
    //     showDropdowns: true,
    //     timePicker: true,
    //     locale: {
    //         format: 'YYYY-MM-DD'
    //     }
    // });
    
    // //single date picker with time
    // $("input[name='date-time']").daterangepicker({
    //     singleDatePicker: true,
    //     showDropdowns: true,
    //     timePicker: true,
    //     locale: {
    //         format: 'YYYY-MM-DD, hh:mm A'
    //     }
    // });
    
    $('[data-toggle="tooltip"]').tooltip();
    
    //search in datatable
    $('input[name="search-table"]').on('keyup', function () {
        $(this).closest('.page-table--wrap').find('table').DataTable().search(this.value).draw();
    })
    
    if ($(window).outerWidth() < 768) {
        $('.sidenav').addClass('slidenav');
    }
    
    $(window).resize(function () {
        if ($(window).outerWidth() < 768) {
            if (!$('.sidenav').hasClass('slidenav')) {
                $('.sidenav').addClass('slidenav');
                // $('.sidenav').css('width','unset');
                
            }
            
            //pageadmin
            $('body').addClass('mini-sidebar');
            
        }
        else {
            if ($('.sidenav').hasClass('slidenav')) {
                $('.sidenav').removeClass('slidenav');
                // $('.sidenav').css('width','100%');
                
            }
            $('body').removeClass('mini-sidebar');
            
        }
        
        
    });
    
    $('.opennav').on('click', function (e) {
        e.preventDefault();
    })
    //nav of admin page
    $('.background-blur').on('click', function () {
        $('body').removeClass('open-sidebar');
    })
    
    $('.slidenav').on('click', function (e) {
        if ($('.slidenav').width() > 0) {
            e.preventDefault();
        }
    })
    
    $('.sign__footer-totop').click(function () {
        $('html , body').animate({
            scrollTop: 0,
        }, 500);
        
    })
    
    //daterangepicker
    $('input[name="dates"]').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD'));
    });
    $('input[name="dates"]').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
        dateTo = '';
    });
});

window.addEventListener('load', function () {
    $('input[type="file"]').on('change', function () {
        if (this.files && this.files[0]) {
            var img = $(this).closest('.box__input').find('img');
            img.attr('src', URL.createObjectURL(this.files[0]));
            img.css('width', '300px');
        }
    })
});