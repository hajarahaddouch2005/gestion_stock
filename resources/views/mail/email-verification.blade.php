<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Vérification de votre adresse e-mail</title>
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
            background-color: #4CAF50;
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
        <h1>Vérification de votre adresse e-mail</h1>
    </div>
    
    <div class="content">
        <p>Bonjour {{ $user->name }},</p>
        
        <p>Merci de vous être inscrit sur notre plateforme. Pour activer votre compte, veuillez cliquer sur le bouton ci-dessous pour vérifier votre adresse e-mail :</p>
        
        <p style="text-align: center;">
            <a href="{{ $verificationUrl }}" class="button">Vérifier mon adresse e-mail</a>
        </p>
        
        <p>Si vous n'avez pas créé de compte, aucune action n'est requise.</p>
        
        <p>Si le bouton ne fonctionne pas, vous pouvez également copier et coller le lien suivant dans votre navigateur :</p>
        <p>{{ $verificationUrl }}</p>
    </div>
    
    <div class="footer">
        <p>Ce message a été envoyé automatiquement, merci de ne pas y répondre.</p>
    </div>
</body>
</html>