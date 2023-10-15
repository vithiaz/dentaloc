<nav id="main-navbar">
    <div class="container">
        <div class="content-wrapper">
            <div class="logo-wrapper">
                <div class="logo-container">
                    <img src="{{ asset('image/logo-img.png') }}"/>                
                </div>
                <span class="logo-title"><span class="title-bold">DENTAL</span>OC</span>
            </div>
            <ul class="menu-wrapper">
                <li><a href="{{ route('homepage') }}">BERANDA</a></li>
                <li><a href="{{ route('clinic-list') }}">KLINIK</a></li>
                @auth
                    <li><a href="{{ route('admin.clinic-list') }}">ADMIN PANEL</a></li>
                    <li class="button-li">
                        <button onclick="location.href='/logout'" class="button-default logout-button ico hovered">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            <span>Logout</span>
                        </button>
                    </li>
                @else
                    <li class="button-li"><button onclick="showLogin()" class="button-default"><i class="fa-solid fa-right-to-bracket"></i></button></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>