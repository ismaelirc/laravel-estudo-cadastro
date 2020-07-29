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
            <form class="form-horizontal" action="/produtos" method="POST" name="formProduto" id="formProduto">
                <div class="modal-header">
                    <h5 class="modal-header">Novo produto</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" class="form-control" />
                    <div class="form-group">
                        <label for="nomeProduto">Nome do produto</label>
                        <input type="text" class="form-control" name="nome" id="nome" placeholder="Produto" />
                    </div>
                    <div class="form-group">
                        <label for="quantidadeEstoque">Quantidade em estoque</label>
                        <input type="number" class="form-control" name="estoque" id="estoque" placeholder="Produto" />
                    </div>
                    <div class="form-group">
                        <label for="precoProduto">Preço</label>
                        <input type="number" class="form-control" name="preco" id="preco" placeholder="R$ 600" />
                    </div>
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <select class="form-control" name="categoria_id" id="categoria_id">
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

            $("#id").val(''); 
            $("#nome").val('');
            $("#estoque").val('');
            $("#preco").val('');
            
            $("#dlgProdutos").modal('show');
        }

        function carregarCategoria(){
            $.getJSON('/api/categorias',function(data){
                
                for(i=0; i < data.length; i++){
                    op = '<option value="'+data[i].id+'">'+data[i].nome + '</option>';

                    $("#categoria_id").append(op);
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
                            '<button class="btn btn-sm btn-primary" onclick="editar('+data[i].id+')">Editar</button>'+
                            '<button class="btn btn-sm btn-danger" onclick="remover('+data[i].id+')">apagar</button>'+
                        '</td></tr>';

                    $("#tableProdutos tbody").append(tr);
                }
            });
        }

        function criarProduto(){
            prod = {nome: $("#nome").val(),
                    preco: $("#preco").val(), 
                    estoque: $("#estoque").val(), 
                    categoria_id:$("#categoria_id").val()
                };

                $.post('/api/produtos',prod,function(data){
                    console.log(data);
                });

        }

        function salvarProduto(){
            prod = {
                    id: $("#id").val(),
                    nome: $("#nome").val(),
                    preco: $("#preco").val(), 
                    estoque: $("#estoque").val(), 
                    categoria_id:$("#categoria_id").val()
                };

            $.ajax({
                type: 'PUT',
                url: '/api/produtos/'+prod.id,
                context: this,
                data: prod,
                success: function(){
                    console.log('ok');
                },
                error: function(error){
                    console.log(error);
                }
            });

        }


        function remover(id){
            $.ajax({
                type: 'DELETE',
                url: '/api/produtos/'+id,
                context: this,
                success: function(){
                    $("#tableProdutos tbody").empty();
                    carregarProdutos();
                },
                error: function(error){
                    console.log(error);
                }
            });
        }

        function editar(id){

            $.getJSON('/api/produtos/'+id,function(data){

                $("#id").val(data.id);
                $("#nome").val(data.nome);
                $("#estoque").val(data.estoque);
                $("#preco").val(data.preco);

                $("#categoria_id").val(data.categoria_id);
            
                $("#dlgProdutos").modal('show');
               
            });

        }


        $("#formProduto").submit(function(event){
            event.preventDefault();

            if($("#id").val() != ''){
                salvarProduto();
            }else{
                criarProduto();
            }

            
            $("#dlgProdutos").modal('hide');
            $("#tableProdutos tbody").empty();
            carregarProdutos();

        });

        $(function(){
            carregarCategoria();
            carregarProdutos();
        });
    

    </script>
@endsection