<?php

namespace App\Http\Controllers\Api\V1\Applications;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Applications\ApplyApplicationRequest;
use App\Http\Requests\Api\V1\Applications\ShowApplicationRequest;
use App\Http\Services\Api\V1\Applications\ApplicationsService;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{

    protected $applicationsService;

    public function __construct(ApplicationsService $applicationsService)
    {
        $this->applicationsService = $applicationsService;
    }

    public function apply(ApplyApplicationRequest $request): object
    {
        return $this->applicationsService->apply((int)$request->id);
    }

    public function index(): object
    {
        return $this->applicationsService->index();
    }

    public function show(ShowApplicationRequest $request)
    {
        return $this->applicationsService->show((int)$request->id);
    }
}
