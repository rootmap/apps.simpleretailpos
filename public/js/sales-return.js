    var csrftLarVe = $('meta[name="csrf-token"]').attr("content");

    function loadSalesReturnItem(itemID){
        $("#salesReturnMSG").html(loadingOrProcessing("Please wait, loading customer invoices."));
        //------------------------Ajax Customer Start-------------------------//
        var table_data="<tr><td colspan='6'>No Invoice Found</td></tr>";
            $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': sales_return_invoice_detail,
            'data': {
                'invoice_id':itemID,
                '_token':csrftLarVe
                },
            'success': function (data) 
            {
                var table_data="";
                console.log(data);
                $("#salesReturnMSG").hide();
                $("#warranty_invoice_list").parent().parent().hide();
                $("#returnSalesItems_warranty_invoice_list").parent().parent().show();
                $(".backSalesReturnInvoicesGrid").fadeIn();
                if(data.length > 0)
                {
                    $.each(data, function(key,row){
                        table_data += '<tr id="tr_'+key+'">';
                        table_data +='    <td>'+row.product_barcode+'</td>';
                        table_data +='    <td>'+row.product_name+'</td>';
                        table_data +='    <td>'+row.price+'</td>';
                        table_data +='    <td>1</td>';
                        if(row.item_return_status == 1){
                            table_data +='    <td colspan="3">Item Return To Store</td>';
                        }
                        else{
                            table_data +='    <td>';
                            table_data +='          <fieldset class="form-group position-relative has-icon-left">';
                            table_data +='              <input value="'+row.price+'" size="8" type="text" class="form-control form-control-success" placeholder="Enter Reason">';
                            table_data +='              <div class="form-control-position">';
                            table_data +='                  <i class="icon-dollar primary"></i>';
                            table_data +='              </div>';
                            table_data +='          </fieldset>';
                            table_data +='    </td>';
                            table_data +='    <td>';
                            table_data +='          <fieldset class="form-group position-relative has-icon-left">';
                            table_data +='              <input value="Customer Want To Return"  size="20"  type="text" class="form-control form-control-success" placeholder="Enter Reason">';
                            table_data +='              <div class="form-control-position">';
                            table_data +='                  <i class="icon-phone3 primary"></i>';
                            table_data +='              </div>';
                            table_data +='          </fieldset>';
                            table_data +='     </td>';
                            table_data +='     <td>';
                            table_data +='           <button onclick="SalesReturnItem('+row.id+','+key+')" type="button" class="btn btn-outline-success">';
                            table_data +='             <i style="font-size:15px;" class="icon-cross2"></i>';
                            table_data +='           </button>';
                            table_data +='     </td>';
                        }
                        
                        table_data += '</tr>';
                    });
                    
                }
                else
                {
                    table_data="<tr><td colspan='5'>No Invoice Found</td></tr>";
                }

                $("#returnSalesItems_warranty_invoice_list").children('tbody').html(table_data);
                
                
            }
        });
        //------------------------Ajax Customer End---------------------------//

    }

    function SalesReturnItem(itemID,key){
        $("#salesReturnMSG").html(loadingOrProcessing("Please wait, loading customer invoices."));

        var return_amount = $("#tr_"+key).find("td:eq(4)").children().children("input").val();
        var return_reason = $("#tr_"+key).find("td:eq(5)").children().children("input").val();

        //alert(return_amount);
        //------------------------Ajax Customer Start-------------------------//
        var table_data="<tr><td colspan='6'>No Invoice Found</td></tr>";
            $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': sales_return_item,
            'data': {
                'item_id':itemID,
                'return_amount':return_amount,
                'return_reason':return_reason,
                '_token':csrftLarVe
                },
            'success': function (data){
                console.log(data);
                if(data.status==1){
                    $("#salesReturnMSG").fadeIn();
                    $("#salesReturnMSG").html(successMessage("Sales Return successful."));
                    $("#tr_"+key).fadeOut();
                }
                else{
                    $("#salesReturnMSG").fadeIn();
                    $("#salesReturnMSG").html(warningMessage("Sales Return Failed."));
                }
            }
        });
        //------------------------Ajax Customer End---------------------------//

    }

    function formatDate(data){
        if(data !== undefined){
            if(data=="0000-00-00"){
                return "00/00/0000";
            }else{
                if(data.length==0){
                    return "";
                }else{
                    var d = new Date(data),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                    if (month.length < 2) month = '0' + month;
                    if (day.length < 2) day = '0' + day;

                    return [month, day, year].join('/');
                }
            }
            
        }else{
            return "";
        }
    }

    $(document).ready(function(){

        $(".resetSalesReturnInvoices").click(function(){
            $("input[name=sales_return_invoice_date]").val("");
            $("input[name=sales_return_invoice_id]").val("");
            $("input[name=sales_return_barcode]").val("");
            var table_data="<tr><td colspan='6'>No Invoice Found</td></tr>";
            $("#warranty_invoice_list").children('tbody').html(table_data);
            $("#returnSalesItems_warranty_invoice_list").parent().parent().hide();
            $("#warranty_invoice_list").parent().parent().fadeIn();
            $(".backSalesReturnInvoicesGrid").fadeOut();
        });

        $(".loadSalesReturnInvoices").click(function(){
            $("#salesReturnMSG").html(loadingOrProcessing("Please wait, loading customer invoices."));
            var sales_return_invoice_date=$("input[name=sales_return_invoice_date]").val();
            var sales_return_invoice_id=$("input[name=sales_return_invoice_id]").val();
            var sales_return_barcode=$("input[name=sales_return_barcode]").val();

            if(sales_return_invoice_date.length==0 && sales_return_invoice_id.length==0 && sales_return_barcode.length==0)
            {
                var sales_return_today=$("input[name=sales_return_today]").val();
                sales_return_invoice_date = sales_return_today;
            }

            //------------------------Ajax Customer Start-------------------------//
            var table_data="<tr><td colspan='6'>No Invoice Found</td></tr>";
             $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': sales_return_invoice_ajax,
                'data': {
                    'invoice_date':sales_return_invoice_date,
                    'barcode':sales_return_barcode,
                    'invoice_id':sales_return_invoice_id,
                    '_token':csrftLarVe
                    },
                'success': function (data) 
                {
                    var table_data="";
                    console.log(data);
                    $("#salesReturnMSG").hide();

                    $("#returnSalesItems_warranty_invoice_list").parent().parent().hide();
                    

                    
                    
                    if(data.length > 0)
                    {
                        $.each(data, function(key,row){
                            table_data += '<tr>';
                            table_data +='    <td>'+row.invoice_id+'</td>';
                            table_data +='    <td>'+row.customer_name+'</td>';
                            table_data +='    <td>'+row.tender_name+'</td>';
                            table_data +='    <td>'+row.total_amount+'</td>';
                            table_data +='    <td>'+formatDate(row.created_at)+'</td>';
                            table_data +='    <td>';
                            table_data +='           <button onclick="loadSalesReturnItem('+row.invoice_id+')" type="button" class="btn btn-outline-success">';
                            table_data +='             <i style="font-size:15px;" class="icon-android-arrow-dropright-circle"></i>';
                            table_data +='           </button>';
                            table_data +='    </td>';
                            table_data += '</tr>';
                        });
                        
                    }
                    else
                    {
                        table_data="<tr><td colspan='6'>No Invoice Found</td></tr>";
                    }

                    $("#warranty_invoice_list").children('tbody').html(table_data);
                    $("#warranty_invoice_list").parent().parent().fadeIn();
                    $(".backSalesReturnInvoicesGrid").fadeOut();

                    
                }
            });
            //------------------------Ajax Customer End---------------------------//
        });

        $("select[name=sales_return_customer_id]").change(function(){

            $("#salesReturnMSG").html(loadingOrProcessing("Please wait, loading customer invoices."));

            var sales_return_customer_id=$(this).val();
            if(sales_return_customer_id.length==0)
            {
                $("#salesReturnMSG").html(warningMessage("Please Select a customer."));
                return false;
            }
            //------------------------Ajax Customer Start-------------------------//
             $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': sales_return_invoice_ajax,
                'data': {'customer_id':sales_return_customer_id,'_token':csrftLarVe},
                'success': function (data) 
                {
                    $("#salesReturnMSG").html(successMessage("Customer invoices loaded successfully, Please select a invoice."));
                    var ff="<option value=''>Select A Invoice</option>";
                    $.each(data,function(index,row){
                        //console.log(row);
                        ff+="<option data-value='"+row.total_amount+"' value='"+row.invoice_id+"'>"+row.invoice_id+" - "+row.created_at+"</option>";
                    });

                    $("select[name=sales_return_sales_invoice_id]").html(ff);
                }
            });
            //------------------------Ajax Customer End---------------------------//

        });

        $("select[name=sales_return_sales_invoice_id]").change(function(){
            $("#salesReturnMSG").html(loadingOrProcessing("Please wait, loading customer invoices."));
            var invoice_id=$(this).val();
            if(invoice_id.length==0)
            {
                $("#salesReturnMSG").html(warningMessage("Please Select a Invoice."));
                return false;
            }

            var invoiceAmount=$("select[name=sales_return_sales_invoice_id] option[value="+invoice_id+"]").attr("data-value");
            $("#salesReturnMSG").html(successMessage("Invoice Total Amount Load Successfully."));
            $("input[name=sales_return_sales_amount]").val(invoiceAmount);

        });

        $(".saveSalesReturnSave").click(function(){
            $("#salesReturnMSG").html(loadingOrProcessing("Please wait, Sales Return Information Processing."));

            var customer_id=$("select[name=sales_return_customer_id]").val();
            if(customer_id.length==0)
            {
                $("#salesReturnMSG").html(warningMessage("Please Select a customer."));
                return false;
            }

            var invoice_id=$("select[name=sales_return_sales_invoice_id]").val();
            if(invoice_id.length==0)
            {
                $("#salesReturnMSG").html(warningMessage("Please Select a invoice."));
                return false;
            }

            var sales_amount=$("input[name=sales_return_sales_amount]").val();
            if(sales_amount.length==0)
            {
                $("#salesReturnMSG").html(warningMessage("Please Enter a Sales Amount."));
                return false;
            }

            var return_amount=$("input[name=sales_return_return_amount]").val();
            if(return_amount.length==0)
            {
                $("#salesReturnMSG").html(warningMessage("Please Enter a Return Amount."));
                return false;
            }

            var sales_return_note=$("input[name=sales_return_note]").val();
            if(sales_return_note.length==0)
            {
                $("#salesReturnMSG").html(warningMessage("Please Enter a Sales Return Note."));
                return false;
            }

            //------------------------Ajax Customer Start-------------------------//
             
             $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': sales_return_save_ajax,
                'data': {
                            'customer_id':customer_id,
                            'invoice_id':invoice_id,
                            'sales_amount':sales_amount,
                            'return_amount':return_amount,
                            'sales_return_note':sales_return_note,
                            '_token':csrftLarVe
                        },
                'success': function (data) 
                {
                    if(data==1)
                    {
                        $("#salesReturnMSG").html(successMessage("Customer invoices loaded successfully, Please select a invoice."));
                        $("#salesReturn").modal('hide');
                        $('select[name=sales_return_customer_id]').val('').select2();
                        $('select[name=sales_return_sales_invoice_id]').val('').select2();
                        $('input[name=sales_return_sales_amount]').val('');
                        $('input[name=sales_return_return_amount]').val('');
                        $('input[name=sales_return_note]').val('');
                    }
                    else
                    {
                        $("#salesReturnMSG").html(warningMessage("Failed, Please try again."));
                        return false;
                    }

                }
            });
            //------------------------Ajax Customer End---------------------------//
        });

        $(".backSalesReturnInvoices").click(function(){
            $("#returnSalesItems_warranty_invoice_list").parent().parent().hide();
            $("#warranty_invoice_list").parent().parent().fadeIn();
            $(".backSalesReturnInvoicesGrid").hide();
        });

    });