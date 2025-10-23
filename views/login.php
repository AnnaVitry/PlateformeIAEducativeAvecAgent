<head>
    <link rel="stylesheet" href="/PlateformeIAEducativeAvecAgent/public/css/style.css">
</head>

<main class="login-container">
    <h2>Connexion</h2>
    
    <form action="/connexion" method="POST" class="login-form">
        
        <label for="email">Adresse Email</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>
        
        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        
        <button type="submit" class="btn-primary">Se Connecter</button>
        
        <p class="register-link">
            Pas encore de compte ? <a href="/inscription">S'inscrire ici</a>
        </p>

        <button type="submit" class="btn-primary">Connexion Admin</button>
    </form>
</main>
