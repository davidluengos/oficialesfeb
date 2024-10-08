@extends('admin.layouts.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Formulario para editar un Equipo -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Editar Equipo</h1>
                        <a href="{{ route('admin.team.index') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-list fa-sm text-white-50"></i> Lista de Equipos
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.team.update', $team->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Campo para el nombre -->
                            <div class="form-group @error('name') has-error @enderror">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Nombre" 
                                    value="{{ old('name') ?? $team->name }}">
                                @error('name')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Campo para seleccionar la ciudad -->
                            <div class="form-group @error('city_id') has-error @enderror">
                                <label for="city_id">Ciudad</label>
                                <select name="city_id" class="form-control" id="city_id">
                                    <option value="">Seleccione una ciudad</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}" 
                                            {{ (old('city_id') ?? $team->city_id) == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Botón de envío -->
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
