<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Programme du Séjour') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- Programme d'aujourd'hui --}}
                    <div class="mb-8">
                        <h3 class="text-lg font-bold mb-4">Aujourd'hui ({{ $today->format('d/m/Y') }})</h3>
                        @if($todayActivity)
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="p-4 bg-blue-100 rounded-lg">
                                    <h4 class="font-bold">Matin</h4>
                                    <p>{{ $todayActivity->morning_activity }}</p>
                                </div>
                                <div class="p-4 bg-green-100 rounded-lg">
                                    <h4 class="font-bold">Après-midi</h4>
                                    <p>{{ $todayActivity->afternoon_activity }}</p>
                                </div>
                                <div class="p-4 bg-yellow-100 rounded-lg">
                                    <h4 class="font-bold">Veillée</h4>
                                    <p>{{ $todayActivity->evening_activity }}</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p><span class="font-bold">Responsable(s):</span> {{ $todayActivity->responsible }}</p>
                            </div>
                        @else
                            <p>Aucune activité prévue pour aujourd'hui.</p>
                        @endif
                    </div>

                    {{-- Programme de demain --}}
                    <div>
                        <h3 class="text-lg font-bold mb-4">Demain ({{ $tomorrow->format('d/m/Y') }})</h3>
                        @if($tomorrowActivity)
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="p-4 bg-blue-100 rounded-lg">
                                    <h4 class="font-bold">Matin</h4>
                                    <p>{{ $tomorrowActivity->morning_activity }}</p>
                                </div>
                                <div class="p-4 bg-green-100 rounded-lg">
                                    <h4 class="font-bold">Après-midi</h4>
                                    <p>{{ $tomorrowActivity->afternoon_activity }}</p>
                                </div>
                                <div class="p-4 bg-yellow-100 rounded-lg">
                                    <h4 class="font-bold">Veillée</h4>
                                    <p>{{ $tomorrowActivity->evening_activity }}</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <p><span class="font-bold">Responsable(s):</span> {{ $tomorrowActivity->responsible }}</p>
                            </div>
                        @else
                            <p>Aucune activité prévue pour demain.</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
