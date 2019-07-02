<?php 
$navClass="bg-purple bg-darken-1";
$objSite=StaticDataController::navClass();
if(!empty($objSite))
{
    $navClass=$objSite;
}
?>


<nav class="header-navbar navbar navbar-with-menu navbar-fixed-top {{$navClass}} navbar-dark navbar-shadow  navbar-border">
      <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav">
            <li class="nav-item mobile-menu hidden-md-up float-xs-left">
              <a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a>
            </li>
            <li class="nav-item">
              <a href="{{url('dashboard')}}" class="navbar-brand nav-link">
                <img alt="branding logo" 
                      src="{{url('images/logo/logo-white.png')}}" 
                      data-expand="{{url('images/logo/logo-white.png')}}" 
                      data-collapse="{{url('images/logo/logo-white.png')}}" class="brand-logo')}}"></a>
            </li>
            <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x icon-icon-rotate-right-right"></i></a></li>
          </ul>
        </div>
        <style type="text/css">
          .header-navbar .navbar-header .navbar-brand
          {
                padding: 3px 6px !important;
          }
        </style>
        <div class="navbar-container content container-fluid">
          <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
            <ul class="nav navbar-nav">
              <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5"></i></a></li>
              <!-- <li class="nav-item nav-search"><a href="#" class="nav-link nav-link-search fullscreen-search-btn"><i class="ficon icon-search7"></i></a></li>
              <li class="nav-item hidden-sm-down"><a href="#" class="nav-link nav-link-expand"><i class="ficon icon-expand2"></i></a></li> -->
              <!-- <li class="dropdown nav-item mega-dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link">Mega</a>
                <ul class="mega-dropdown-menu dropdown-menu row">
                  <li class="col-md-2">
                    <h6 class="dropdown-menu-header text-uppercase mb-1"><i class="icon-paper"></i> News</h6>
                    
                  </li>
                  <li class="col-md-3">
                    <h6 class="dropdown-menu-header text-uppercase"><i class="icon-shuffle3"></i> Drill down menu</h6>
                    <ul class="drilldown-menu">
                      <li class="menu-list">
                        <ul>
                          <li><a href="layout-2-columns.html" class="dropdown-item"><i class="icon-layout"></i> Page layouts & Templates</a></li>
                          <li><a href="#"><i class="icon-layers"></i> Multi level menu</a>
                            <ul>
                              <li><a href="#" class="dropdown-item"><i class="icon-share4"></i>  Second level</a></li>
                              <li><a href="#"><i class="icon-umbrella3"></i> Second level menu</a>
                                <ul>
                                  <li><a href="#" class="dropdown-item"><i class="icon-microphone2"></i>  Third level</a></li>
                                  <li><a href="#" class="dropdown-item"><i class="icon-head"></i> Third level</a></li>
                                  <li><a href="#" class="dropdown-item"><i class="icon-signal2"></i> Third level</a></li>
                                  <li><a href="#" class="dropdown-item"><i class="icon-camera8"></i> Third level</a></li>
                                </ul>
                              </li>
                              <li><a href="#" class="dropdown-item"><i class="icon-flag4"></i> Second level, third link</a></li>
                              <li><a href="#" class="dropdown-item"><i class="icon-box"></i> Second level, fourth link</a></li>
                            </ul>
                          </li>
                          <li><a href="color-palette-primary.html" class="dropdown-item"><i class="icon-marquee-plus"></i> Color pallet system</a></li>
                          <li><a href="sk-2-columns.html" class="dropdown-item"><i class="icon-edit2"></i> Page starter kit</a></li>
                          <li><a href="changelog.html" class="dropdown-item"><i class="icon-files-empty"></i> Change log</a></li>
                          <li><a href="http://support.pixinvent.com/" class="dropdown-item"><i class="icon-tencent-weibo"></i> Customer support center</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li class="col-md-3">
                    <h6 class="dropdown-menu-header text-uppercase"><i class="icon-list2"></i> Accordion</h6>
                    <div id="accordionWrap" role="tablist" aria-multiselectable="true">
                      <div class="card no-border box-shadow-0 collapse-icon accordion-icon-rotate">
                        <div id="headingOne" role="tab" class="card-header p-0 pb-1 no-border"><a data-toggle="collapse" data-parent="#accordionWrap" href="#accordionOne" aria-expanded="true" aria-controls="accordionOne" class="card-title">Accordion Group Item #1</a></div>
                        <div id="accordionOne" role="tabpanel" aria-labelledby="headingOne" aria-expanded="true" class="card-collapse collapse in">
                          <div class="card-body">
                            <p class="accordion-text">Caramels dessert chocolate cake pastry jujubes bonbon. Jelly wafer jelly beans. Caramels chocolate cake liquorice cake wafer jelly beans croissant apple pie.</p>
                          </div>
                        </div>
                        <div id="headingTwo" role="tab" class="card-header p-0 pb-1 no-border"><a data-toggle="collapse" data-parent="#accordionWrap" href="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo" class="card-title collapsed">Accordion Group Item #2</a></div>
                        <div id="accordionTwo" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" class="card-collapse collapse">
                          <div class="card-body">
                            <p class="accordion-text">Sugar plum bear claw oat cake chocolate jelly tiramisu dessert pie. Tiramisu macaroon muffin jelly marshmallow cake. Pastry oat cake chupa chups.</p>
                          </div>
                        </div>
                        <div id="headingThree" role="tab" class="card-header p-0 pb-1 no-border"><a data-toggle="collapse" data-parent="#accordionWrap" href="#accordionThree" aria-expanded="false" aria-controls="accordionThree" class="card-title collapsed">Accordion Group Item #3</a></div>
                        <div id="accordionThree" role="tabpanel" aria-labelledby="headingThree" aria-expanded="false" class="card-collapse collapse">
                          <div class="card-body">
                            <p class="accordion-text">Candy cupcake sugar plum oat cake wafer marzipan jujubes lollipop macaroon. Cake dragée jujubes donut chocolate bar chocolate cake cupcake chocolate topping.</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="col-md-4">
                    <h6 class="dropdown-menu-header text-uppercase mb-1"><i class="icon-mail6"></i> Contact Us</h6>
                    <form>
                      <fieldset class="form-group position-relative has-icon-left">
                        <label for="inputName1" class="col-sm-3 form-control-label">Name</label>
                        <div class="col-sm-9">
                          <input type="text" id="inputName1" placeholder="John Doe" class="form-control">
                          <div class="form-control-position"><i class="icon-head"></i></div>
                        </div>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left">
                        <label for="inputEmail1" class="col-sm-3 form-control-label">Email</label>
                        <div class="col-sm-9">
                          <input type="email" id="inputEmail1" placeholder="john@example.com" class="form-control">
                          <div class="form-control-position"><i class="icon-mail6"></i></div>
                        </div>
                      </fieldset>
                      <fieldset class="form-group position-relative has-icon-left">
                        <label for="inputMessage1" class="col-sm-3 form-control-label">Message</label>
                        <div class="col-sm-9">
                          <textarea id="inputMessage1" rows="2" placeholder="Simple Textarea" class="form-control"></textarea>
                          <div class="form-control-position"><i class="icon-file-text"></i></div>
                        </div>
                      </fieldset>
                      <div class="col-sm-12 mb-1">
                        <button type="button" class="btn btn-primary float-xs-right"><i class="icon-send-o"></i> Send</button>
                      </div>
                    </form>
                  </li>
                </ul>
              </li> -->
              <!-- <li class="dropdown nav-item mega-dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link">Custom Page</a>
                <ul class="mega-dropdown-menu dropdown-menu row">
                  
                  <li class="col-md-3">
                    <h6 class="dropdown-menu-header text-uppercase"><i class="icon-shuffle3"></i> Custom Page</h6>
                    <ul class="drilldown-menu">
                      <li class="menu-list">
                        <ul>
                         
                        </ul>
                      </li>
                    </ul>
                  </li>
                  
                  
                </ul>
              </li> -->
            </ul>
            <ul class="nav navbar-nav float-xs-right">
              

              <li class="dropdown dropdown-user nav-item"><a href="#" data-toggle="dropdown" class="dropdown-toggle nav-link dropdown-user-link"><span class="avatar avatar-online"><img src="{{url('theme/app-assets/images/portrait/small/avatar-s-1.png')}}" alt="avatar"><i></i></span><span class="user-name">{{Auth::user()->name}}</span></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <!-- <a href="#" class="dropdown-item"><i class="icon-head"></i> Edit Profile</a>
                  <a href="#" class="dropdown-item"><i class="icon-mail6"></i> My Inbox</a>
                  <a href="#" class="dropdown-item"><i class="icon-clipboard2"></i> Task</a>
                  <a href="#" class="dropdown-item"><i class="icon-calendar5"></i> Calender</a> -->
                  <div class="dropdown-divider"></div>
                  <form method="post" id="logoutME" action="{{url('logout')}}" >
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <button class="link-login btn dropdown-item" href="{{url('logout')}}" title="logout" rel="nofollow"><i class="icon-power3"></i> Logout</button>
                  </form>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>