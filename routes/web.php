<?php

use App\Component\Grifo\GrifoComponent;
use Illuminate\Support\Facades\Route;

$coinConversionComponent = new GrifoComponent();
$coinConversionComponent->loadConversionList();
$test1 = $coinConversionComponent->setOrigin('USD')->setDestiny('GBP')->setQuantity(10)->get();
$test2 = $coinConversionComponent->setOrigin('BTC')->setDestiny('ARS')->setQuantity(5)->get();

dd($test1, $test2);

Route::get('/', function () {
    return view('welcome');
});
