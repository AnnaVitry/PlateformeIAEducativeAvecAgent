// Function appendMessage globale (appelée partout)
function appendMessage(sender, text, container = document.querySelector('.messages-container')) {
    if (!container) {
        console.error('Conteneur messages non trouvé');
        return;
    }
    const div = document.createElement('div');
    div.className = `message ${sender}`;
    div.textContent = text;
    container.appendChild(div);
    container.scrollTop = container.scrollHeight;
    console.log(`✅ Message ajouté: ${sender} - ${text.substring(0, 50)}...`);
}

// DOM ready
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('chat-form');
    const input = document.getElementById('message-input');
    const messagesContainer = document.querySelector('.messages-container');

    if (!form || !input || !messagesContainer) {
        console.error('❌ Éléments chat manquants – check HTML');
        return;
    }

    console.log('🚀 Chat JS chargé');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        // ← FIX : message déclarée ICI, dans le scope submit
        const message = input.value.trim();
        console.log('📤 User message:', message);  // Log pour tracer
        if (!message) return;

        // Ajoute user message
        appendMessage('user', message);

        input.value = '';  // Clear

        try {
            const response = await fetch('/PlateformeIAEducativeAvecAgent/public/api/ai.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({message: message})
            });

            console.log('📡 Fetch response status:', response.status);  // Log status

            if (!response.ok) throw new Error(`HTTP ${response.status}`);

            const data = await response.json();  // Direct json() si clean

            if (data.error) {
                appendMessage('assistant', `❌ Erreur: ${data.error}`);
            } else if (data.reply) {
                appendMessage('assistant', data.reply);
            } else {
                appendMessage('assistant', '🤷 Réponse vide – réessaie !');
            }

        } catch (err) {
            console.error('💥 Erreur fetch:', err);
            appendMessage('assistant', `Erreur: ${err.message}`);
        }
    });
});