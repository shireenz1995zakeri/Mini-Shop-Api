<?php

namespace App\Repositories\Role;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use App\Filters\FuzzyFilter;
use Illuminate\Database\Eloquent\Builder;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function addPermission($id, $permission)
    {
        $model = parent::get($id);
        $model->givePermissionTo($permission);
        return $model;
    }

    public function syncPermission($id, $permissions)
    {
        $model = parent::get($id);
        $model->syncPermissions($permissions);
        return $model;
    }

//    public function query(array $payload = []):Builder
//    {
//        return QueryBuilder::for(Role::class)
//            ->with('permissions')
//            ->defaultSort('-id')
//            ->allowedSorts('id' , 'name')
//            ->allowedFields(['id'])
//            ->allowedFilters([
//                AllowedFilter::custom('search', new FuzzyFilter(['name'])),
//            ]);
//    }



    public function all(): Collection
    {
        return $this->query()->get();
    }

    public function store($attributes):Role
    {
        $model = Role::create([
            'name' => $attributes['name']
        ]);
        $model->syncPermissions($attributes['permissions']);
        return $model;
    }




    public function update($eloquent,  array $data):Model
    {
        $eloquent->update([
            'name' => $data['name']
        ]);
        $eloquent->syncPermissions($data['permissions']);
        return $eloquent;
    }

    public function destroy($eloquent): mixed
    {
        if (User::role($eloquent->name)->count()) {
            abort(Response::HTTP_BAD_REQUEST, trans('roles.can_not_delete'));
        }
        return $eloquent->delete();
    }
}
