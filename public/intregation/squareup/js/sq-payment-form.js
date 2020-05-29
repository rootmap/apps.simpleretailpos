/**
 * Define callback function for "sq-button"
 * @param {*} event
 */
var csrftLarVe = $('meta[name="csrf-token"]').attr("content");
var squareCapturePayment = $('meta[name="squareconnectpayment"]').attr("content");
var squarepartialpayment = $('meta[name="squarepartialpayment"]').attr("content");

function loadingOrProcessing(sms) {
    var strHtml = '';
    strHtml += '<div class="alert alert-icon-right alert-green alert-dismissible fade in mb-2" role="alert">';
    strHtml += '      <i class="icon-spinner10 spinner"></i> ' + sms;
    strHtml += '</div>';
    strHtml += '<script>setTimeout(function(){ $(".alert-dismissible").hide(); }, 10000);</script>';

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
    strHtml += '<script>setTimeout(function(){ $(".alert-dismissible").hide(); }, 10000);</script>';
    return strHtml;
}

function successMessage(sms) {
    var strHtml = '';
    strHtml += '<div class="alert alert-icon-left alert-success alert-dismissible fade in mb-2" role="alert">';
    strHtml += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    strHtml += '<span aria-hidden="true">×</span>';
    strHtml += '</button>';
    strHtml += sms;
    strHtml += '</div>';
    strHtml += '<script>setTimeout(function(){ $(".alert-dismissible").hide(); }, 10000);</script>';
    return strHtml;
}

function onGetCardNonce(event) {

    // Don't submit the form until SqPaymentForm returns with a nonce
    event.preventDefault();

    // Request a nonce from the SqPaymentForm object
    paymentForm.requestCardNonce();
}

function processCardPayment() {
    var nonce = $("#card-nonce").val();
    var card_amount = $("#card-amount").val();
    var paymentType = 1;
    var card_invoice = $("#card-invoice").val();
    if (card_invoice.length > 0) {
        paymentType = 2;
    }
    var topFrame = window.parent;

    if (paymentType == 1) {
        /* Payment Start */
    $.ajax({
        'async': true,
        'type': "POST",
        'global': false,
        'dataType': 'json',
        'url': squareCapturePayment,
        'data': {
            'card_amount': card_amount,
            'nonce': nonce,
            '_token': csrftLarVe
        },
        'success': function(data) {
            console.log("Square Connect Print Sales ID : " + data);
            if (data == null) {
                    topFrame.$("#squareupMsg").html(warningMessage(data.msg));
                    topFrame.$("#squareupMsg").show();
            } else {
                console.log(data);
                if (data.status == 0) {
                    console.log(0);
                    console.log(topFrame.$("#squareupMsg").html());
                    topFrame.$("#squareupMsg").html(warningMessage(data.msg));
                    topFrame.$("#squareupMsg").show();
                } else if (data.status == 1) {
                    console.log(1);
                    topFrame.$("#squareupMsg").html(successMessage(data.msg));
                    topFrame.$("#squareupMsg").show();
                    var amount_to_pay = topFrame.$("input[name=amount_to_pay]").val();

                    var expaid = topFrame.$("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
                    if ($.trim(expaid) == 0) {
                        var parseNewPayment = parseFloat(amount_to_pay).toFixed(2);
                        topFrame.$("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                    } else {
                        var newpayment = (expaid - 0) + (amount_to_pay - 0);
                        var parseNewPayment = parseFloat(newpayment).toFixed(2);
                        topFrame.$("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                    }

                    topFrame.genarateSalesTotalCart();
                    topFrame.$("#squareupmodal").modal('hide');

                    topFrame.$("#cartMessageProShow").html(successMessage(data.msg));
                    topFrame.$("#cartMessageProShow").show();
                    //cartMessageProShow

                } else {
                    console.log('else');
                }
                }
        }
    });
        /* Payment End */
    } else {
        /* Partial Payment Start */
        $.ajax({
            'async': true,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': squarepartialpayment,
            'data': {
                'card_amount': card_amount,
                'card_invoice': card_invoice,
                'nonce': nonce,
                '_token': csrftLarVe
            },
            'success': function(data) {
                console.log("Square Connect Print Sales ID : " + data);
                if (data == null) {
                    topFrame.$("#squareupPartialMsg").html(warningMessage(data.msg));
                    topFrame.$("#squareupPartialMsg").show();
                } else {
                    console.log(data);
                    if (data.status == 0) {
                        console.log(0);
                        console.log(topFrame.$("#squareupPartialMsg").html());
                        topFrame.$("#squareupPartialMsg").html(warningMessage(data.msg));
                        topFrame.$("#squareupPartialMsg").show();
                    } else if (data.status == 1) {
                        console.log(1);
                        topFrame.$("#squareupPartialMsg").html(successMessage(data.msg));
                        topFrame.$("#squareupPartialMsg").show();

                        topFrame.$("#squareupPartialmodal").modal('hide');

                        topFrame.$("#cartMessageProShow").html(successMessage(data.msg));
                        topFrame.$("#cartMessageProShow").show();
                        //cartMessageProShow

                    } else {
                        console.log('else');
                    }
                }
            }
        });
        /* Partial Payment End */
    }



    //------------------------Ajax Customer End---------------------------//

    return false;
}

// Initializes the SqPaymentForm object by
// initializing various configuration fields and providing implementation for callback functions.
var paymentForm = new SqPaymentForm({
    // Initialize the payment form elements
    applicationId: applicationId,
    locationId: locationId,
    inputClass: 'sq-input',

    // Customize the CSS for SqPaymentForm iframe elements
    inputStyles: [{
        backgroundColor: 'transparent',
        color: '#333333',
        fontFamily: '"Helvetica Neue", "Helvetica", sans-serif',
        fontSize: '16px',
        fontWeight: '400',
        placeholderColor: '#8594A7',
        placeholderFontWeight: '400',
        padding: '16px',
        _webkitFontSmoothing: 'antialiased',
        _mozOsxFontSmoothing: 'grayscale'
    }],

    // Initialize Google Pay button ID
    googlePay: {
        elementId: 'sq-google-pay'
    },

    // Initialize Apple Pay placeholder ID
    applePay: {
        elementId: 'sq-apple-pay'
    },

    // Initialize Masterpass placeholder ID
    masterpass: {
        elementId: 'sq-masterpass'
    },

    // Initialize the credit card placeholders
    cardNumber: {
        elementId: 'sq-card-number',
        placeholder: '•••• •••• •••• ••••'
    },
    cvv: {
        elementId: 'sq-cvv',
        placeholder: 'CVV'
    },
    expirationDate: {
        elementId: 'sq-expiration-date',
        placeholder: 'MM/YY'
    },
    postalCode: {
        elementId: 'sq-postal-code'
    },

    // SqPaymentForm callback functions
    callbacks: {

        /*
         * callback function: methodsSupported
         * Triggered when: the page is loaded.
         */
        methodsSupported: function(methods) {
            if (!methods.masterpass && !methods.applePay && !methods.googlePay) {
                var walletBox = document.getElementById('sq-walletbox');
                walletBox.style.display = 'none';
            } else {
                var walletBox = document.getElementById('sq-walletbox');
                walletBox.style.display = 'block';
            }

            // Only show the button if Google Pay is enabled
            if (methods.googlePay === true) {
                var googlePayBtn = document.getElementById('sq-google-pay');
                googlePayBtn.style.display = 'inline-block';
            }

            // Only show the button if Apple Pay for Web is enabled
            if (methods.applePay === true) {
                var applePayBtn = document.getElementById('sq-apple-pay');
                applePayBtn.style.display = 'inline-block';
            }

            // Only show the button if Masterpass is enabled
            if (methods.masterpass === true) {
                var masterpassBtn = document.getElementById('sq-masterpass');
                masterpassBtn.style.display = 'inline-block';
            }
        },

        /*
         * callback function: createPaymentRequest
         * Triggered when: a digital wallet payment button is clicked.
         */
        createPaymentRequest: function() {

            var paymentRequestJson = {
                requestShippingAddress: false,
                requestBillingInfo: true,
                shippingContact: {
                    familyName: "CUSTOMER LAST NAME",
                    givenName: "CUSTOMER FIRST NAME",
                    email: "mycustomer@example.com",
                    country: "USA",
                    region: "CA",
                    city: "San Francisco",
                    addressLines: [
                        "1455 Market St #600"
                    ],
                    postalCode: "94103",
                    phone: "14255551212"
                },
                currencyCode: "USD",
                countryCode: "US",
                total: {
                    label: "MERCHANT NAME",
                    amount: "1.00",
                    pending: false
                },
                lineItems: [{
                    label: "Subtotal",
                    amount: "1.00",
                    pending: false
                }]
            };

            return paymentRequestJson;
        },

        /*
         * callback function: validateShippingContact
         * Triggered when: a shipping address is selected/changed in a digital
         *                 wallet UI that supports address selection.
         */
        validateShippingContact: function(contact) {

            var validationErrorObj;
            /* ADD CODE TO SET validationErrorObj IF ERRORS ARE FOUND */
            return validationErrorObj;
        },

        /*
         * callback function: cardNonceResponseReceived
         * Triggered when: SqPaymentForm completes a card nonce request
         */
        cardNonceResponseReceived: function(errors, nonce, cardData, billingContact, shippingContact) {
            if (errors) {
                var error_html = "";
                for (var i = 0; i < errors.length; i++) {
                    error_html += "<li> " + errors[i].message + " </li>";
                }
                document.getElementById("error").innerHTML = error_html;
                document.getElementById('sq-creditcard').disabled = false;

                return;
            } else {
                document.getElementById("error").innerHTML = "";
            }

            // Assign the nonce value to the hidden form field
            document.getElementById('card-nonce').value = nonce;

            // POST the nonce form to the payment processing page
            document.getElementById('nonce-form').submit();

        },

        /*
         * callback function: unsupportedBrowserDetected
         * Triggered when: the page loads and an unsupported browser is detected
         */
        unsupportedBrowserDetected: function() {
            /* PROVIDE FEEDBACK TO SITE VISITORS */
        },

        /*
         * callback function: inputEventReceived
         * Triggered when: visitors interact with SqPaymentForm iframe elements.
         */
        inputEventReceived: function(inputEvent) {
            switch (inputEvent.eventType) {
                case 'focusClassAdded':
                    /* HANDLE AS DESIRED */
                    break;
                case 'focusClassRemoved':
                    /* HANDLE AS DESIRED */
                    break;
                case 'errorClassAdded':
                    /* HANDLE AS DESIRED */
                    break;
                case 'errorClassRemoved':
                    /* HANDLE AS DESIRED */
                    break;
                case 'cardBrandChanged':
                    /* HANDLE AS DESIRED */
                    break;
                case 'postalCodeChanged':
                    /* HANDLE AS DESIRED */
                    break;
            }
        },

        /*
         * callback function: paymentFormLoaded
         * Triggered when: SqPaymentForm is fully loaded
         */
        paymentFormLoaded: function() {
            /* HANDLE AS DESIRED */
        }
    }
});