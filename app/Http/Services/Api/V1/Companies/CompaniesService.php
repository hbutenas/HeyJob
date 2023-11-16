<?php

namespace App\Http\Services\Api\V1\Companies;

use App\Http\Repositories\Api\V1\Companies\CompaniesRepository;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class CompaniesService
{
  use HttpResponses;

  protected $companiesRepository;

  public function __construct(CompaniesRepository $companiesRepository)
  {
    $this->companiesRepository = $companiesRepository;
  }

  public function update(object $request): object
  {
    // Get user who requested company update
    $user = Auth::user();


    // Set defualt values for company fields
    $companyFields = [
      'name' => $request->name ? $request->name : $user->company->name,
      'description' => $request->description ? $request->description : $user->company->description,
      'website_url' => $request->website_url ? $request->website_url : $user->company->website_url,
    ];

    /**
     * TODO Implement functionality to upload company images
     */

    $companyUpdated = $this->companiesRepository->update($companyFields, $user->id);

    // Couldn't update company profile
    if (!$companyUpdated) {
      return $this->failedRequest('', 'Failed to updated company profile', 400);
    }

    return $this->successfullRequest('', 'Company profile successfully updated', 200);
  }

  public function index(): object
  {
    // Get user who requested profile update
    $user = Auth::user();

    $company = $this->companiesRepository->index($user->id);

    // Couldn't receive profile for soem reasons
    if (!$company) {
      return $this->failedRequest('', 'Failed to receive company profile', 400);
    }

    return $this->successfullRequest($company, 'Successfully received company profile', 200);
  }

  public function show(int $companyId): object
  {
    // Check subscriptions or etc.. Future update

    // There won't be a need to validate if company profile exists or not, because Request service will do it on controller request
    return $this->companiesRepository->show($companyId);
  }
}
