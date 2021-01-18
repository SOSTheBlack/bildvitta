<?php

namespace Database\Seeders;

use App\Repositories\Contracts\CoinConversionRepository;
use Illuminate\Database\Seeder;
use Throwable;

/**
 * Class CoinConversionSeeder
 *
 * @package Database\Seeders
 */
class CoinConversionSeeder extends Seeder
{
    /**
     * @var CoinConversionRepository
     */
    protected CoinConversionRepository $coinConversionRepository;

    /**
     * CoinConversionSeeder constructor.
     *
     * @param  CoinConversionRepository  $coinConversionRepository
     */
    public function __construct(CoinConversionRepository $coinConversionRepository)
    {
        $this->coinConversionRepository = $coinConversionRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        try {
            $graph = ['origin' => 'USD', 'destiny' => 'BRL', 'price' => 5.65];
            $this->coinConversionRepository->create($graph);

            $graph = ['origin' => 'ARS', 'destiny' => 'BRL', 'price' => 0.07];
            $this->coinConversionRepository->create($graph);

            $graph = ['origin' => 'EUR', 'destiny' => 'USD', 'price' => 1.18];
            $this->coinConversionRepository->create($graph);

            $graph = ['origin' => 'GBP', 'destiny' => 'BRL', 'price' => 7.24];
            $this->coinConversionRepository->create($graph);

            $graph = ['origin' => 'BTC', 'destiny' => 'USD', 'price' => 10700];
            $this->coinConversionRepository->create($graph);
        } catch (Throwable $exception) {
            //
        }
    }
}
