@extends('layouts.admin')

@section('content')
    <main>
        <section>
            <div class="container">
                <div class="row my-5">
                    <div class="col-12">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h2>Elenco Projects</h2>
                            </div>
                            <div>
                                <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">Aggiungi un Progetto</a>
                            </div>
                        </div>
                    </div>
                </div>
                @if (session('message'))
                    <div class="row">
                        <div class="col-4">
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <table class="table table-striped">
                            <thead>
                                <th>id</th>
                                <th>cover</th>
                                <th>Tipologia</th>
                                <th>Tecnologia</th>
                                <th>Titolo</th>
                                <th>Slug</th>
                                <th>Azioni</th>
                            </thead>
                            <tbody>
                                @forelse ( $projects as $project )
                                    <tr>
                                        <td>{{ $project->id }}</td>
                                        <td>
                                            @if ($project->cover_path)
                                                <img src="{{ asset('storage/' . $project->cover_path) }}" alt="{{ $project->title }}">
                                            @else
                                                <span class="text-secondary">NON disponibile</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($project->type_id)
                                                {{ $project->type->name }}
                                            @else
                                                <span class="text-secondary">NON disponibile</span>
                                            @endif
                                        </td>
                                        <td>
                                            @forelse ($project->technologies as $technology)
                                                {{ $technology->name }}<br>
                                            @empty
                                                <span class="text-secondary">NON disponibile</span>
                                            @endforelse
                                        </td>
                                        <td>{{ $project->title }}</td>
                                        <td>{{ $project->slug }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <div>
                                                    <a href="{{ route('admin.projects.show', $project->slug) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                                </div>
                                                <div class="mx-1">
                                                    <a href="{{ route('admin.projects.edit', $project->slug) }}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                                </div>
                                                <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST">
                                                @csrf 
                                                @method('DELETE')
                                                    <div>
                                                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty 
                                    <div class="mb-4">
                                        <div class="d-inline-block alert alert-success">
                                            Non hai nessun progetto, <span class="fw-semibold text-primary text-decoration-underline">clicca su aggiungi progetto</span> per iniziare <span class="fw-semibold text-primary text-decoration-underline">o in basso per riempirla a caso</span>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.seederProject') }}" class="btn btn-primary">Riempi la tabella progetti</a>
                                        </div>
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection