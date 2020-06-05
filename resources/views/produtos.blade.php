@extends('layout.app',["current"=>"produtos"])

@section('body')
  <div class="card border">
    <div class="card-body">
        <h5 class="card-title">Cadastro de produtos</h5>
        @if (count($produtos) > 0)
            <table class="table table-ordered table-hover">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Estoque</th>
                        <th>Preço</th>
                        <th>Categoria</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produtos as $p)

                        <tr>
                            <td>{{$p->id}}</td>
                            <td>{{$p->nome}}</td>
                            <td>{{$p->estoque}}</td>
                            <td>{{$p->preco}}</td>
                            <td>{{$p->nome_cat}}</td>
                            <td>
                                <a href="/produtos/editar/{{$p->id}}" class="btn btn-primary btn-sm">Editar</a>
                                <a href="/produtos/apagar/{{$p->id}}" class="btn btn-danger btn-sm">Apagar</a>
                            </td>
                        </tr>
                    
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <div class="card-footer">
        <a href="/produtos/novo/" class="btn btn-success btn-sm" role="button">Novo Produto</a>
    </div>
  </div>
@endSection