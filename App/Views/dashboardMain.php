<?php
if (!isset($_SESSION['chat_messages'])) {
    $_SESSION['chat_messages'] = [];
}
?>

<!-- Header -->
<div class="header">
    <div class="header-left">
        <button class="btn btn-primary">Inscription</button>
        <button class="btn btn-secondary">Déconnexion</button>
    </div>
    <div class="notification-badge">3</div>
</div>

<!-- Chat Area -->
<div class="chat-area">
    <div class="assistant-avatar">🧙‍♂️</div>
    <div class="chat-title">You are a wizard Harry!</div>

    <!-- Conteneur pour les messages -->
    <div class="messages-container">
        <?php foreach ($_SESSION['chat_messages'] ?? [] as $msg): ?>
            <div class="message <?= htmlspecialchars($msg['sender']) ?>">
                <?= htmlspecialchars($msg['text'] ?? '') ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Input Area -->
<div class="input-area">
    <div class="input-wrapper">
        <div class="input-box">
            <form id="chat-form" style="display: flex; align-items: center; gap: 12px; width: 100%;"> 
                <input type="text" id="message-input" name="message" class="message-input" placeholder="Écris ton message ici..." autocomplete="off" />
                <button type="submit" class="send-btn" aria-label="Envoyer">➤</button>
            </form>
        </div>
    </div>
</div>

<!-- Fin de la zone de saisie -->