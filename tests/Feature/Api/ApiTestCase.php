<?php

namespace Tests\Feature\Api;

use Tests\TestCase;

/**
 * Class ApiTestCase
 *
 * @package Tests\Feature\Api
 */
class ApiTestCase extends TestCase
{
    /**
     * @var array
     */
    protected array $headers;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->structureHeaders();
    }

    /**
     * @return void
     */
    private function structureHeaders(): void
    {
        $this->headers = [
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
            'Token'        => config('services.api.token'),
        ];
    }
}
