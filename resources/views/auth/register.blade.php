<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('instagram-logo.png') }}">
    <title>Login - DardanGram</title>
    @vite(['resources/css/login-register.css'])

    <script src="https://kit.fontawesome.com/87e420d556.js" crossorigin="anonymous"></script>
</head>
<body>
    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                <h1 class="opacity">REGISTER</h1>
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <input type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="NAME" />

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="USERNAME" />

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="EMAIL" />

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="PASSWORD" />

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="CONFIRM PASSWORD">
                    <button class="opacity">SUBMIT</button>
                </form>
                <div class="register-forget opacity">
                    <span>Have an account?
                        <a href="{{ route('login') }}">Login in</a>
                    </span>
                    <span><a href="{{ route('homepage') }}">Back to homepage</a></span>
                </div>
            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>
</body>

<script>
    const themes = [
        {
            background: "#1A1A2E",
            color: "#FFFFFF",
            primaryColor: "#0F3460"
        },
        {
            background: "#461220",
            color: "#FFFFFF",
            primaryColor: "#E94560"
        },
        {
            background: "#192A51",
            color: "#FFFFFF",
            primaryColor: "#967AA1"
        },
        {
            background: "#F7B267",
            color: "#000000",
            primaryColor: "#F4845F"
        },
        {
            background: "#F25F5C",
            color: "#000000",
            primaryColor: "#642B36"
        },
        {
            background: "#231F20",
            color: "#FFF",
            primaryColor: "#BB4430"
        }
    ];

    const setTheme = (theme) => {
        const root = document.querySelector(":root");
        root.style.setProperty("--background", theme.background);
        root.style.setProperty("--color", theme.color);
        root.style.setProperty("--primary-color", theme.primaryColor);
        root.style.setProperty("--glass-color", theme.glassColor);
    };

    const displayThemeButtons = () => {
        const btnContainer = document.querySelector(".theme-btn-container");
        themes.forEach((theme) => {
            const div = document.createElement("div");
            div.className = "theme-btn";
            div.style.cssText = `background: ${theme.background}; width: 25px; height: 25px`;
            btnContainer.appendChild(div);
            div.addEventListener("click", () => setTheme(theme));
        });
    };

    displayThemeButtons();

</script>

</html>
