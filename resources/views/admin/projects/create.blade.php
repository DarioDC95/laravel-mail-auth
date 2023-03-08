@extends('layouts.admin')

@section('content')
    <main>
        <section>
            <div class="container">
                <div class="row my-5">
                    <div class="col-12">
                        <h2>Inserisci un nuovo progetto</h2>
                    </div>
                    @if ($errors->any())
                        @foreach ($errors->all() as $value)
                            <div class="text-danger">{{ $value }}</div>
                        @endforeach
                    @endif
                </div>
                <div class="row">    
                    <div class="col-12">
                        <form action="{{ route('admin.projects.store') }}" method="POST">
                        @csrf
                            <div class="form-group mb-4">
                                <label class="control-label">Titolo</label>
                                <input type="text" class="form-control" placeholder="Inserisci un nuovo titolo" id="title" name="title">
                                @error('title')
                                    @foreach ($errors->get('title') as $value)
                                        <div class="text-danger">{{ $value }}</div>
                                    @endforeach
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label class="control-label">Tipologia</label>
                                <select class="form-select" id="type_id" name="type_id">
                                    <option value="" selected disabled>Scegli una Tipologia</option>
                                    @foreach ($types as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                    @foreach ($errors->get('type_id') as $value)
                                        <div class="text-danger">{{ $value }}</div>
                                    @endforeach
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="control-label ">Tecnologie</label>
                                @foreach ($technologies as $technology)
                                    <div class="form-check @error('technologies') is-invalid @enderror">
                                        <input class="form-check-input" type="checkbox" name="technologies[]" value="{{ $technology->id }}" id="technology">
                                        <label class="form-check-label" for="technology">
                                            {{ $technology->name }}
                                        </label>
                                    </div>
                                @endforeach
                                @error('technologies')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group mb-5">
                                <label class="control-label">Contenuto</label>
                                <textarea type="text" class="form-control" placeholder="Inserisci una nuova Descrizione" id="content" name="content"></textarea>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Salva Progetto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection