<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProjectController extends Controller
{
    public function index()
    {
        $page = request()->get('page', 1);
        $projects = Cache::remember('projects_page_' . $page, 60*24, function () {
            return Project::latest()->paginate(10);
        });
        return view('projects.index', compact('projects'));
    }

    public function show($slug)
    {
        $project = Cache::remember('project_' . $slug, 60*24, function () use ($slug) {
            return Project::where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();
        });

        $relatedProjects = Cache::remember('related_projects_' . $project->id, 60*24, function () use ($project) {
            return Project::where('id', '!=', $project->id)
                ->where('is_active', true)
                ->when($project->solution_id, function($query) use ($project) {
                    return $query->where('solution_id', $project->solution_id);
                })
                ->latest()
                ->take(3)
                ->get();
        });

        return view('projects.show', compact('project', 'relatedProjects'));
    }

    public function loadMore(Request $request)
    {
        $page = $request->page;
        $projects = Cache::remember('projects_loadmore_page_' . $page, 60*24, function () use ($page) {
            return Project::latest()
                ->paginate(10, ['*'], 'page', $page);
        });

        $html = view('projects._list', ['projects' => $projects])->render();

        return response()->json([
            'html' => $html,
            'hasMore' => $projects->hasMorePages()
        ]);
    }

    private function clearProjectCache($project)
    {
        // Clear individual project cache
        Cache::forget('project_' . $project->slug);
        
        // Clear related projects cache
        Cache::forget('related_projects_' . $project->id);
        
        // Clear paginated pages cache
        for ($i = 1; $i <= 10; $i++) {
            Cache::forget('projects_page_' . $i);
            Cache::forget('projects_loadmore_page_' . $i);
        }
    }
}