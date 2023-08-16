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
              <a class="btn btn-md btn-success btnNovoInstrutor" type="button" href="#"><i class="fas fa-plus"></i> Novo Instrutor</a>
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
              <h4 class="card-title">{{ $plano->plano }}</h4>
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
	              		<a href="#" onclick="editarPlano({{ $plano->id }});" class="btn btn-warning">Editar</a>
					</div>
					<div class="col-4">
						<a href="#" onclick="confirmDelete({{ $plano->id }},'{{ $plano->plano }}');" 

						class="btn btn-danger   

						@if($plano->alunos_count > 0)
							disabled
						@endif
						">Excluir</a>

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

<!-- Script de Exclusão do Plano -->
<script>
	
	function editarPlano(id) 
	{
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('Editar Plano') }}",
            data: {'id':id},
            success: function(response) {
            	alert(response);
            },
            error: function(error) {
                console.error("Erro ao carregar os dados do gráfico:", error);
            }
        });
	 	
	} 

</script>

<!-- Script de Edição do Plano -->
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
                alert(response);
            },
            error: function(error) {
                console.error("Erro ao carregar os dados do gráfico:", error);
            }
        });	
	}
	</script>