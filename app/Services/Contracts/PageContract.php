<?php

namespace App\Services\Contracts;

use Illuminate\Http\Request;

interface PageContract
{
    public function index(Request $request): array;
}
