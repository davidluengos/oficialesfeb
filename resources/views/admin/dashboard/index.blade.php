@extends('admin.layouts.main')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <!-- listado de oficiales, contando el número de partidos de cada categoría -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Oficiales</h6>
    
    <form method="GET" action="{{ route('admin.dashboard') }}" class="d-flex align-items-center">
        <span class="mr-2 font-weight-bold">Temporada:</span>
        <select class="form-control" name="temporada" onchange="this.form.submit()">
            @foreach ($temporadas as $temporada)
                <option value="{{ $temporada }}"
                    {{ $temporada == $temporadaSeleccionada ? 'selected' : '' }}>
                    {{ $temporada }}
                </option>
            @endforeach
        </select>
    </form>
</div>


                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th>Nombre</th>
                                        <th>Acta</th>
                                        <th>Crono</th>
                                        <th>24"</th>
                                        <th>Ayud.</th>
                                        <th class="bg-secondary">Total</th>
                                        <th class="bg-info">Viajes</th>
                                        @foreach ($categories as $category)
                                            <th>{{ $category->code }}</th>
                                            <!-- Cambia 'name' si tu campo de nombre es diferente -->
                                        @endforeach
                                        <th>€</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($officials as $official)
                                        <tr class="text-center">
                                            <td>{{ $official->name }} {{ $official->surname }}</td>
                                            <td>{{ $official->total_scorer_games }}</td>
                                            <td>{{ $official->total_timer_games }}</td>
                                            <td>{{ $official->total_shot_clock_games }}</td>
                                            <td>{{ $official->total_assistant_scorer_games }}</td>
                                            {{-- Destacar el máximo y mínimo con clases adicionales --}}
                                            <td
                                                class="bg-secondary
                                                @if ($official->total_games == $max_total_games) bg-success text-white
                                                @elseif ($official->total_games == $min_total_games)bg-danger text-white @endif ">
                                                {{ $official->total_games }}
                                                {{-- @if ($official->total_games == $max_total_games)
                                                    <i class="fas fa-crown text-warning"></i>
                                                @endif --}}
                                            </td>
                                            <td class="bg-info">{{ $official->total_travels ?? 0 }}</td>

                                            @foreach ($categories as $category)
                                                <td>
                                                    {{ $official->games_by_category[$category->id] ?? 0 }}
                                                </td>
                                            @endforeach
                                            <td>{{ number_format($official->total_amount_by_category, 2, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
