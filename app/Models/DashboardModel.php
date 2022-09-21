<?php

namespace App\Models;

use App\Models\AdminModel;
use Illuminate\Support\Facades\DB;

class DashboardModel extends AdminModel
{  
    public function countItems($options = []) {
        if($options['task'] == 'user') {
            return DB::table('user')->count();
        }

        if($options['task'] == 'article') {
            return DB::table('article')->count();
        }

        if($options['task'] == 'slider') {
            return DB::table('slider')->count();
        }

        if($options['task'] == 'category') {
            return DB::table('category')->count();
        }
    }
}

