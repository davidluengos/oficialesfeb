<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Game;
use App\Models\TableOfficial;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener todas las categorías
        $categories = Category::where('is_active', 1)->get();

        // Obtenemos los oficiales con el conteo de partidos en diferentes roles
        $officials = TableOfficial::withCount([
            'scorerGames as total_scorer_games',
            'timerGames as total_timer_games',
            'shotClockOperatorGames as total_shot_clock_games',
            'assistantScorerGames as total_assistant_scorer_games',
        ])
            ->with(['scorerGames', 'timerGames', 'shotClockOperatorGames', 'assistantScorerGames'])
            ->orderBy('surname')
            ->get();

        // Variables para almacenar el máximo y mínimo total de partidos
        $max_total_games = 0;
        $min_total_games = PHP_INT_MAX;

        // Recorrer cada oficial para calcular sus viajes y los partidos por categoría
        foreach ($officials as $official) {
            // Sumamos los viajes globales para el oficial
            $total_travels = $official->scorerGames->sum('scorer_travels') +
                $official->timerGames->sum('timer_travels') +
                $official->shotClockOperatorGames->sum('shot_clock_operator_travels') +
                $official->assistantScorerGames->sum('assistant_scorer_travels');

            // Usamos setAttribute para almacenar el total de viajes
            $official->setAttribute('total_travels', $total_travels);

            // Calculamos y almacenamos el total de partidos
            $total_games = $official->total_scorer_games +
                $official->total_timer_games +
                $official->total_shot_clock_games +
                $official->total_assistant_scorer_games;

            $official->setAttribute('total_games', $total_games);

            // Actualizamos los máximos y mínimos
            if ($total_games > $max_total_games) {
                $max_total_games = $total_games;
            }
            if ($total_games < $min_total_games) {
                $min_total_games = $total_games;
            }

            // Inicializamos un array para contar los partidos por categoría
            $games_by_category = [];

            // Contamos los partidos por categoría en todos los roles
            $games = Game::where('scorer_id', $official->id)
                ->orWhere('timer_id', $official->id)
                ->orWhere('shot_clock_operator_id', $official->id)
                ->orWhere('assistant_scorer_id', $official->id)
                ->get();

            // Agrupamos los partidos por categoría
            $games_by_category_grouped = $games->groupBy('category_id');

            // Contamos los partidos en cada categoría
            foreach ($games_by_category_grouped as $category_id => $games_in_category) {
                $games_by_category[$category_id] = $games_in_category->count();
            }

            // Asignamos los partidos por categoría usando setAttribute
            $official->setAttribute('games_by_category', $games_by_category);

            // Calculamos el importe total por categoría y los sumamos en una variable
            $total_amount_by_category = 0;
            foreach ($games_by_category as $category_id => $games_in_category) {
                $category = $categories->find($category_id);
                $total_amount_by_category += $category->price * $games_in_category;
            }

            // Asignamos el importe total por categoría usando setAttribute
            $official->setAttribute('total_amount_by_category', $total_amount_by_category);

        }
        return view('admin.dashboard.index', compact('officials', 'categories', 'max_total_games', 'min_total_games'));
    }
}
