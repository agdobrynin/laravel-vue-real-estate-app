<?php

namespace App\Policies;

use App\Models\Apartment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ApartmentPolicy
{
    use HandlesAuthorization;

    public function before(?User $user, $ability): ?Response
    {
        if ($user?->is_admin && !\in_array($ability, ['update', 'view', 'make-offer'])) {
            return Response::allow();
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(?User $user = null): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Apartment $apartment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(?User $user = null, Apartment $apartment): Response
    {
        $ownerId = $apartment->owner()->first()->id;

        if ($user?->id && $ownerId === $user->id) {
            return Response::allow();
        }

        if ($soldAt = $apartment->sold_at) {
            return Response::deny($this->apartmentSoldMessage($soldAt));
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user): Response
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Apartment $apartment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Apartment $apartment): Response
    {
        return $user->id === $apartment->owner()->getResults()->id
            ? Response::allow()
            : Response::deny('Can\'t access to edit');
    }

    public function makeOffer(User $user, Apartment $apartment): Response
    {
        if ($soldAt = $apartment->sold_at) {
            return Response::deny($this->apartmentSoldMessage($soldAt));
        }

        if ($user->id === $apartment->owner->id) {
            return Response::deny('You are owner this apartment');
        }

        return Response::allow();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Apartment $apartment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Apartment $apartment): Response
    {
        return $user->id === $apartment->owner()->getResults()->id
            ? Response::allow()
            : Response::deny('Access deny for this action');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Apartment $apartment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Apartment $apartment): Response
    {
        return $user->id === $apartment->owner()->getResults()->id
            ? Response::allow()
            : Response::deny();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Apartment $apartment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Apartment $apartment): bool
    {
        return $user->id === $apartment->owner()->getResults()->id;
    }

    private function apartmentSoldMessage(string $soldAt): string
    {
        $dateFormatted = (new \DateTimeImmutable($soldAt))->format('F d, Y \y\e\a\r');

        return sprintf('Was sold %s', $dateFormatted);
    }
}
