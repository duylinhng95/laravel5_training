<?php

namespace App\Repository;

use App\Entities\User;
use App\Repository\UserRepository;
use App\Repository\BaseRepositoryEloquent;
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
        foreach ($users as $u) {
            $id                = $this->makeModel()->firstOrCreate($u['user'])->id;
            $rocket            = $u['rocket'];
            $rocket['user_id'] = $id;
            $rockets[]         = $rocket;
        }
        return $rockets;
    }

    public function blocked($id)
    {
        $user         = $this->makeModel()->find($id);
        $user->status = User::STATUS['BLOCK'];
        $user->save();

        return $user;
    }

    public function unblocked($id)
    {
        $user = $this->makeModel()->find($id);
        if (!empty($user->email)) {
            $user->status = User::STATUS['VERIFY'];
        } else {
            $user->status = User::STATUS['NOT_VERIFY'];
        }
        $user->save();
        return $user;
    }

    public function loginRocket($input)
    {
        $user = $this->loginAPI($input);
        return $user;
    }

    public function getInfo()
    {
        return Auth::user();
    }

    public function search($keyword)
    {
        return $this->model->where(function ($query) use ($keyword) {
            /** @var Builder $query */
            $query->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%');
        })->paginate(50);
    }
}
