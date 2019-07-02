<div data-scroll-to-active="true" class="main-menu menu-flipped menu-fixed menu-light menu-bordereded menu-accordion menu-shadow">
      <!-- main menu header-->
      <!-- / main menu header-->
      <!-- main menu content-->
      <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
          <li class="nav-item {{ Request::path() == 'dashboard' ? 'active' : '' }} border-bottom-purple">
            <a href="{{url('dashboard')}}">
              <i class="icon-dashboard"></i>
              <span data-i18n="nav.dash.main" class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item {{ Request::path() == 'counter-display' ? 'active' : '' }} border-bottom-purple">
            <a href="{{url('counter-display')}}">
              <i class="icon-dashboard"></i>
              <span data-i18n="nav.dash.main" class="menu-title">Counter Display</span>
            </a>
          </li>
        
        </ul>
      </div>

