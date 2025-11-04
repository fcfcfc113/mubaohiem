<?php

namespace App\Http\Controllers\Managers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerProductController extends Controller
{
    public function view(){
        return view('managers.products.sections.list');
    }
}
