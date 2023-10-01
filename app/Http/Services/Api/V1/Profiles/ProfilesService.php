<?php

namespace App\Http\Services\Api\V1\Profiles;

use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use App\Http\Repositories\Api\V1\Profiles\ProfilesRepository;

class ProfilesService
{
  use HttpResponses;

  protected $profileRepository;

  public function __construct(ProfilesRepository $profilesRepository)
  {
    $this->profileRepository = $profilesRepository;
  }

  public function update(object $request): object
  {
    // Get user who requested profile update
    $user = Auth::user();

    // Set values for profile fields
    $profileFields = [
      'first_name' => $request->first_name ? $request->first_name : $user->profile->first_name,
      'last_name' => $request->last_name ? $request->last_name : $user->profile->last_name,
      'age' => $request->age ? $request->age : $user->profile->age,
    ];

    /**
     * TODO Implement functionality to upload .pdf file for resume
     */

    $profileUpdated =  $this->profileRepository->update($profileFields, $user->id);

    // Couldn't update profile
    if (!$profileUpdated) {
      return $this->failedRequest('', 'Failed to updated profile', 400);
    }

    return $this->successfullRequest('', 'Profile successfully updated', 200);
  }

  public function index(): object
  {
    // Get user who requested profile update
    $user = Auth::user();

    $profile = $this->profileRepository->index($user->id);

    // Couldn't receive profile for soem reasons
    if (!$profile) {
      return $this->failedRequest('', 'Failed to receive profile', 400);
    }

    return $this->successfullRequest($profile, 'Successfully received profile', 200);
  }

  /**
   * TODO 
   * This function will be used for other people to check someones profile, will require additional checking F.E subscription
   */
  public function show(int $profileId): object
  {
    // Check subscriptions or etc.. Future update

    // There won't be a need to validate if profile exists or not, because Request service will do it on controller request
    return $this->profileRepository->show($profileId);
  }
}
