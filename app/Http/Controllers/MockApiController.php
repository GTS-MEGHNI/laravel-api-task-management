<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class MockApiController extends ApiController
{
    public function testSuccess(): Response
    {
        $data = User::query()->firstOrFail()->toResource();

        return $this->respondSuccess($data);
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
        $data = User::query()->firstOrFail()->toResource();

        return $this->respondCreated($data);
    }

    /**
     * @throws Throwable
     */
    public function testWithPagination(): Response
    {
        $paginator = User::query()->paginate(10);
        $data = $paginator->toResourceCollection();

        return $this->respondWithPagination($paginator, $data);
    }

    public function testValidationErrors(): Response
    {
        return $this->respondValidationErrors();
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
