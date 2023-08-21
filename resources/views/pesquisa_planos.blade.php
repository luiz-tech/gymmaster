{{ view('header') }}

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Planos da Academia</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a class="btn btn-md btn-success btnNovoPlano" type="button" href="#"><i class="fas fa-plus"></i> Novo Plano</a>
            </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        @foreach($planos as $plano)
        <div class="col-md-4">
          <div class="card">
            <img class="card-img-top" src="resources/images/logo-dark.png" alt="Plano de Academia">
            <div class="card-body">	
              <h3 class="card-title">{{ $plano->plano }}</h3>
              <p class="card-text">{{ $plano->descricao }}</p>
              <h4 class="card-title bg-light">Alunos Matriculados: {{ $plano->alunos_count }}</h5>
            </div>

            <ul class="list-group list-group-flush">
              <li class="list-group-item">Mensalidade: R$ {{ number_format($plano->mensalidade, 2, ',', '.') }}</li>
              <li class="list-group-item">
                Status:
                @if ($plano->status === 'A')
                  <span class="badge badge-success">Plano Ativo</span>
                @else
                  <span class="badge badge-danger">Plano Inativo</span>
                @endif
              </li>
            </ul>

            <div class="card-body">
            	<div class="row text-center">
            		<div class="col-4">
            			<a href="#página-de-vendas" class="btn btn-primary">Detalhes</a>
            		</div>
	              	<div class="col-4">
	              		<a href="#" onclick="editarPlano({{ $plano }});" class="btn btn-warning">Editar</a>
					</div>
					<div class="col-4">
						

						@if($plano->alunos_count > 0)
							
							<a
								class="btn btn-danger"
								data-toggle="tooltip" 
								title="Este plano possui alunos matriculados">Excluir
							</a>
							
						@else 
							<a href="#" onclick="confirmDelete({{ $plano->id }},'{{ $plano->plano }}');" 
								class="btn btn-danger"
								title="AAA"
								>Excluir

							</a>
						@endif

					</div>	
            	</div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

{{ view('footer') }}

<!-- Modal de Cadastro de Plano -->
<div class="modal fade" id="modalNovoPlano" tabindex="-1" role="dialog" aria-labelledby="modalNovoPlanoLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalNovoPlanoLabel">Cadastre um Novo Plano</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulário de Cadastro de Novo Plano -->
        <form id="formNovoPlano" method="POST">
            @csrf
            <hr>
            <!-- Dados Pessoais -->
            <div class="row mb-3 pt-3">
                <div class="col-md-6">
                    <label for="novo_nomeplano">Nome do Plano</label>
                    <input type="text" class="form-control" id="novo_nomeplano" name="novo_nomeplano" placeholder="Informe o nome do Plano"  required>
                </div>
                <div class="col-md-6">
                    <label for="novo_mensalidade">Mensalidade (R$)</label>
                    <input type="number" step="any" class="form-control" id="novo_mensalidade" name="novo_mensalidade" placeholder="Informe o preço da mensalidade"  required>
                </div>
                <div class="col-md-12">
                    <label for="descricao">Descrição</label>
                    <textarea type="text" class="form-control" id="novo_descricao" name="novo_descricao" placeholder="Informe uma descrição para o plano"  required></textarea>
                </div>
            </div>
            
        </form>
    </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnSalvarNovo">Adicionar Plano</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Edição de Plano -->
<div class="modal fade" id="modalEditarPlano" tabindex="-1" role="dialog" aria-labelledby="modalEditarPlanoLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalEditarPlanoLabel">Edição de um Plano</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulário de Cadastro de Novo Plano -->
        <form id="formEditarPlano" method="POST">
            @csrf
            <input type="hidden" name="idplano" id="idplano" value="">
            <hr>
            <!-- Dados Pessoais -->
            <div class="row mb-3 pt-3">
                <div class="col-md-6">
                    <label for="nomeplano">Nome do Plano</label>
                    <input type="text" class="form-control" id="nomeplano" name="nomeplano" placeholder="Informe o nome do Plano"  required>
                </div>
                <div class="col-md-6">
                    <label for="mensalidade">Mensalidade (R$)</label>
                    <input type="number" step="any" class="form-control" id="mensalidade" name="mensalidade" placeholder="Informe o preço da mensalidade"  required>
                </div>
                <div class="col-md-6">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                    	<option value="A">Ativo</option>
                    	<option value="I">Inativo</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="descricao">Descrição</label>
                    <textarea type="text" class="form-control" id="descricao" name="descricao" placeholder="Informe uma descrição para o plano"  required></textarea>
                </div>
            </div>
            
        </form>
    </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnEditarNovo">Salvar Alterações</button>
      </div>
    </div>
  </div>
</div>


<!-- Script de Edição do Plano -->
<script>
	
	function editarPlano(plano) 
	{
		$('#formEditarPlano')[0].reset();

		$('#idplano').val(plano.id);
		$('#nomeplano').val(plano.plano);
		$('#mensalidade').val(plano.mensalidade);
		$('#descricao').val(plano.descricao);

		$('#modalEditarPlano').modal('show');

	 	
	} 

	$('#btnEditarNovo').click(function(){
		
		var formData = $('#formEditarPlano').serialize();

		    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
		
        $.ajax({
            type: "POST",
            url: "{{ route('Editar Plano') }}",
            data: formData,
            success: function(response) {
                location.reload();
            },
            error: function(error) {
                if (error.responseJSON && error.responseJSON.errors) {
                    // Monta a mensagem de erro
                    var errorMessage = '';
                    for (var field in error.responseJSON.errors) {
                        errorMessage += error.responseJSON.errors[field].join('<br>') + '<br>'; 
                    }

                    //Exibe os erros
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro de validação',
                        html: errorMessage,
                    });
                } else {
                    //Lógica de erro, se necessário
                    console.log(error);
                }
            }
        });	


	});

</script>

<!-- Script de Exclusão do Plano -->
<script>

	function confirmDelete(id, nome) {
	    Swal.fire({
	      title: "Tem certeza?",
	      text: "O registro de " + nome + " será excluído permanentemente.",
	      icon: "warning",
	      showCancelButton: true,
	      confirmButtonColor: "#d33",
	      cancelButtonColor: "#3085d6",
	      confirmButtonText: "Sim, excluir",
	      cancelButtonText: "Cancelar"
	    }).then((result) => {
	      if (result.isConfirmed) {
	        // Prosseguir com a exclusão
	        excluirPlano(id);
	      }
	    });
  	}
	
	function excluirPlano(id) 
	{
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('Excluir Plano') }}",
            data: {'id':id},
            success: function(response) {
                locaton.reload();
            },
            error: function(error) {
                console.error("Erro ao carregar os dados do gráfico:", error);
            }
        });	
	}
</script>

<!-- Script de Cadastro -->
<script>
	$('.btnNovoPlano').click(function(){	
		$('#modalNovoPlano').modal('show');
	});


	$('#btnSalvarNovo').click(function(){
		
		var formData = $('#formNovoPlano').serialize();

		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('Novo Plano') }}",
     		     data: formData ,
              success: function(response) {
         				if(response === true){
         					location.reload();
         				}
              },
              error: function(error) {
                if (error.responseJSON && error.responseJSON.errors) {
                    // Monta a mensagem de erro
                    var errorMessage = '';
                    for (var field in error.responseJSON.errors) {
                        errorMessage += error.responseJSON.errors[field].join('<br>') + '<br>'; 
                    }

                    //Exibe os erros
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro de validação',
                        html: errorMessage,
                    });
                } else {
                    //Lógica de erro, se necessário
                    console.log(error);
                }
            }
        });


	});
</script>

<!-- Configurações de ToolTip -->
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
