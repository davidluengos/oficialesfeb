@extends('admin.layouts.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Mostramos en una tabla todos los partidos -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Lista de Partidos</h1>
                        <a href="{{ route('admin.game.create') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus fa-sm text-white-50"></i> Agregar Partido</a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha</th>
                                    <th>Categoría</th>
                                    <th>Equipo Local</th>
                                    <th>Anotador</th>
                                    <th>Cronometrador</th>
                                    <th>Operador 24"</th>
                                    <th>Ayudante</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($games as $game)
                                    <tr>
                                        <td>{{ $game->id }}</td>
                                        <td>{{ $game->date }}</td>
                                        <td>{{ $game->category->name }}</td>
                                        <td>{{ $game->localTeam->name }}</td>
                                        <td>{{ $game->scorer ? $game->scorer->name . ' ' . $game->scorer->surname : '-' }}</td>
                                        <td>{{ $game->timer ? $game->timer->name . ' ' . $game->timer->surname : '-'}}</td>
                                        <td>{{ $game->shotClockOperator ? $game->shotClockOperator->name . ' ' . $game->assistantScorer->surname : '-'}}</td>
                                        <td>{{ $game->assistantScorer ? $game->assistantScorer->name . ' ' . $game->assistantScorer->surname : '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.game.edit', $game->id) }}"
                                                class="btn btn-primary btn-sm">Editar</a>
                                            <form action="{{ route('admin.game.destroy', $game->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este partido?')">
                                                    Eliminar
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    @endsection
