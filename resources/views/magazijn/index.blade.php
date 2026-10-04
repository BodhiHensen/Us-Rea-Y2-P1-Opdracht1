<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Overzicht Magazijn Jamin') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 border border-gray-200 dark:border-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-b">
                                    Barcode
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-b">
                                    Naam
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-b">
                                    Verpakkingseenheid
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-b">
                                    Aantal aanwezig
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-b">
                                    Allergenen Info
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider border-b">
                                    Leverantie Info
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($magazijnProducten as $item)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-900 dark:text-gray-100">
                                        {{ $item->product->Barcode }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ $item->product->Naam }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                        {{ rtrim(rtrim(number_format($item->VerpakkingsEenheid, 1, ',', ''), '0'), ',') }} kg
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                        {{ is_null($item->AantalAanwezig) ? '-' : $item->AantalAanwezig }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <a href="{{ route('magazijn.allergenen', $item->product->Id) }}" 
                                           class="inline-flex items-center justify-center w-8 h-8 rounded-full text-red-600 hover:text-red-800 hover:bg-red-50 dark:hover:bg-red-900/30 transition"
                                           title="Allergenen Informatie">
                                            <span class="text-lg font-bold">❌</span>
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <a href="{{ route('magazijn.levering', $item->product->Id) }}" 
                                           class="inline-flex items-center justify-center w-8 h-8 rounded-full text-blue-600 hover:text-blue-800 hover:bg-blue-50 dark:hover:bg-blue-900/30 transition"
                                           title="Leveringsinformatie">
                                            <span class="text-xl font-bold text-blue-600 dark:text-blue-400">❓</span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                        Geen magazijnproducten gevonden.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
