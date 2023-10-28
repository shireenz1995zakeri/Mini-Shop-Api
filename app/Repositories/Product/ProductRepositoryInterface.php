<?php

namespace App\Repositories\Product;


use Carbon\Carbon;

interface ProductRepositoryInterface extends \App\Repositories\BaseReposirotyInterface
{




    public function theMostVisitedProducts();


    public function expensive();

    public function theMostCommentProducts();

    public function toggle($model);


}
