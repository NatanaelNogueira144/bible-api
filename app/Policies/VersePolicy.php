<?php

namespace App\Policies;

use App\Models\User;

class VersePolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }
}
