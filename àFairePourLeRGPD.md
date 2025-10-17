# 📜 Liste des obligations RGPD à implémenter
(plateforme éducative avec IA et comptes utilisateurs)

---

## 🧠 1. Principes fondamentaux du RGPD

Tu dois respecter les **7 principes clés** :

1. **Licéité, loyauté, transparence** — informer clairement les utilisateurs sur les traitements.

2. **Limitation des finalités** — ne collecter les données que pour un but précis (ex. apprentissage personnalisé).

3. **Minimisation des données** — ne stocker que ce qui est strictement nécessaire.

4. **Exactitude** — permettre la mise à jour/correction des données.

5. **Limitation de la conservation** — supprimer les données après une durée définie (ex. 1 an d’inactivité).

6. **Intégrité et confidentialité** — protéger contre les accès non autorisés (hash, chiffrement…).

7. **Responsabilité (accountability)** — prouver ta conformité (registre, logs, mentions légales…).

---

## 👤 2. Données personnelles collectées

Tu dois **identifier** précisément :

- Nom, prénom
- Email / identifiant
- Mot de passe (hashé)
- Données pédagogiques (notes, niveau scolaire, historique d’activité)
- Données de consentement (accepter cookies, CGU, etc.)
- Échanges avec les agents IA (si liés à un utilisateur identifiable)

---

## 🛠️ 3. Mesures techniques obligatoires

| Domaine | Exigence | Exemple concret |
|----------|-----------|----------------|
| 🔐 **Sécurité** | Hashage des mots de passe | `password_hash()` (PHP) |
| 🔒 **Chiffrement** | Si stockage d’informations sensibles (ex. historique IA) | `openssl_encrypt()` ou stockage chiffré |
| 🔑 **Accès restreint** | Compte admin séparé, rôles utilisateurs | Gestion des accès via rôles (admin, user) |
| 🚫 **Suppression automatique** | Données supprimées après 1 an d’inactivité | Script ou tâche CRON de nettoyage |
| 📦 **Sauvegardes sécurisées** | Base de données exportée uniquement chiffrée | Sauvegardes `.sql` ou `.zip` protégées par mot de passe |
| 🧹 **Tri régulier** | Suppression des utilisateurs inactifs, logs anciens, etc. | Procédure planifiée de purge mensuelle |

---

## 🧾 4. Documentation RGPD

À produire et conserver :

1. **Registre des traitements** (Word / PDF) :
 - Quelles données sont collectées ?
 - Par qui ? Pour quoi ?
 - Où sont-elles stockées ?
 - Quelle durée de conservation ?
 - Quels moyens de sécurité ?

2. **Politique de confidentialité** (page sur le site)
 - Lisible pour les mineurs et les parents
 - Mention des droits (accès, rectification, suppression, portabilité)

3. **Mentions légales** :
 - Nom de l’éditeur, hébergeur, responsable du traitement

4. **Consentement explicite** :
 - Case à cocher lors de l’inscription (“J’accepte la politique RGPD”)
 - Journalisation de la date et IP du consentement

---

## 🧒 5. Protection des mineurs
Cas **critique** : Protection des mineurs (6e → Terminale)

| Exigence | Détail |
|-----------|---------|
| 🧩 **Consentement parental** | Pour les moins de 15 ans (en France), le parent doit valider l’inscription. |
| 🪪 **Vérification d’âge** | Champ “date de naissance” + vérification côté serveur pour restreindre l’accès selon l’âge. |
| 📤 **Communication transparente** | Formulation adaptée aux enfants, explications claires et compréhensibles. |
| 🧹 **Suppression rapide** | Droit à l’effacement facilité (“Désinscription” visible, exécution en moins de 30 jours). |

---

## 💬 6. Données des agents IA

Les agents d’apprentissage (assistants, LLM, etc.) peuvent manipuler des données personnelles.

Tu dois :

- **Journaliser les requêtes IA** sans identifier directement l’utilisateur (anonymisation).
- **Supprimer les historiques d’échanges** après une durée raisonnable (ex. 3 mois).
- Si usage d’un **LLM externe** (API OpenAI, HuggingFace, etc.) :
 - Mentionner la transmission éventuelle de données à des tiers.
 - Masquer ou pseudonymiser les données sensibles avant envoi.

---

## ⚙️ 7. Droits des utilisateurs à mettre en place

## ⚖️ Droits RGPD des utilisateurs

| Droit | Description | Implémentation technique |
|--------|--------------|---------------------------|
| 🧍 **Droit d’accès** | Obtenir une copie des données personnelles stockées. | Page “Mon profil” avec export des données au format JSON ou CSV. |
| ✏️ **Droit de rectification** | Modifier ou corriger ses informations personnelles. | Formulaire “Modifier profil” avec validation côté serveur. |
| ❌ **Droit à l’effacement** | Supprimer définitivement son compte et son historique. | Bouton “Supprimer mon compte” (requête `DELETE` sur user + historique associé). |
| 🕑 **Droit à la limitation** | Suspension temporaire du traitement sans suppression des données. | Marquage du compte comme “inactif” sans suppression physique. |
| 🔄 **Droit à la portabilité** | Export des données dans un format structuré, lisible et couramment utilisé. | Génération d’un fichier `.json` ou `.csv` téléchargeable. |
| 🧱 **Droit d’opposition** | Refuser l’usage des données pour certaines finalités (ex. IA de recommandation). | Option “refuser l’utilisation à des fins pédagogiques” dans les paramètres du compte. |

---

## 🧮 8. Durées de conservation recommandées

| Type de donnée | Durée |
|-----------------|--------|
| 👤 **Compte utilisateur inactif** | 1 an maximum |
| 🧾 **Logs de connexion** | 6 mois |
| 💬 **Historique de chat avec l’agent IA** | 3 mois |
| ✅ **Consentement RGPD** | 3 ans (preuve légale de consentement) |
| 💽 **Sauvegardes système** | 3 mois, puis purge automatique |

---

## 🌐 9. Hébergement et transfert des données

- Hébergeur **situé dans l’UE** (ex. OVH, Scaleway, Clever Cloud)

- Si tu utilises une API IA **hors UE**, préciser le **pays de transfert**

- Signer des **clauses contractuelles types (CCT)** si nécessaire

---

## 🧩 10. Pour ton projet (version étudiant)

💡 Tu peux simplifier avec ces éléments pratiques :
- ✅ Un **registre RGPD simplifié** (Word ou PDF dans ton repo GitHub)
- ✅ Une **page “Politique RGPD”** dans ton site (`rgpd.php`)
- ✅ Une **table SQL** `consentement_rgpd` :

```sql
CREATE TABLE consentement_rgpd (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    date_consentement DATETIME NOT NULL,
    ip_utilisateur VARCHAR(45),
    FOREIGN KEY (user_id) REFERENCES utilisateurs(id)
);
```
- ✅ Une tâche CRON mensuelle pour supprimer les utilisateurs inactifs > 1 an.