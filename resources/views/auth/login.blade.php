<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>DOST-IMS</title>
    
    <link rel="stylesheet" href="{{ asset('css/popterms.css') }}">
    <script defer src="{{ asset('js/popterms.js') }}"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" >
    <link rel="stylesheet" href="{{ asset('css/login_page.css') }}">
</head>
    <body>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="whole-container">
            <!-- Title Header !-->
            <div class="title-block">
                <div class="text-center"><b>Indicators</b></div>
                <div class="text-center"><b>Management System</b></div>
            </div>

            <div class="form-block">
                <div class="form-container">
                    <div class="text-welcome">Welcome</div>

                    <div class="text-enter"><i>Enter your email address and password to sign in</i></div>

                    <div class="input-container">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="fields-container">
                                <!-- Email and Password -->
                                <div class="email-container">
                                    <input  id="email"
                                            type="email" name="email" 
                                            :value="old('email')" 
                                            required 
                                            autofocus 
                                            autocomplete="username" 
                                            placeholder="Enter your email address here" 
                                    />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div class="pw-container">
                                    <input  id="password"
                                            type="password"
                                            name="password"
                                            required 
                                            autocomplete="current-password" 
                                            placeholder="Enter your password here"
                                    />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Remember Me -->
                                <div class="remember-container">
                                    <div class="checkbox-container"><input type="checkbox" name="remember"></div>
                                    <div class="label-remember"><label for="remember_me">Remember me</label></div>
                                </div>
                                
                                <!-- Submit Buttom -->
                                <div class="submit-container">
                                    <input type="submit" class="input-submit" value="SIGN IN">
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="action-forgot-pw">Forgot password</a>
                        @endif
                    </div>

                    <div>
                        <div class="text-terms">
                            By using this service, you understood and agree to the DOST DX <a data-pop-target="#terms"><b>Terms of Use</b> and <b>Privacy Statement</b></a>.
                        </div>
                        <div class="terms" id="terms">
                            <div class="popterms">
                                <div class="title">Terms of Use and Privacy Statement</div>
                                <button data-close-button class="close-button">&times;</button>
                            </div>
                            <div class="termscontent">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. 
                                Voluptate laborum eius, doloremque adipisci modi sed. 
                                Itaque, quidem laboriosam saepe animi, 
                                autem eos rerum ab obcaecati neque labore beatae doloremque soluta?
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                                Maiores excepturi officia recusandae animi nihil, quis, est commodi, 
                                praesentium numquam velit vero illo. Vel asperiores voluptates, 
                                deleniti quaerat doloribus veniam incidunt!
                            </div>
                        </div>
                        <div id="overlay"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

