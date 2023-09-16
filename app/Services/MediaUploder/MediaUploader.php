<?php

namespace App\Services\MediaUploder;

use Carbon\Carbon;

class MediaUploader
{
    public function upload(string $path):array
    {
         $img=request()->all();
        $imagePath=$img['image']->store($path);
        // تاریخ عکس را دخیره کن و از کش کردن جلوگیری می کند
        //$imagePath = Carbon::now()->microsecond . '.' . $img['image']->extension();
        // محل دخیره عکس ها
        //$img['image']->storeAs('images/brands', $imagePath, 'public');
      //Storage::disk('public')->put()
         $img['image']->getSize();


        return[
            'extension'=>$img['image']->extension(),
            'url'=>$imagePath,
            'size'=>$img['image']->getSize(),
        ];
    }

}
