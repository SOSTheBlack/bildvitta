<?php

namespace Tests\Feature\Api\Coins;

use App\Components\Grifo\Grifo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Api\ApiTestCase;

/**
 * Class ConversionTest
 *
 * @package Tests\Feature\Api\Coins
 */
class ConversionTest extends ApiTestCase
{
    use RefreshDatabase, ConversionProvider;

    /**
     * @var Grifo
     */
    private Grifo $grifo;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->grifo = app(Grifo::class);
    }

    /**
     * A basic feature test example.
     *
     * @param  array  $data
     *
     * @return void
     *
     * @dataProvider coinConversionPerfectProvider
     */
    public function testCoinConversionWithSuccess(array $data): void
    {
        $this->grifo->setOrigin($data['coin_from']);
        $this->grifo->setDestiny($data['coin_to']);
        $price = floor($this->grifo->conversionPrice($data['quantity']) * 100) / 100;

        $response = $this->json('GET', route('api.coins.conversion'), $data, $this->headers);
        $response
            ->assertSuccessful()
            ->assertExactJson(['data' => array_merge($data, ['price' => $price])]);
    }

    /**
     * @dataProvider coinConversionFailedProvider
     *
     * @param  array  $data
     * @param  array  $errors
     *
     * @return void
     */
    public function testHasValidationInputs(array $data, array $errors): void
    {
        $response = $this->json('GET', route('api.coins.conversion'), $data, $this->headers);

        $response
            ->assertStatus(422)
            ->assertJson(['message' => 'The given data was invalid.'])
            ->assertJsonValidationErrors($errors)
            ->assertJsonMissingValidationErrors($data)
            ->assertJsonStructure(['message', 'errors' => $errors]);
    }

    /**
     * @param  array  $data
     * @param  array  $errors
     *
     * @dataProvider coinConversionNonexistentProvider
     */
    public function testIfCoinExistsInDatabase(array $data, array $errors): void
    {
        $response = $this->json('GET', route('api.coins.conversion'), $data, $this->headers);

        $response
            ->assertStatus(422)
            ->assertJson(['message' => 'The given data was invalid.'])
            ->assertJsonValidationErrors($errors)
            ->assertJsonMissingValidationErrors($data)
            ->assertJsonStructure(['message', 'errors' => $errors]);
    }
}
