<?php

use App\Models\Magazijn;
use App\Models\Product;
use App\Models\ProductPerLeverancier;
use App\Models\User;

beforeEach(function () {
    $this->seed();
    $this->user = User::factory()->create([
        'rolename' => 'magazijnmedewerker',
    ]);
});

test('suppliers overview displays suppliers sorted by distinct product count descending (Wireframe-01)', function () {
    $response = $this->actingAs($this->user)->get(route('leverancier.index'));

    $response->assertStatus(200);
    $response->assertSee('Overzicht leveranciers');
    $response->assertSee('Venco');
    $response->assertSee('Bert van Linge');
    $response->assertSee('L1029384719');
    $response->assertSee('06-28493827');
    $response->assertSee('Quality Street');
    $response->assertSee('Johan Nooij');

    // Supplier with 3 distinct products appears before supplier with 1 distinct product
    $content = $response->getContent();
    $vencoPos = strpos($content, 'Venco');
    $bassetPos = strpos($content, 'Basset');
    $qualityStreetPos = strpos($content, 'Quality Street');

    expect($vencoPos)->toBeLessThan($bassetPos);
    expect($bassetPos)->toBeLessThan($qualityStreetPos);
});

test('user story 1 scenario 01: successful delivered products view for supplier with products (Wireframe-02)', function () {
    // Venco (Id: 1)
    $response = $this->actingAs($this->user)->get(route('leverancier.producten', 1));

    $response->assertStatus(200);
    $response->assertSee('Geleverde producten');
    $response->assertSee('Venco');
    $response->assertSee('Bert van Linge');
    $response->assertSee('L1029384719');
    $response->assertSee('06-28493827');
    $response->assertSee('Mintnopjes');
    $response->assertSee('Schoolkrijt');
    $response->assertSee('Honingdrop');
    $response->assertSee('453');
    $response->assertSee('5 kg');

    // Products are sorted by stock descending: Mintnopjes (453) before Honingdrop (1)
    $content = $response->getContent();
    $mintnopjesPos = strpos($content, 'Mintnopjes');
    $honingdropPos = strpos($content, 'Honingdrop');

    expect($mintnopjesPos)->toBeLessThan($honingdropPos);
});

test('user story 1 scenario 02: supplier with no delivered products displays message and 3-second countdown (Wireframe-03)', function () {
    // Quality Street (Id: 6) has 0 delivered products
    $response = $this->actingAs($this->user)->get(route('leverancier.producten', 6));

    $response->assertStatus(200);
    $response->assertSee('Geleverde producten');
    $response->assertSee('Quality Street');
    $response->assertSee('Johan Nooij');
    $response->assertSee('Dit bedrijf heeft tot nu toe geen producten geleverd aan Jamin');
    $response->assertSee('countdown');
    $response->assertSee('3');
});

test('user story 2 scenario 01: adding delivery increases warehouse stock and updates last delivery date (Wireframe-04)', function () {
    // Initial warehouse stock for Mintnopjes (Id: 1) is 453
    $initialStock = Magazijn::where('ProductId', 1)->value('AantalAanwezig');
    expect($initialStock)->toBe(453);

    // View delivery form
    $formResponse = $this->actingAs($this->user)->get(route('leverancier.levering.create', [1, 1]));
    $formResponse->assertStatus(200);
    $formResponse->assertSee('Levering Product');
    $formResponse->assertSee('Mintnopjes');
    $formResponse->assertSee('Venco');
    $formResponse->assertSee('Bert van Linge');

    // Submit delivery of 25 units
    $submitResponse = $this->actingAs($this->user)->post(route('leverancier.levering.store', [1, 1]), [
        'aantal' => 25,
        'datum_eerstvolgende_levering' => '2024-05-29',
    ]);

    $submitResponse->assertRedirect(route('leverancier.producten', 1));

    // Verify warehouse stock increased by 25
    $updatedStock = Magazijn::where('ProductId', 1)->value('AantalAanwezig');
    expect($updatedStock)->toBe(453 + 25);

    // Verify delivery record was created
    $newDelivery = ProductPerLeverancier::where('LeverancierId', 1)
        ->where('ProductId', 1)
        ->where('Aantal', 25)
        ->first();

    expect($newDelivery)->not->toBeNull();
    expect($newDelivery->DatumLevering->format('Y-m-d'))->toBe(now()->toDateString());
    expect($newDelivery->DatumEerstVolgendeLevering->format('Y-m-d'))->toBe('2024-05-29');

    // When viewing delivered products again, new stock is visible
    $viewResponse = $this->actingAs($this->user)->get(route('leverancier.producten', 1));
    $viewResponse->assertSee('478');
});

test('user story 2 scenario 02: adding delivery for inactive product displays message and 4-second countdown (Wireframe-04)', function () {
    // Winegums (ProductId 10) is inactive for Basset (LeverancierId 4)
    $product = Product::find(10);
    expect($product->IsActief)->toBeFalse();

    // View form
    $formResponse = $this->actingAs($this->user)->get(route('leverancier.levering.create', [4, 10]));
    $formResponse->assertStatus(200);
    $formResponse->assertSee('Winegums');
    $formResponse->assertSee('Basset');

    // Submit form with 30 units and today's date
    $submitResponse = $this->actingAs($this->user)->post(route('leverancier.levering.store', [4, 10]), [
        'aantal' => 30,
        'datum_eerstvolgende_levering' => now()->toDateString(),
    ]);

    // Should stay on form with message and 4-second countdown
    $submitResponse->assertStatus(200);
    $submitResponse->assertSee('Het product Winegums van de leverancier Basset wordt niet meer geproduceerd');
    $submitResponse->assertSee('countdown');
    $submitResponse->assertSee('4');

    // Stock for Winegums should not be affected
    $winegumsStock = Magazijn::where('ProductId', 10)->value('AantalAanwezig');
    expect($winegumsStock)->toBeNull();

    // No new delivery row with 30 units should exist
    $unexpectedDelivery = ProductPerLeverancier::where('LeverancierId', 4)
        ->where('ProductId', 10)
        ->where('Aantal', 30)
        ->first();
    expect($unexpectedDelivery)->toBeNull();
});

