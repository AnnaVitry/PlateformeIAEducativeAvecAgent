<?php
session_start(); // En haut du fichier ?>
<div class="login-container">
    <?php if (isset($_SESSION['user_id'])): ?>
        <p>Vous êtes connecté ! <a href="/App/public/?route=dashboard">Aller au Dashboard</a> | <a href="/App/public/?route=logout">Déconnexion</a></p>
    <?php else: ?>
        <form action="/App/public/?route=connexion" method="POST"> <!-- ← Ajusté pour handler -->
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
        <?php if (isset($error)): ?><p style="color:red;"><?= $error ?></p><?php endif; ?>
    <?php endif; ?>
</div>

?>

<head>
    <link rel="stylesheet" href="../../public/css/style.css">
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
            Pas encore de compte ? <a href="user_registration.php">S'inscrire ici</a>
        </p>

        <button type="submit" class="btn-primary">Connexion Admin</button>
    </form>
</main>
