<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="shadow-bottom"></div>

        <ul class="list-unstyled menu-categories" id="accordionExample">

            <li class="menu">
                <a href="{{ route('frontoffice.home') }}" aria-expanded="false" class="dropdown-toggle" @if(Route::currentRouteName() == 'frontoffice.home') data-active="true"  @else data-active="false"  @endif>
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span> Accueil</span>
                    </div>
                </a>
            </li>

            <li class="menu">
                <a href="#Couriels" data-toggle="collapse"  @if( (Route::currentRouteName() == 'frontoffice.categorymail.list')||(Route::currentRouteName() == 'frontoffice.mail.list') || (Route::currentRouteName() == 'frontoffice.mail.list.trash')) aria-expanded="true" data-active="true"   @else aria-expanded="false" data-active="false"  @endif class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>                        <span>Couriels</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled  @if((Route::currentRouteName() == 'frontoffice.categorymail.list')||(Route::currentRouteName() == 'frontoffice.mail.list') || (Route::currentRouteName() == 'frontoffice.mail.list.trash') || (Route::currentRouteName() == 'frontoffice.mail.list.archive') || (Route::currentRouteName() == 'frontoffice.mail.request.list')) show  @endif " id="Couriels" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('frontoffice.mail.list') }}"> Courriers </a>
                    </li>
                    <li>
                        <a href="{{ route('frontoffice.mail.list.trash') }}"> Corbiel</a>
                    </li>
                    <li>
                        <a href="{{ route('frontoffice.mail.list.archive') }}"> Archive</a>
                    </li>
                    <li>
                        <a href="{{ route('frontoffice.mail.request.list') }}"> Demande d'envoi</a>
                    </li>

                </ul>
            </li>
            <li class="menu">
                <a href="{{ route('frontoffice.my.subscription') }}" aria-expanded="false" class="dropdown-toggle" @if(Route::currentRouteName() == 'frontoffice.my.subscription') data-active="true"  @else data-active="false"  @endif>
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>                        <span> Mon plan</span>
                    </div>
                </a>
            </li>
        </ul>

    </nav>

</div>