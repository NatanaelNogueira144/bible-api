<?php

namespace App\Policies;

use App\Models\User;

class ReadingPlanDayPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }
}
