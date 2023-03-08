<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use App\Models\Type;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // PRENDO TUTTE LE TIPOLOGIA
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();

        $slug = Project::generateSlug($request->title);

        // AGGIUNGO UNA COPPIA CHIAVE/VALORE ALL'ARRAY $form_data
        $form_data['slug'] = $slug;

        /* 
        $newProject = new Project();
        $newProject->fill($form_data); */
        // QUESTE DUE OPERAZIONI LE POSSO SVOLGERE IN UN UNICO METODO:
        $newProject = Project::create($form_data);

        if($request->has('technologies')) {
            $newProject->technologies()->attach($form_data['technologies']);
        }

        return redirect()->route('admin.projects.index')->with('message', 'Il Progetto è stato aggiunto correttamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data = $request->validated();

        $slug = Project::generateSlug($request->title);

        $form_data['slug'] = $slug;

        $project->update($form_data);

        if($request->has('technologies')) {
            $project->technologies()->sync($form_data['technologies']);
        }
        else {
            $project->technologies()->sync([]);
        }

        return redirect()->route('admin.projects.index')->with('message', 'Il Progetto è stato modificato correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // PRIMA COSA DA FARE IN ASSOLUTO E' CANCELLARE I RECORD RELATIVI DALLA TABELLA PONTE, A RISCHIO DI CORROMPERE IL DATABASE. Ciò non serve se si è provveduto con "cascedeOnDelete" nella creazione della tabella.
        // $project->technologies()->sync([]);

        // DOPO DI CHE CANCELLIAMO L'ELEMENTO
        $project->delete();

        return redirect()->route('admin.projects.index')->with('message', 'Il Progetto è stato eliminato correttamente');
    }
}
