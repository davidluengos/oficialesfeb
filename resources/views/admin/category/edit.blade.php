@extends('admin.layouts.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Mostramos un formulario para editar una category -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Editar Categoría FEB</h1>
                        <a href="{{ route('admin.category.index') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-list fa-sm text-white-50"></i> Lista de Categorías FEB</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group
                                @error('name') has-error @enderror">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Nombre"
                                    value="{{ old('name', $category->name) }}">
                                @error('name')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection