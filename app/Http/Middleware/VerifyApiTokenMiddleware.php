<?php

namespace App\Http\Middleware;

use App\Exceptions\Api\TokenException;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class PrivateApiMiddleware
 *
 * @package App\Http\Middleware
 */
class VerifyApiTokenMiddleware
{
    /**
     * Token key name.
     *
     * @const string
     */
    private const HEADER_TOKEN_KEY = 'token';

    /**
     * Token of private API.
     *
     * @var string
     */
    private string $privateToken;

    /**
     * @var Request
     */
    private Request $request;

    /**
     * PrivateApiMiddleware constructor.
     */
    public function __construct()
    {
        $this->privateToken = config('services.api.token');
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     *
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next): JsonResponse
    {
        $this->request = $request;

        $this->hasTokenHeader();

        $this->matchingTokenHeader();

        return $next($request);
    }

    /**
     * @retunr void
     *
     * @throws TokenException
     */
    private function hasTokenHeader(): void
    {
        if (! $this->request->hasHeader(self::HEADER_TOKEN_KEY)) {
            throw new TokenException(401, 'missing token, is has required', code: 1001);
        }
    }

    /**
     * @throws TokenException
     *
     * @retunr void
     */
    private function matchingTokenHeader(): void
    {
        if ($this->privateToken !== $this->request->header(self::HEADER_TOKEN_KEY)) {
            throw new TokenException(401, 'invalid token', code: 1002);
        }
    }
}
