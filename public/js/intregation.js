$(document).ready(function() {
    /*   Square Connect API Start    */



    $(".SquareupPayment").click(function() {

        var customerID = $.trim($("select[name=customer_id]").val());
        if (customerID.length == 0) {
            //$("#payModal").modal('hide');
            $(".payModal-message-area").html(warningMessage("Please select a customer."));
            return false;
        }



        var amount_to_pay = $("input[name=amount_to_pay]").val();
        if ($.trim(amount_to_pay) > 0) {
            //Swal.showLoading();
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