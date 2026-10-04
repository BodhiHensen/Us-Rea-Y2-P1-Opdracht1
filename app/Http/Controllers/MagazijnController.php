<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Magazijn;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MagazijnController extends Controller
{
    /**
     * Display warehouse overview (Overzicht Magazijn Jamin).
     */
    public function index()
    {
        $magazijnProducten = Magazijn::with('product')
            ->join('Product', 'Magazijn.ProductId', '=', 'Product.Id')
            ->select('Magazijn.*')
            ->orderBy('Product.Barcode', 'asc')
            ->get();

        return view('magazijn.index', compact('magazijnProducten'));
    }

    /**
     * Display delivery information (Levering Informatie) - User Story 1.
     */
    public function levering($productId)
    {
        $product = Product::with(['magazijn', 'productPerLeverancier.leverancier'])->findOrFail($productId);
        $magazijn = $product->magazijn;

        // Check stock (Scenario 02)
        $isOutOfStock = is_null($magazijn?->AantalAanwezig) || $magazijn?->AantalAanwezig === 0;

        // Get levering records sorted by DatumLevering ascending
        $leveringen = $product->productPerLeverancier()->orderBy('DatumLevering', 'asc')->get();

        // Get primary supplier info
        $leverancier = $leveringen->first()?->leverancier;

        // Next expected delivery date
        $eerstVolgendeLevering = $leveringen->first(fn($l) => !is_null($l->DatumEerstVolgendeLevering))?->DatumEerstVolgendeLevering;
        $formattedNextDelivery = $eerstVolgendeLevering ? Carbon::parse($eerstVolgendeLevering)->format('d-m-Y') : null;

        return view('magazijn.levering', compact('product', 'leverancier', 'leveringen', 'isOutOfStock', 'formattedNextDelivery'));
    }

    /**
     * Display allergen information (Overzicht Allergenen) - User Story 2.
     */
    public function allergenen($productId)
    {
        $product = Product::with(['allergenen' => function ($query) {
            $query->orderBy('Naam', 'asc');
        }])->findOrFail($productId);

        $hasNoAllergens = $product->allergenen->isEmpty();

        return view('magazijn.allergenen', compact('product', 'hasNoAllergens'));
    }
}
