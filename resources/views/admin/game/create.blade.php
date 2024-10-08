@extends('admin.layouts.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Mostramos un formulario para crear un partido -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Agregar Partido</h1>
                        <a href="{{ route('admin.game.index') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-list fa-sm text-white-50"></i> Lista de Partidos</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.game.index') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div
                                    class="form-group col-4
                                    @error('date') has-error @enderror">
                                    <label for="date">Fecha</label>
                                    <input type="date" name="date" class="form-control" id="date"
                                        placeholder="Fecha" value="{{ old('date') }}">
                                    @error('date')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-4 @error('category_id') has-error @enderror">
                                    <label for="category_id">Categoría FEB</label>
                                    <select name="category_id" class="form-control" id="category_id">
                                        <option value="">Seleccione una Categoría FEB</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-4 @error('local_team_id') has-error @enderror">
                                    <label for="local_team_id">Equipo Local</label>
                                    <select name="local_team_id" class="form-control" id="local_team_id">
                                        <option value="">Seleccione un Equipo</option>
                                        @foreach ($teams as $team)
                                            <option value="{{ $team->id }}"
                                                {{ old('local_team_id') == $team->id ? 'selected' : '' }}>
                                                {{ $team->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('local_team_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6 @error('scorer_id') has-error @enderror">
                                    <label for="scorer_id">Anotador</label>
                                    <select name="scorer_id" class="form-control" id="scorer_id">
                                        <option value="">Seleccione un Oficial de Mesa</option>
                                        @foreach ($tableOfficials as $tableOfficial)
                                            <option value="{{ $tableOfficial->id }}"
                                                {{ old('scorer_id') == $tableOfficial->id ? 'selected' : '' }}>
                                                {{ $tableOfficial->name . ' ' . $tableOfficial->surname }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('scorer_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-6 @error('timer_id') has-error @enderror">
                                    <label for="timer_id">Cronometrador:</label>
                                    <select name="timer_id" class="form-control" id="timer_id">
                                        <option value="">Seleccione un Oficial de Mesa</option>
                                        @foreach ($tableOfficials as $tableOfficial)
                                            <option value="{{ $tableOfficial->id }}"
                                                {{ old('timer_id') == $tableOfficial->id ? 'selected' : '' }}>
                                                {{ $tableOfficial->name . ' ' . $tableOfficial->surname }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('timer_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-6 @error('shot_clock_operator_id') has-error @enderror">
                                    <label for="shot_clock_operator_id">Operador de Reloj de Lanzamiento</label>
                                    <select name="shot_clock_operator_id" class="form-control" id="shot_clock_operator_id">
                                        <option value="">Seleccione un Oficial de Mesa</option>
                                        @foreach ($tableOfficials as $tableOfficial)
                                            <option value="{{ $tableOfficial->id }}"
                                                {{ old('shot_clock_operator_id') == $tableOfficial->id ? 'selected' : '' }}>
                                                {{ $tableOfficial->name . ' ' . $tableOfficial->surname }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('shot_clock_operator_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-6 @error('assistant_scorer_id') has-error @enderror">
                                    <label for="assistant_scorer_id">Ayudante de Anotador</label>
                                    <select name="assistant_scorer_id" class="form-control" id="assistant_scorer_id">
                                        <option value="">Seleccione un Oficial de Mesa</option>
                                        @foreach ($tableOfficials as $tableOfficial)
                                            <option value="{{ $tableOfficial->id }}"
                                                {{ old('assistant_scorer_id') == $tableOfficial->id ? 'selected' : '' }}>
                                                {{ $tableOfficial->name . ' ' . $tableOfficial->surname }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('assistant_scorer_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <!-- Creamos un checkbox para saber si el scorer viaja -->
                                <div class="form-group col-3
                                    @error('scorer_travels') has-error @enderror">
                                    <label for="scorer_travels">¿Anotador viaja?</label>
                                    <input type="checkbox" name="scorer_travels" id="scorer_travels" value="1"
                                        {{ old('scorer_travels') ? 'checked' : '' }}>
                                    @error('scorer_travels')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Creamos un checkbox para saber si el timer viaja -->
                                <div class="form-group col-3
                                    @error('timer_travels') has-error @enderror">
                                    <label for="timer_travels">¿Cronometrador viaja?</label>
                                    <input type="checkbox" name="timer_travels" id="timer_travels" value="1"
                                        {{ old('timer_travels') ? 'checked' : '' }}>
                                    @error('timer_travels')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Creamos un checkbox para saber si el shot clock operator viaja -->
                                <div
                                    class="form-group col-3
                                    @error('shot_clock_operator_travels') has-error @enderror">
                                    <label for="shot_clock_operator_travels">¿Operador 24" viaja?</label>
                                    <input type="checkbox" name="shot_clock_operator_travels"
                                        id="shot_clock_operator_travels" value="1"
                                        {{ old('shot_clock_operator_travels') ? 'checked' : '' }}>
                                    @error('shot_clock_operator_travels')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- Creamos un checkbox para saber si el assistant scorer viaja -->
                                <div
                                    class="form-group col-3
                                    @error('assistant_scorer_travels') has-error @enderror">
                                    <label for="assistant_scorer_travels">¿Ayudante viaja?</label>
                                    <input type="checkbox" name="assistant_scorer_travels" id="assistant_scorer_travels"
                                        value="1" {{ old('assistant_scorer_travels') ? 'checked' : '' }}>
                                    @error('assistant_scorer_travels')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
