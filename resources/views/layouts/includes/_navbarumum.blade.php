<nav class="navbar navbar-default navbar-fixed-top">
    <div class="brand">
        <a href="/atk"><img src="{{asset('assets/img/canva-photo-editor3.png')}}" alt="Klorofil Logo"
                class="img-responsive logo"></a>
    </div>
    <div class="container-fluid">
        <div class="navbar-btn">
            <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
        </div>
        @yield('cari')
        <div id="navbar-menu">
            <ul class="nav navbar-nav navbar-right">

                <li><a href="/loginatk"><i class="lnr lnr-enter"></i> <span>Login</span></a></li>

            </ul>
        </div>
    </div>
</nav>