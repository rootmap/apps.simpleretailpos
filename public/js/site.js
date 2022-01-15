
$(document).ready(function(e){
    $.getScript("https://cdn.jsdelivr.net/npm/sweetalert2@9");
});

var searchClick=0;
/* search GLobal Start*/
function searchInNuc()
{
    console.log('Got Search');
    if(searchClick==0)
    {
        //$.getScript(siteConfig_fullscreenSearch);
        var searchClickConfig = (function () {
            var searchClickConfig = null;
                $.ajax({
                    'async': false,
                    'global': false,
                    'url': siteConfig_fullscreenSearch,
                    'dataType': "script",
                    'success': function (data) {
                        searchClickConfig = data;
                    }
                });
                return searchClickConfig;
        })();

        $("#fullscreen-search-btn").click();
    }
    
    console.log('searchClick =',searchClick);
    searchClick++;
    //$('.fullscreen-search-btn').trigger('click');

}
function searchInvoice(strSearch,strSearchParam){
    console.log('Invoice Search Init= ',strSearch);
    console.log('Invoice Search Init= ',strSearchParam);
        
        $("#search_result_loader").html(loadingOrProcessing("Loading Search Result, Please Wait..."));
        //------------------------Ajax Customer Start-------------------------//
        var AddHowMowKhaoUrl = searchnucleus;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddHowMowKhaoUrl,
            'data': { 
                'search': strSearch, 
                'search_param': strSearchParam, 
                '_token': csrftLarVe, 
            },
            'success': function(data) {
                console.log("Completing Sales : " + data);
                $("#search_result_loader").fadeOut();
                if(data.status == 0)
                {
                    $('#invoice_table').dataTable().fnClearTable();
                    $('#invoice_table').dataTable().fnDestroy();
                    var new_row = "<tr><td colspan='9' class='text-xs-center'>No Invoice Record Found : Search Result </td></tr>";
                    $("#invoice_table").find("tbody").html(new_row);
                    $("#search_result_loader").html(warningMessage("No Invoice Record Found Related To Search."));
                    $("#invoice_total_record").addClass("text-danger");
                }
                else
                {

                    

                    $("#invoice_total_record").addClass("text-info");
                    $("#invoice_total_record").html(data.status)
                    var new_row = '';
                    new_row = '';
                    $.each(data.invoice, function(key,row){
                        //console.log(row);
                        new_row += '<tr>';
                        new_row += '    <td>'+row.invoice_id+'</td>';
                        new_row += '    <td>'+row.created_at+'</td>';
                        new_row += '    <td>'+row.product_name+'</td>';
                        new_row += '    <td>'+row.customer_name+'</td>';
                        new_row += '    <td>'+row.tender_name+'</td>';
                        new_row += '    <td>'+row.invoice_status+'</td>';
                        new_row += '    <td>'+row.total_amount+'</td>';
                        new_row += '    <td><a target="_blank" class="btn btn-info" href="'+viewInvoiceURL+'/'+row.id+'"><i class="icon-eye"></i> View Invoice</a></td>';
                        new_row += '</tr>';
                    });
                    $("#invoice_table").find("tbody").html(new_row);
                    $("#invoice_table").DataTable();
                    $("#search_result_loader").fadeOut('slow');

                    var exTotal = $("#total_search_found").html();
                    var newTotal = (exTotal-0) + (data.status-0);
                    $("#total_search_found").html(newTotal);
                }
                
            }
        });
        //------------------------Ajax Customer End---------------------------//
}

function searchCustomerNuc(strSearch,strSearchParam){
    console.log('searchCustomerNuc Search Init= ',strSearch);
    console.log('searchCustomerNuc Search Init= ',strSearchParam);
        
        $("#customer_search_result_loader").html(loadingOrProcessing("Loading Search Result, Please Wait..."));
        //------------------------Ajax Customer Start-------------------------//
        var AddHowMowKhaoUrl = searchCustomerURL;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddHowMowKhaoUrl,
            'data': { 
                'search': strSearch, 
                'search_param': strSearchParam, 
                '_token': csrftLarVe, 
            },
            'success': function(data) {
                console.log("Completing Sales : " + data);
                $("#customer_search_result_loader").fadeOut();
                if(data.status == 0)
                {
                    $('#customer_table').dataTable().fnClearTable();
                    $('#customer_table').dataTable().fnDestroy();
                    var new_row = "<tr><td colspan='8' class='text-xs-center'>No Record Found : Search Result </td></tr>";
                    $("#customer_table").find("tbody").html(new_row);
                    $("#customer_search_result_loader").html(warningMessage("No Record Found Related To Search."));
                    $("#customer_total_record").addClass("text-danger");
                }
                else
                {
                    $("#customer_total_record").addClass("text-info");
                    $("#customer_total_record").html(data.status)
                    var new_row = '';
                    new_row = '';
                    $.each(data.invoice, function(key,row){
                        console.log('Repair',row);
                        new_row += '<tr>';
                        new_row += '    <td>'+row.id+'</td>';
                        new_row += '    <td>'+row.name+'</td>';
                        new_row += '    <td>'+row.address+'</td>';
                        new_row += '    <td>'+row.phone+'</td>';
                        new_row += '    <td>'+row.email+'</td>';
                        new_row += '    <td>'+row.last_invoice_no+'</td>';
                        new_row += '    <td>'+row.created_at+'</td>';
                        new_row += '    <td><a target="_blank" class="btn btn-info" href="'+viewCustomerURL+'/'+row.id+'"><i class="icon-eye"></i> View Customer</a></td>';
                        new_row += '</tr>';
                    });
                    $("#customer_table").find("tbody").html(new_row);
                    $("#customer_table").DataTable();
                    $("#customer_search_result_loader").fadeOut('slow');

                    var exTotal = $("#total_search_found").html();
                    var newTotal = (exTotal-0) + (data.status-0);
                    $("#total_search_found").html(newTotal);
                }
                
            }
        });
        //------------------------Ajax Customer End---------------------------//
}

function searchProductNuc(strSearch,strSearchParam){
    console.log('searchProductNuc Search Init= ',strSearch);
    console.log('searchProductNuc Search Init= ',strSearchParam);
        
        $("#product_search_result_loader").html(loadingOrProcessing("Loading Search Result, Please Wait..."));
        //------------------------Ajax Customer Start-------------------------//
        var AddHowMowKhaoUrl = searchProductURL;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddHowMowKhaoUrl,
            'data': { 
                'search': strSearch, 
                'search_param': strSearchParam, 
                '_token': csrftLarVe, 
            },
            'success': function(data) {
                console.log("Completing Sales : " + data);
                $("#product_search_result_loader").fadeOut();
                if(data.status == 0)
                {
                    $('#product_table').dataTable().fnClearTable();
                    $('#product_table').dataTable().fnDestroy();
                    var new_row = "<tr><td colspan='9' class='text-xs-center'>No Record Found : Search Result </td></tr>";
                    $("#product_table").find("tbody").html(new_row);
                    $("#product_search_result_loader").html(warningMessage("No Record Found Related To Search."));
                    $("#product_total_record").addClass("text-danger");
                }
                else
                {
                    $("#product_total_record").addClass("text-info");
                    $("#product_total_record").html(data.status)
                    var new_row = '';
                    new_row = '';
                    $.each(data.invoice, function(key,row){
                        console.log('Repair',row);
                        new_row += '<tr>';
                        new_row += '    <td>'+row.id+'</td>';
                        new_row += '    <td>'+row.category_name+'</td>';
                        new_row += '    <td>'+row.barcode+'</td>';
                        new_row += '    <td>'+row.name+'</td>';
                        new_row += '    <td>'+row.quantity+'</td>';
                        new_row += '    <td>'+row.price+'</td>';
                        new_row += '    <td>'+row.cost+'</td>';
                        new_row += '    <td>'+row.created_at+'</td>';
                        new_row += '</tr>';
                    });
                    $("#product_table").find("tbody").html(new_row);
                    $("#product_table").DataTable();
                    $("#product_search_result_loader").fadeOut('slow');

                    var exTotal = $("#total_search_found").html();
                    var newTotal = (exTotal-0) + (data.status-0);
                    $("#total_search_found").html(newTotal);
                }
                
            }
        });
        //------------------------Ajax Customer End---------------------------//
}

function searchNucleus(strSearch,strSearchParam){
    searchInvoice(strSearch,strSearchParam);
    setTimeout(() => {
        searchInventoryRepair(strSearch,strSearchParam);
    }, 1000);
    setTimeout(() => {
        searchNonInventoryRepair(strSearch,strSearchParam);
    }, 2000);
    
}

$('.fullscreen-search-input').on('keypress',function(e) {
    if(e.which == 13) {
        findnCOnvertParam();
        $('form.fullscreen-search-form').submit();
    }
});

$('.fullscreen-search-submit').on('click',function(e) {
    findnCOnvertParam();
    $('form.fullscreen-search-form').submit();
});

function findnCOnvertParam(){
    var  nuc_search_all = 0;
       if($('#nuc-search-all').is(":checked")){ nuc_search_all = 1; }

       var  nuc_search_customer = 0;
       if($('#nuc-search-customer').is(":checked")){ nuc_search_customer = 1; }

       var  nuc_search_invoice = 0;
       if($('#nuc-search-invoice').is(":checked")){ nuc_search_invoice = 1; }

       var  nuc_search_product = 0;
       if($('#nuc-search-product').is(":checked")){ nuc_search_product = 1; }

       var search_param  = {};
       search_param['nuc_search_all']=nuc_search_all;
       search_param['nuc_search_customer']=nuc_search_customer;
       search_param['nuc_search_invoice']=nuc_search_invoice;
       search_param['nuc_search_product']=nuc_search_product;
     
       var encode_param = JSON.stringify(search_param);

       console.log(search_param);
       console.log(encode_param);

       $("input[name=search_param]").val(encode_param);
}
/* search GLobal End*/    

var csrftLarVe = $('meta[name="csrf-token"]').attr("content");
function swalErrorMsg(msg) {
    Swal.fire({
        icon: 'error',
        title: '<h3 class="text-danger">Warning</h3>',
        html: '<h5>' + msg + '!!!</h5>'
    });
}

function swalSuccessMsg(msg) {
    Swal.fire({
        icon: 'success',
        title: '<h3 class="text-info">Thank You</h3>',
        html: '<h5>' + msg + '</h5>'
    });
}

function loadingOrProcessing(sms) {
    var strHtml = '';
    strHtml += '<div class="alert alert-icon-right alert-info alert-dismissible fade in mb-2" role="alert">';
    strHtml += '      <i class="icon-spinner10 spinner"></i> ' + sms;
    strHtml += '</div>';
    //strHtml += '<script>setTimeout(function(){ $(".alert-dismissible").hide(); }, 4000);</script>';

    return strHtml;

}

function warningMessage(sms) {
    var strHtml = '';
    strHtml += '<div class="alert alert-icon-left alert-danger alert-dismissible fade in mb-2" role="alert">';
    strHtml += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    strHtml += '<span aria-hidden="true">×</span>';
    strHtml += '</button>';
    strHtml += sms;
    strHtml += '</div>';
    strHtml += '<script>setTimeout(function(){ $(".alert-dismissible").hide(); }, 4000);</script>';
    return strHtml;
}

function successMessage(sms) {
    var strHtml = '';
    strHtml += '<div class="alert alert-icon-left alert-info alert-dismissible fade in mb-2" role="alert">';
    strHtml += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    strHtml += '<span aria-hidden="true">×</span>';
    strHtml += '</button>';
    strHtml += sms;
    strHtml += '</div>';
    strHtml += '<script>setTimeout(function(){ $(".alert-dismissible").hide(); }, 4000);</script>';
    return strHtml;
}

/* footer Script Global Start*/
    function logoutFRM()
    {
            $("#logoutME").submit();
    }

    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
        alert("Counter display link copied successfully.");
    }

    console.log("menu status",siteConfig_dataslideCheck);

    if(siteConfig_dataslideCheck==2){
        $("body").removeClass("page-sidebar-minimize menu-collapsed");
    }else{
        $("body").addClass("page-sidebar-minimize menu-collapsed");
    }



    $(document).ready(function(){
        $("#fullscreen").click(function(){
            $(document).toggleFullScreen()
            $(this).children("i").toggleClass("danger");
        });

        $(".copyButton").click(function(){
            copyToClipboard('#cdlDt');
        });
        
        $(".cash_register_collapse").click(function(){
            //---------------------Ajax New Product Start---------------------//
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': siteConfig_slidemenu_slide_status,
                'data': {'slide':1,'_token':csrftLarVe},
                'success': function (data) { 
                    console.log(data);
                }
            });
            //-----------------Ajax New Product End------------------//
        });
    });

    if(siteConfig_userguideInit==1)
    {
        $.getScript(siteConfig_introjs_intro_js);
        $(document).ready(function(){
            $("#initiateUserGuideTour").modal('show');

            $("#strSystemTour").click(function(){
                $("#initiateUserGuideTour").modal('hide');
                introJs().start();
                //---------------------Ajax New Product Start---------------------//
                $.ajax({
                    'async': true,
                    'type': "POST",
                    'global': true,
                    'dataType': 'json',
                    'url': siteConfig_systemtour_ajax_status,
                    'data': {'systour':1,'page_name':siteConfig_request_path,'_token':csrftLarVe},
                    'success': function (data) 
                    { 
                        console.log(data);
                    }
                });
                //-----------------Ajax New Product End------------------//
            });

            $("#skpSystemTour").click(function(){
                $("#initiateUserGuideTour").modal('hide');
            });

            $("#stpSystemTour").click(function(){
                $("#initiateUserGuideTour").modal('hide');
                //---------------------Ajax New Product Start---------------------//
                $.ajax({
                    'async': true,
                    'type': "POST",
                    'global': true,
                    'dataType': 'json',
                    'url': siteConfig_systemtour_ajax_status,
                    'data': {'systour':2,'page_name':siteConfig_request_path,'_token':csrftLarVe},
                    'success': function (data) 
                    { 
                        console.log(data);
                    }
                });
                //-----------------Ajax New Product End------------------//
            });
        });
    }
/* footer Script Global End*/