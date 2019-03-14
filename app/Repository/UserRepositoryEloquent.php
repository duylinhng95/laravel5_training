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
            $user->status = config('constant.user.status.verify');
        } else {
            $user->status = config('constant.user.status.not_verify');
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

    public function getUsers($params)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $query */
        $query = $this->makeModel();

        if (key_exists('keywords', $params) && $params['keywords']) {
            $keyword = $params['keywords'];
            $query   = $query->where(function ($subQuery) use ($keyword) {
                /** @var Builder $subQuery */
                $subQuery->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }

        if (key_exists('sort', $params) && $params['sort'] && $params['order']) {
            $section = $params['sort'];
            $order   = $params['order'];
            $query   = $query->orderBy($section, $order);
        }

        $query = $query->whereDoesntHave('userRoles', function ($subQuery) {
            /** @var Builder $subQuery */
            $adminId = config('constant.user.role.admin');
            $subQuery->where('role_id', $adminId);
        });
        $users = $query->paginate(45);
        return $users;
    }
}
