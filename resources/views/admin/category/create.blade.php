@extends('admin.layouts.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Mostramos un formulario para crear una ciudad -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Agregar Categoría FEB</h1>
                        <a href="{{ route('admin.category.index') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-list fa-sm text-white-50"></i> Lista de Categorías FEB</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.category.store') }}" method="POST">
                            @csrf
                            <div class="form-group
                                @error('name') has-error @enderror">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Nombre" value="{{ old('name') }}">
                                @error('name')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Agregamos un campo para el código de la categoría -->
                            <div class="form-group
                                @error('code') has-error @enderror">
                                <label for="code">Código</label>
                                <input type="text" name="code" class="form-control" id="code"
                                    placeholder="Código" value="{{ old('code') }}">
                                @error('code')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('is_active') has-error @enderror">
                                <label for="is_active">Activo</label>
                                <input type="checkbox" name="is_active" id="is_active" value="1"
                                    {{ old('is_active') ? 'checked' : '' }}>
                                @error('is_active')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Agregamos un campo para el price de la categoría -->
                            <div class="form-group
                                @error('price') has-error @enderror">
                                <label for="price">Precio</label>
                                <input type="text" name="price" class="form-control" id="price"
                                    placeholder="Precio" value="{{ old('price') }}">
                                @error('price')
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
