<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::published()->with('projectCategory')->orderBy('order_column')->get();

        seo()->title('Projelerimiz')->description('Kalyon İnşaat tarafından hayata geçirilen konut, villa ve ticari projeler.');

        return view('frontend.pages.project.index', compact('projects'));
    }

    public function show(Project $project)
    {
        abort_unless($project->published, 404);

        $others = Project::published()
            ->where('id', '!=', $project->id)
            ->orderBy('order_column')
            ->limit(3)
            ->get();

        seo()->title($project->title)->description($project->short_description ?? '');

        return view('frontend.pages.project.show', compact('project', 'others'));
    }
}
