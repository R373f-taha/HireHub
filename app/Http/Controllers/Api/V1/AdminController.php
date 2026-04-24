<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\V1\Admin\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct( AdminService $admineService)
    {
        $this->adminService=$admineService;
    }

    public function adminPanel(){

    $statistics=$this->adminService->AdminPanel();

    return $this->successResponse(data:$statistics);
    }
}
