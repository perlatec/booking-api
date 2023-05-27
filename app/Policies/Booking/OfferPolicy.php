<?php

namespace App\Policies\Booking;

use App\Enums\Constants;
use App\Models\Booking\Offer;
use App\Models\User;

class OfferPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Offer $offer): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->isSudoUser($user);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Offer $offer): bool
    {
        return $this->isSudoUser($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Offer $offer): bool
    {
        return $this->isSudoUser($user);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Offer $offer): bool
    {
        return $this->isSudoUser($user);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Offer $offer): bool
    {
        return $this->isSudoUser($user);
    }

    /**
     * isSudoUser
     *
     * @param  User $user
     * @return bool
     */
    private function isSudoUser(User $user): bool
    {
        return $user->hasAnyRole([Constants::ROLE_ADMIN, Constants::ROLE_DEVELOPER]);
    }
}
