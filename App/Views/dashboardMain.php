<?php
session_start(); // On garde la session pour l'affichage des messages côté serveur
// NOTE: On a retiré l'appel direct à l'API depuis la vue. Les requêtes se font maintenant via
// fetch() vers l'endpoint `public/api/ai.php` (proxy côté serveur). Cela permet de garder
// la clé API secrète et centralise la logique d'appel dans un service.
?>
    <div class="main-section"> 
        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <div class="header-left">
                    <button class="btn btn-primary">Inscription</button>
                    <button class="btn btn-secondary">Deconnexion</button>
                </div>
                
                <div class="notification-badge">3</div>
            </div>

            <!-- Chat Area -->
            <div class="chat-area">
        <div class="assistant-avatar">🧙</div>
        <div class="chat-title">You are a wizard Harry!</div>

        <!-- Conteneur pour les messages -->
        <div class="messages-container">
            <?php
            // Vérifie si des messages existent
            if (!empty($_SESSION['chat_messages'])) {
                foreach ($_SESSION['chat_messages'] as $msg) {
                    $class = $msg['sender'] === 'user' ? 'user' : 'assistant';
                    echo '<div class="message ' . $class . '">' . htmlspecialchars($msg['text']) . '</div>';
                }
            }
            ?>
        </div>

            
        <div class="input-area">
            <form id="chat-form">
                <input type="text" id="message-input" class="message-input" placeholder="wingardium leviosa" required>
                <button type="submit" class="send-btn">→</button>
            </form>
        </div>
    </div>
    <script src="/js/style.js"></script>