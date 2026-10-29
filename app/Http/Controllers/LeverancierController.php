<?php

namespace App\Http\Controllers;

use App\Models\Leverancier;
use App\Models\Magazijn;
use App\Models\Product;
use App\Models\ProductPerLeverancier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class LeverancierController extends Controller
{
    /**
     * Display supplier overview (Overzicht leveranciers) - Wireframe-01.
     * Sorted by distinct delivered products count descending.
     */
    public function index(): View
    {
        $leveranciers = Leverancier::leftJoin('ProductPerLeverancier', 'Leverancier.Id', '=', 'ProductPerLeverancier.LeverancierId')
            ->select(
                'Leverancier.*',
                DB::raw('COUNT(DISTINCT ProductPerLeverancier.ProductId) as aantal_verschillende_producten')
            )
            ->groupBy(
                'Leverancier.Id',
                'Leverancier.Naam',
                'Leverancier.ContactPersoon',
                'Leverancier.LeverancierNummer',
                'Leverancier.Mobiel',
                'Leverancier.IsActief',
                'Leverancier.Opmerkingen',
                'Leverancier.DatumAangemaakt',
                'Leverancier.DatumGewijzigd'
            )
            ->orderByDesc('aantal_verschillende_producten')
            ->orderBy('Leverancier.Naam', 'asc')
            ->get();

        return view('leverancier.index', compact('leveranciers'));
    }

    /**
     * Display delivered products for a supplier (Geleverde producten) - Wireframe-02 / Wireframe-03.
     */
    public function producten(int|string $leverancierId): View
    {
        $leverancier = Leverancier::findOrFail($leverancierId);

        $geleverdeProducten = DB::table('ProductPerLeverancier as ppl')
            ->join('Product as p', 'ppl.ProductId', '=', 'p.Id')
            ->leftJoin('Magazijn as m', 'p.Id', '=', 'm.ProductId')
            ->where('ppl.LeverancierId', $leverancier->Id)
            ->select(
                'p.Id as ProductId',
                'p.Naam as NaamProduct',
                'p.IsActief as IsActief',
                'm.AantalAanwezig',
                'm.VerpakkingsEenheid',
                DB::raw('MAX(ppl.DatumLevering) as LaatsteLevering')
            )
            ->groupBy('p.Id', 'p.Naam', 'p.IsActief', 'm.AantalAanwezig', 'm.VerpakkingsEenheid')
            ->orderByDesc('m.AantalAanwezig')
            ->get();

        $hasDeliveredProducts = $geleverdeProducten->isNotEmpty();

        return view('leverancier.producten', compact('leverancier', 'geleverdeProducten', 'hasDeliveredProducts'));
    }

    /**
     * Display delivery form (Levering product) - Wireframe-04.
     */
    public function leveringCreate(int|string $leverancierId, int|string $productId): View
    {
        $leverancier = Leverancier::findOrFail($leverancierId);
        $product = Product::findOrFail($productId);

        return view('leverancier.levering', [
            'leverancier' => $leverancier,
            'product' => $product,
            'isInactive' => false,
            'errorMessage' => null,
        ]);
    }

    /**
     * Process new product delivery - User Story 2 (Scenario 01 & Scenario 02).
     */
    public function leveringStore(Request $request, int|string $leverancierId, int|string $productId): View|RedirectResponse
    {
        $validated = $request->validate([
            'aantal' => ['required', 'integer', 'min:1'],
            'datum_eerstvolgende_levering' => ['required', 'date'],
        ]);

        $leverancier = Leverancier::findOrFail($leverancierId);
        $product = Product::findOrFail($productId);

        // Scenario 02: Check if product is active
        if (! $product->IsActief) {
            return view('leverancier.levering', [
                'leverancier' => $leverancier,
                'product' => $product,
                'isInactive' => true,
                'errorMessage' => "Het product {$product->Naam} van de leverancier {$leverancier->Naam} wordt niet meer geproduceerd",
                'submittedAantal' => $validated['aantal'],
                'submittedDatum' => $validated['datum_eerstvolgende_levering'],
            ]);
        }

        // Scenario 01: Create new delivery record in ProductPerLeverancier
        ProductPerLeverancier::create([
            'LeverancierId' => $leverancier->Id,
            'ProductId' => $product->Id,
            'DatumLevering' => now()->toDateString(),
            'Aantal' => $validated['aantal'],
            'DatumEerstVolgendeLevering' => $validated['datum_eerstvolgende_levering'],
            'IsActief' => 1,
            'DatumAangemaakt' => now(),
            'DatumGewijzigd' => now(),
        ]);

        // Increase stock in Magazijn
        $magazijn = Magazijn::where('ProductId', $product->Id)->first();
        if ($magazijn) {
            $magazijn->AantalAanwezig = ($magazijn->AantalAanwezig ?? 0) + (int) $validated['aantal'];
            $magazijn->DatumGewijzigd = now();
            $magazijn->save();
        }

        return redirect()
            ->route('leverancier.producten', $leverancier->Id)
            ->with('status', 'Levering succesvol opgeslagen.');
    }
}

