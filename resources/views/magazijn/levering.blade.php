<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('LeveringsInformatie') }}
            </h2>
            <a href="{{ route('magazijn.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none transition">
                &larr; Terug naar Magazijn Overzicht
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Leverancier Details Header Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4 border-b pb-2 border-gray-200 dark:border-gray-700">
                    Leverancier Gegevens
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">Naam Leverancier:</span>
                        <span class="ms-2 text-gray-900 dark:text-gray-100">{{ $leverancier?->Naam ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">Contactpersoon leverancier:</span>
                        <span class="ms-2 text-gray-900 dark:text-gray-100">{{ $leverancier?->ContactPersoon ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">Leverancier nummer:</span>
                        <span class="ms-2 text-gray-900 dark:text-gray-100">{{ $leverancier?->LeverancierNummer ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">Mobiel:</span>
                        <span class="ms-2 text-gray-900 dark:text-gray-100">{{ $leverancier?->Mobiel ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Leveringsinformatie Tabel Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 border border-gray-200 dark:border-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-b">
                                    Naam Product
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-b">
                                    Datum laatste levering
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-b">
                                    Aantal
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-b">
                                    Eerstvolgende levering
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @if ($isOutOfStock)
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-base font-semibold text-red-600 dark:text-red-400 bg-red-50/50 dark:bg-red-950/20">
                                        Er is van dit product op dit moment geen voorraad aanwezig, de verwachte eerstvolgende levering is: {{ $formattedNextDelivery ?? '30-04-2023' }}
                                        <div class="text-xs font-normal text-gray-500 dark:text-gray-400 mt-2">
                                            U wordt over <span id="countdown">4</span> seconden automatisch teruggestuurd naar het overzicht...
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @forelse ($leveringen as $levering)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $product->Naam }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ \Carbon\Carbon::parse($levering->DatumLevering)->format('d-m-Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ $levering->Aantal }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ $levering->DatumEerstVolgendeLevering ? \Carbon\Carbon::parse($levering->DatumEerstVolgendeLevering)->format('d-m-Y') : '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                            Geen leveringsgegevens beschikbaar voor dit product.
                                        </td>
                                    </tr>
                                @endforelse
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if ($isOutOfStock)
        <script>
            let seconds = 4;
            const countdownEl = document.getElementById('countdown');
            const interval = setInterval(function() {
                seconds--;
                if (countdownEl) {
                    countdownEl.textContent = seconds;
                }
                if (seconds <= 0) {
                    clearInterval(interval);
                    window.location.href = "{{ route('magazijn.index') }}";
                }
            }, 1000);
        </script>
    @endif
</x-app-layout>
