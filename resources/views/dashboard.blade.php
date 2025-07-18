<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-black-800 dark:text-black-200 leading-tight">
                {{ __('Tableau de bord') }}
            </h2>

                        @if(in_array(Auth::user()->role, ['administrateur', 'directeur']))
                <div class="flex items-center space-x-4">
                    <a href="{{ route('feedback.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-100 border border-transparent rounded-md font-semibold text-xs text-blue-700 uppercase tracking-widest hover:bg-blue-200 active:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Avis
                    </a>
                    <a href="{{ route('monitor-report.index') }}" class="inline-flex items-center px-4 py-2 bg-purple-100 border border-transparent rounded-md font-semibold text-xs text-purple-700 uppercase tracking-widest hover:bg-purple-200 active:bg-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Rapports Moniteurs
                    </a>
                    <a href="{{ route('programme') }}" class="inline-flex items-center px-4 py-2 bg-green-100 border border-transparent rounded-md font-semibold text-xs text-green-700 uppercase tracking-widest hover:bg-green-200 active:bg-green-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Programme
                    </a>
                    <a href="{{ route('reports.daily') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Générer le rapport du jour
                    </a>
                    <a href="{{ route('children.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Liste des Enfants
                    </a>
                </div>
            @elseif(Auth::user()->role == 'infirmier')
                <a href="{{ route('programme') }}" class="inline-flex items-center px-4 py-2 bg-green-100 border border-transparent rounded-md font-semibold text-xs text-green-700 uppercase tracking-widest hover:bg-green-200 active:bg-green-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Programme
                </a>
            @elseif(Auth::user()->role == 'moniteur')
                <div class="flex items-center space-x-4">
                    <a href="{{ route('programme') }}" class="inline-flex items-center px-4 py-2 bg-green-100 border border-transparent rounded-md font-semibold text-xs text-green-700 uppercase tracking-widest hover:bg-green-200 active:bg-green-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Programme
                    </a>
                    <a href="{{ route('incidents.create') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Signaler un Incident
                    </a>
                    <a href="{{ route('attendances.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150" style="background-color: #4B5563;">
                        Signaler une Absence
                    </a>
                </div>
            @endif
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Message de bienvenue générique --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium">Bonjour, {{ Auth::user()->name }} !</h3>
                    <p class="text-gray-600 dark:text-gray-400">Bienvenue sur votre tableau de bord. Voici un aperçu de l'activité de la colonie.</p>
                </div>
            </div>

            {{-- Vue pour Administrateur et Directeur --}}
            @if(in_array(Auth::user()->role, ['administrateur', 'directeur']))
                <div class="space-y-6">
                    <!-- Section des statistiques -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Carte pour le Code du Jour -->
                        @isset($codeDuJour)
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-center space-x-4">
                            <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-full">
                                <!-- Heroicon name: key -->
                                <svg class="h-6 w-6 text-blue-600 dark:text-blue-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H5v-2H3v-2H1v-4a6 6 0 017.743-5.743z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Code du Jour (Moniteurs)</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $codeDuJour }}</p>
                            </div>
                        </div>
                        @endisset
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-center space-x-4">
                            <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-full">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Enfants Inscrits</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalChildren ?? 0 }}</p>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-center space-x-4">
                            <div class="bg-red-100 dark:bg-red-900 p-3 rounded-full">
                                <svg class="w-6 h-6 text-red-600 dark:text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Absents Aujourd'hui</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $absentToday ?? 0 }}</p>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-center space-x-4">
                            <div class="bg-green-100 dark:bg-green-900 p-3 rounded-full">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Groupes Actifs</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalGroups ?? 0 }}</p>
                            </div>
                        </div>
                        @if(Auth::user()->role == 'administrateur')
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-center space-x-4">
                            <div class="bg-yellow-100 dark:bg-yellow-900 p-3 rounded-full">
                                <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Utilisateurs</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalUsers ?? 0 }}</p>
                            </div>
                        </div>
                        @endif
                    </div>



                    <!-- Grille principale -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Colonne de gauche : Répartition des groupes -->
                        <div class="lg:col-span-1 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Répartition par Groupe</h3>
                            <div class="space-y-4">
                                @forelse($groups as $group)
                                    <div class="flex items-center justify-between">
                                        <p class="text-gray-700 dark:text-gray-300">{{ $group->name }}</p>
                                        <p class="font-semibold text-gray-900 dark:text-white">{{ $group->children_count }}</p>
                                    </div>
                                @empty
                                    <p class="text-gray-500 dark:text-gray-400">Aucun groupe trouvé.</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Colonne de droite : Incidents et Absences -->
                        <div class="lg:col-span-2 space-y-6">
                            <!-- Derniers incidents -->
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Derniers Incidents</h3>
                                    <a href="{{ route('incidents.index') }}" class="text-sm text-gray-600 dark:text-white-400 hover:underline">Voir tout</a>
                                </div>
                                <div class="space-y-3">
                                    @forelse($incidents as $incident)
                                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                            <div>
                                                <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $incident->child->full_name }}</p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($incident->description, 40) }}</p>
                                            </div>
                                            <a href="{{ route('incidents.show', $incident) }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">Détails</a>
                                        </div>
                                    @empty
                                        <p class="text-gray-500 dark:text-gray-400">Aucun incident récent.</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Dernières absences -->
                            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Dernières Absences</h3>
                                    <a href="{{ route('attendances.index') }}" class="text-sm text-gray-600 dark:text-white-400 hover:underline">Voir tout</a>
                                </div>
                                <div class="space-y-3">
                                    @forelse($attendances as $attendance)
                                        <div class="p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                            <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $attendance->child->full_name }}</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">Motif : {{ $attendance->reason }} ({{ $attendance->absence_date->format('d/m/Y') }})</p>
                                        </div>
                                    @empty
                                        <p class="text-gray-500 dark:text-gray-400">Aucune absence récente.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            {{-- Vue pour Moniteur --}}
            @elseif(Auth::user()->role == 'moniteur')
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @if($group)
                            <h3 class="text-xl font-semibold text-white mb-4">
                                Mon Groupe : {{ $group->name }} ({{ $children->count() }} {{ Str::plural('enfant', $children->count()) }})
                            </h3>



                            @if($children->isNotEmpty())
                                <div class="mt-4 overflow-x-auto">
                                    <table class="min-w-full bg-gray-900 text-white rounded-lg">
                                        <thead class="bg-gray-700">
                                            <tr>
                                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">N°</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Prénom</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Nom</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Âge</th>
                                                <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Sexe</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-700">
                                            @foreach($children as $child)
                                                <tr class="hover:bg-gray-800">
                                                    <td class="px-4 py-3 whitespace-nowrap">{{ $loop->iteration }}</td>
                                                    <td class="px-4 py-3 whitespace-nowrap">{{ $child->first_name }}</td>
                                                    <td class="px-4 py-3 whitespace-nowrap">{{ $child->last_name }}</td>
                                                    <td class="px-4 py-3 whitespace-nowrap">{{ $child->age }} ans</td>
                                                    <td class="px-4 py-3 whitespace-nowrap">{{ $child->gender }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="mt-4 text-white">Aucun enfant n'est actuellement dans votre groupe.</p>
                            @endif
                        @else
                            <p class="text-red-500">Vous n'êtes assigné à aucun groupe pour le moment.</p>
                        @endif
                    </div>
                </div>

            {{-- Vue pour Infirmier --}}
            @elseif(Auth::user()->role == 'infirmier')
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium">Incidents Médicaux Récents</h3>
                            <a href="{{ route('incidents.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">Voir tout</a>
                        </div>
                        <div class="space-y-3">
                            @forelse($incidents as $incident)
                                <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                    <div>
                                        <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $incident->child->full_name }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($incident->description, 60) }}</p>
                                    </div>
                                    <a href="{{ route('incidents.show', $incident) }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">Détails</a>
                                </div>
                            @empty
                                <p class="text-gray-500 dark:text-gray-400">Aucun incident médical à afficher.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

            @else
                {{-- Vue par défaut pour d'autres rôles si nécessaire --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <p>Bienvenue !</p>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
