<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobPolicy
{
   
    public function before(User $user, string $ability): ?bool
    {
        if($user->isAdmin())
            {
                return true;
            }

    
        return null;
    
    }
    
    public function update(User $user, Job $job): bool
    {
        return $user->id === $job->user_id && $user->isEmployer();
    }

    
    public function delete(User $user, Job $job): bool
    {
        return $user->id === $job->user_id && $user->isEmployer();
    }

    public function manageApplications(User $user, Job $job): bool
    {
        return $user->id === $job->user_id && $user->isEmployer();
    }

}
