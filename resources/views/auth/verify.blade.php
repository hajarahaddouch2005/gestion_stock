<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Vérification de l'adresse e-mail</title>
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

    .verify-container {
      background: #fff;
      padding: 40px 35px;
      border-radius: 18px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.15);
      max-width: 450px;
      width: 100%;
      text-align: center;
    }

    .verify-container h2 {
      color: #3e3f5e;
      font-weight: 700;
      margin-bottom: 30px;
    }

    .alert-info, .alert-success {
      font-size: 1rem;
      margin-bottom: 30px;
      border-radius: 10px;
      padding: 15px 20px;
    }

    .alert-info {
      color: #3e3f5e;
      background-color: #e3e7f7;
      border: 1px solid #b5bbe3;
    }

    .alert-success {
      color: #9d57c6;
      background-color: #d4edda;
      border: 1px solid #c3e6cb;
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

    button.btn-resend {
      background-color: #6c63ff;
      border: none;
      border-radius: 10px;
      padding: 12px;
      font-weight: 700;
      color: white;
      width: 100%;
      transition: background-color 0.3s ease;
      cursor: pointer;
      margin-top: 10px;
    }

    button.btn-resend:hover {
      background-color: #5a52d4;
    }
  </style>
</head>
<body>
  <div class="verify-container">
    <h2>Vérification de l'adresse e-mail</h2>

    @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif

    <div class="alert alert-info">
      Un lien de vérification a été envoyé à votre adresse e-mail.<br>
      Veuillez vérifier votre boîte de réception et cliquer sur le lien pour activer votre compte.
    </div>

    <p>Si vous ne l'avez pas reçu, cliquez sur le bouton ci-dessous pour recevoir un nouveau lien.</p>

    <form method="POST" action="{{ route('verification.send') }}">
      @csrf
      <button type="submit" class="btn-resend">Renvoyer le lien de vérification</button>
    </form>

    <div class="links">
      <a href="{{ route('login') }}">Retour à la connexion</a>
    </div>
  </div>
</body>
</html>
