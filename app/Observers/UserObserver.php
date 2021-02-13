<?php

namespace App\Observers;

use App\Models\User;
use App\Repositories\Profile\ProfileRepositoryInterface;
use App\Repositories\Property\PropertyRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class UserObserver
{
    /**
     * @var \App\Repositories\User\UserEloquentRepository
     */
    protected $userRepository;

    /**
     * @var \App\Repositories\Property\PropertyEloquentRepository
     */
    private $propertyRepository;

    /**
     * @var \App\Repositories\Profile\ProfileEloquentRepository
     */
    private $profileRepository;

    /**
     * UserObserver constructor.
     * @param UserRepositoryInterface $userRepository
     * @param ProfileRepositoryInterface $profileRepository
     * @param PropertyRepositoryInterface $propertyRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        ProfileRepositoryInterface $profileRepository,
        PropertyRepositoryInterface $propertyRepository
    ) {
        $this->userRepository = $userRepository;
        $this->propertyRepository = $propertyRepository;
        $this->profileRepository = $profileRepository;
    }

    /**
     * Handle the user "deleting" event.
     *
     * @param User $user
     */
    public function deleting(User $user)
    {
        $user->update(['unblock_status' => true]);
        $user->property()->update(['unblock_status' => true]);
        $user->articlePhotos()->update(['unblock_status' => true]);
        $user->topics()->update(['unblock_status' => true]);
        $user->taxes()->update(['unblock_status' => true]);
        $user->subUserProperty()->delete();
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param User $user
     */
    public function deleted(User $user)
    {
        $this->userRepository->deleteSubUserOfMainUser($user->id);
        $this->profileRepository->deleteProfileByUserId($user->id);
        $user->property()->delete();
        $user->articlePhotos()->delete();
        $user->topics()->delete();
        $user->taxes()->delete();
    }
}
