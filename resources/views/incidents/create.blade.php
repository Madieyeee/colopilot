<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Signaler un nouvel incident') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('incidents.store') }}">
                        @csrf

                        <!-- Enfant concerné -->
                        <div class="mb-4">
                            <label for="child_id" class="block text-gray-700 text-sm font-bold mb-2">Enfant concerné :</label>
                            <select name="child_id" id="child_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">-- Sélectionnez un enfant --</option>
                                @foreach ($children as $child)
                                    <option value="{{ $child->id }}">{{ $child->first_name }} {{ $child->last_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Type d'incident -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Type d'incident :</label>
                            <div class="flex items-center">
                                <input type="radio" name="type" id="medical" value="médical" class="mr-2" checked>
                                <label for="medical" class="mr-4">Médical</label>
                                <input type="radio" name="type" id="disciplinary" value="disciplinaire" class="mr-2">
                                <label for="disciplinary">Disciplinaire</label>
                            </div>
                        </div>

                        <!-- Date et heure -->
                        <div class="mb-4">
                            <label for="incident_date" class="block text-gray-700 text-sm font-bold mb-2">Date et heure de l'incident :</label>
                            <input type="datetime-local" name="incident_date" id="incident_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description :</label>
                            <textarea name="description" id="description" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Signaler l'incident
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        new window.TomSelect('#child_id',{
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
    });
</script>
</x-app-layout>
