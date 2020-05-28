<?php 
$proImage=url('chat/user.png');
?>
<!DOCTYPE html>
<html class=''>
<head>
  <meta charset='UTF-8'><meta name="robots" content="noindex">
  <meta name="pos-token" content="{{ csrf_token() }}">
  <meta name="chat-user-avater" content="{{$proImage}}">
  <link rel="shortcut icon" type="image/x-icon" href="//production-assets.codepen.io/assets/favicon/favicon-8ea04875e70c4b0bb41da869e81236e54394d63638a1ef12fa558a4a835f1164.ico" />
  <link rel="mask-icon" type="" href="//production-assets.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
  <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700,300' rel='stylesheet' type='text/css'>

  <script src="https://use.typekit.net/hoy3lrg.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->

  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->

  <script>try{Typekit.load({ async: true });}catch(e){}</script>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
  <link rel='stylesheet' href="{{url('chat/master.css')}}">
  </head>
  <body>
<!-- 

A concept for a chat interface. 

Try writing a new message! :)


Follow me here:
Twitter: https://twitter.com/thatguyemil
Codepen: https://codepen.io/emilcarlsson/
Website: http://emilcarlsson.se/

-->

<div id="frame">
	<div id="sidepanel">
		<div id="profile">
			<div class="wrap">
				<img id="profile-img" src="{{$proImage}}" class="online" alt="" />
				<p>Support Admin</p>
			</div>
		</div>
		{{-- <div id="search">
			<label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
			<input type="text" placeholder="Search contacts..." />
		</div> --}}
		<div id="contacts">
			<ul class="allLoadContacts">
				<li class="contact">
					<div class="wrap">
						<span class="contact-status online"></span>
						<img src="{{$proImage}}" alt="" />
						<div class="meta">
							<p class="name">Loading..</p>
							<p class="preview">Loading... <span style="text-align: right; float: right; padding-right: 70px;">Loading...</span></p>
						</div>
					</div>
				</li>
				
			</ul>
		</div>
		{{-- <div id="bottom-bar">
			<button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add contact</span></button>
			<button id="settings"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button>
		</div> --}}
	</div>
	<div class="content">
		<div class="contact-profile">
			<img src="{{$proImage}}" alt="" />
			<p>Harvey Specter</p>
    </div>
    <h3 class="messSelectUser" style="margin-top: 45%; text-align: center;">Please select a user.</h3>
    <div class="messages" style="display: none;">
     <ul class="messageLoadAreaCOntent">
      <li class="sent">
       <img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
        <p>How the hell am I supposed to get a jury to believe you when I am not even sure that I do?!
          <br>
          <span class="masterchatTimestamp">03:44 PM</span>
        </p>
     </li>
     <li class="replies">
       <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
        <p>
          When you're backed against the wall, break the god damn thing down.
          <br>
          <span class="masterchatTimestamp">03:44 PM</span>
        </p>
     </li>
     
   </ul>
 </div>
 <div class="message-input">
   <div class="wrap">
     <input type="text" class="currentMessageUserCon" data-user-id="0" placeholder="Write your message..." />
     <i class="fa fa-camera attachment"  onclick="javascript:changeProfile();" aria-hidden="true"></i>
     <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>

      <input type="file" id="file" style="display: none"/>
      <input type="hidden" id="file_name"/>
   </div>
 </div>
</div>
</div>
<script type="text/javascript">
  var csrftLarVe=$('meta[name="pos-token"]').attr('content');
  var masterChatUser="{{url('master/chat/alluser')}}";
  var masterChatLoadConversationUser="{{url('master/chat/load/conversation')}}";
  var masterChatSaveConUser="{{url('master/chat/save/conversation')}}";
  var masterChatUserAvater=$('meta[name="chat-user-avater"]').attr('content');
  var chatMessPhotoUrl="{{url('master/chat/conv/usr/image')}}";
</script>
<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
<script src="{{url('chat/sc-master.js')}}"></script>
<script >

$('.contact-profile').hide();

$("#profile-img").click(function() {
	$("#status-options").toggleClass("active");
  $(".messSelectUser").hide();
  $('.contact-profile').show();
  $(".messages").show();
  $(".messages").animate({ scrollTop: $(document).height() }, "fast");
});

$(".expand-button").click(function() {
  $("#profile").toggleClass("expanded");
  $("#contacts").toggleClass("expanded");
});

$("#status-options ul li").click(function() {
	$("#profile-img").removeClass();
	$("#status-online").removeClass("active");
	$("#status-away").removeClass("active");
	$("#status-busy").removeClass("active");
	$("#status-offline").removeClass("active");
	$(this).addClass("active");
	
	if($("#status-online").hasClass("active")) {
		$("#profile-img").addClass("online");
	} else if ($("#status-away").hasClass("active")) {
		$("#profile-img").addClass("away");
	} else if ($("#status-busy").hasClass("active")) {
		$("#profile-img").addClass("busy");
	} else if ($("#status-offline").hasClass("active")) {
		$("#profile-img").addClass("offline");
	} else {
		$("#profile-img").removeClass();
	};
	
	$("#status-options").removeClass("active");
});


//# sourceURL=pen.js
</script>
</body></html>