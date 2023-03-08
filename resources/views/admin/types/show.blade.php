@extends('layouts.admin')

@section('content')
    <main>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12 mt-5 mb-3">
                        <h2>{{ $type->name }}</h2>
                    </div>
                    <div class="col-12 mb-4">
                        <h4>Slug:</h4>
                        <p>{{ $type->slug }}</p>
                    </div>
                    <div class="col-12 mb-5">
                        <div class="row gy-4">
                            @forelse ( $type->projects as $project )
                                <div class="col-4">
                                    <div class="card h-100">
                                        <div class="card-header">
                                            <div>Progetto: <span class="fw-semibold fs-5">{{ $project->title }}</span></div>
                                        </div>
                                        <div class="card-body">
                                            <p>Contenuto: <span class="fs-5">{{ $project->content }}</span></p>
                                        </div>
                                        <div class="card-footer text-center">
                                            <a class="btn btn-primary w-100" href="{{ route('admin.projects.show', $project->slug) }}">Vai al progetto</a>
                                        </div>
                                    </div>                  
                                </div>
                            @empty
                                <div class="fw-semibold text-secondary">NON contiene Progetti associati</div> 
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection