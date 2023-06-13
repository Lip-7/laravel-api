<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        $projects = Project::with('technologies', 'framework')->paginate(3);
        if ($projects) {
            return response()->json([
                'success' => true,
                'results' => $projects
            ]);
        }else{
            return response()->json([
                'success' => false,
                'results' => "There aren't projects found :("
            ]);
        }
    }

    public function show($slug) {
        $project = Project::with('technologies', 'framework')->where('slug', $slug)->first();
        if ($project) {
            return response()->json([
                'success' => true,
                'results' => $project
            ]);
        }else{
            return response()->json([
                'success' => false,
                'results' => "The project: $slug, wasn't found"
            ]);
        }
    }
}
