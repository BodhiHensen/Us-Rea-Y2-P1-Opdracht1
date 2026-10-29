<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Geleverde producten') }}
            </h2>
            <div class="flex items-center space-x-3">
                <a href="{{ route('leverancier.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none transition">
                    &larr; {{ __('Terug') }}
                </a>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-800 focus:outline-none transition">
                    {{ __('Home') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg dark:bg-green-950/40 dark:border-green-700 dark:text-green-300">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Leverancier Details Header Card (Wireframe-02 / Wireframe-03) -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4 border-b pb-2 border-gray-200 dark:border-gray-700">
                    Leverancier Gegevens
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">Naam leverancier :</span>
                        <span class="ms-2 text-gray-900 dark:text-gray-100">{{ $leverancier->Naam }}</span>
                    </div>
                    <div>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">Contactpersoon :</span>
                        <span class="ms-2 text-gray-900 dark:text-gray-100">{{ $leverancier->ContactPersoon }}</span>
                    </div>
                    <div>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">Leverancier nr :</span>
                        <span class="ms-2 text-gray-900 dark:text-gray-100 font-mono">{{ $leverancier->LeverancierNummer }}</span>
                    </div>
                    <div>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">Mobiel :</span>
                        <span class="ms-2 text-gray-900 dark:text-gray-100">{{ $leverancier->Mobiel }}</span>
                    </div>
                </div>
            </div>

            <!-- Geleverde Producten Tabel Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 border border-gray-200 dark:border-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-b">
                                    Naam product
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-b">
                                    Aantal in Magazijn
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-b">
                                    Verpakkingseenheid
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-b">
                                    Laatste levering
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-b">
                                    Nieuwe levering
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @if (! $hasDeliveredProducts)
                                <!-- Wireframe-03: Melding geen producten -->
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-base font-semibold text-red-600 dark:text-red-400 bg-red-50/50 dark:bg-red-950/20">
                                        Dit bedrijf heeft tot nu toe geen producten geleverd aan Jamin
                                        <div class="text-xs font-normal text-gray-500 dark:text-gray-400 mt-2">
                                            U wordt over <span id="countdown">3</span> seconden automatisch teruggestuurd naar het overzicht...
                                        </div>
                                    </td>
                                </tr>
                            @else
                                <!-- Wireframe-02: Geleverde productenlijst -->
                                @foreach ($geleverdeProducten as $item)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $item->NaamProduct }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ is_null($item->AantalAanwezig) ? '-' : $item->AantalAanwezig }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ $item->VerpakkingsEenheid ? rtrim(rtrim(number_format($item->VerpakkingsEenheid, 1, ',', ''), '0'), ',') . ' kg' : '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ $item->LaatsteLevering ? \Carbon\Carbon::parse($item->LaatsteLevering)->format('d-m-Y') : '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <a href="{{ route('leverancier.levering.create', [$leverancier->Id, $item->ProductId]) }}" 
                                               class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 hover:bg-emerald-200 dark:hover:bg-emerald-900/60 transition shadow-sm"
                                               title="Nieuwe levering toevoegen voor {{ $item->NaamProduct }}">
                                                <span class="text-lg font-bold leading-none">➕</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Bottom Action Buttons (Wireframe-02 / Wireframe-03) -->
                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('leverancier.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none transition">
                        {{ __('Terug') }}
                    </a>
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-800 focus:outline-none transition">
                        {{ __('Home') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if (! $hasDeliveredProducts)
        <script>
            let seconds = 3;
            const countdownEl = document.getElementById('countdown');
            const interval = setInterval(function() {
                seconds--;
                if (countdownEl) {
                    countdownEl.textContent = seconds;
                }
                if (seconds <= 0) {
                    clearInterval(interval);
                    window.location.href = "{{ route('leverancier.index') }}";
                }
            }, 1000);
        </script>
    @endif
</x-app-layout>

