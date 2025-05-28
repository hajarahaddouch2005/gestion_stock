<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Inscription</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(to right, #dde6f2, #f3e8ff);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .register-container {
      background: #ffffff;
      padding: 40px 35px;
      border-radius: 18px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      max-width: 420px;
      width: 100%;
    }

    .register-container h2 {
      text-align: center;
      color: #3e3f5e;
      margin-bottom: 30px;
      font-weight: 700;
    }

    .form-label {
      color: #3e3f5e;
      font-weight: 500;
    }

    .form-control {
      border-radius: 10px;
      padding: 10px 15px;
      border: 1.5px solid #c8c8d8;
      transition: border-color 0.3s ease;
    }

    .form-control:focus {
      border-color: #6c63ff;
      box-shadow: 0 0 8px rgba(108, 99, 255, 0.3);
      outline: none;
    }

    .btn-custom {
      background-color: #6c63ff;
      border: none;
      border-radius: 10px;
      padding: 12px;
      font-weight: 700;
      color: white;
      width: 100%;
      transition: background-color 0.3s ease;
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
      font-weight: 500;
      text-decoration: none;
    }

    .links a:hover {
      text-decoration: underline;
    }

    .alert {
      font-size: 0.9rem;
    }

    .invalid-feedback {
      font-size: 0.85rem;
      color: #d9534f;
    }
  </style>
</head>
<body>
  <div class="register-container">
    <h2>Inscription</h2>

    @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="mb-3">
        <label for="name" class="form-label">Nom</label>
        <input
          type="text"
          class="form-control @error('name') is-invalid @enderror"
          id="name"
          name="name"
          value="{{ old('name') }}"
          required
          autofocus
        />
        @error('name')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Adresse e-mail</label>
        <input
          type="email"
          class="form-control @error('email') is-invalid @enderror"
          id="email"
          name="email"
          value="{{ old('email') }}"
          required
        />
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input
          type="password"
          class="form-control @error('password') is-invalid @enderror"
          id="password"
          name="password"
          required
        />
        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password-confirm" class="form-label">Confirmer le mot de passe</label>
        <input
          type="password"
          class="form-control"
          id="password-confirm"
          name="password_confirmation"
          required
        />
      </div>

      <button type="submit" class="btn btn-custom">S'inscrire</button>

      <div class="links mt-3">
        <a href="{{ route('login') }}">Déjà inscrit ? Connectez-vous</a>
      </div>
    </form>
  </div>
</body>
</html>
