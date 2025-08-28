<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Game;
use App\Models\TableOfficial;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // ------------------------------
        // Temporada actual y seleccionada
        // ------------------------------
        $temporadaActual = $this->temporadaDeFecha(now());
        $temporadaSeleccionada = request('temporada', $temporadaActual);

        [$fecha_inicio_temporada, $fecha_fin_temporada] = $this->rangoFechasTemporada($temporadaSeleccionada);

        // ------------------------------
        // Obtener temporadas existentes
        // ------------------------------
        $temporadas = Game::all()
            ->map(fn($g) => $this->temporadaDeFecha($g->date))
            ->filter()
            ->unique()
            ->sortDesc();

        // Asegurarse de que la temporada actual siempre aparezca
        if (!in_array($temporadaActual, $temporadas->toArray())) {
            $temporadas->prepend($temporadaActual);
        }

        // ------------------------------
        // Categorías activas
        // ------------------------------
        $categories = Category::where('is_active', 1)->get();

        // ------------------------------
        // Cargar oficiales con contadores y partidos filtrados por temporada
        // ------------------------------
        $officials = TableOfficial::withCount([
            'scorerGames as total_scorer_games' => fn($q) => $q->whereBetween('date', [
                $fecha_inicio_temporada->format('Y-m-d'),
                $fecha_fin_temporada->format('Y-m-d')
            ]),
            'timerGames as total_timer_games' => fn($q) => $q->whereBetween('date', [
                $fecha_inicio_temporada->format('Y-m-d'),
                $fecha_fin_temporada->format('Y-m-d')
            ]),
            'shotClockOperatorGames as total_shot_clock_games' => fn($q) => $q->whereBetween('date', [
                $fecha_inicio_temporada->format('Y-m-d'),
                $fecha_fin_temporada->format('Y-m-d')
            ]),
            'assistantScorerGames as total_assistant_scorer_games' => fn($q) => $q->whereBetween('date', [
                $fecha_inicio_temporada->format('Y-m-d'),
                $fecha_fin_temporada->format('Y-m-d')
            ]),
        ])->with([
            'scorerGames' => fn($q) => $q->whereBetween('date', [
                $fecha_inicio_temporada->format('Y-m-d'),
                $fecha_fin_temporada->format('Y-m-d')
            ]),
            'timerGames' => fn($q) => $q->whereBetween('date', [
                $fecha_inicio_temporada->format('Y-m-d'),
                $fecha_fin_temporada->format('Y-m-d')
            ]),
            'shotClockOperatorGames' => fn($q) => $q->whereBetween('date', [
                $fecha_inicio_temporada->format('Y-m-d'),
                $fecha_fin_temporada->format('Y-m-d')
            ]),
            'assistantScorerGames' => fn($q) => $q->whereBetween('date', [
                $fecha_inicio_temporada->format('Y-m-d'),
                $fecha_fin_temporada->format('Y-m-d')
            ]),
        ])->orderBy('surname')->get();

        $max_total_games = 0;
        $min_total_games = PHP_INT_MAX;

        foreach ($officials as $official) {

            // Total de viajes
            $total_travels = $official->scorerGames->sum('scorer_travels')
                + $official->timerGames->sum('timer_travels')
                + $official->shotClockOperatorGames->sum('shot_clock_operator_travels')
                + $official->assistantScorerGames->sum('assistant_scorer_travels');

            $official->setAttribute('total_travels', $total_travels);

            // Total de partidos
            $total_games = $official->total_scorer_games
                + $official->total_timer_games
                + $official->total_shot_clock_games
                + $official->total_assistant_scorer_games;

            $official->setAttribute('total_games', $total_games);

            if ($total_games > $max_total_games) $max_total_games = $total_games;
            if ($total_games < $min_total_games) $min_total_games = $total_games;

            // Partidos combinados por categoría
            $games = $official->scorerGames
                ->merge($official->timerGames)
                ->merge($official->shotClockOperatorGames)
                ->merge($official->assistantScorerGames);

            $games_by_category = [];
            foreach ($games->groupBy('category_id') as $category_id => $games_in_category) {
                $games_by_category[$category_id] = $games_in_category->count();
            }
            $official->setAttribute('games_by_category', $games_by_category);

            // Total importe por categoría
            $total_amount_by_category = 0;
            foreach ($games_by_category as $category_id => $games_count) {
                $category = $categories->find($category_id);
                $total_amount_by_category += $category ? $category->price * $games_count : 0;
            }
            $official->setAttribute('total_amount_by_category', $total_amount_by_category);
        }

        // ------------------------------
        // Filtrar oficiales que tengan al menos un partido en la temporada
        // ------------------------------
        $officials = $officials->filter(fn($official) => $official->total_games > 0);

        return view('admin.dashboard.index', compact(
            'officials',
            'categories',
            'max_total_games',
            'min_total_games',
            'temporadas',
            'temporadaSeleccionada'
        ));
    }

    protected function temporadaDeFecha($fecha)
    {
        if (!$fecha) return null;

        if (!$fecha instanceof Carbon) {
            try {
                $fecha = Carbon::parse($fecha);
            } catch (\Exception $e) {
                return null;
            }
        }

        $anio = (int) $fecha->format('Y');
        $mes = (int) $fecha->format('m');

        return ($mes >= 8) ? "{$anio}-" . ($anio + 1) : ($anio - 1) . "-{$anio}";
    }

    protected function rangoFechasTemporada($temporada)
    {
        [$anio_inicio, $anio_fin] = explode('-', $temporada);

        $inicio = Carbon::createFromDate($anio_inicio, 8, 1);
        $fin = Carbon::createFromDate($anio_fin, 7, 31);

        return [$inicio, $fin];
    }
}
