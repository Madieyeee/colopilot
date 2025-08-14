# ???? Colopilot - Votre copilote pour une colonie de vacances inoubliable ! ????

Bienvenue sur Colopilot, l'application qui transforme la gestion d'une colonie de vacances en une partie de plaisir ! Fini les papiers qui volent et les informations perdues. Avec Colopilot, tout est centralisé, sécurisé et accessible en un clin d'œil.

## ?? Qu'est-ce que Colopilot ?

Colopilot est une application web conçue avec amour ?? en utilisant le framework **Laravel**. Elle a pour mission de simplifier la vie des directeurs, moniteurs, et de tout le personnel encadrant une colonie. De la gestion des enfants à la communication interne, en passant par le suivi des incidents et la génération de rapports, Colopilot est l'outil ultime pour une organisation au top !

## ?? Fonctionnalités phares

Notre plateforme est pensée pour chaque rôle au sein de la colonie :

#### ?? Pour les Moniteurs :
*   **Gestion des présences** : Faites l'appel en quelques clics.
*   **Rapports d'incidents** : Signalez un incident (bobos, disputes, etc.) de manière simple et rapide.
*   **Rapports journaliers** : Rédigez un résumé de la journée pour la direction.
*   **Consultation du programme** : Accédez au planning des activités à tout moment.

#### ?? Pour les Directeurs & Administrateurs :
*   **Tableau de bord complet** : Une vue d'ensemble sur tout ce qui se passe dans la colonie.
*   **Gestion des enfants** : Accédez aux fiches détaillées de chaque enfant.
*   **Suivi des incidents** : Visualisez et mettez à jour le statut des incidents signalés.
*   **Centralisation des rapports** : Lisez les rapports des moniteurs et les avis des colons.
*   **Génération de rapports** : Créez des rapports journaliers consolidés en PDF.

#### ?? Pour le personnel Infirmier :
*   **Accès aux incidents** : Consultez les incidents pour un suivi médical efficace.

#### ?? Pour les Colons (les stars !) :
*   **Donner son avis** : Une page simple et fun pour qu'ils puissent partager leurs retours sur la journée.

## ?? Stack Technique

Colopilot est construit avec les technologies les plus modernes et robustes :

*   **Backend** : PHP 8.2+ / Laravel 12
*   **Frontend** : Blade, Tailwind CSS, Alpine.js
*   **Base de données** : MySQL (ou votre SGBD préféré compatible avec Laravel)
*   **Dépendances notables** : `barryvdh/laravel-dompdf` pour la magie des PDF, `twilio/sdk` pour de futures notifications SMS.

## ?? Guide d'installation

Envie de lancer Colopilot sur votre machine ? Rien de plus simple !

1.  **Clonez le projet** :
    ```bash
    git clone https://github.com/Madieyeee/colopilot.git
    cd colopilot
    ```

2.  **Installez les dépendances** :
    ```bash
    composer install
    npm install
    ```

3.  **Configurez votre environnement** :
    *   Copiez le fichier `.env.example` en `.env`.
    *   Générez une clé d'application : `php artisan key:generate`
    *   Configurez vos identifiants de base de données dans le fichier `.env`.

4.  **Lancez les migrations et les seeders** (pour avoir des données de démo) :
    ```bash
    php artisan migrate --seed
    ```

5.  **Compilez les assets et lancez le serveur** :
    ```bash
    npm run dev
    php artisan serve
    ```

?? Et voilà ! Colopilot est prêt à décoller sur [http://localhost:8000](http://localhost:8000).

---
