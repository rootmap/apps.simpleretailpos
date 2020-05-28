<div class="container text-center" style="display: none;">
    <div class="row">
        <div class="round hollow text-right" style="position:fixed; z-index: 9999; bottom: 100px; right: 150px;">
          <a href="javascript:void(0);" id="supportChatStart"><span class="icon-android-chat"></span> Chat with support </a>
        </div>
    </div>
</div>

<div class="popup-box chat-popup" id="supportChatPopup">
  <div class="popup-head">
    <div class="popup-head-left pull-left">
          <div class="direct-chat-info clearfix">
            <span class="direct-chat-img-reply-small pull-left" style="margin: 4px 8px;">
            </span>
            <span class="direct-chat-reply-name" style="color:#228EB6; line-height: 26px; margin: 0 0 0 0px; text-transform: capitalize; font-weight: 700;">Support Admin</span>
          </div>
    </div>
    <div class="popup-head-right pull-right">                     
        <button style="border: 0px; cursor: pointer;" data-widget="remove" id="removeClass" class="chat-header-button pull-right" type="button"><i style="border: none;" class="icon-cancel-circle"></i>
        </button>
    </div>
  </div>
  <div class="popup-messages">
      <div class="direct-chat-messages">
          <div class="chat-box-single-line">
            <abbr class="sbc_timestamp initiateMSGCHat">Conversion started</abbr>
          </div>      
          <div class="direct-chat-msg doted-border">

            
          </div>
      </div>
      <input type="hidden" id="SendUserID" name="SendUserID" value="{{ Auth::user()->id }}">
  </div>
  <div class="popup-messages-footer">
      <input id="status_message" placeholder="Type a message..." name="message">
      <div class="btn-footer">
          <button class="btn btn-info" onclick="javascript:changeProfile();">Upload <i class="icon-camera6"></i></button>
          <button class="btn btn-info pull-right" id="messageSend">Send <i class="icon-android-chat"></i> 
          </button>
      </div>
  </div>
</div>

<input type="file" id="file" style="display: none"/>
<input type="hidden" id="file_name"/>