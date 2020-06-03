@extends('layout.app',["current"=>"categorias"])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de categorias</h5>
            @if (count($categorias) > 0)
                <table class="table table-ordered table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $cat)

                            <tr>
                                <td>{{$cat->id}}</td>
                                <td>{{$cat->nome}}</td>
                                <td>
                                    <a href="/categorias/editar/{{$cat->id}}" class="btn btn-primary btn-sm">Editar</a>
                                    <a href="/categorias/apagar/{{$cat->id}}" class="btn btn-danger btn-sm">Apagar</a>
                                </td>
                            </tr>
                        
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="card-footer">
            <a href="/categorias/novo/" class="btn btn-success btn-sm" role="button">Nova Categoria</a>
        </div>
    </div>
@endSection