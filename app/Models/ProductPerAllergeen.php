<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPerAllergeen extends Model
{
    use HasFactory;

    protected $table = 'ProductPerAllergeen';
    protected $primaryKey = 'Id';

    const CREATED_AT = 'DatumAangemaakt';
    const UPDATED_AT = 'DatumGewijzigd';

    protected $fillable = [
        'ProductId',
        'AllergeenId',
        'IsActief',
        'Opmerkingen',
        'DatumAangemaakt',
        'DatumGewijzigd',
    ];

    protected $casts = [
        'IsActief' => 'boolean',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'ProductId', 'Id');
    }

    public function allergeen(): BelongsTo
    {
        return $this->belongsTo(Allergeen::class, 'AllergeenId', 'Id');
    }
}
