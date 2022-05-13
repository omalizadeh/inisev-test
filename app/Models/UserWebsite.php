<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserWebsite extends Pivot
{
    use HasFactory;

    public const UPDATED_AT = null;
}
