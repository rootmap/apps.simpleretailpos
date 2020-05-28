function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('.card-img-top').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

var csrftLarVe = $('meta[name="pos-token"]').attr("content");
$(document).ready(function(){

    var chkPS=$('input[name=chkPS]').val();
    if(chkPS==0)
    {
        $(".imgStatusProduct").html('Disabled');
        $(".imgStatusProduct").css('color','red');
        $('.product_with_image').fadeOut('slow');
        $('.product_without_image').fadeIn('slow');
        $('.proImageArea').hide();
    }
    else
    {
        $(".imgStatusProduct").html('Enabled');
        $(".imgStatusProduct").css('color','green');
        $('.product_without_image').fadeOut('slow');
        $('.product_with_image').fadeIn('slow');
        $('.proImageArea').show();
    }

	$('body').on('click', '.switchery', function() {
		var chSwitchery=document.getElementById('switchery').checked;
        var product_image_status=0;
		if(chSwitchery==true)
		{
			$(".imgStatusProduct").html('Enabled');
			$(".imgStatusProduct").css('color','green');
			$('.product_without_image').fadeOut('slow');
			$('.product_with_image').fadeIn('slow');
            product_image_status=1;
            if($('.proNameArea').hasClass('col-md-12'))
            {
                $('.proNameArea').removeClass('col-md-12');
                $('.proNameArea').addClass('col-md-6');
            }
            else
            {
                $('.proNameArea').addClass('col-md-6');
            }
            $('.proImageArea').show();


		}
		else
		{
			$(".imgStatusProduct").html('Disabled');
			$(".imgStatusProduct").css('color','red');
			$('.product_with_image').fadeOut('slow');
			$('.product_without_image').fadeIn('slow');
            $('.proImageArea').hide();

            if($('.proNameArea').hasClass('col-md-6'))
            {
                $('.proNameArea').removeClass('col-md-6');
                $('.proNameArea').addClass('col-md-12');
            }
            else
            {
                $('.proNameArea').addClass('col-md-12');
            }
		}

        var AddHowMowKhaoUrl=productSettings;
         $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddHowMowKhaoUrl,
            'data': {'product_image_status':product_image_status,'_token':csrftLarVe},
            'success': function (data) {
                console.log("Counter Display Status : "+data);
            }
        });
        //------------------------Ajax Customer End---------------------------//
        
    });

    $('.tpname').keyup(function() {
		$(".product_name_place").html($(this).val());
    });

    $('.tpprice').keyup(function() {
		$(".product_price_place").html($(this).val());
    });

    $('#file_product').change(function(e){
        
        var file = this.files[0];
        var fileType = file["type"];
        var validImageTypes = ["image/jpeg", "image/png"];
        if ($.inArray(fileType, validImageTypes) < 0) {
             
            alert('Invalid file, Please select only image.');
            $('head').append("<style>.custom-file-control:lang(en)::after { content: 'Choose Image file...'; }</style>");
            return false;
        }

        var fileName = e.target.files[0].name;
        //$('.card-img-top').attr('src',e.target.result);
        $('head').append("<style>.custom-file-control:lang(en)::after { content: '"+fileName+"'; }</style>");



        readURL(this);
    });



});