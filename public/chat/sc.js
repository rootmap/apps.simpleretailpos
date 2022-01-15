function userChatSingleTemplate(uniqTimeLo,chatInterfaceUserName,mess)
{
    var htmlSTR='';
        htmlSTR+='<div data-chat="'+uniqTimeLo+'" class="direct-chat-info clearfix currentMSGSent" id="0">';
        htmlSTR+='    <span class="direct-chat-img-reply-small pull-left"></span>';
        htmlSTR+='    <span class="direct-chat-reply-name">'+chatInterfaceUserName+'</span>';
        htmlSTR+='</div>';
        htmlSTR+='<div class="direct-chat-text">';
        htmlSTR+=''+mess;
        htmlSTR+='  <span id="AdminText"></span>';
        htmlSTR+='</div>';
        htmlSTR+='<div class="direct-chat-info clearfix">';
        htmlSTR+='  <span data-chat="'+uniqTimeLo+'" class="direct-chat-sbc_timestamp pull-right currentMSGSentST">Sending...</span>';
        htmlSTR+='</div>';

        htmlSTR+='<div class="direct-chat-info clearfix typeing-admin">';
        htmlSTR+='  <span class="direct-chat-img-reply-small pull-left"></span>';
        htmlSTR+='</div>';

        return htmlSTR;
}

function userChatPushTemplate(rowID,userType,uniqTimeLo,sent_time,chatInterfaceUserName,mess)
{
    if(userType==99999)
    {
        var htmlSTR='';
        htmlSTR+='<div data-chat="'+uniqTimeLo+'" class="direct-chat-info clearfix currentMSGSent" id="CHAT'+rowID+'">';
        htmlSTR+='    <span class="direct-chat-img-reply-small-admin pull-left"></span>';
        htmlSTR+='    <span class="direct-chat-reply-name">Admin</span>';
        htmlSTR+='</div>';
        htmlSTR+='<div class="direct-chat-text">';
        htmlSTR+=''+mess;
        htmlSTR+='  <span id="AdminText"></span>';
        htmlSTR+='</div>';
        htmlSTR+='<div class="direct-chat-info clearfix">';
        htmlSTR+='  <span data-chat="'+uniqTimeLo+'" class="direct-chat-sbc_timestamp pull-right currentMSGSentST">'+sent_time+'</span>';
        htmlSTR+='</div>';

        htmlSTR+='<div class="direct-chat-info clearfix typeing-admin">';
        htmlSTR+='  <span class="direct-chat-img-reply-small-admin pull-left"></span>';
        htmlSTR+='</div>';
    }
    else
    {

        var htmlSTR='';
        htmlSTR+='<div data-chat="'+uniqTimeLo+'" class="direct-chat-info clearfix currentMSGSent" id="CHAT'+rowID+'">';
        htmlSTR+='    <span class="direct-chat-img-reply-small pull-left"></span>';
        htmlSTR+='    <span class="direct-chat-reply-name">'+chatInterfaceUserName+'</span>';
        htmlSTR+='</div>';
        htmlSTR+='<div class="direct-chat-text">';
        htmlSTR+=''+mess;
        htmlSTR+='  <span id="AdminText"></span>';
        htmlSTR+='</div>';
        htmlSTR+='<div class="direct-chat-info clearfix">';
        htmlSTR+='  <span data-chat="'+uniqTimeLo+'" class="direct-chat-sbc_timestamp pull-right currentMSGSentST">'+sent_time+'</span>';
        htmlSTR+='</div>';

        htmlSTR+='<div class="direct-chat-info clearfix typeing-admin">';
        htmlSTR+='  <span class="direct-chat-img-reply-small pull-left"></span>';
        htmlSTR+='</div>';
    }

        return htmlSTR;
}

function userChatLoadForUser()
{
    $.ajax({
        'async': false,
        'type': "POST",
        'global': false,
        'dataType': 'json',
        'url': chatMessloUrl,
        'data': {'loaUID':chatInterfaceUserID,'_token':csrftLarVe},
        'success': function (data) {
            console.log(data); 
            
            if(data.length>0)
            {
                $.each(data,function(key,row){
                    console.log(row);
                    var usrMessage=userChatPushTemplate(row.id,row.from_user_id,row.created_at,row.sent_time,chatInterfaceUserName,row.chat_message);
                    $(".typeing-admin").hide();
                    $(".direct-chat-msg").append(usrMessage);
                }); 

            }
        }
    }); 
}

function userChatLoadInInterval()
{
    $.ajax({
        'async': false,
        'type': "POST",
        'global': false,
        'dataType': 'json',
        'url': chatMessloUrl,
        'data': {'loaUID':chatInterfaceUserID,'_token':csrftLarVe},
        'success': function (data) {
            console.log(data); 
            
            if(data.length>0)
            {
                $.each(data,function(key,row){
                    console.log(row);
                    //$("p[class!='intro']")

                    if($("div[ID='CHAT"+row.id+"']").length)
                    {
                        //alert('Data Match FOund');
                    }
                    else
                    {
                        var usrMessage=userChatPushTemplate(row.id,row.from_user_id,row.created_at,row.sent_time,chatInterfaceUserName,row.chat_message);
                        $(".typeing-admin").hide();
                        $(".direct-chat-msg").append(usrMessage);
                    }
                }); 

                chatShowScrollDown();

            }
        }
    }); 
}

function initiateChatHistory()
{
    $(".initiateMSGCHat").html("Please wait. Loading chat history....");
    $(".direct-chat-msg").hide();
    userChatLoadForUser();
    $(".initiateMSGCHat").html("Conversation Started");
    $(".direct-chat-msg").show();

    chatShowScrollDown();
}

function chatShowScrollDown()
{
    $('.popup-messages').animate({scrollTop:$('.direct-chat-msg').height()+60000}, 'slow');
}

$(document).ready(function(){	

    

	$("#supportChatStart").click(function () {
  		$('#supportChatPopup').addClass('popup-box-on');
        initiateChatHistory();
	    chatShowScrollDown();

        setInterval(function(){ userChatLoadInInterval(); }, 5000);
    });
  
    $("#removeClass").click(function () {
  		$('#supportChatPopup').removeClass('popup-box-on');
    });

    /*$('.submit').click(function() {
      newMessage();
    });*/

    $("#status_message").on('keypress',function(e) {
      if (e.which == 13) {
        $("#messageSend").click();
        return false;
      }
    });

    $("#messageSend").click(function(){
	    var message = $("#status_message").val();
        if(message.length>0)
        {
            var uniqTimeLo = new Date().getUTCMilliseconds();
            //alert(uniqTimeLo);
            $(".typeing-admin").hide();
            var usrMessage=userChatSingleTemplate(uniqTimeLo,chatInterfaceUserName,message);
            console.log(usrMessage);
            $(".direct-chat-msg").append(usrMessage);
            $("#status_message").val("");
            $.ajax({
                'async': false,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': chatMessSendUrl,
                'data': {'message':message,'_token':csrftLarVe},
                'success': function (data) {
                    console.log(data); 
                    if(data.status>0)
                    {

                        //<span id="AdminText"></span>
                        $("div[data-chat="+uniqTimeLo+"]").attr('id','CHAT'+data.id);
                        $("span[data-chat="+uniqTimeLo+"]").html('Delivered');
                        $("span[data-chat="+uniqTimeLo+"]").html(data.sendtime);
                        chatShowScrollDown();

                        //userChatLoadForUser();
                    }
                    else
                    {
                        $("span[data-chat="+uniqTimeLo+"]").html('Failed to send');
                    }
                    chatShowScrollDown();
                }
            }); 
        }
        
	});


});


function changeProfile() 
{
        $('#file').click();
}

$('#file').change(function () {
    if ($(this).val() != '') {
        upload(this);

    }
});

function upload(img) {
    var form_data = new FormData();
    form_data.append('file', img.files[0]);
    form_data.append('_token', csrftLarVe);
    $('#loading').css('display', 'block');
    $.ajax({
        url: chatMessPhotoUrl,
        data: form_data,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.fail) {
                alert(data.errors['file']);
            }
            else {
                console.log(data);
                $('#file_name').val(data);
            }
            //$('#loading').css('display', 'none');
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
            //$('#preview_image').attr('src', '{{asset('images/noimage.jpg')}}');
        }
    });
}