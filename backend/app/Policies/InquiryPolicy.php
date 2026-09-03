<?php

namespace App\Policies;

use App\Models\Inquiry;
use App\Models\User;

class InquiryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isBroker() || $user->isClient();
    }

    public function view(User $user, Inquiry $inquiry): bool
    {
        if ($user->isBroker()) {
            return $inquiry->property->broker_id === $user->id;
        }

        return $user->isClient() && $inquiry->client_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->isClient();
    }

    public function update(User $user, Inquiry $inquiry): bool
    {
        if ($user->isBroker()) {
            return $inquiry->property->broker_id === $user->id;
        }

        return false;
    }
}
