<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="shadow-bottom"></div>

        <ul class="list-unstyled menu-categories" id="accordionExample">

            <li class="menu">
                <a href="{{ route('backoffice.home') }}" aria-expanded="false" class="dropdown-toggle" @if(Route::currentRouteName() == 'backoffice.home') data-active="true"  @else data-active="false"  @endif>
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span> Accueil</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="{{ route('backoffice.staff.list') }}" aria-expanded="false" class="dropdown-toggle" @if(Route::currentRouteName() == 'backoffice.staff.list') data-active="true"  @else data-active="false"  @endif>
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <span>Equipe</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="{{ route('backoffice.client.list') }}" aria-expanded="false" class="dropdown-toggle" @if(Route::currentRouteName() == 'backoffice.client.list') data-active="true"  @else data-active="false"  @endif>
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        <span>Client</span>
                    </div>
                </a>
            </li>

            <li class="menu">
                <a href="#Couriels" data-toggle="collapse"  @if(Route::currentRouteName() == 'backoffice.categorymail.list') aria-expanded="true" data-active="true"   @else aria-expanded="false" data-active="false"  @endif class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>                        <span>Couriels</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled  @if(Route::currentRouteName() == 'backoffice.categorymail.list') show  @endif " id="Couriels" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('backoffice.categorymail.list') }}"> Catégories </a>
                    </li>

                </ul>
            </li>

        </ul>

    </nav>

</div>
