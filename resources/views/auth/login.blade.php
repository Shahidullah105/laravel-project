{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>


 --}}


 
@include('layouts.header')
<body class="authentication-bg">
    <div class="account-pages my-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-6 p-4">
                                    <div class="mx-auto">
                                        <a href="index.html">
                                            <img src="assets/images/logo-dark.png" alt="" height="24" />
                                        </a>
                                    </div>

                                    <h6 class="h5 mb-0 mt-3">Welcome back!</h6>
                                    <p class="text-muted mt-1 mb-4">
                                        Enter your email address and password to access admin panel.
                                    </p>

                                    <form method="POST" action="{{ route('login') }} ">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Email Address</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="icon-dual" data-feather="mail"></i>
                                                </span>
                                                <input type="email" class="form-control" name="email"  placeholder="Enter your Email">
                                               
                                            </div>
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <a href="pages-recoverpw.html" class="float-end text-muted text-unline-dashed ms-1">Forgot your password?</a>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="icon-dual" data-feather="lock"></i>
                                                </span>
                                                <input type="password" class="form-control" name="password" placeholder="Enter your password">
                                                
                                            </div>
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                                <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                            </div>
                                        </div>

                                        <div class="mb-3 text-center d-grid">
                                            <button class="btn btn-primary" type="submit">Log In</button>
                                        </div>
                                    </form>

                                    <div class="py-3 text-center"><span class="fs-16 fw-bold">OR</span></div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <a href="#" class="btn btn-white mb-2 mb-sm-0"><i class='uil uil-google icon-google me-2'></i>With Google</a>
                                            <a href="#" class="btn btn-white mb-2 mb-sm-0"><i class='uil uil-facebook me-2 icon-fb'></i>With Facebook</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-none d-md-inline-block">
                                    <div class="auth-page-sidebar">
                                        <div class="overlay"></div>
                                        <div class="auth-user-testimonial">
                                            <p class="fs-24 fw-bold text-white mb-1">I simply love it!</p>
                                            <p class="lead">"It's a elegent templete. I love it very much!"</p>
                                            <p>- Admin User</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-muted">Don't have an account? <a href="pages-register.html" class="text-primary fw-bold ms-1">Sign Up</a></p>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
  
    <script src="{{asset('admin')}}/assets/js/vendor.min.js"></script>
    <script src="{{asset('admin')}}/assets/js/app.min.js"></script>
</body>


</html>


