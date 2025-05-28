<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Réinitialisation de votre mot de passe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
        }
        .button {
            display: inline-block;
            background-color: #7f4caf;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Réinitialisation de votre mot de passe</h1>
    </div>

    <div class="content">
        <p>Bonjour,</p>

        <p>Vous recevez cet e-mail car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.</p>

        <p style="text-align: center;">
            <a href="{{ $resetUrl }}" class="button">Réinitialiser mon mot de passe</a>
        </p>

        <p>Ce lien de réinitialisation de mot de passe expirera dans 60 minutes.</p>

        <p>Si vous n'avez pas demandé de réinitialisation de mot de passe, aucune action n'est requise.</p>

        <p>Si le bouton ne fonctionne pas, vous pouvez également copier et coller le lien suivant dans votre navigateur :</p>
        <p>{{ $resetUrl }}</p>
    </div>

    <div class="footer">
        <p>Ce message a été envoyé automatiquement, merci de ne pas y répondre.</p>
    </div>
</body>
</html>
