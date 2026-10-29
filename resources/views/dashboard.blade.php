<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="text-lg font-medium mb-4">{{ __("Welkom bij het Jamin Magazijnbeheersysteem!") }}</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('magazijn.index') }}" class="block p-5 bg-blue-50 dark:bg-blue-950/40 border border-blue-200 dark:border-blue-800 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/40 transition">
                            <h3 class="text-base font-bold text-blue-900 dark:text-blue-200 mb-1">🏬 Overzicht Magazijn</h3>
                            <p class="text-sm text-blue-700 dark:text-blue-300">Bekijk de voorraad, allergenen en leveringsinformatie van producten.</p>
                        </a>
                        <a href="{{ route('leverancier.index') }}" class="block p-5 bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800 rounded-lg hover:bg-amber-100 dark:hover:bg-amber-900/40 transition">
                            <h3 class="text-base font-bold text-amber-900 dark:text-amber-200 mb-1">🚚 Overzicht Leveranciers</h3>
                            <p class="text-sm text-amber-700 dark:text-amber-300">Bekijk leveranciers, geleverde producten en voeg nieuwe leveringen toe.</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
