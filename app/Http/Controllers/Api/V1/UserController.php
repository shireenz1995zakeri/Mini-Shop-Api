<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\User\DeleteUserService;
use App\Services\User\StoreUserService;
use App\Services\User\UpdateUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     */
//    public function __construct()
//    {
//        $this->middleware('auth:sanctum');
//        $this->authorizeResource(User::class);
//    }
    public function index(Request                 $request,
                          UserRepositoryInterface $repository)
    {
        if ($request->input('limit') == -1) {
            $model = $repository->with('category')->get($request->all());
        } else {
            $model = $repository->paginate($request->input('limit', 5), $request->all());
        }

        return $this->successResponse([
            "blogs" => UserResource::collection($model),
            "links" => UserResource::collection($model)->response()->getData()->links],
         __('ApiMassage.Users were successfully displayed'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {

        $data=$request->validated();
        $data['password']=Hash::make('password');
        $user = StoreUserService::run($data);
        return $this->successResponse(UserResource::make($user->load(['medias'])),
            __('ApiMassage.User registered successfully'),
            '201');

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load(['blogs','products','medias','likes','comments']);
        return $this->successResponse(UserResource::make($user->load(['blogs','products','medias','likes','comments'])),
        __('ApiMassage.The user was shown'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {


        $model = UpdateUserService::run($user,$request->validated());
        return $this->successResponse(UserResource::make($model->load(['medias'])),
            __('ApiMassage.The user has been updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if($user->role === 'admin'){
            DeleteUserService::run($user);
            return $this->successResponse(UserResource::make($user),
                __('ApiMassage.User deleted'));
        }

    }

    public function toggle(User $user, UserRepositoryInterface  $repository)
    {
         $repository->toggle($user);
        return $this->successResponse(
            UserResource::make($user),
            //"Message status updated successfully"
                    __('ApiMassage.Message status updated successfully')
        );
    }
    public function addRole(Request $request, User $user)
    {

      //  $this->authorize('addRole', User::class);
        ($user->assignRole($request->role)) ;
        return $this->successResponse(
            UserResource::make($user),
            //"کاربر دارای نقش شد"
            __('ApiMassage.addRole')
        );
    }

    public function removeRole( Request $request, UserRepositoryInterface $repository,User $user,Role $role)
    {

      //  $this->authorize('removeRole', User::class);
        $user = $repository->find($user->id);

       $model=$user->removeRole($role);
       // $user->removeRole($role);
        return $this->successResponse(
            UserResource::make($model),
            //"نقش با موفقیت حذف شد"
            __('ApiMassage.removeRole')
        );
    }


}
