<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Stock Management System')</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" rel="stylesheet">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <style>
        :root {
            --primary-color: #6c63ff;
            --primary-hover: #5a52d4;
            --text-dark: #3e3f5e;
            --bg-light: #f8f9fa;
            --bg-dark: #1a1a2e;
            --text-light: #ffffff;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(to right, #dde6f2, #f3e8ff);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: var(--text-dark);
            transition: background 0.3s ease, color 0.3s ease;
        }

        body.dark {
            background: linear-gradient(to right, #2c2c54, #3e3f5e);
            color: var(--text-light);
        }

        .navbar {
            background: var(--bg-light);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 1rem 2rem;
            transition: background 0.3s ease;
        }

        body.dark .navbar {
            background: var(--bg-dark);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            transition: color 0.3s ease;
        }

        body.dark .navbar-brand {
            color: var(--text-light);
        }

        .navbar-brand:hover {
            color: var(--primary-hover);
        }

        .btn-light, .btn-primary, .btn-outline-danger {
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-light {
            background: #ffffff;
            border: 1px solid #c8c8d8;
            color: var(--text-dark);
        }

        body.dark .btn-light {
            background: #2c2c54;
            border: 1px solid #4a4a6a;
            color: var(--text-light);
        }

        .btn-light:hover {
            background: #f0f0f5;
            border-color: var(--primary-color);
        }

        body.dark .btn-light:hover {
            background: #3e3f5e;
            border-color: var(--primary-hover);
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
            color: #ffffff;
        }

        .btn-primary:hover {
            background: var(--primary-hover);
        }

        .btn-outline-danger {
            border-color: #b535dc;
            color: #7d35dc;
        }

        body.dark .btn-outline-danger {
            border-color: #eb6bff;
            color: #df6bff;
        }

        .btn-outline-danger:hover {
            background: #e097f1;
            color: #ffffff;
        }

        body.dark .btn-outline-danger:hover {
            background: #e46bff;
        }

        .theme-toggle {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 50%;
            transition: background 0.3s ease;
        }

        .theme-toggle:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        body.dark .theme-toggle:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .theme-toggle svg {
            width: 24px;
            height: 24px;
            stroke: var(--text-dark);
        }

        body.dark .theme-toggle svg {
            stroke: var(--text-light);
        }

        .container {
            flex-grow: 1;
            padding: 2rem;
        }

        .footer {
            background: var(--bg-light);
            color: var(--text-dark);
            text-align: center;
            padding: 1rem;
            font-size: 0.9rem;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
            transition: background 0.3s ease, color 0.3s ease;
        }

        body.dark .footer {
            background: var(--bg-dark);
            color: var(--text-light);
        }

        /* RTL Adjustments */
        [dir="rtl"] .navbar-brand {
            margin-right: 0;
            margin-left: 2rem;
        }

        [dir="rtl"] .d-flex.justify-end {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .me-2 {
            margin-right: 0 !important;
            margin-left: 0.5rem !important;
        }
    </style>
</head>
<body class="min-vh-100 d-flex flex-column">
    <div>
        <nav class="navbar navbar-light">
            <a class="navbar-brand" href="#">@yield('navbar-title', 'Gestion de stock')</a>
            <div class="d-flex align-items-center justify-end gap-1">
                <select name="selectLang" id="selectLang" class="btn btn-light">
                    <option @if(app()->getLocale() == 'ar') selected @endif value="ar">العربية</option>
                    <option @if(app()->getLocale() == 'fr') selected @endif value="fr">Français</option>
                    <option @if(app()->getLocale() == 'en') selected @endif value="en">English</option>
                    <option @if(app()->getLocale() == 'es') selected @endif value="es">Español</option>
                </select>
                <button class="theme-toggle" aria-label="Toggle dark mode">
                    <svg id="theme-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>
                @auth
                    <a href="{{ route('profile') }}" class="btn btn-primary me-2">Mon profil</a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Se déconnecter</button>
                    </form>
                @endauth
            </div>
        </nav>
    </div>

    <div class="container flex-grow-1 py-4">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $("#selectLang").on('change', function() {
            const locale = $(this).val();
            window.location.href = `/changeLocale/${locale}`;
        });

        // Dark Mode Toggle
        const themeToggle = document.querySelector('.theme-toggle');
        const themeIcon = document.querySelector('#theme-icon');
        const body = document.body;

        if (localStorage.getItem('theme') === 'dark') {
            body.classList.add('dark');
            themeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />';
        }

        themeToggle.addEventListener('click', () => {
            body.classList.toggle('dark');
            if (body.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
                themeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />';
            } else {
                localStorage.setItem('theme', 'light');
                themeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />';
            }
        });
    </script>

    @stack('script')

    <div class="footer">
        <div>© copyright 2025</div>
    </div>
</body>
</html>
