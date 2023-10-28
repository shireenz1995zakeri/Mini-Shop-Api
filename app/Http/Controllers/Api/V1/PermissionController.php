<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use App\Repositories\Permission\PermissionRepositoryInterface;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,PermissionRepositoryInterface $repository)
    {

        if($request->input('limit')==-1){
          $model=$repository->get($request->all());
        }else{
          $model=$repository->paginate($request->input('limit',10),$request->all());
        }
        return $this->successResponse(PermissionResource::collection($model),
            __('ApiMassage.Permissions were successfully displayed'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PermissionRepositoryInterface $repository,Permission $permission)
    {
        $model=$repository->find($permission->id);
        return succesResponse(PermissionResource::make($permission),
            __('ApiMassage.The permission was shown'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
