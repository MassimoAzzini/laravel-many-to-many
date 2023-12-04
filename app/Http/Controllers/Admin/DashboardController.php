<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;

class DashboardController extends Controller
{
    public function index() {
        $projects = Project::orderBy('id', 'desc')->paginate(4);
        $technologies = Technology::all();
        $types = Type::all();

        return view('admin.home', compact('projects', 'technologies', 'types'));
    }
}
