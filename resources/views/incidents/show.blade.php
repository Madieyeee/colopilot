<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Détails de l'incident #{{ $incident->id }}
        </h2>
    </x-slot>

        <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Message de succès -->
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Informations sur l'enfant -->
                    <h3 class="text-lg font-bold mb-2">Informations sur l'enfant</h3>
                    <p><strong>Nom :</strong> {{ $incident->child->first_name ?? 'N/A' }} {{ $incident->child->last_name ?? 'N/A' }}</p>
                    <p><strong>Âge :</strong> {{ $incident->child->date_of_birth->age ?? 'N/A' }} ans</p>
                    <p><strong>Sexe :</strong> {{ $incident->child->gender ?? 'N/A' }}</p>

                    <hr class="my-6">

                    <!-- Détails de l'incident -->
                    <h3 class="text-lg font-bold mb-2">Détails de l'incident</h3>
                    <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($incident->incident_date)->format('d/m/Y à H:i') }}</p>
                    <p><strong>Type :</strong> <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $incident->type == 'médical' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ ucfirst($incident->type) }}
                    </span></p>
                    <p><strong>Signalé par :</strong> {{ $incident->user->name ?? 'Utilisateur supprimé' }} ({{ $incident->user->role ?? '' }})</p>
                    <p><strong>Statut :</strong> <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $incident->status == 'ouvert' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($incident->status) }}
                    </span></p>
                    <div class="mt-4">
                        <strong>Description :</strong>
                        <p class="mt-1 p-4 bg-gray-50 rounded-md">{{ $incident->description }}</p>
                    </div>

                    <hr class="my-6">

                    <!-- Suivi de l'incident -->
                    <h3 class="text-lg font-bold mb-2">Suivi</h3>
                    <div class="mt-4">
                        <strong>Notes de suivi :</strong>
                        @if($incident->follow_up)
                            <p class="mt-1 p-4 bg-gray-50 rounded-md">{{ $incident->follow_up }}</p>
                        @else
                            <p class="mt-1 text-gray-500">Aucun suivi n'a encore été ajouté.</p>
                        @endif
                    </div>

                                        <!-- Formulaire de mise à jour -->
                    <form action="{{ route('incidents.update', $incident) }}" method="POST" class="mt-6">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="follow_up" class="block font-medium text-sm text-gray-700">Ajouter/Modifier le suivi</label>
                            <textarea id="follow_up" name="follow_up" rows="4" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('follow_up', $incident->follow_up) }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label for="status" class="block font-medium text-sm text-gray-700">Statut de l'incident</label>
                            <select id="status" name="status" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="ouvert" {{ $incident->status == 'ouvert' ? 'selected' : '' }}>Ouvert</option>
                                <option value="fermé" {{ $incident->status == 'fermé' ? 'selected' : '' }}>Fermé</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline">
                                Retour au tableau de bord
                            </a>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Mettre à jour l'incident
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
