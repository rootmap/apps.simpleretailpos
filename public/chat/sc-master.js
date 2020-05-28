function masterChatLoadAllUser()
{

    $.ajax({
        'async': false,
        'type': "GET",
        'global': false,
        'dataType': 'json',
        'url': masterChatUser,
        'data': {'_token':csrftLarVe},
        'success': function (data) {
            console.log(data); 

            if(data.total>0)
            {
                $(".allLoadContacts").html("");

                $.each(data.data,function(key,row){
                    var chatUser=contactListTemplate(row.from_user_id,row.user_name,row.chat_message,row.sent_time);
                    if($("li[id='CHUID"+row.from_user_id+"']").length)
                    {

                    }
                    else
                    {
                        $(".allLoadContacts").append(chatUser);
                    }
                });
                
            }
        }
    }); 
}



function contactListTemplate(userID,name,message,sentTime)
{
    var sHtml='';
        sHtml+='<li class="contact loadChatMaster" onclick="javascript:startMasterChat('+userID+')"  data-chatuserID="'+userID+'" data-chatuser="'+name+'" id="CHUID'+userID+'">';
        sHtml+='<div class="wrap">';
        sHtml+='    <span class="contact-status online"></span>';
        sHtml+='    <img src="'+masterChatUserAvater+'" alt="'+name+'" />';
        sHtml+='    <div class="meta">';
        sHtml+='        <p class="name">'+name+'</p>';
        sHtml+='        <p class="preview">'+message+' <span style="text-align: right; float: right; padding-right: 70px;">'+sentTime+'</span></p>';
        sHtml+='    </div>';
        sHtml+='</div>';
        sHtml+='</li>';

        return sHtml;
}

function conversationTemplate(rowID,userID,name,message,sentTime)
{
    if(userID==99999)
    {
        var sHtml='';
        sHtml+='<li class="replies" id="cconvDID'+rowID+'">';
        sHtml+='    <img src="'+masterChatUserAvater+'" alt="Admin" />';
        sHtml+='    <p>'+message;
        sHtml+='        <br>';
        sHtml+='        <span class="masterchatTimestamp">'+sentTime+'</span>';
        sHtml+='    </p>';
        sHtml+='</li>';
    }
    else
    {
        var sHtml='';
        sHtml+='<li class="sent" id="cconvDID'+rowID+'">';
        sHtml+='    <img src="'+masterChatUserAvater+'" alt="'+name+'" />';
        sHtml+='    <p>'+message;
        sHtml+='        <br>';
        sHtml+='        <span class="masterchatTimestamp">'+sentTime+'</span>';
        sHtml+='    </p>';
        sHtml+='</li>';
    }
    

        return sHtml;
}

function masterChatLoadUserConv()
{


    var UserID=$(".currentMessageUserCon").attr("data-user-id");
    $.ajax({
        'async': false,
        'type': "POST",
        'global': false,
        'dataType': 'json',
        'url': masterChatLoadConversationUser,
        'data': {'loaUID':UserID,'_token':csrftLarVe},
        'success': function (data) {
            console.log(data); 
            if(data.total>0)
            {
                $.each(data.datas,function(key,rows){
                    if($("li[id='cconvDID"+rows.id+"']").length)
                    {

                    }
                    else
                    {
                        var rowContent=conversationTemplate(rows.id,rows.from_user_id,rows.user_name,rows.chat_message,rows.sent_time);
                        $(".messageLoadAreaCOntent").append(rowContent);

                    }
                });

                chatShowScrollDown();
            }
            
        }
    }); 
}

function chatShowScrollDown()
{
    $('.messages').animate({scrollTop:$('.messages').height()+60000}, 'slow');
    //$(".messages").animate({ scrollTop: $(document).height() }, "fast");
}

function sendMessTemp(dataID,rowID,name,message,sentTime)
{
    var sHtml='';
        sHtml+='<li data-id="'+dataID+'" class="replies" id="cconvDID'+rowID+'">';
        sHtml+='    <img src="'+masterChatUserAvater+'" alt="'+name+'" />';
        sHtml+='    <p>'+message;
        sHtml+='        <br>';
        sHtml+='        <span class="masterchatTimestamp" data-id="'+dataID+'">'+sentTime+'</span>';
        sHtml+='    </p>';
        sHtml+='</li>';

    return sHtml;
}

function newMessage() {
    message = $(".message-input input").val();
    if($.trim(message) == '') {
        return false;
    }



    var sendSMS=sendMessage(message);
    
    //chatShowScrollDown();
    //$('.contact.active .preview').html('<span>You: </span>' + message);
};



function sendMessage(message)
{
    var uniqTimeLo = new Date().getUTCMilliseconds();
    var rowID=0;
    var name="Admin";
    var sentTime="Sending...";
    var usrMessage=sendMessTemp(uniqTimeLo,rowID,name,message,sentTime);
    console.log(usrMessage);
    $(".messageLoadAreaCOntent").append(usrMessage);
    $('.message-input input').val(null);
    var UserID=$(".currentMessageUserCon").attr("data-user-id");
    //alert(UserID);
    //return false;
    chatShowScrollDown();
    $.ajax({
        'async': false,
        'type': "POST",
        'global': false,
        'dataType': 'json',
        'url': masterChatSaveConUser,
        'data': {'loaUID':UserID,'message':message,'_token':csrftLarVe},
        'success': function (data) {
            console.log(data); 
            if(data.status>0)
            {
                $("li[data-id="+uniqTimeLo+"]").attr('id','cconvDID'+data.id);
                $("span[data-id="+uniqTimeLo+"]").html('Delivered');
                $("span[data-id="+uniqTimeLo+"]").html(data.sendtime);
                //chatShowScrollDown();
            }
            else
            {
                $("span[data-id="+uniqTimeLo+"]").html('Failed to send');
            }
            //chatShowScrollDown();
        }
    });
}

function startMasterChat(CHUID)
{
    //CHUID
    var dataLoadArea=$("#CHUID"+CHUID);
    $(dataLoadArea).addClass("active");
    var user_name=$(dataLoadArea).attr('data-chatuser');
    var user_id=$(dataLoadArea).attr('data-chatuserID');
    $(".messSelectUser").html("Loading chat conversation, please wait...");
    $(".currentMessageUserCon").attr("data-user-id",user_id);
    $(".messageLoadAreaCOntent").html("");
    masterChatLoadUserConv();
    $(".messSelectUser").hide();
    $('.contact-profile').show();
    $('.contact-profile').children('p').html(user_name);
    $(".messages").show();
    //$(".messages").animate({ scrollTop: $(document).height() }, "fast");
    chatShowScrollDown();

    setInterval(function(){ masterChatLoadUserConv(); }, 5000);
}

$(document).ready(function(){	

    masterChatLoadAllUser();
    $(".loadChatMaster").click(function(){
        $(this).addClass("active");
        var user_name=$(this).attr('data-chatuser');
        var user_id=$(this).attr('data-chatuserID');
        $(".messSelectUser").html("Loading chat conversation, please wait...");
        $(".currentMessageUserCon").attr("data-user-id",user_id);
        $(".messageLoadAreaCOntent").html("");
        masterChatLoadUserConv();
        $(".messSelectUser").hide();
        $('.contact-profile').show();
        $('.contact-profile').children('p').html(user_name);
        $(".messages").show();
        //$(".messages").animate({ scrollTop: $(document).height() }, "fast");
        chatShowScrollDown();

        setInterval(function(){ masterChatLoadUserConv(); }, 5000);
    });



    setInterval(function(){ masterChatLoadAllUser(); }, 5000);

    //masterChatLoadAllUser()


    $('.submit').click(function() {
      newMessage();
    });

    $(window).on('keydown', function(e) {
      if (e.which == 13) {
        newMessage();
        return false;
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
    var UserID=$(".currentMessageUserCon").attr("data-user-id");
    var form_data = new FormData();
    form_data.append('userLOA', UserID);
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