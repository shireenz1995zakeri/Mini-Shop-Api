<?php


namespace App\Services\User;


use App\Models\User;
use App\Services\Product\ProductService;

class UserService
{
    private ProductService $productService;
    public  function  __construct(ProductService $productService){
             $this->productService =$productService;
    }


    public function store(array $payload) : User
    {
        return User::create($payload);
    }

    public function update(User $user, array $payload) :User
    {
        return User::update($payload);
    }
    public function  buyProduct(){
          $this->productService->buy($product,auth()->user());
    }


}
