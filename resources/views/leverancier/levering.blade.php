<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Levering Product') }}
            </h2>
            <div class="flex items-center space-x-3">
                <a href="{{ route('leverancier.producten', $leverancier->Id) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none transition">
                    &larr; {{ __('Terug') }}
                </a>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-800 focus:outline-none transition">
                    {{ __('Home') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if ($isInactive && $errorMessage)
                <!-- User Story 2 Scenario 02: Melding product wordt niet meer geproduceerd -->
                <div class="p-6 bg-red-100 border border-red-400 text-red-800 rounded-lg shadow-sm dark:bg-red-950/50 dark:border-red-700 dark:text-red-300">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400 me-3 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                        <div>
                            <h4 class="text-base font-bold">{{ $errorMessage }}</h4>
                            <p class="text-xs font-normal text-red-700 dark:text-red-400 mt-2">
                                U wordt over <span id="countdown" class="font-bold">4</span> seconden automatisch doorgestuurd naar het overzicht van geleverde producten...
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Wireframe-04 Form Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Top Details Header (Wireframe-04) -->
                <div class="border-b pb-4 mb-6 border-gray-200 dark:border-gray-700 space-y-2 text-sm">
                    <div>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">Product:</span>
                        <span class="ms-2 text-gray-900 dark:text-gray-100 font-medium">{{ $product->Naam }}</span>
                    </div>
                    <div>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">Leverancier:</span>
                        <span class="ms-2 text-gray-900 dark:text-gray-100 font-medium">{{ $leverancier->Naam }}</span>
                    </div>
                    <div>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">Contactpersoon:</span>
                        <span class="ms-2 text-gray-900 dark:text-gray-100">{{ $leverancier->ContactPersoon }}</span>
                    </div>
                    <div>
                        <span class="font-semibold text-gray-700 dark:text-gray-300">Mobiel:</span>
                        <span class="ms-2 text-gray-900 dark:text-gray-100">{{ $leverancier->Mobiel }}</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('leverancier.levering.store', [$leverancier->Id, $product->Id]) }}" class="space-y-6">
                    @csrf

                    <!-- Aantal producteenheden -->
                    <div>
                        <x-input-label for="aantal" :value="__('Aantal producteenheden')" class="font-semibold text-gray-700 dark:text-gray-300" />
                        <x-text-input id="aantal" 
                                      name="aantal" 
                                      type="number" 
                                      min="1" 
                                      class="mt-1 block w-full" 
                                      :value="old('aantal', $submittedAantal ?? '')" 
                                      required 
                                      autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('aantal')" />
                    </div>

                    <!-- Datum eerstvolgende levering -->
                    <div>
                        <x-input-label for="datum_eerstvolgende_levering" :value="__('Datum eerstvolgende levering')" class="font-semibold text-gray-700 dark:text-gray-300" />
                        <x-text-input id="datum_eerstvolgende_levering" 
                                      name="datum_eerstvolgende_levering" 
                                      type="date" 
                                      class="mt-1 block w-full" 
                                      :value="old('datum_eerstvolgende_levering', $submittedDatum ?? '')" 
                                      required />
                        <x-input-error class="mt-2" :messages="$errors->get('datum_eerstvolgende_levering')" />
                    </div>

                    <!-- Action buttons (Wireframe-04: Sla op, Terug, Home) -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                        <x-primary-button>
                            {{ __('Sla op') }}
                        </x-primary-button>

                        <div class="flex items-center space-x-3">
                            <a href="{{ route('leverancier.producten', $leverancier->Id) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none transition">
                                {{ __('Terug') }}
                            </a>
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-800 focus:outline-none transition">
                                {{ __('Home') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($isInactive)
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
                    window.location.href = "{{ route('leverancier.producten', $leverancier->Id) }}";
                }
            }, 1000);
        </script>
    @endif
</x-app-layout>

