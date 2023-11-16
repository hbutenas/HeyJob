<?php

namespace App\Http\Controllers\Api\V1\Companies;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Companies\ShowCompanyRequest;
use App\Http\Requests\Api\V1\Companies\UpdateCompanyRequest;
use App\Http\Services\Api\V1\Companies\CompaniesService;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{

    protected $companiesService;

    public function __construct(CompaniesService $companiesService)
    {
        $this->companiesService = $companiesService;
    }

    public function update(UpdateCompanyRequest $request): object
    {
        return $this->companiesService->update($request);
    }

    public function index(): object
    {
        return $this->companiesService->index();
    }

    public function show(ShowCompanyRequest $request): object
    {
        return $this->companiesService->show((int)$request->id);
    }
}
