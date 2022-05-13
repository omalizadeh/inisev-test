<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Website extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(UserWebsite::class);
    }

    public function isSubscribed(int $userId): bool
    {
        return $this->users()->wherePivot('user_id', $userId)->exists();
    }
}
