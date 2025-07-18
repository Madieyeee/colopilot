<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-700 dark:text-gray-500 leading-tight">
                {{ __('Rapport du Moniteur : ') }} {{ $report->user->name }}
            </h2>
            <a href="{{ route('monitor-report.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('Retour à la liste') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-700 dark:text-gray-500 space-y-6">

                    <div class="border-b pb-4 mb-4">
                        <p class="text-gray-700 dark:text-gray-500"><strong>Moniteur :</strong> {{ $report->user->name }}</p>
                        <p class="text-gray-700 dark:text-gray-500"><strong>Date de soumission :</strong> {{ $report->created_at->format('d/m/Y à H:i') }}</p>
                    </div>

                    @php
                        $sections = [
                            '1' => ['title' => 'Le Projet Pédagogique et les Activités', 'questions' => [
                                'q1_projet_comprehension' => 'Comment évaluez-vous votre compréhension du projet pédagogique avant et pendant le séjour ?',
                                'q1_activites_adequation' => 'Les activités proposées étaient-elles en adéquation avec les objectifs du projet pédagogique et l’âge des enfants ?',
                                'q1_activites_equilibre' => 'Comment jugez-vous l’équilibre entre les activités (manuelles, sportives, calmes, grands jeux) ?',
                                'q1_activites_ressources' => 'Aviez-vous suffisamment de ressources (matériel, budget, temps de préparation) pour mener à bien vos activités ?',
                                'q1_activite_top' => 'Quelle a été l’activité « top » de la semaine et pourquoi ?',
                                'q1_activite_flop' => 'Avez-vous rencontré une activité « flop » ? Si oui, laquelle et comment l’analysez-vous ?',
                            ]],
                            '2' => ['title' => 'La Vie Quotidienne et le Bien-être des Enfants', 'questions' => [
                                'q2_rythme_journee' => 'Le rythme de la journée (lever, coucher, repas, temps calmes) était-il adapté aux besoins des enfants ?',
                                'q2_enfants_integration' => 'Comment s’est passée l’intégration des enfants, notamment les plus timides ou nouveaux ?',
                                'q2_conflits_gestion' => 'Avez-vous observé des conflits entre enfants ? Comment ont-ils été gérés par l’équipe ?',
                                'q2_participation_enfants' => 'Les enfants ont-ils eu l’opportunité de proposer des idées ou de participer aux décisions ?',
                            ]],
                            '3' => ['title' => 'La Dynamique de l’Équipe d’Animation', 'questions' => [
                                'q3_equipe_accueil' => 'Comment avez-vous été accueilli(e) et intégré(e) au sein de l’équipe d’animation ?',
                                'q3_equipe_communication' => 'La communication au sein de l’équipe (réunions, transmissions) était-elle efficace ?',
                                'q3_equipe_soutien_direction' => 'Vous êtes-vous senti(e) soutenu(e) par la direction du séjour en cas de besoin ?',
                                'q3_equipe_ambiance' => 'Comment décririez-vous l’ambiance générale au sein de l’équipe d’animation ?',
                            ]],
                            '4' => ['title' => 'Sécurité, Hygiène et Logistique', 'questions' => [
                                'q4_securite_respect' => 'Les règles de sécurité (effectifs, lieux, matériel) ont-elles été bien respectées ?',
                                'q4_hygiene_locaux' => 'Comment évaluez-vous l’hygiène générale des locaux (sanitaires, chambres, réfectoire) ?',
                                'q4_restauration_qualite' => 'La qualité et la quantité des repas étaient-elles satisfaisantes ?',
                                'q4_logistique_transport' => 'Avez-vous des remarques sur la logistique (transport, matériel, gestion du linge) ?',
                            ]],
                            '5' => ['title' => 'Bilan Personnel et Suggestions Stratégiques', 'questions' => [
                                'q5_bilan_personnel' => 'Que retenez-vous personnellement de cette expérience (compétences acquises, difficultés rencontrées) ?',
                                'q5_suggestion_cle' => 'Si vous aviez une suggestion clé à faire à l’organisateur pour améliorer ce séjour, quelle serait-elle ?',
                                'q5_revenir' => 'Seriez-vous prêt(e) à revenir travailler pour notre organisme et pourquoi ?',
                            ]],
                        ];
                    @endphp

                    @foreach ($sections as $section)
                        <div class="mt-6">
                            <h3 class="text-lg font-bold text-gray-700 dark:text-gray-500">{{ $section['title'] }}</h3>
                            <div class="mt-4 space-y-4">
                                @foreach ($section['questions'] as $field => $question)
                                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                        <p class="font-semibold">{{ $question }}</p>
                                        <p class="mt-2 text-gray-700 dark:text-gray-500">{{ $report->$field ?? 'Non renseigné' }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
