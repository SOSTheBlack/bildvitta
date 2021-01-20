<?php

namespace Tests\Feature\Api\Coins;

/**
 * Trait ConversonProvider
 *
 * @package Tests\Feature\Api\Coins
 */
trait ConversionProvider
{
    /**
     * @return array[]
     */
    public function coinConversionPerfectProvider(): array
    {
        return [
            [['coin_from' => 'USD', 'coin_to' => 'GBP', 'quantity' => 10]],
            [['coin_from' => 'BTC', 'coin_to' => 'ARS', 'quantity' => 5]],
            [['coin_from' => 'ARS', 'coin_to' => 'GBP', 'quantity' => 76]],
            [['coin_from' => 'BTC', 'coin_to' => 'BTC', 'quantity' => 52]],
            [['coin_from' => 'BRL', 'coin_to' => 'BTC', 'quantity' => 23]],
            [['coin_from' => 'EUR', 'coin_to' => 'BTC', 'quantity' => 8]],
            [['coin_from' => 'EUR', 'coin_to' => 'ARS', 'quantity' => 9]],
            [['coin_from' => 'EUR', 'coin_to' => 'BRL', 'quantity' => 87]],
            [['coin_from' => 'EUR', 'coin_to' => 'USD', 'quantity' => 66]],
            [['coin_from' => 'USD', 'coin_to' => 'ARS', 'quantity' => 333]],
            [['coin_from' => 'BRL', 'coin_to' => 'ARS', 'quantity' => 666]],
        ];
    }

    /**
     * @return array[]
     */
    public function coinConversionFailedProvider(): array
    {
        return [
            [[], ['quantity', 'coin_from', 'coin_to']],
            [['coin_from' => 'USD'], ['quantity', 'coin_to']],
            [['coin_to' => 'USD'], ['quantity', 'coin_from']],
            [['quantity' => 1], ['coin_to', 'coin_from']],
            [['coin_from' => 'USD', 'coin_to' => 'USD'], ['quantity']],
            [['quantity' => 10, 'coin_to' => 'USD'], ['coin_from']],
            [['coin_from' => 'USD', 'quantity' => 10], ['coin_to']],
        ];
    }

    /**
     * @return array[]
     */
    public function coinConversionNonexistentProvider(): array
    {
        return [
            [['coin_from' => '-', 'coin_to' => 'GBP', 'quantity' => 10], ['coin_from']],
            [['coin_from' => 'USDx', 'coin_to' => 'ARS', 'quantity' => 5], ['coin_from']],
            [['coin_from' => 'bBRL', 'coin_to' => 'GBP', 'quantity' => 76], ['coin_from']],
            [['coin_from' => '1234', 'coin_to' => 'BTC', 'quantity' => 52], ['coin_from']],
            [['coin_from' => '@@@', 'coin_to' => 'BTC', 'quantity' => 23], ['coin_from']],
            [['coin_from' => 'inject', 'coin_to' => 'BTC', 'quantity' => 8], ['coin_from']],
            [['coin_from' => 'bild', 'coin_to' => 'ARS', 'quantity' => 9], ['coin_from']],
            [['coin_from' => 'vitta', 'coin_to' => 'BRL', 'quantity' => 87], ['coin_from']],
            [['coin_from' => 'approve', 'coin_to' => 'USD', 'quantity' => 66], ['coin_from']],
            [['coin_from' => 'me', 'coin_to' => 'ARS', 'quantity' => 333], ['coin_from']],
            [['coin_from' => 'WoW', 'coin_to' => 'ARS', 'quantity' => 666], ['coin_from']],
            [['coin_to' => '-', 'coin_from' => 'GBP', 'quantity' => 10], ['coin_to']],
            [['coin_to' => 'USDx', 'coin_from' => 'ARS', 'quantity' => 5], ['coin_to']],
            [['coin_to' => 'bBRL', 'coin_from' => 'GBP', 'quantity' => 76], ['coin_to']],
            [['coin_to' => '01234', 'coin_from' => 'BTC', 'quantity' => 52], ['coin_to']],
            [['coin_to' => '@@@', 'coin_from' => 'BTC', 'quantity' => 23], ['coin_to']],
            [['coin_to' => '\/***', 'coin_from' => 'BTC', 'quantity' => 8], ['coin_to']],
            [['coin_to' => 'bild', 'coin_from' => 'ARS', 'quantity' => 9], ['coin_to']],
            [['coin_to' => 'vitta', 'coin_from' => 'BRL', 'quantity' => 87], ['coin_to']],
            [['coin_to' => 'approve', 'coin_from' => 'USD', 'quantity' => 66], ['coin_to']],
            [['coin_to' => 'me', 'coin_from' => 'ARS', 'quantity' => 333], ['coin_to']],
            [['coin_to' => 'WoW', 'coin_from' => 'ARS', 'quantity' => 666], ['coin_to']],
        ];
    }
}
