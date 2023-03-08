@extends('layouts.admin')

@section('content')
    <main>
        <section>
            <div class="container">
                <div class="row my-5">
                    <div class="col-12">
                        <h2>Cambia la Tecnologia</h2>
                    </div>
                    @if ($errors->any())
                        @foreach ($errors->all() as $value)
                            <div class="text-danger">{{ $value }}</div>
                        @endforeach
                    @endif
                </div>
                <div class="row">    
                    <div class="col-12">
                        <form action="{{ route('admin.technologies.update', $technology->slug) }}" method="POST">
                        @csrf
                        @method('PUT')
                            <div class="form-group mb-4">
                                <label class="control-label">Nome</label>
                                <input type="text" class="form-control" placeholder="Inserisci una Nuova Tecnologia" id="name" name="name" value="{{ old('name', $technology) }}">
                                @error('name')
                                    @foreach ($errors->get('name') as $value)
                                        <div class="text-danger">{{ $value }}</div>
                                    @endforeach
                                @enderror
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Salva Tecnologia</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection