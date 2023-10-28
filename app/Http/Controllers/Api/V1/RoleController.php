<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Resources\BrandResource;
use App\Http\Resources\RoleResource;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Services\Blog\StoreBlogService;
use App\Services\Product\StoreProductService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,RoleRepositoryInterface $repository)
    {
        if($request->input('limit')==-1){
             $model=$repository->get($request->all());
        }else{
            $model=$repository->paginate($request->input('limit',10),$request->all());
        }

        return $this->successResponse([
            "roles" => RoleResource::collection($model),
            "links" => RoleResource::collection($model)->response()->getData()->links],
            //'نقش ها باموفقیت نشان داده شد'
            __('ApiMassage.Roles were successfully displayed')
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request,RoleRepositoryInterface $repository)
    {

        $model = $repository->store($request->validated());
        return $this->successResponse(RoleResource::make($model),
            //'نقش باموفقیت ایجاد شد'
            __('ApiMassage.Roles were successfully displayed.Role created  successfully') );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(RoleRepositoryInterface $repository,Role $role)
    {
        $model=$repository->find($role->id);
        return $this->successResponse(RoleResource::make($role),
            //'نقش ها با موفقیت نمایش داده شد')
                __('ApiMassage.The role was shown'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role,RoleRepositoryInterface $repository)
    {
        $model = $repository->update($role, $request->validated());

        return $this->successResponse(RoleResource::make($model),
            //'نقش باموفقیت آپدیت شد'
            __('ApiMassage.The role has been updated successfully') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoleRepositoryInterface $repository,Role $role)
    {
        $repository->delete($role);
        return $this->successResponse(RoleResource::make($role),
            //'نقش باموفقیت  حذف شد'
                __('ApiMassage.Role deleted')
        );
    }
}
