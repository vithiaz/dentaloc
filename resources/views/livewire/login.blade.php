<div wire:ignore.self id="login-sidenav" class="">
    <div class="overlay"></div>
    <div class="background">
        <div class="body">
            <div class="login-head-wrapper">
                <div class="logo-wrapper">
                    <div class="logo-container">
                        <img src="{{ asset('image/logo-img.png') }}"/>                
                    </div>
                    <span class="logo-title"><span class="title-bold">DENTAL</span>OC</span>
                </div>
                <button id="login-modal-close" class="button-default"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="login-form-wrapper">
                <span class="form-title">LOGIN</span>
                <form wire:submit='login' class="login-form input-form column-wrap">
                    <div class="form-floating mb-3">
                        <input wire:model='email' type="email" class="form-control default-input @error('email') is-invalid @enderror" placeholder="Email" id="login-username">
                        <label for="login-username">Email</label>
                        @error('email')
                            <small class="error">email wajib diisi</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input wire:model='password' type="password" class="form-control default-input @error('password') is-invalid @enderror" placeholder="Password" id="login-password">
                        <label for="login-password">Password</label>
                        @error('password')
                            <small class="error">password wajib diisi</small>
                        @enderror
                    </div>
                    @if (session('failed-login'))
                        <small class="error">{{ session('failed-login') }}</small>
                    @endif
                    <div class="button-wrapper">
                        <button type="submit" class="btn button-default login-button">LOGIN</button>
                        <div class="register-wrapper">
                            <span>belum punya akun ?</span>
                            <span><a href="#">Buat akun</a></span>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>


    @teleport('body')
    <script>
        let loginSideNav = $('#login-sidenav')

        function showLogin() {
            $('#login-sidenav').css('display', 'flex')
            
            setTimeout(function() {
                loginSideNav.addClass('show')
            }, 150);            
        }

        function hideLogin() {
            loginSideNav.removeClass('show')
            
            setTimeout(function() {
                $('#login-sidenav').css('display', 'none')
            }, 500);
        }
    
        $('#login-modal-close').click(function () {
            hideLogin()
        })

        loginSideNav.find('.overlay').first().click(function () {
            hideLogin()
        })
        
    
    </script>
    @endteleport
</div>

