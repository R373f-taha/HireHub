<?php

namespace App\Services\V1\Admin;

use App\Models\V1\Offer;
use App\Models\V1\Project;
use App\Models\V1\User;
use Illuminate\Support\Facades\DB;

class AdminService{


public function AdminPanel(){

$stats=DB::select('
        SELECT
            (SELECT COUNT(*) FROM users) as total_users,
            (SELECT COUNT(*) FROM projects) as total_projects,
            (SELECT COUNT(*) FROM users WHERE role = "freelancer") as total_freelancers,
            (SELECT COUNT(*) FROM offers) as total_offers,
            (SELECT SUM(proposed_amount) FROM offers) as total_offers_value
    ');
    return $stats;
}
}
