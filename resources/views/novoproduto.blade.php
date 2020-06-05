@extends('layout.app',["current" => "produtos"])

@section('body')

<div class="card border">
    <div class="card-body">
        <form action="/produtos" method="POST">
            @csrf
            <div class="form-group">
                <label for="nomeProduto">Nome do produto</label>
                <input type="text" class="form-control" name="nomeProduto" id="nomeProduto" placeholder="Produto" />
            </div>
            <div class="form-group">
                <label for="quantidadeEstoque">Quantidade em estoque</label>
                <input type="text" class="form-control" name="quantidadeEstoque" id="quantidadeEstoque" placeholder="Produto" />
            </div>
            <div class="form-group">
                <label for="precoProduto">Preço</label>
                <input type="text" class="form-control" name="precoProduto" id="precoProduto" placeholder="R$ 600" />
            </div>
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <select class="form-control" name="categoria" id="categoria">
                    @foreach ($categorias as $cat)
                        <option value="{{$cat->id}}">{{$cat->nome}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
            <button type="cancel" class="btn btn-danger btn-sm">Cancelar</button>
        </form>
    </div>

</div>

@endsection