<?php

namespace App\Repositories\Product;


use Carbon\Carbon;

interface ProductRepositoryInterface extends \App\Repositories\BaseReposirotyInterface
{




    public function theMostVisitedProducts();


    public function expensive();

    public function theMostCommentProducts();

    public function toggle($model);

    public function popularProducts($model);

    public function getOldProductsByDate(Carbon $data);

    public function getNewProductsByDate(Carbon $data);

    public function getProductsByDate($date);

    public function NumberOfAproductPurchasedByAUser($user);

    public function BestSellingProducts();

    public function ProductBuyUser($user);


}
