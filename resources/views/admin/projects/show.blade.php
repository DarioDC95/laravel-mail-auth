@extends('layouts.admin')

@section('content')
    <main>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12 my-5">
                        <h2>{{ $project->title }}</h2>
                    </div>
                    <div class="col-12 mb-5">
                        @if ($project->cover_path)
                            <img src="{{ asset('storage/' . $project->cover_path) }}" alt="{{ $project->title }}">
                        @else
                            <span class="text-secondary">Immagine NON disponibile</span>
                        @endif
                    </div>
                    <div class="col-12 mb-5">
                        @if ($project->type)
                            <div>Tipologia: <span class="fw-semibold fs-5">{{ $project->type->name }}</span></div>              
                        @else
                            <div class="fw-semibold text-secondary">NON contiene tipologia</div>
                        @endif
                    </div>
                    <div class="col-12 mb-5">
                        <div class="m-2">Tecnologie:</div>
                        @forelse ($project->technologies as $technology)
                            <span class="fw-semibold fs-5">- {{ $technology->name }}</span>
                            <br>            
                        @empty
                            <div class="fw-semibold text-secondary">NON contiene tecnologie</div>
                        @endforelse
                    </div>
                    <div class="col-12">
                        <h4>Contenuto:</h4>
                        <p>{{ $project->content }}</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection