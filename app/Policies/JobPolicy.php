<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobPolicy
{
   

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Job $job): bool
    {
        return $user->id === $job->user_id && $user->isEmployer();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Job $job): bool
    {
        return $user->id === $job->user_id && $user->isEmployer();
    }

    /**
     * Determine whether the user can access and manage the applications in the model.
     */
    public function manageApplications(User $user, Job $job): bool
    {
        return $user->id === $job->user_id && $user->isEmployer();
    }

}
