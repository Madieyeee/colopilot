<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport de Suivi Moniteur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Custom style for a smoother accordion transition */
        .transition-max-height {
            transition: max-height 0.3s ease-in-out;
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-100 text-slate-800">

    <header class="bg-white shadow-md">
        <div class="max-w-5xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">Rapport de Suivi Moniteur</h1>
        </div>
    </header>

    <main class="py-8 sm:py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 mb-6 rounded-lg shadow-md" role="alert">
                    <div class="flex">
                        <div class="py-1">
                            <svg class="h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold">Succès</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('monitor-report.store') }}" method="POST" class="bg-white p-6 sm:p-8 rounded-xl shadow-xl space-y-8">
                @csrf

                <!-- Section Identification -->
                <div>
                    <span class="text-lg font-semibold text-gray-700 dark:text-gray-500">Identification</span>
                    <p class="mt-1 text-sm text-slate-600">Veuillez vous identifier et entrer le code du jour.</p>
                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-500">Votre Nom</label>
                            <select id="user_id" name="user_id" required class="mt-2 block w-full rounded-md border-0 py-2.5 pl-3 pr-10 text-slate-900 ring-1 ring-inset ring-slate-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="" disabled selected>-- Choisissez votre nom --</option>
                                @foreach($monitors as $monitor)
                                    <option value="{{ $monitor->id }}">{{ $monitor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="code_du_jour" class="block text-sm font-medium text-gray-700 dark:text-gray-500">Code du Jour</label>
                            <input type="text" name="code_du_jour" id="code_du_jour" required class="mt-2 block w-full rounded-md border-0 py-2.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="xxxx">
                        </div>
                    </div>
                </div>

                <hr class="border-slate-200">

                <!-- Accordéon pour les sections du questionnaire -->
                <div x-data="{ open: 'section1' }" class="space-y-4">
                    @php
                        $sections = [
                            'section1' => ['title' => '1. Le Projet Pédagogique et les Activités', 'questions' => [
                                ['name' => 'q1_projet_comprehension', 'label' => 'Le projet pédagogique vous a-t-il été présenté clairement et l\'avez-vous trouvé pertinent pour le public accueilli ?', 'type' => 'textarea'],
                                ['name' => 'q1_activites_adequation', 'label' => 'Les activités proposées étaient-elles en adéquation avec les objectifs du projet et l\'âge des enfants ?', 'type' => 'textarea'],
                                ['name' => 'q1_activites_equilibre', 'label' => 'Comment évaluez-vous l\'équilibre entre les activités dirigées, les temps libres et les temps calmes ?', 'type' => 'textarea'],
                                ['name' => 'q1_activites_ressources', 'label' => 'Avez-vous disposé des moyens (matériels, financiers) suffisants pour mener à bien vos projets d\'animation ?', 'type' => 'textarea'],
                                ['name' => 'q1_activite_top', 'label' => 'Quelle est l\'activité qui a, selon vous, le mieux fonctionné ? Expliquez pourquoi.', 'type' => 'textarea'],
                                ['name' => 'q1_activite_flop', 'label' => 'Quelle est l\'activité qui pourrait être significativement améliorée ? Proposez des pistes concrètes.', 'type' => 'textarea'],
                            ]],
                            'section2' => ['title' => '2. La Vie Quotidienne et le Bien-être des Enfants', 'questions' => [
                                ['name' => 'q2_rythme_journee', 'label' => 'Le rythme de la journée (lever, repas, coucher, douches) vous a-t-il semblé respectueux des besoins des enfants ?', 'type' => 'textarea'],
                                ['name' => 'q2_enfants_integration', 'label' => 'Avez-vous observé des difficultés d\'intégration chez certains enfants ? Comment ont-elles été gérées ?', 'type' => 'textarea'],
                                ['name' => 'q2_conflits_gestion', 'label' => 'Comment la gestion des conflits entre enfants a-t-elle été abordée par l\'équipe ?', 'type' => 'textarea'],
                                ['name' => 'q2_participation_enfants', 'label' => 'Les enfants ont-ils eu l\'opportunité d\'exprimer leurs envies et de participer aux décisions de la vie du centre ?', 'type' => 'textarea'],
                            ]],
                            'section3' => ['title' => '3. La Dynamique de l\'Équipe d\'Animation', 'questions' => [
                                ['name' => 'q3_equipe_accueil', 'label' => 'Comment s\'est passée votre intégration au sein de l\'équipe d\'animation ?', 'type' => 'textarea'],
                                ['name' => 'q3_equipe_communication', 'label' => 'La communication au sein de l\'équipe (réunions, transmissions d\'informations) était-elle efficace ?', 'type' => 'textarea'],
                                ['name' => 'q3_equipe_soutien_direction', 'label' => 'Vous êtes-vous senti soutenu et accompagné par la direction du séjour ?', 'type' => 'textarea'],
                                ['name' => 'q3_equipe_ambiance', 'label' => 'Comment décririez-vous l\'ambiance de travail et la cohésion de l\'équipe ?', 'type' => 'textarea'],
                            ]],
                            'section4' => ['title' => '4. Sécurité, Hygiène et Logistique', 'questions' => [
                                ['name' => 'q4_securite_respect', 'label' => 'Les règles de sécurité (physique, morale, affective) vous ont-elles semblé claires et bien appliquées ?', 'type' => 'textarea'],
                                ['name' => 'q4_hygiene_locaux', 'label' => 'Quel est votre avis sur l\'hygiène générale des locaux (sanitaires, chambres, salles d\'activité) ?', 'type' => 'textarea'],
                                ['name' => 'q4_restauration_qualite', 'label' => 'Comment évaluez-vous la qualité, la quantité et l\'équilibre des repas proposés ?', 'type' => 'textarea'],
                                ['name' => 'q4_logistique_transport', 'label' => 'La logistique (transport pour les sorties, matériel disponible) a-t-elle été à la hauteur des besoins ?', 'type' => 'textarea'],
                            ]],
                            'section5' => ['title' => '5. Bilan Personnel et Suggestions Stratégiques', 'questions' => [
                                ['name' => 'q5_bilan_personnel', 'label' => 'Sur un plan personnel, que retenez-vous de cette expérience ? Qu\'avez-vous appris ?', 'type' => 'textarea'],
                                ['name' => 'q5_suggestion_cle', 'label' => 'Si vous aviez une seule suggestion majeure à faire à l\'organisateur pour les prochains séjours, quelle serait-elle ?', 'type' => 'textarea'],
                                ['name' => 'q5_revenir', 'label' => 'Seriez-vous prêt à revenir travailler pour notre organisme et pourquoi ?', 'type' => 'textarea'],
                            ]],
                        ];
                    @endphp

                    @foreach ($sections as $key => $section)
                    <div class="border border-slate-200 rounded-lg">
                        <button type="button" @click="open = (open === '{{ $key }}' ? '' : '{{ $key }}')" class="w-full flex justify-between items-center p-4 text-left">
                            <h3 class="font-semibold text-gray-700 dark:text-gray-500">{{ $section['title'] }}</h3>
                            <svg class="h-5 w-5 text-slate-500 transform transition-transform duration-300" :class="{ 'rotate-180': open === '{{ $key }}' }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open === '{{ $key }}'" x-cloak class="p-4 border-t border-slate-200 space-y-6 transition-max-height overflow-hidden">
                            @foreach ($section['questions'] as $question)
                                <div>
                                    <label for="{{ $question['name'] }}" class="block text-sm font-medium text-gray-700 dark:text-gray-500">{{ $question['label'] }}</label>
                                    @if ($question['type'] === 'textarea')
                                        <textarea id="{{ $question['name'] }}" name="{{ $question['name'] }}" rows="4" class="mt-2 block w-full rounded-md border-0 py-2.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                    @else
                                        <input type="{{ $question['type'] }}" id="{{ $question['name'] }}" name="{{ $question['name'] }}" class="mt-2 block w-full rounded-md border-0 py-2.5 text-slate-900 shadow-sm ring-1 ring-inset ring-slate-300 placeholder:text-slate-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="pt-5">
                    <div class="flex justify-end">
                        <button type="submit" class="w-full sm:w-auto inline-flex justify-center rounded-md bg-indigo-600 py-3 px-6 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Soumettre le rapport
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <x-footer />

</body>
</html>
