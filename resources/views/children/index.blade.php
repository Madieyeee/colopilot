<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste de tous les enfants') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">



                    <div class="mb-4">
                        <form action="{{ route('children.index') }}" method="GET">
                            <div class="flex rounded-md shadow-sm">
                                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Rechercher par nom ou prénom..." class="block w-full px-4 py-2 border-gray-300 rounded-l-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-r-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Rechercher
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nom
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Prénom
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date de Naissance
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php($currentGroup = null)
                                @forelse ($children as $child)
                                    @if (($child->group->name ?? 'Non assigné') !== $currentGroup)
                                        @php($currentGroup = $child->group->name ?? 'Non assigné')
                                        <tr class="bg-gray-100">
                                            <td colspan="3" class="px-6 py-3 text-left text-sm font-bold text-gray-700">
                                                {{ $currentGroup }}
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $child->last_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $child->first_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($child->birth_date)->format('d/m/Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                            Aucun enfant trouvé.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>

</x-app-layout>
