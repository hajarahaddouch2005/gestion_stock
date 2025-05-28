<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Mot de passe oublié</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(to right, #dde6f2, #f3e8ff);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      padding: 20px;
    }

    .forgot-container {
      background: #fff;
      padding: 40px 35px;
      border-radius: 18px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
      max-width: 420px;
      width: 100%;
      text-align: center;
    }

    .forgot-container h2 {
      color: #3e3f5e;
      font-weight: 700;
      margin-bottom: 30px;
    }

    p {
      color: #5a5a7d;
      margin-bottom: 30px;
      font-size: 1rem;
      font-weight: 500;
    }

    label {
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
      margin-bottom: 20px;
    }

    .invalid-feedback {
      font-size: 0.85rem;
      color: #d9534f;
      text-align: left;
      margin-top: 5px;
    }
  </style>
</head>
<body>
  <div class="forgot-container">
    <h2>Mot de passe oublié</h2>

    @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <p>Pour des raisons de sécurité, un lien de réinitialisation vous sera envoyé par e-mail. </p>

    <form method="POST" action="{{ route('password.email') }}">
      @csrf

      <div class="mb-3 text-start">
        <label for="email">Adresse e-mail</label>
        <input
          type="email"
          class="form-control @error('email') is-invalid @enderror"
          id="email"
          name="email"
          value="{{ old('email') }}"
          required
          autofocus
        />
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-custom">Envoyer le lien de réinitialisation</button>

      <div class="links mt-3">
        <a href="{{ route('login') }}">Retour à la connexion</a>
      </div>
    </form>
  </div>
</body>
</html>
