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
        .prose {
            max-width: 80ch;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

    <header class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold leading-tight text-gray-900">Rapport de Suivi Moniteur</h1>
        </div>
    </header>

    <main class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow" role="alert">
                    <p class="font-bold">Succès</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <form action="{{ route('monitor-report.store') }}" method="POST" class="bg-white p-8 rounded-lg shadow-md space-y-8">
                @csrf

                <!-- Section Identification -->
                <div class="prose">
                    <h2 class="text-xl font-semibold">Identification</h2>
                    <p class="text-gray-600">Veuillez vous identifier et entrer le code du jour.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700">Votre Nom</label>
                        <select id="user_id" name="user_id" required class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="" disabled selected>-- Choisissez votre nom --</option>
                            @foreach($monitors as $monitor)
                                <option value="{{ $monitor->id }}">{{ $monitor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="code_du_jour" class="block text-sm font-medium text-gray-700">Code du Jour</label>
                        <input type="text" name="code_du_jour" id="code_du_jour" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="xxxx">
                    </div>
                </div>

                <hr>

                <!-- Accordéon pour les sections du questionnaire -->
                <div x-data="{ open: '' }">
                    <!-- Section 1 -->
                    <div class="border-t border-gray-200 py-6">
                        <button type="button" @click="open = (open === 'section1' ? '' : 'section1')" class="w-full text-left">
                            <h3 class="text-lg font-medium text-gray-900">1. Départ de la colonie</h3>
                        </button>
                        <div x-show="open === 'section1'" x-cloak class="mt-4 prose space-y-4">
                            <div>
                                <label class="block font-medium">Comment avez-vous trouvé le dispositif mis en place ?</label>
                                <input type="text" name="q1_dispositif" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label class="block font-medium">Le voyage s’est-il déroulé dans les meilleures conditions ?</label>
                                <input type="text" name="q1_voyage" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                    </div>

                    <!-- Section 2 -->
                    <div class="border-t border-gray-200 py-6">
                        <button type="button" @click="open = (open === 'section2' ? '' : 'section2')" class="w-full text-left">
                            <h3 class="text-lg font-medium text-gray-900">2. Aspects Pédagogiques</h3>
                        </button>
                        <div x-show="open === 'section2'" x-cloak class="mt-4 prose space-y-4">
                            <div>
                                <label class="block font-medium">Avez-vous trouvé l’organisation générale de la colonie satisfaisante ?</label>
                                <input type="text" name="q2_organisation" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label class="block font-medium">Quelles sont les améliorations à apporter ?</label>
                                <input type="text" name="q2_ameliorations" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label class="block font-medium">Comment avez-vous trouvé la répartition des enfants dans les différents groupes ?</label>
                                <input type="text" name="q2_repartition_groupes" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label class="block font-medium">Avez-vous eu des référents vers qui vous tournez en cas de besoin ?</label>
                                <input type="text" name="q2_referents" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label class="block font-medium">Comment avez-vous trouvé le rythme des activités ?</label>
                                <input type="text" name="q2_rythme_activites" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                    </div>

                    <!-- Section 3 -->
                    <div class="border-t border-gray-200 py-6">
                        <button type="button" @click="open = (open === 'section3' ? '' : 'section3')" class="w-full text-left">
                            <h3 class="text-lg font-medium text-gray-900">3. Relations et cohabitation</h3>
                        </button>
                        <div x-show="open === 'section3'" x-cloak class="mt-4 prose space-y-4">
                            <div>
                                <label class="block font-medium">Comment jugez-vous les relations entre les moniteurs ?</label>
                                <input type="text" name="q3_relations_moniteurs" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label class="block font-medium">Comment jugez-vous les relations entre les enfants ?</label>
                                <input type="text" name="q3_relations_enfants" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label class="block font-medium">Comment jugez-vous les relations entre les moniteurs et les enfants ?</label>
                                <input type="text" name="q3_relations_moniteurs_enfants" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                    </div>

                    <!-- Section 4 -->
                    <div class="border-t border-gray-200 py-6">
                        <button type="button" @click="open = (open === 'section4' ? '' : 'section4')" class="w-full text-left">
                            <h3 class="text-lg font-medium text-gray-900">4. Hébergement et restauration</h3>
                        </button>
                        <div x-show="open === 'section4'" x-cloak class="mt-4 prose space-y-4">
                            <div>
                                <label class="block font-medium">Comment avez-vous trouvé l’hébergement ?</label>
                                <input type="text" name="q4_hebergement" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <div>
                                <label class="block font-medium">Comment avez-vous trouvé la restauration ?</label>
                                <input type="text" name="q4_restauration" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                    </div>

                    <!-- Section 5 -->
                    <div class="border-t border-gray-200 py-6">
                        <button type="button" @click="open = (open === 'section5' ? '' : 'section5')" class="w-full text-left">
                            <h3 class="text-lg font-medium text-gray-900">5. Autres suggestions</h3>
                        </button>
                        <div x-show="open === 'section5'" x-cloak class="mt-4 prose space-y-4">
                            <div>
                                <label class="block font-medium">Avez-vous d’autres suggestions à faire ?</label>
                                <textarea name="q5_suggestions" rows="4" class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="pt-5">
                    <div class="flex justify-end">
                        <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
