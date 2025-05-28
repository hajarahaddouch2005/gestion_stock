<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Réinitialisation du mot de passe</title>
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

      .reset-container {
        background: #fff;
        padding: 40px 35px;
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        max-width: 450px;
        width: 100%;
        text-align: center;
      }

      .reset-container h2 {
        color: #3e3f5e;
        font-weight: 700;
        margin-bottom: 30px;
      }

      label {
        color: #3e3f5e;
        font-weight: 500;
        text-align: left;
        display: block;
        margin-bottom: 8px;
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

      .btn-primary {
        background-color: #6c63ff;
        border: none;
        border-radius: 10px;
        padding: 12px;
        font-weight: 700;
        color: white;
        width: 100%;
        transition: background-color 0.3s ease;
      }

      .btn-primary:hover {
        background-color: #5a52d4;
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
    </style>
</head>
<body>
    <div class="reset-container">
        <h2>Réinitialisation du mot de passe</h2>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="mb-3 text-start">
                <label for="password">Nouveau mot de passe</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autofocus>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 text-start">
                <label for="password-confirm">Confirmer le mot de passe</label>
                <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn-primary">Réinitialiser le mot de passe</button>

            <div class="links mt-3">
                <a href="{{ route('login') }}">Retour à la connexion</a>
            </div>
        </form>
    </div>
</body>
</html>
