<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $table = 'Product';
    protected $primaryKey = 'Id';

    const CREATED_AT = 'DatumAangemaakt';
    const UPDATED_AT = 'DatumGewijzigd';

    protected $fillable = [
        'Naam',
        'Barcode',
        'IsActief',
        'Opmerkingen',
        'DatumAangemaakt',
        'DatumGewijzigd',
    ];

    protected $casts = [
        'IsActief' => 'boolean',
    ];

    public function magazijn(): HasOne
    {
        return $this->hasOne(Magazijn::class, 'ProductId', 'Id');
    }

    public function allergenen(): BelongsToMany
    {
        return $this->belongsToMany(Allergeen::class, 'ProductPerAllergeen', 'ProductId', 'AllergeenId', 'Id', 'Id');
    }

    public function productPerAllergeen(): HasMany
    {
        return $this->hasMany(ProductPerAllergeen::class, 'ProductId', 'Id');
    }

    public function productPerLeverancier(): HasMany
    {
        return $this->hasMany(ProductPerLeverancier::class, 'ProductId', 'Id');
    }

    public function leveranciers(): BelongsToMany
    {
        return $this->belongsToMany(Leverancier::class, 'ProductPerLeverancier', 'ProductId', 'LeverancierId', 'Id', 'Id');
    }
}
