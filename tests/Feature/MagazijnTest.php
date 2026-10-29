<?php

use App\Models\User;
use App\Models\Product;

beforeEach(function () {
    $this->seed();
    $this->user = User::factory()->create([
        'rolename' => 'magazijnmedewerker',
    ]);
});

test('warehouse overview displays products sorted by barcode ascending', function () {
    $response = $this->actingAs($this->user)->get(route('magazijn.index'));

    $response->assertStatus(200);
    $response->assertSee('Overzicht Magazijn Jamin');
    $response->assertSee('Mintnopjes');
    $response->assertSee('8719587231278');
    $response->assertSee('Winegums');
    $response->assertSee('8719587327527');
});

test('user story 1 scenario 01: successful delivery information view for product in stock', function () {
    // Mintnopjes (Id: 1)
    $response = $this->actingAs($this->user)->get(route('magazijn.levering', 1));

    $response->assertStatus(200);
    $response->assertSee('LeveringsInformatie');
    $response->assertSee('Venco');
    $response->assertSee('Bert van Linge');
    $response->assertSee('L1029384719');
    $response->assertSee('06-28493827');
    $response->assertSee('Mintnopjes');
    $response->assertSee('09-11-2024');
    $response->assertSee('16-11-2024');
});

test('user story 1 scenario 02: delivery info for out-of-stock product displays warning message and countdown', function () {
    // Winegums (Id: 10, AantalAanwezig is null)
    $response = $this->actingAs($this->user)->get(route('magazijn.levering', 10));

    $response->assertStatus(200);
    $response->assertSee('Er is van dit product op dit moment geen voorraad aanwezig, de verwachte eerstvolgende levering is: 30-11-2024');
    $response->assertSee('countdown');
});

test('user story 2 scenario 01: successful allergen information view for product with allergens', function () {
    // Zoute Ruitjes (Id: 13) has Gluten, Lactose, Soja
    $response = $this->actingAs($this->user)->get(route('magazijn.allergenen', 13));

    $response->assertStatus(200);
    $response->assertSee('Overzicht Allergenen');
    $response->assertSee('Zoute Ruitjes');
    $response->assertSee('8719587323256');
    $response->assertSee('Gluten');
    $response->assertSee('Dit product bevat gluten');
    $response->assertSee('Lactose');
    $response->assertSee('Soja');
});

test('user story 2 scenario 02: allergen info for product without allergens displays message and countdown', function () {
    // Cola Flesjes (Id: 5) has no allergens
    $response = $this->actingAs($this->user)->get(route('magazijn.allergenen', 5));

    $response->assertStatus(200);
    $response->assertSee('Overzicht Allergenen');
    $response->assertSee('Cola Flesjes');
    $response->assertSee('8719587321237');
    $response->assertSee('In dit product zitten geen stoffen die een allergische reactie kunnen veroorzaken');
    $response->assertSee('countdown');
});
