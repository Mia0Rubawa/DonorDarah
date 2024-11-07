  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">



      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
          <div class="sidebar-brand-icon rotate-n-15">
              <i class="fas fa-laugh-wink"></i>
          </div>
          <div class="sidebar-brand-text mx-3">{{ env('APP_NAME') }} </div>
      </a>
      <!-- Divider -->
      @switch(SendResponse::determineAuth())
          @case('web')
              {{-- SUPER --}}
              @include('akun.layouts.list_menu.super')
          @break

          @case('individu')
              @include('akun.layouts.list_menu.individu')
          @break

          @default
              
      @endswitch


  </ul>
  <!-- End of Sidebar -->
