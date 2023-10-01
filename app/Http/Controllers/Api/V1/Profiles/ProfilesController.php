<?php

namespace App\Http\Controllers\Api\V1\Profiles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\Profiles\ProfilesService;
use App\Http\Requests\Api\V1\Profiles\ShowProfileRequest;
use App\Http\Requests\Api\V1\Profiles\UpdateProfileRequest;

class ProfilesController extends Controller
{

    protected $profilesService;

    public function __construct(ProfilesService $profilesService)
    {
        $this->profilesService = $profilesService;
    }

    public function update(UpdateProfileRequest $request): object
    {
        return $this->profilesService->update($request);
    }

    public function index(): object
    {
        return $this->profilesService->index();
    }

    public function show(ShowProfileRequest $request): object
    {
        return $this->profilesService->show((int)$request->id);
    }
}
