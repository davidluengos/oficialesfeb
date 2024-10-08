@extends('admin.layouts.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Mostramos en una tabla todas las $cities -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Lista de Oficiales de Mesa</h1>
                        <a href="{{ route('admin.table-official.create') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-plus fa-sm text-white-50"></i> Agregar Oficial de Mesa</a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Ciudad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tableOfficials as $tableOfficial)
                                    <tr>
                                        <td>{{ $tableOfficial->id }}</td>
                                        <td>{{ $tableOfficial->name }}</td>
                                        <td>{{ $tableOfficial->surname }}</td>
                                        <td>{{ $tableOfficial->city->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.table-official.edit', $tableOfficial->id) }}"
                                                class="btn btn-primary btn-sm">Editar</a>
                                            <form action="{{ route('admin.table-official.destroy', $tableOfficial->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este oficial de mesa?')">
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
