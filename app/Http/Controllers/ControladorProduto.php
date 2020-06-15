<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produtos;
use App\Categoria;
use DB;

class ControladorProduto extends Controller
{

    public function index(){

        $produtos = DB::table('produtos')->join('categorias','produtos.categoria_id','=','categorias.id')->select('produtos.*','categorias.nome as nome_cat')->get();
       
        return json_encode($produtos);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexView()
    {
        $produtos = DB::table('produtos')->join('categorias','produtos.categoria_id','=','categorias.id')->select('produtos.*','categorias.nome as nome_cat')->get();
       
        return view('produtos',compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categorias = Categoria::all();

        return view('novoproduto',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $p = new Produtos();
        $p->nome = $request->input('nomeProduto');
        $p->estoque = $request->input('quantidadeEstoque');
        $p->preco = $request->input('precoProduto');
        $p->categoria_id = $request->input('categoria');

        $p->save();

        return redirect('/produtos');;
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p = Produtos::find($id);

        if(isset($p)){

            $p->delete();

        }

        return redirect('/produtos');

    }

}
