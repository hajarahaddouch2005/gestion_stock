<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profil utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
      body {
        background: linear-gradient(to right, #dde6f2, #f3e8ff);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 40px 20px;
      }

      .profile-container {
        background: #fff;
        padding: 40px 35px;
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        max-width: 700px;
        width: 100%;
      }

      h2 {
        color: #3e3f5e;
        font-weight: 700;
        margin-bottom: 30px;
      }

      .btn-outline-secondary {
        color: #6c63ff;
        border-color: #6c63ff;
        border-radius: 10px;
        font-weight: 600;
        padding: 8px 20px;
        transition: background-color 0.3s ease, color 0.3s ease;
      }
      .btn-outline-secondary:hover {
        background-color: #6c63ff;
        color: white;
      }

      .alert {
        font-size: 0.9rem;
        margin-bottom: 20px;
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        border-radius: 10px;
        padding: 15px 20px;
      }

      .card {
        border: none;
        border-radius: 18px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        margin-bottom: 30px;
      }

      .card-header {
        background: #f3e8ff;
        color: #3e3f5e;
        font-weight: 700;
        font-size: 1.2rem;
        border-top-left-radius: 18px;
        border-top-right-radius: 18px;
        padding: 20px 30px;
      }

      .card-body {
        padding: 30px 35px;
      }

      label {
        color: #3e3f5e;
        font-weight: 600;
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

      .is-invalid {
        border-color: #d9534f !important;
        box-shadow: none !important;
      }

      .invalid-feedback {
        font-size: 0.85rem;
        color: #d9534f;
        margin-top: 5px;
        display: block;
        text-align: left;
      }

      .form-text {
        font-size: 0.85rem;
        color: #6c757d;
        margin-top: 5px;
      }

      .btn-primary {
        background-color: #6c63ff;
        border: none;
        border-radius: 10px;
        padding: 12px 20px;
        font-weight: 700;
        color: white;
        width: 100%;
        transition: background-color 0.3s ease;
        cursor: pointer;
      }
      .btn-primary:hover {
        background-color: #5a52d4;
      }

      .btn-danger {
        background-color: #de52eb;
        border: none;
        border-radius: 10px;
        padding: 12px 20px;
        font-weight: 700;
        color: white;
        width: 200px;
        transition: background-color 0.3s ease;
        cursor: pointer;
      }
      .btn-danger:hover {
        background-color: #c249e3;
      }

      .d-flex-between {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
      }

      .text-center {
        text-align: center;
      }

      .mt-3 {
        margin-top: 1rem;
      }
    </style>
</head>
<body>
  <div class="profile-container">
    <div class="d-flex-between">
      <h2>Profil utilisateur</h2>
      <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Retour au tableau de bord</a>
    </div>

    @if (session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="card">
      <div class="card-header">Informations du profil</div>
      <div class="card-body">
        <form method="POST" action="{{ route('profile.update') }}">
          @csrf
          @method('PUT')

          <div class="mb-3 text-start">
            <label for="name">Nom</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus>
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3 text-start">
            <label for="email">Adresse e-mail</label>
            <input type="email" class="form-control" id="email" value="{{ $user->email }}" disabled>
            <small class="form-text">L'adresse e-mail ne peut pas être modifiée.</small>
          </div>

          <button type="submit" class="btn-primary">Mettre à jour le profil</button>
        </form>
      </div>
    </div>

    <div class="card">
      <div class="card-header">Changer le mot de passe</div>
      <div class="card-body">
        <form method="POST" action="{{ route('password.change') }}">
          @csrf
          @method('PUT')

          <div class="mb-3 text-start">
            <label for="current_password">Mot de passe actuel</label>
            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
            @error('current_password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3 text-start">
            <label for="password">Nouveau mot de passe</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3 text-start">
            <label for="password-confirm">Confirmer le nouveau mot de passe</label>
            <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required>
          </div>

          <button type="submit" class="btn-primary">Changer le mot de passe</button>
        </form>
      </div>
    </div>

    <div class="mt-3 text-center">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn-danger">Se déconnecter</button>
      </form>
    </div>
  </div>
</body>
</html>
