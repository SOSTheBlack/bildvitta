<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as BuilderEloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as BuilderQuery;
use Illuminate\Support\Carbon;

/**
 * Class CoinConversion
 *
 * @package App\Models
 * @extends Model
 * @property int $id
 * @property string $origin
 * @property string $destiny
 * @property float $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static BuilderEloquent|CoinConversion newModelQuery()
 * @method static BuilderEloquent|CoinConversion newQuery()
 * @method static BuilderQuery|CoinConversion onlyTrashed()
 * @method static BuilderEloquent|CoinConversion query()
 * @method static BuilderEloquent|CoinConversion whereCreatedAt($value)
 * @method static BuilderEloquent|CoinConversion whereDeletedAt($value)
 * @method static BuilderEloquent|CoinConversion whereDestiny($value)
 * @method static BuilderEloquent|CoinConversion whereId($value)
 * @method static BuilderEloquent|CoinConversion whereOrigin($value)
 * @method static BuilderEloquent|CoinConversion wherePrice($value)
 * @method static BuilderEloquent|CoinConversion whereUpdatedAt($value)
 * @method static BuilderQuery|CoinConversion withTrashed()
 * @method static BuilderQuery|CoinConversion withoutTrashed()
 * @mixin \Eloquent
 */
class CoinConversion extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
