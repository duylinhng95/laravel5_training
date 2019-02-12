<?php

namespace App\Repository;

use App\Entities\User;
use App\Traits\RocketTrait;
use Auth;
use Illuminate\Database\Query\Builder;

class UserRepositoryEloquent extends BaseRepositoryEloquent implements UserRepository
{
    use RocketTrait;

    public function model()
    {
        return User::class;
    }

    public function createProfile($users)
    {
        $rockets = [];
        foreach ($users as $user) {
            $id                = $this->makeModel()->firstOrCreate($user['user'])->id;
            $rocket            = $user['rocket'];
            $rocket['user_id'] = $id;
            $rockets[]         = $rocket;
        }
        return $rockets;
    }

    public function blocked($id)
    {
        $user         = $this->makeModel()->find($id);
        $user->status = $user->statusName['block'];
        $user->save();
        return $user;
    }

    public function unblocked($id)
    {
        $user = $this->makeModel()->find($id);
        if (!empty($user->email)) {
            $user->status = $user->statusName['verify'];
        } else {
            $user->status = $user->statusName['not_verify'];
        }
        $user->save();
        return $user;
    }

    public function loginRocket($input)
    {
        return $this->loginAPI($input);
    }

    public function getInfo()
    {
        return Auth::user();
    }

    public function getUsers($request)
    {
        /** @var Builder $query */
        $query = $this->makeModel();

        if ($request->has('keywords')) {
            $keyword = $request->input('keywords');
            $query   = $query->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }

        if ($request->has('sort')) {
            $section = $request->input('sort');
            $order   = $request->input('order');
            $query   = $query->orderBy($section, $order);
        }
        $query = $query->whereDoesntHave('userRoles', function ($subQuery) {
            $adminId = config('constant.user.role.admin');
            $subQuery->where('role_id', $adminId);
        });
        $users = $query->paginate(45);
        return $users;
    }
}
