<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProdutoController extends Controller
{
    public function index(): View
    {
        $produtos = Produto::latest()->paginate(5);

        return view('produtos.index', compact('produtos'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('produtos.create'); // corrigido: era 'crate'
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'descricao' => 'required',
            'qtd' => 'required',
            'precoUnitario' => 'required',
            'precoVenda' => 'required',
        ]);

        Produto::create($request->all());

        return redirect()->route('produtos.index') // corrigido: era 'Produtos.idex'
            ->with('sucesso', 'Produto criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto): View // corrigido: nome da variável e compact
    {
        return view('produtos.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto): View // corrigido: variável no singular
    {
        return view('produtos.edit', compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto): RedirectResponse
    {
        $request->validate([
            'descricao' => 'required',
            'qtd' => 'required',
            'precoUnitario' => 'required',
            'precoVenda' => 'required',
        ]);

        $produto->update($request->all());

        return redirect()->route('produtos.index')
            ->with('sucesso', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto): RedirectResponse
    {
        $produto->delete(); // corrigido: faltava ponto e vírgula

        return redirect()->route('produtos.index')
            ->with('sucesso', 'Produto excluído com sucesso!');
    }
}
