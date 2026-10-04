<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Allergeen extends Model
{
    use HasFactory;

    protected $table = 'Allergeen';
    protected $primaryKey = 'Id';

    const CREATED_AT = 'DatumAangemaakt';
    const UPDATED_AT = 'DatumGewijzigd';

    protected $fillable = [
        'Naam',
        'Omschrijving',
        'IsActief',
        'Opmerkingen',
        'DatumAangemaakt',
        'DatumGewijzigd',
    ];

    protected $casts = [
        'IsActief' => 'boolean',
    ];

    public function producten(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'ProductPerAllergeen', 'AllergeenId', 'ProductId', 'Id', 'Id');
    }

    public function productPerAllergeen(): HasMany
    {
        return $this->hasMany(ProductPerAllergeen::class, 'AllergeenId', 'Id');
    }
}
