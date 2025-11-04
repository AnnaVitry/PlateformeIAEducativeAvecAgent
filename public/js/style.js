// Exemple minimal: envoi du message au endpoint serveur et affichage basique en DOM.
document.addEventListener('DOMContentLoaded', function () {
	const form = document.getElementById('chat-form');
	const input = document.getElementById('message-input');
	const container = document.querySelector('.messages-container');

	if (!form || !input || !container) return;

	form.addEventListener('submit', async function (e) {
		e.preventDefault();
		const text = input.value.trim();
		if (!text) return;

		// Affiche le message utilisateur immédiatement
		const userDiv = document.createElement('div');
		userDiv.className = 'message user';
		userDiv.textContent = text;
		container.appendChild(userDiv);

		input.value = '';

		try {
			// Adjuster l'URL si votre webroot n'est pas `public/`.
			const res = await fetch('../api/ai.php', {
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				body: JSON.stringify({ message: text })
			});

			const json = await res.json();

			let replyText = 'Erreur API';
			// Essayez de récupérer le contenu suivant la structure retournée par le fournisseur
			if (json.choices && Array.isArray(json.choices) && json.choices[0]?.message?.content) {
				replyText = json.choices[0].message.content;
			} else if (json.error) {
				replyText = 'Erreur: ' + (json.error.message || json.error);
			} else if (typeof json === 'string') {
				replyText = json;
			}

			const botDiv = document.createElement('div');
			botDiv.className = 'message assistant';
			botDiv.textContent = replyText;
			container.appendChild(botDiv);
			container.scrollTop = container.scrollHeight;

		} catch (err) {
			const errDiv = document.createElement('div');
			errDiv.className = 'message assistant';
			errDiv.textContent = 'Erreur réseau: ' + err.message;
			container.appendChild(errDiv);
		}
	});
});
