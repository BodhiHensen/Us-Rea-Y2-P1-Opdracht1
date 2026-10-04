<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Overzicht Allergenen') }}
            </h2>
            <a href="{{ route('magazijn.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none transition">
                &larr; Terug naar Magazijn Overzicht
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Product Gegevens Header Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4 border-b pb-2 border-gray-200 dark:border-gray-700">
                    Product Gegevens
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">Naam Product:</span>
                        <span class="ms-2 text-gray-900 dark:text-gray-100 font-medium">{{ $product->Naam }}</span>
                    </div>
                    <div>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">Barcode:</span>
                        <span class="ms-2 font-mono text-gray-900 dark:text-gray-100">{{ $product->Barcode }}</span>
                    </div>
                </div>
            </div>

            <!-- Allergenen Tabel Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 border border-gray-200 dark:border-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-b w-1/3">
                                    Naam
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-b">
                                    Omschrijving
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @if ($hasNoAllergens)
                                <tr>
                                    <td colspan="2" class="px-6 py-8 text-center text-base font-semibold text-green-600 dark:text-green-400 bg-green-50/50 dark:bg-green-950/20">
                                        In dit product zitten geen stoffen die een allergische reactie kunnen veroorzaken
                                        <div class="text-xs font-normal text-gray-500 dark:text-gray-400 mt-2">
                                            U wordt over <span id="countdown">4</span> seconden automatisch teruggestuurd naar het overzicht...
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @forelse ($product->allergenen as $allergeen)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-gray-100">
                                            {{ $allergeen->Naam }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ $allergeen->Omschrijving }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                            Geen allergeneninformatie beschikbaar.
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

    @if ($hasNoAllergens)
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
