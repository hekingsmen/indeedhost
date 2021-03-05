<div class="sidebar" data-color="purple" data-background-color="white" data-image="https://www.indeedhost.seller2seller.com/sliders/6309_2.png">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"
        Tip 2: you can also add an image using data-image tag
      -->

      <div class="logo"><a href="{{ route('home') }}" class="simple-text logo-normal"> Indeed Host </a></div>

      <div class="sidebar-wrapper">

        <ul class="nav">


          @if( Auth::user()->is_admin == 1 )

            <li class="nav-item @if(Request::route()->getName()=='admin.home') active @endif ">
              <a class="nav-link" href="{{route('admin.home')}}">
                <i class="material-icons">dashboard</i>
                <p>Dashboard</p>
              </a>
            </li>

          @endif


            <li class="nav-item @if(Request::route()->getName()=='Viewprofile') active @endif ">
              <a class="nav-link" href="{{route('Viewprofile')}}">
                <i class="material-icons">person</i>
                <p>My Profile</p>
              </a>
            </li>

            <li class="nav-item @if(Request::route()->getName()=='userOrder') active @endif ">
              <a class="nav-link" href="{{route('userOrder')}}">
                <i class="material-icons">person</i>
                <p>Order History</p>
              </a>
            </li>

          @if( Auth::user()->is_admin == 1 )

            <li class="nav-item @if(Request::route()->getName()=='admin.users.index' || Request::route()->getName()=='admin.users.edit' || Request::route()->getName()=='admin.users.create') active @endif ">
              <a class="nav-link " href="{{route('admin.users.index')}}">
                <i class="material-icons">person</i>
                <p>Users</p>
              </a>
            </li>


            <li class="nav-item  @if(Request::route()->getName()=='admin.sliders' ||
              Request::route()->getName()=='admin.slider.edit' ||
              Request::route()->getName()=='admin.slider.create') active @endif ">

                <a class="nav-link  " href="{{route('admin.sliders')}}">
                  <i class="material-icons">content_paste</i>
                  <p>Sliders</p>
                </a>
            </li>

            <li class="nav-item
              @if(Request::route()->getName()=='admin.offers' || Request::route()->getName()=='offers.create' || Request::route()->getName()=='admin.offers.edit' ) active @endif  ">

              <a class="nav-link" href="{{ route('admin.offers') }}">
                <i class="material-icons">bubble_chart</i>
                <p>Offers</p>
              </a>
            </li>

            <li class="nav-item @if(Request::route()->getName()=='admin.features' ||
              Request::route()->getName()=='admin.feature.edit' ||
              Request::route()->getName()=='admin.feature.create' ) active @endif ">

                <a class="nav-link" href="{{route('admin.features')}}">
                  <i class="material-icons">content_paste</i>
                  <p>Features</p>
                </a>
            </li>


            <li class="nav-item @if( Request::route()->getName()=='admin.UserRoles' ||
              Request::route()->getName()=='admin.editrole' ||
              Request::route()->getName()=='admin.addrole' ) active @endif ">

                <a class="nav-link" href="{{route('admin.UserRoles')}}">
                  <i class="material-icons">bubble_chart</i>
                  <p>User Roles</p>
                </a>
            </li>

            <li class="nav-item @if(Request::route()->getName()=='admin.orderslist' ||
              Request::route()->getName()=='admin.orderview' ) active @endif ">

              <a class="nav-link" href="{{route('admin.orderslist')}}">
                <i class="material-icons">content_paste</i>
                <p>Orders</p>
              </a>
            </li>

            <li class="nav-item @if(Request::route()->getName()=='admin.hostings.index' ||
              Request::route()->getName()=='admin.hostings.edit' ||
              Request::route()->getName()=='admin.hostings.create') active @endif ">

              <a class="nav-link" href="{{route('admin.hostings.index')}}">
                <i class="material-icons">library_books</i>
                <p>Hosting Plan</p>
              </a>
            </li>


            <li class="nav-item
            @if(Request::route()->getName()=='admin.about.to.expire' || Request::route()->getName()=='admin.hosting.overview') active @endif ">
              <a class="nav-link" href="{{ route('admin.about.to.expire') }}">
                <i class="material-icons">library_books</i>
                <p>Hosting About To Expire</p>
              </a>
            </li>

            <li class="nav-item @if( Request::route()->getName()=='admin.todays.sale' || Request::route()->getName()=='sale.overview' ) active @endif ">
              <a class="nav-link" href="{{ route('admin.todays.sale') }}">
                <i class="material-icons">library_books</i>
                <p>Today's Sale</p>
              </a>
            </li>

            <li class="nav-item
            @if(Request::route()->getName()=='admin.routesmanager.index' || Request::route()->getName()=='admin.routesmanager.edit' || Request::route()->getName()=='admin.routesmanager.create') active @endif ">

              <a class="nav-link" href="{{route('admin.routesmanager.index')}}">
                <i class="material-icons">bubble_chart</i>
                <p>Routes Manager</p>
              </a>
            </li>

            <li class="nav-item
              @if(Request::route()->getName()=='admin.contact.list' ) active @endif  ">

              <a class="nav-link" href="{{ route('admin.contact.list') }}">
                <i class="material-icons">bubble_chart</i>
                <p>Contact Us List</p>
              </a>
            </li>

            <li class="nav-item
              @if(Request::route()->getName()=='admin.contact.page.detail' ) active @endif  ">

              <a class="nav-link" href="{{ route('admin.contact.page.detail') }}">
                <i class="material-icons">bubble_chart</i>
                <p>Contact Page Detail</p>
              </a>
            </li>

          @endif


        </ul>

      </div>

    </div>