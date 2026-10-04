<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPerLeverancier extends Model
{
    use HasFactory;

    protected $table = 'ProductPerLeverancier';
    protected $primaryKey = 'Id';

    const CREATED_AT = 'DatumAangemaakt';
    const UPDATED_AT = 'DatumGewijzigd';

    protected $fillable = [
        'LeverancierId',
        'ProductId',
        'DatumLevering',
        'Aantal',
        'DatumEerstVolgendeLevering',
        'IsActief',
        'Opmerkingen',
        'DatumAangemaakt',
        'DatumGewijzigd',
    ];

    protected $casts = [
        'DatumLevering' => 'date',
        'DatumEerstVolgendeLevering' => 'date',
        'Aantal' => 'integer',
        'IsActief' => 'boolean',
    ];

    public function leverancier(): BelongsTo
    {
        return $this->belongsTo(Leverancier::class, 'LeverancierId', 'Id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'ProductId', 'Id');
    }
}
