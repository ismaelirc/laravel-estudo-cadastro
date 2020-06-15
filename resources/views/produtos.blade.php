@extends('layout.app',["current"=>"produtos"])

@section('body')
  <div class="card border">
    <div class="card-body">
        <h5 class="card-title">Cadastro de produtos</h5>
        @if (count($produtos) > 0)
            <table class="table table-ordered table-hover" id="tableProdutos">
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
                    
                </tbody>
            </table>
        @endif
    </div>
    <div class="card-footer">
        <button class="btn btn-success btn-sm" role="button" onclick="novoProduto()">Novo Produto</a>
    </div>
  </div>

  <div class="modal" tabindex="-1" role="dialog" id="dlgProdutos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" action="/produtos" method="POST">
                <div class="modal-header">
                    <h5 class="modal-header">Novo produto</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" class="form-control" />
                    <div class="form-group">
                        <label for="nomeProduto">Nome do produto</label>
                        <input type="text" class="form-control" name="nomeProduto" id="nomeProduto" placeholder="Produto" />
                    </div>
                    <div class="form-group">
                        <label for="quantidadeEstoque">Quantidade em estoque</label>
                        <input type="number" class="form-control" name="quantidadeEstoque" id="quantidadeEstoque" placeholder="Produto" />
                    </div>
                    <div class="form-group">
                        <label for="precoProduto">Preço</label>
                        <input type="number" class="form-control" name="precoProduto" id="precoProduto" placeholder="R$ 600" />
                    </div>
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <select class="form-control" name="categoria" id="categoria">
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                    <button type="cancel" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
  </div>

@endSection

@section('javascript')
    <script type="text/javascript">

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        
        function novoProduto(){
            
            $("#nomeProduto").val('');
            $("#quantidadeEstoque").val('');
            $("#precoProduto").val('');
            
            $("#dlgProdutos").modal('show');
        }

        function carregarCategoria(){
            $.getJSON('/api/categorias',function(data){
                
                for(i=0; i < data.length; i++){
                    op = '<option value="'+data[i].id+'">'+data[i].nome + '</option>';

                    $("#categoria").append(op);
                }
            });
        }

        function carregarProdutos(){
            $.getJSON('/api/produtos',function(data){
                
                for(i=0; i < data.length; i++){
                    tr = '<tr>'+
                        '<td>'+data[i].id+'</td>'+
                        '<td>'+data[i].nome+'</td>'+
                        '<td>'+data[i].estoque+'</td>'+
                        '<td>'+data[i].preco+'</td>'+
                        '<td>'+data[i].nome_cat+'</td>'+
                        '<td>'+
                            '<button class="btn btn-sm btn-primary">Editar</button>'+
                            '<button class="btn btn-sm btn-danger">apagar</button>'+
                        '</td></tr>';

                    $("#tableProdutos tbody").append(tr);
                }
            });
        }

        $(function(){
            carregarCategoria();
            carregarProdutos();
        });
    

    </script>
@endsection