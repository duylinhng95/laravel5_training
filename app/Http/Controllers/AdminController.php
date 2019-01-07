<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\AdminRepositoryEloquent;

class AdminController extends Controller
{
    protected $adminRepository;

    public function __construct()
    {
        $this->adminRepository = app(AdminRepositoryEloquent::class);
    }

    public function importUser()
    {
        $array = $this->adminRepository->getUser();
        dd($array);
    }
}
