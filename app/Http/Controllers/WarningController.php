<?php

namespace App\Http\Controllers;

use App\Warning;
use Illuminate\Database\Eloquent\Builder;

class WarningController extends ApiController
{
    public function builder(): Builder
    {
        return Warning::query();
    }
}
