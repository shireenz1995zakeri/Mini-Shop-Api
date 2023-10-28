<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;
    protected $fillable=[
        'viewable_id',
        'user_id',
        'viewable_type',
         'ip',
    ];

    public function viewable(){

        return $this->morphTo();
    }



    public function handle(Blog $blog)
    {
        if (!$this->isBlogViewed($blog))
        {
            $blog->increment('view_count');
            $this->storeBlog($blog);
        }
    }

    private function isblogViewed($blog)
    {
        $viewed = $this->session->get('viewed_blogs', []);

        return array_key_exists($blog->id, $viewed);
    }

    private function storeBlog($blog)
    {
        $key = 'viewed_blogs.' . $blog->id;

        $this->session->put($key, time());
    }

}
