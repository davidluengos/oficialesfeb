<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean', // Este campo es opcional y debe ser un booleano
        ]);

        // Asegurarse de que el valor del checkbox se maneje correctamente
        $data = $request->all();
        $data['is_active'] = $request->has('is_active') ? 1 : 0; // Si el checkbox está marcado, 1; si no, 0

        // Crear la categoría
        Category::create($data);

        // Redirigir con un mensaje de éxito
        return redirect()->route('admin.category.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validar los datos recibidos
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean', // Este campo es opcional y debe ser un booleano
        ]);

        // Encontrar la categoría
        $category = Category::find($id);

        if (!$category) {
            return redirect()->route('admin.category.index')->with('error', 'Category not found.');
        }

        // Asegurarse de que el valor del checkbox se maneje correctamente
        $data = $request->all();
        $data['is_active'] = $request->has('is_active') ? 1 : 0; // Si el checkbox está marcado, 1; si no, 0

        // Actualizar la categoría
        $category->update($data);

        // Redirigir con un mensaje de éxito
        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully');
    }
}
