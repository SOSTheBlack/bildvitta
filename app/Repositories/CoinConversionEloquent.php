<?php

namespace App\Repositories;

use App\Exceptions\Repositories\QueryException;
use App\Models\CoinConversion;
use App\Repositories\Contracts\CoinConversionRepository;
use Throwable;

/**
 * Class CoinConversionEloquent
 *
 * @package App\Repositories
 */
class CoinConversionEloquent implements CoinConversionRepository
{
    /**
     * Model CoinConversion
     *
     * @var CoinConversion
     */
    protected CoinConversion $model;

    /**
     * CoinConversionEloquent constructor.
     *
     * @param  CoinConversion  $coinConversion
     */
    public function __construct(CoinConversion $coinConversion)
    {
        $this->model = $coinConversion;
    }

    /**
     * @param  array  $attributes
     *
     * @return bool always returns true.
     *
     * @throws QueryException
     */
    public function create(array $attributes): bool
    {
        try {
            $this->resetModel();

            $this->model->origin = $attributes['origin'];
            $this->model->destiny = $attributes['destiny'];
            $this->model->price = $attributes['price'];

            return $this->model->saveOrFail($attributes);
        } catch (Throwable $exception) {
            throw new QueryException('error when inserting database: '.$exception->getMessage(), 1001, $exception);
        }
    }

    /**
     * Reset model.
     *
     * @return void
     */
    private function resetModel(): void
    {
        $this->model = app($this->model::class);
    }
}
