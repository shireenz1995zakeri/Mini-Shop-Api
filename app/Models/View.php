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
    ];
    public function viewable(){
        return $this->morphTo();
    }



    public function handle(Post $post)
    {
        if (!$this->isPostViewed($post))
        {
            $post->increment('view_count');
            $this->storePost($post);
        }
    }

    private function isPostViewed($post)
    {
        $viewed = $this->session->get('viewed_posts', []);

        return array_key_exists($post->id, $viewed);
    }

    private function storePost($post)
    {
        $key = 'viewed_posts.' . $post->id;

        $this->session->put($key, time());
    }

}
