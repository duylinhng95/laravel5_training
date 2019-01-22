<?php

namespace App\Repository;

interface UserRepository
{
    public function createProfile($array);

    public function blocked($id);

    public function unblocked($id);

    public function loginRocket($input);

    public function getInfo();

    public function getUsers($request);
}
