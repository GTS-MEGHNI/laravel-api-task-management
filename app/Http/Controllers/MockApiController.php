<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

final class MockApiController extends ApiController
{
    public function testSuccess(): Response
    {
        return $this->respondSuccess();
    }

    public function testError(): Response
    {
        return $this->respondError();
    }

    public function testNotFound(): Response
    {
        return $this->respondNotFound();
    }

    public function testUnauthorized(): Response
    {
        return $this->respondUnauthorized();
    }

    public function testForbidden(): Response
    {
        return $this->respondForbidden();
    }

    public function testInternalError(): Response
    {
        return $this->respondInternalError();
    }

    public function testNoContent(): Response
    {
        return $this->respondNoContent();
    }

    public function testCreated(): Response
    {
        return $this->respondCreated();
    }

    public function testWithPagination(): Response
    {
        $paginator = new LengthAwarePaginator([], 0, 10);

        return $this->respondWithPagination($paginator);
    }

    public function testValidationErrors(): Response
    {
        return $this->respondValidationErrors([]);
    }

    public function testMethodNotAllowed(): Response
    {
        return $this->respondMethodNotAllowed();
    }

    public function testTooManyRequests(): Response
    {
        return $this->respondTooManyRequests();
    }
}
