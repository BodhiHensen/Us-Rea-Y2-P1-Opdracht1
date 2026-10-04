<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Leverancier extends Model
{
    use HasFactory;

    protected $table = 'Leverancier';
    protected $primaryKey = 'Id';

    const CREATED_AT = 'DatumAangemaakt';
    const UPDATED_AT = 'DatumGewijzigd';

    protected $fillable = [
        'Naam',
        'ContactPersoon',
        'LeverancierNummer',
        'Mobiel',
        'IsActief',
        'Opmerkingen',
        'DatumAangemaakt',
        'DatumGewijzigd',
    ];

    protected $casts = [
        'IsActief' => 'boolean',
    ];

    public function productPerLeverancier(): HasMany
    {
        return $this->hasMany(ProductPerLeverancier::class, 'LeverancierId', 'Id');
    }

    public function producten(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'ProductPerLeverancier', 'LeverancierId', 'ProductId', 'Id', 'Id');
    }
}
