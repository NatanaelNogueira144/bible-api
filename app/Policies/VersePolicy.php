<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Verse;
use Illuminate\Auth\Access\Response;

class VersePolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }
}
