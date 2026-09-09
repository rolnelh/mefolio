# CLAUDE.md — guide de maintenance Mefolio

Ce fichier documente l'architecture, les conventions et les décisions non
évidentes du projet, pour que n'importe quel développeur (humain ou agent
IA) puisse reprendre le code sans devoir relire tout l'historique. Il
complète le `README.md` (qui décrit le produit) sans le remplacer.

## Stack

- **Laravel 10** (PHP ^8.1), Blade pour les vues, Alpine.js pour
  l'interactivité côté client, Tailwind CSS pour le style.
- **Base de données** : MySQL en production, SQLite pour les tests locaux
  (`database/database.sqlite`, jamais commité).
- **Auth** : Laravel Breeze (email/mot de passe) + Google OAuth via
  Laravel Socialite (`app/Http/Controllers/Auth/GoogleAuthController.php`).
- **Déploiement** : Docker sur Render (https://mefolio-z6n9.onrender.com/),
  déploiement automatique sur push vers `main`.
- **IA** : SDK Anthropic (`anthropic-ai/sdk`) pour l'assistant IA du
  tableau de bord (`app/Http/Controllers/AIAssistantController.php`).

## Commandes utiles

```bash
# Installation
composer install
npm install
cp .env.example .env && php artisan key:generate

# Base de données (SQLite pour dev/tests rapides)
touch database/database.sqlite
php artisan migrate:fresh --seed

# Build front-end
npm run build      # production
npm run dev        # watch mode (Vite)

# Tests
php artisan test

# Style de code PHP (Pint, config Laravel par défaut)
./vendor/bin/pint
```

## Architecture des vues Blade

Les pages les plus riches en fonctionnalités (accueil, tableau de bord,
navigation) suivent le même principe : **une vue "orchestratrice" courte
qui calcule les variables communes puis `@include` un partial par
section/onglet**, plutôt qu'un unique fichier de centaines de lignes.

```
resources/views/
├── dashboard.blade.php              orchestrateur (~150 lignes)
├── dashboard/
│   ├── profile-card.blade.php       widget "carte profil" de la sidebar
│   ├── onboarding-checklist.blade.php
│   └── tabs/                        un fichier par onglet du dashboard
│       ├── projets-quick-actions.blade.php
│       ├── projets-list.blade.php
│       ├── profil-form.blade.php
│       ├── productivite.blade.php
│       ├── missions.blade.php
│       ├── services.blade.php
│       ├── stats.blade.php
│       ├── parametres.blade.php
│       ├── paiements.blade.php
│       └── assistant.blade.php
├── home.blade.php                   orchestrateur (~20 lignes)
├── home/                            une section de la page d'accueil par fichier
│   ├── hero.blade.php
│   ├── avantages.blade.php
│   ├── benefits.blade.php
│   ├── steps.blade.php
│   ├── recent-projects.blade.php
│   ├── talents.blade.php
│   ├── testimonials.blade.php
│   └── faq-cta.blade.php
└── layouts/
    ├── navigation.blade.php         orchestrateur (~110 lignes)
    └── navigation/                  un widget de nav par fichier
        ├── desktop-menu.blade.php
        ├── language-switcher.blade.php
        ├── notifications-dropdown.blade.php
        ├── user-dropdown.blade.php
        ├── mobile-menu.blade.php
        └── bottom-nav.blade.php
```

**Convention** : chaque partial commence par un commentaire Blade
`{{-- ... --}}` qui documente son rôle et la liste des variables qu'il
attend (fournies soit par le contrôleur via la vue parente, soit calculées
localement). Avant de modifier un partial, lire ce commentaire pour savoir
d'où viennent ses données — `@include` sans tableau explicite partage tout
le scope de la vue parente en Blade, donc rien ne les force à être
listées ailleurs.

**Quand créer un nouveau partial ?** Dès qu'une section d'une vue dépasse
~150-200 lignes ou représente un onglet/bloc visuellement autonome. Pas
la peine de fragmenter des blocs de moins de 30-40 lignes (recherche
rapide et icône Messages dans `navigation.blade.php`, par exemple, restent
inline).

## Décisions non évidentes

### Onboarding à la première visite de `/register`

`RegisteredUserController::create()` redirige vers `/bienvenue` (route
`onboarding`, carousel de présentation en 3 slides) si le cookie
`mefolio_onboarded` est absent, quel que soit le lien qui a mené à
`/register`. Le cookie (durée 1 an) est posé dès que `/bienvenue` est
affichée, donc la redirection ne se déclenche qu'une fois par visiteur.
Ce comportement est centralisé dans le contrôleur pour éviter d'avoir à
faire pointer chaque CTA "S'inscrire" du site vers `/bienvenue` : tous
pointent simplement vers `route('register')`. Voir
`app/Http/Controllers/Auth/RegisteredUserController.php` et
`routes/auth.php`.

### Connexion "Rester connecté" cochée par défaut

Le site n'implémente **pas** de connexion sans mot de passe basée sur
`localStorage` : ce serait un contournement d'authentification réel
(`localStorage` est modifiable depuis les devtools du navigateur, contrairement
à Google OAuth qui vérifie l'identité côté serveur par cryptographie).
À la place, la case "Rester connecté" du formulaire de connexion est
cochée par défaut, ce qui pose un `remember_token` signé côté serveur
(mécanisme standard Laravel) — un utilisateur qui l'a coché reste connecté
sans retaper son mot de passe à chaque visite, de façon sécurisée. Voir
`resources/views/auth/login.blade.php` et
`app/Http/Requests/Auth/LoginRequest.php`.

### Message d'erreur dédié pour les comptes créés via Google

Un compte créé (ou relié) via Google n'a jamais de mot de passe choisi par
l'utilisateur (un hash aléatoire est stocké côté serveur, voir
`GoogleAuthController::storeRole`). Si cette personne essaie de se
connecter avec un mot de passe, le message d'erreur générique de Breeze
laisserait croire à un mot de passe oublié — `LoginRequest::authenticate()`
détecte ce cas (`google_id` non nul) et affiche un message qui oriente
vers le bouton "Continuer avec Google" ou la réinitialisation de mot de
passe.

### Internationalisation (FR/EN) — interface seulement

Le site est bilingue **pour l'interface uniquement** (menus, boutons,
formulaires, textes marketing statiques). Le contenu publié par les
utilisateurs (bios, descriptions de projets/missions, articles de blog)
reste dans sa langue d'origine — pratique standard des marketplaces
(LinkedIn, Upwork...), pas de traduction automatique du contenu généré.

- `config/app.php` : `locale` et `fallback_locale` valent `fr` (le
  français est la langue "native" du site — les vues contiennent du texte
  français en dur, pas de clés de traduction artificielles).
- `App\Http\Middleware\SetLocale` (enregistré dans le groupe `web` de
  `app/Http/Kernel.php`) lit `session('locale')` et appelle
  `App::setLocale()` si la valeur fait partie de
  `SetLocale::AVAILABLE_LOCALES` (`['fr', 'en']`).
  Un widget de langue publie cette valeur en session via la route GET
  `/langue/{locale}` (nom `locale.switch`, définie dans `routes/web.php`).
- **Stratégie de traduction** : fichier JSON `lang/en.json`, où chaque
  **clé est le texte français source lui-même** (ex.
  `"Explorer": "Explore"`). Ça permet d'envelopper le texte existant dans
  `__('texte français exact')` sans inventer de schéma de clés, et la
  locale `fr` n'a besoin d'aucun fichier de traduction (`__()` renvoie la
  clé telle quelle si aucune traduction n'existe). Pour les pluriels,
  utiliser `trans_choice('singulier|pluriel', $count)` (supporté nativement
  par `lang/en.json` via la même clé pipe-délimitée).
- Les fichiers `lang/en/{auth,passwords,pagination,validation}.php`
  traduisent les messages système du framework (erreurs de validation,
  etc.) — nécessaires car `fallback_locale` reste `fr` : sans eux, ces
  messages retomberaient silencieusement en français même en locale `en`.
- **Couverture actuelle (état à ce jour, à étendre)** : navigation, footer,
  accueil (toutes sections), authentification (connexion, inscription,
  mot de passe oublié/confirmation/réinitialisation, vérification email,
  rôle Google), onboarding, tableau de bord (tous les onglets), et les
  pages listing publiques (`projects`, `creatifs`, `missions`,
  `challenges`, `classement`, `blog`, `hackathons`, `services`,
  `talentoftheweek`, `coming-soon`) sont traduites. Restent en français
  fixe quelle que soit la langue choisie : les pages de détail/formulaire
  (`projects/show`, `creatifs/show`, `creatifs/create`, `creatifs/edit`,
  `missions/show`, `missions/create`, `challenges/show`, `blog-show`),
  les messages privés, la page profil (`profile/*`), et tout l'espace
  admin (`admin/*`, usage interne, priorité basse) — ce n'est pas un bug,
  juste une couverture incrémentale. Pour étendre : envelopper le texte
  français dans `__('...')` dans la vue concernée (ou dans le contrôleur
  si le texte est défini côté PHP, comme pour les accroches de
  `AuthenticatedSessionController`), puis ajouter sa traduction anglaise
  dans `lang/en.json` (clé = texte français exact, espaces et ponctuation
  compris). Les noms propres de marque/paiement (MTN, Wave, PayPal...),
  les noms de pays dans les filtres, et les termes déjà établis comme
  fixes (Talent of the Week, Hall of Fame, Dashboard, Blog, Challenges)
  restent volontairement non traduits.

### Règle de "profil complet"

Un profil créatif est considéré "complet" (affiché publiquement, invite à
créer un projet plutôt qu'à finir son profil) quand `nom`, `prenom`,
`specialite`, `localisation`, `bio`, `portfolio_url` et `photo` sont tous
renseignés. Cette règle est **dupliquée localement** dans
`dashboard.blade.php`, `home/hero.blade.php` et
`layouts/navigation.blade.php` (desktop et mobile) plutôt que centralisée
dans un accesseur du modèle `Creatif` — un ticket de nettoyage possible
serait d'en faire un accesseur Eloquent (`$creatif->est_complet`) pour
n'avoir qu'un seul endroit à maintenir si la règle change.

## Tests

`php artisan test` doit passer avant tout push. Les tests vivent sous
`tests/Feature/` (organisés par domaine : `Auth/`, etc.) et
`tests/Unit/`. Utiliser SQLite en mémoire ou fichier
(`database/database.sqlite`) pour les lancer localement, jamais la base
MySQL de production.

## Conventions de code

- Les noms de variables et de méthodes métier sont en français
  (`$creatif`, `$profilComplet`, `creatifs.edit`...), cohérent avec le
  contenu du site ; le code framework (routes REST, noms de classes Eloquent)
  suit les conventions Laravel habituelles en anglais.
- Aucun emoji dans le code, les commentaires, le contenu ou les commits —
  convention du projet, vérifiée par un scan avant chaque livraison.
- Les flèches `→` / `←` dans les libellés UI (ex. "Voir le projet →") ne
  sont **pas** des emoji et sont une convention visuelle du site — à ne
  pas retirer par erreur lors d'un nettoyage.
