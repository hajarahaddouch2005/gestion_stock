<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #dde6f2, #f3e8ff);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-container {
      background: #ffffff;
      padding: 40px 35px;
      border-radius: 18px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      max-width: 420px;
      width: 100%;
    }

    .login-container h2 {
      text-align: center;
      color: #3e3f5e;
      margin-bottom: 30px;
      font-weight: bold;
    }

    .form-label {
      color: #3e3f5e;
      font-weight: 500;
    }

    .form-control {
      border-radius: 10px;
      padding: 10px 15px;
    }

    .btn-custom {
      background-color: #6c63ff;
      border: none;
      border-radius: 10px;
      padding: 12px;
      font-weight: bold;
      color: white;
      transition: 0.3s ease;
    }

    .btn-custom:hover {
      background-color: #5a52d4;
    }

    .links {
      text-align: center;
      margin-top: 20px;
    }

    .links a {
      color: #6c63ff;
      text-decoration: none;
      font-weight: 500;
    }

    .links a:hover {
      text-decoration: underline;
    }

    .alert {
      font-size: 0.9rem;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Connexion</h2>

    @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ url('/login') }}">
      @csrf

      <div class="mb-3">
        <label for="email" class="form-label">Adresse e-mail</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
               id="email" value="{{ old('email') }}" required autofocus>
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
               id="password" required>
        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" id="remember" name="remember">
        <label class="form-check-label" for="remember">Garder la session ouverte</label>
      </div>

      <button type="submit" class="btn btn-custom w-100">Se connecter</button>

      <div class="links mt-3">
        <a href="{{ route('password.request') }}">Mot de passe oublié ?</a><br>
        <a href="{{ route('register') }}">Créer un compte</a>
      </div>
    </form>
  </div>
</body>
</html>
