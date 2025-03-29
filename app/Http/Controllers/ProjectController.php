<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedProjects = Project::where('id', '!=', $project->id)
            ->where('is_active', true)
            ->when($project->solution_id, function($query) use ($project) {
                return $query->where('solution_id', $project->solution_id);
            })
            ->latest()
            ->take(3)
            ->get();

        return view('projects.show', compact('project', 'relatedProjects'));
    }

    public function loadMore(Request $request)
    {
        $projects = Project::latest()
            ->paginate(10, ['*'], 'page', $request->page);

        $html = view('projects._list', ['projects' => $projects])->render();

        return response()->json([
            'html' => $html,
            'hasMore' => $projects->hasMorePages()
        ]);
    }
}