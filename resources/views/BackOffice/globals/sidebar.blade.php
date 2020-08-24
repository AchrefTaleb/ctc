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
                <a href="{{ route('backoffice.client.list') }}" aria-expanded="false" class="dropdown-toggle" @if(Route::currentRouteName() == 'backoffice.client.list') data-active="true"  @else data-active="false"  @endif>
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        <span>Client</span>
                    </div>
                </a>
            </li>

            <li class="menu">
                <a href="#Couriels" data-toggle="collapse"  @if( (Route::currentRouteName() == 'backoffice.categorymail.list')||(Route::currentRouteName() == 'backoffice.mail.list') || (Route::currentRouteName() == 'backoffice.mail.list.trash') || (Route::currentRouteName() == 'backoffice.mail.list.archive') || (Route::currentRouteName() == 'backoffice.mail.request.list')) aria-expanded="true" data-active="true"   @else aria-expanded="false" data-active="false"  @endif class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>                        <span>Couriels</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled  @if((Route::currentRouteName() == 'backoffice.categorymail.list')||(Route::currentRouteName() == 'backoffice.mail.list') || (Route::currentRouteName() == 'backoffice.mail.list.trash')) show  @endif " id="Couriels" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('backoffice.categorymail.list') }}"> Catégories </a>
                    </li>
                    <li>
                        <a href="{{ route('backoffice.mail.list') }}"> Courriers </a>
                        <a href="{{ route('backoffice.mail.request.list') }}"> Liste des demandes </a>
                    </li>
                    <li>
                        <a href="{{ route('backoffice.mail.list.trash') }}"> Corbiel</a>
                    </li>
                    <li>
                        <a href="{{ route('backoffice.mail.list.archive') }}"> Archive</a>
                    </li>

                </ul>
            </li>
            <li class="menu">
                <a href="#plans" data-toggle="collapse"  @if( (Route::currentRouteName() == 'backoffice.plan.list')||(Route::currentRouteName() == 'backoffice.plan.custom.create') ) aria-expanded="true" data-active="true"   @else aria-expanded="false" data-active="false"  @endif class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>                        <span>Plans</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled  @if((Route::currentRouteName() == 'backoffice.plan.list')||(Route::currentRouteName() == 'backoffice.plan.custom.create') ) show  @endif " id="plans" data-parent="#accordionExample">
                    <li>
                        <a href="{{ route('backoffice.plan.list') }}"> List des plan </a>
                    </li>
                    <li>
                        <a href="{{ route('backoffice.plan.custom.create') }}"> Ajouter </a>
                    </li>


                </ul>
            </li>


            <li class="menu">
                <a href="#settings" data-toggle="collapse"  @if( (Route::currentRouteName() == 'backoffice.staff.list')||(Route::currentRouteName() == 'backoffice.profile') ) aria-expanded="true" data-active="true"   @else aria-expanded="false" data-active="false"  @endif class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg> <span>Paramètre</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled  @if((Route::currentRouteName() == 'backoffice.staff.list')||(Route::currentRouteName() == 'backoffice.profile') ) show  @endif " id="settings" data-parent="#accordionExample">
                    <li class="menu">
                        <a href="{{ route('backoffice.staff.list') }}">
                          Equipe
                        </a>
                    </li>
                    <li class="menu">
                        <a href="{{ route('backoffice.profile') }}">
                          Profile
                        </a>
                    </li>


                </ul>
            </li>

        </ul>

    </nav>

</div>
