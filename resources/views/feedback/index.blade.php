<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 dark:text-gray-500 leading-tight">
            {{ __('Avis et Souhaits des Colons') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Section des Avis sur les Activités -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-4">Avis sur les Activités</h3>
                    <div class="space-y-4">
                        @forelse ($reviews as $review)
                            <div class="border-l-4 border-blue-500 pl-4 py-2 bg-gray-50 dark:bg-gray-700 rounded-r-lg">
                                <p class="font-bold text-lg">{{ $review->child->first_name }} {{ $review->child->last_name }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $review->created_at->format('d/m/Y à H:i') }}</p>
                                <p class="mt-2"><span class="font-semibold">Activité :</span> {{ $review->activity_name }}</p>
                                <div class="flex items-center mt-1">
                                    <span class="font-semibold mr-2">Note :</span>
                                    <div class="flex text-yellow-400">
                                        @for ($i = 0; $i < $review->rating; $i++)
                                            <span>★</span>
                                        @endfor
                                        @for ($i = $review->rating; $i < 5; $i++)
                                            <span class="text-gray-300">★</span>
                                        @endfor
                                    </div>
                                </div>
                                @if($review->comment)
                                    <p class="mt-2 bg-gray-100 dark:bg-gray-600 p-3 rounded-md">{{ $review->comment }}</p>
                                @endif
                            </div>
                        @empty
                            <p>Aucun avis sur les activités pour le moment.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Section des Souhaits -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-4">Souhaits des Colons</h3>
                    <div class="space-y-4">
                        @forelse ($wishes as $wish)
                            <div class="border-l-4 border-purple-500 pl-4 py-2 bg-gray-50 dark:bg-gray-700 rounded-r-lg">
                                <p class="font-bold text-lg">{{ $wish->child->first_name }} {{ $wish->child->last_name }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $wish->created_at->format('d/m/Y à H:i') }}</p>
                                <p class="mt-2"><span class="font-semibold">Catégorie :</span> {{ $wish->category }}</p>
                                <p class="mt-2 bg-gray-100 dark:bg-gray-600 p-3 rounded-md">{{ $wish->description }}</p>
                                <p class="mt-2 text-sm"><span class="font-semibold">Statut :</span> <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $wish->status == 'réalisé' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">{{ ucfirst(str_replace('_', ' ', $wish->status)) }}</span></p>
                            </div>
                        @empty
                            <p>Aucun souhait pour le moment.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
