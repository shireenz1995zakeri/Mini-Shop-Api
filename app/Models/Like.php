<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [

        'likeable_id',
        'likeable_type',
        'user_id',
    ];

    public function likeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addLike($model)
    {

        if (Auth::user()) {


        // $model = Blog::findOrFail($id);
        $like = Like::where('user_id', auth()->user()->id)
            ->where('likeable_type', $model::class)
            ->where('likeable_id', $model->id)
            ->first();

        if ($like) {
            $like->delete();
            return 'delete successfully';
        } else {
            $like = Like::create([
                'likeable_id' => $model->id,
                'likeable_type' => get_class($model),
                'user_id' => auth()->user()->id]);

        }
    }
        else {
            echo 'برای لایک باید وارد سایت شوید';
        }
    }
}
