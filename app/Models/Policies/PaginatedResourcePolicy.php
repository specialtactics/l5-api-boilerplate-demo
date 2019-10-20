<?php

namespace App\Models\Policies;

use App\Models\PaginatedResource;
use App\Models\User;

class PaginatedResourcePolicy extends BasePolicy
{
    /**
     * Determine whether the user can create PaginatedResource.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the PaginatedResource.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PaginatedResource  $paginatedResource
     * @return mixed
     */
    public function view(User $user, PaginatedResource $paginatedResource)
    {
        return $this->own($user, $paginatedResource);
    }

    /**
     * Determine whether the user can view the collection of PaginatedResource.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAll(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the PaginatedResource.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PaginatedResource  $paginatedResource
     * @return mixed
     */
    public function update(User $user, PaginatedResource $paginatedResource)
    {
        return $this->own($user, $paginatedResource);
    }

    /**
     * Determine whether the user can delete the PaginatedResource.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PaginatedResource  $paginatedResource
     * @return mixed
     */
    public function delete(User $user, PaginatedResource $paginatedResource)
    {
        return $this->own($user, $paginatedResource);
    }

    /**
     * Determine whether the user owns the PaginatedResource.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PaginatedResource  $paginatedResource
     * @return mixed
     */
    public function own(User $user, PaginatedResource $paginatedResource) {
        return true;
    }

    /**
     * This function can be used to add conditions to the query builder,
     * which will specify the user's ownership of the model for the get collection query of this model
     *
     * @param \App\Models\User $user A user object against which to construct the query. By default, the currently logged in user is used.
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder|null
     */
    public function qualifyCollectionQueryWithUser(User $user, $query)
    {
        return $query;
    }
}
