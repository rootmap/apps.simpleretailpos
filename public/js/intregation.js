$(document).ready(function() {
    /*   Square Connect API Start    */
    $(".SquareupPartalPayment").click(function() {

        var partialpay_invoice_id = $.trim($("select[name=partialpay_invoice_id]").val());
        if (partialpay_invoice_id.length == 0) {
            $(".payModal-message-area").html(warningMessage("Please select a invoice."));
            return false;
        }

        var partialpay_today_paid = $.trim($("input[name=partialpay_today_paid]").val());
        if (partialpay_today_paid.length == 0) {
            $(".payModal-message-area").html(warningMessage("Please Enter Amount You Want To Paid."));
            return false;
        }

        var amount_to_pay = partialpay_today_paid;
        if ($.trim(amount_to_pay) > 0) {
            $('#MainPartialPopupIframe').show();
            $("#payModal").modal('hide');
            $("#addPartialPayment").modal('hide');
            $("#squareupPartialmodal").modal('show');
            $("#squareupPartialMsg").html(loadingOrProcessing("Loading, Please wait...."));
            $("#squareupPartialMsg").show();
            $('#MainPartialPopupIframe').attr('src', squareupPaymentFormload);
            $('#MainPartialPopupIframe').load(function() {
                setTimeout(function() { $("#squareupPartialMsg").hide(); }, 3000);
                $(this).contents().find("#sq-creditcard").html("Pay $" + amount_to_pay + " Now");
                $(this).contents().find("#card-amount").val(amount_to_pay);
                $(this).contents().find("#card-invoice").val(partialpay_invoice_id);
                $(this).show();
                console.log('iframe loaded successfully');

                $(this).contents().find("#sq-creditcard").click(function() {
                    var nonce = $('#MainPartialPopupIframe').contents().find("#card-nonce").val();
                    $("#squareupPartialMsg").html(loadingOrProcessing("Loading, Please wait...."));
                    $("#squareupPartialMsg").show();
                });
            });
        } else {
            $(".payModal-message-area").html(warningMessage("You don't have any due."));
        }
    });

    $(".SquareupPayment").click(function() {

        var customerID = $.trim($("select[name=customer_id]").val());
        if (customerID.length == 0) {
            $(".payModal-message-area").html(warningMessage("Please select a customer."));
            return false;
        }

        var amount_to_pay = $("input[name=amount_to_pay]").val();
        if ($.trim(amount_to_pay) > 0) {
            $('#MainPopupIframe').show();
            $("#payModal").modal('hide');

            $("#squareupmodal").modal('show');
            $("#squareupMsg").html(loadingOrProcessing("Loading, Please wait...."));
            $("#squareupMsg").show();
            $('#MainPopupIframe').attr('src', squareupPaymentFormload);
            $('#MainPopupIframe').load(function() {
                setTimeout(function() { $("#squareupMsg").hide(); }, 3000);
                $(this).contents().find("#sq-creditcard").html("Pay $" + amount_to_pay + " Now");
                $(this).contents().find("#card-amount").val(amount_to_pay);
                $(this).show();
                console.log('iframe loaded successfully');

                $(this).contents().find("#sq-creditcard").click(function() {
                    var nonce = $('#MainPopupIframe').contents().find("#card-nonce").val();
                    $("#squareupMsg").html(loadingOrProcessing("Loading, Please wait...."));
                    $("#squareupMsg").show();
                });
            });
        } else {
            $(".payModal-message-area").html(warningMessage("You don't have any due."));
        }
    });


});