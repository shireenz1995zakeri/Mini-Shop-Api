<?php

namespace App\Services\View;

use App\Models\View;
use App\Traits\HasView;
use GuzzleHttp\Psr7\Request;

class ViewServices
{
    use HasView;
    public function addview($model)
    {

            $model->views()->updateOrCreate([
                'user_id'=>2,
               'ip'=>request()->ip(),
            ]);

    }
}
