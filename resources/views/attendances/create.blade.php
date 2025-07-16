<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Signaler une absence') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('attendances.store') }}">
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

                        <!-- Date de l'absence -->
                        <div class="mb-4">
                            <label for="absence_date" class="block text-gray-700 text-sm font-bold mb-2">Date de l'absence :</label>
                            <input type="date" name="absence_date" id="absence_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <!-- Raison -->
                        <div class="mb-4">
                            <label for="reason" class="block text-gray-700 text-sm font-bold mb-2">Raison de l'absence (optionnel) :</label>
                            <textarea name="reason" id="reason" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Signaler l'absence
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
