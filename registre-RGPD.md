# Registre RGPD – Plateforme IA Éducative

**Responsable du traitement :**  
David Michel (Projet Simplon - Formation IA)  
**Contact :** contact@plateforme-ia-educative.fr  
**Date de création du registre :** Octobre 2025  
**Dernière mise à jour :** _(à compléter)_

---

## 1. Objectif du traitement

La plateforme a pour but de proposer des **agents d’aide à l’apprentissage** aux élèves de la 6ᵉ à la Terminale.  
Chaque utilisateur possède un compte personnel, qui permet de :
- accéder à son espace d’apprentissage ;
- interagir avec des agents IA personnalisés ;
- suivre sa progression.

---

## 2. Catégories de données collectées

| Type de données | Détails | Base légale |
|------------------|----------|--------------|
| **Données d’identification** | Nom, prénom, email, identifiant unique | Consentement utilisateur / intérêt légitime |
| **Données de connexion** | Adresse IP, date et heure de connexion | Sécurité et traçabilité |
| **Données pédagogiques** | Historique d’apprentissage, résultats, niveaux, préférences | Exécution du service éducatif |
| **Données IA** | Historique des interactions avec les agents IA (prompts, réponses) | Consentement explicite |
| **Données parentales (si < 15 ans)** | Nom, email du responsable légal | Obligation légale de consentement parental |

---

## 3. Finalités du traitement

| Finalité | Description |
|-----------|-------------|
| Gestion des utilisateurs | Création, mise à jour et suppression des comptes |
| Assistance pédagogique IA | Interaction avec un agent d’apprentissage personnalisé |
| Suivi et amélioration | Statistiques d’usage pour améliorer la qualité du service |
| Sécurité | Prévention des abus, gestion des accès, protection des comptes |

---

## 4. Base légale du traitement

| Base légale | Application |
|--------------|-------------|
| Consentement explicite | Inscription et utilisation des agents IA |
| Exécution d’un contrat | Fourniture de la plateforme et des services éducatifs |
| Obligation légale | Consentement parental pour les mineurs |
| Intérêt légitime | Amélioration de la qualité pédagogique et sécurité du site |

---

## 5. Catégories de personnes concernées

- Élèves (6ᵉ → Terminale)  
- Parents (pour les mineurs de moins de 15 ans)  
- Enseignants ou tuteurs  
- Administrateurs du site

---

## 6. Durées de conservation

| Type de donnée | Durée de conservation | Action à l’expiration |
|-----------------|------------------------|------------------------|
| Compte utilisateur inactif | 1 an | Suppression automatique |
| Historique de chat IA | 3 mois | Anonymisation automatique |
| Logs de connexion | 6 mois | Suppression automatique |
| Consentement parental / RGPD | 3 ans | Archivage sécurisé |
| Sauvegardes système | 3 mois | Suppression / écrasement |

---

## 7. Mesures de sécurité techniques et organisationnelles

| Mesure | Détail |
|---------|---------|
| **Hashage des mots de passe** | `password_hash()` (PHP) |
| **Chiffrement des données sensibles** | `openssl_encrypt()` pour les historiques IA |
| **Gestion des accès** | Comptes Admin / Utilisateurs séparés |
| **Suppression automatique** | Script CRON de nettoyage (inactivité > 1 an) |
| **Sauvegardes chiffrées** | Sauvegardes `.sql` ou `.zip` protégées |
| **Journalisation** | Logs d’accès et d’actions sensibles conservés 6 mois |

---

## 8. Droits des personnes concernées

| Droit | Modalité d’exercice |
|--------|----------------------|
| **Accès** | Téléchargement des données via l’espace “Mon profil” |
| **Rectification** | Modification des données personnelles via le profil |
| **Effacement** | Suppression du compte et des historiques IA |
| **Portabilité** | Export des données au format `.json` ou `.csv` |
| **Limitation / Opposition** | Paramètres du compte pour désactiver certaines fonctionnalités IA |
| **Consentement parental** | Courriel de validation parentale pour les moins de 15 ans |

---

## 9. Hébergement et transfert de données

| Élément | Détail |
|----------|--------|
| **Hébergeur** | OVH France (ou autre hébergeur européen) |
| **Localisation des serveurs** | France ou Union Européenne |
| **Transfert de données vers tiers** | Aucun transfert hors UE sans consentement explicite |
| **IA externe (ex. Ollama, API locale)** | Traitement local des données, aucune donnée envoyée à un fournisseur externe sans anonymisation |

---

## 10. Documentation complémentaire

- [x] Politique de confidentialité affichée sur le site  
- [x] Mentions légales complètes  
- [x] Procédure de suppression automatique documentée  
- [x] Suivi du consentement parental (journalisation)  
- [ ] Formation interne à la gestion RGPD (à prévoir)

---

**Mise à jour du registre :** à chaque évolution du traitement des données ou du système IA.  
**Conservation du registre :** en interne + dans le dépôt GitHub du projet.