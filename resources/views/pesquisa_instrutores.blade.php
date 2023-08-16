{{ view('header') }}

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Lista de Instrutores</h1>
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
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Instrutores da Academia</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>CPF</th>
                  <th>Data de Nascimento</th>
                  <th>Status</th>
                  <th>Celular1</th>
                  <th>Entrou em:</th>
                  <th>Ações</th>
                </tr>
                </thead>

                <tbody>
                @foreach($instrutores as $instrutor)
                <tr>
                  <td>{{ $instrutor->nome }}</td>
                  <td>{{ $instrutor->email }}</td>
                  <td>{{ $instrutor->cpf }}</td>
                  <td>{{ date('d/m/Y', strtotime($instrutor->dt_nascimento)) }}</td>
                  <td>
                    @if ($instrutor->status === 'A')
                        <span class="badge badge-success">Ativo</span>
                    @else
                        <span class="badge badge-danger">Inativo</span>
                    @endif
                  </td>
                  <td>{{ $instrutor->celular1 }}</td>
                  <td>{{ date('d/m/Y H:i:s', strtotime($instrutor->created_at)) }}</td>
                  <td>
                     <button class="btn btn-primary btn-sm btnEditarInstrutor" 
                          data-instrutor="{{ json_encode($instrutor) }}">
                        <i class="fas fa-edit"></i> Editar
                    </button>

                    <a onClick="confirmDelete({{ $instrutor->id_pessoa_master }},'{{ $instrutor->nome }}');" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i> Excluir
                    </a>
                  </td>
                </tr>
                @endforeach
                </tbody>

                <tfoot>
                <tr>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>CPF</th>
                  <th>Data de Nascimento</th>
                  <th>Status</th>
                  <th>Celular1</th>
                  <th>Entrou em:</th>
                  <th>Ações</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Janela Modal da ficha do Instrutor --> 

<!-- Modal de Edição do Instrutor -->
<div class="modal fade" id="modalEditarInstrutor" tabindex="-1" role="dialog" aria-labelledby="modalEditarInstrutorLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarInstrutorLabel">Alterar Matrícula do Instrutor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulário de Edição do Instrutor -->
        <form id="formEditarInstrutor" method="POST">
          @csrf
          <input type="hidden" name="instrutor_id" id="instrutor_id">

          <hr>
          <h4>Dados Pessoais</h4>
          <!-- Dados Pessoais -->
          <div class="row mb-3 pt-3 border-top border-primary">
            <div class="col-md-6">
              <label for="nome">Nome</label>
              <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="col-md-6">
              <label for="email">E-mail</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="cpf">CPF</label>
              <input type="text" class="form-control" id="cpf" name="cpf" required>
            </div>
            <div class="col-md-6">
              <label for="dt_nascimento">Data de Nascimento</label>
              <input type="date" class="form-control" id="dt_nascimento" name="dt_nascimento" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-3">
              <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                  <option value="A">Ativo</option>
                  <option value="I">Inativo</option>
                </select>
            </div>
            <div class="col-md-3">
              <label for="sexo">Gênero</label>
                <select class="form-control" id="sexo" name="sexo" required>
                  <option value="M">Masculino</option>
                  <option value="F">Feminino</option>
                  <option value="O">Outro</option>
                </select>
            </div>
            <div class="col-md-3">
                    <label for="salario">Salário</label>
                    <input type="number" step="any" class="form-control" id="salario" name="salario" required />
                </div>
                <div class="col-md-3">
                    <label for="especialidade">Especialidade</label>
                    <select class="form-control" id="especialidade" name="especialidade" required>
                        <option value="">Selecione um Especialidade</option>
                        <option value="Musculação">Musculação</option>
                        <option value="Dança">Dança</option>
                        <option value="Natação">Natação</option>
                        <option value="Hidroginástica">Hidroginástica</option>
                        <option value="Crossfit">Crossfit</option>
                    </select>
                </div>
          </div>
          
          <!-- Endereço -->
          <h4>Endereço</h4>
          <div class="row mb-3 pt-3 border-top border-primary">
            <div class="col-md-6">
              <label for="rua">Rua</label>
              <input type="text" class="form-control" id="rua" name="rua">
            </div>
            <div class="col-md-6">
              <label for="numero">Número</label>
              <input type="text" class="form-control" id="numero" name="numero">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="complemento">Complemento</label>
              <input type="text" class="form-control" id="complemento" name="complemento">
            </div>
            <div class="col-md-6">
              <label for="bairro">Bairro</label>
              <input type="text" class="form-control" id="bairro" name="bairro">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="cidade">Cidade</label>
              <input type="text" class="form-control" id="cidade" name="cidade">
            </div>
            <div class="col-md-6">
              <label for="cep">CEP</label>
              <input type="text" class="form-control" id="cep" name="cep">
            </div>
          </div>

          <!-- Contato -->
          <h4>Contato</h4>
          <div class="row pt-3 mb-3 border-top border-primary">
            <div class="col-md-6">
              <label for="celular1">Celular 1</label>
              <input type="text" class="form-control" id="celular1" name="celular1">
            </div>
            <div class="col-md-6">
              <label for="celular2">Celular 2</label>
              <small>Opcional</small>
              <input type="text" class="form-control" id="celular2" name="celular2">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-12">
              <label for="instagram">Usuário Instagram</label>
              <input type="text" class="form-control" id="instagram" name="instagram">
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnSalvarEdicao">Salvar Alterações</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Cadastro do Instrutor -->
<div class="modal fade" id="modalNovoInstrutor" tabindex="-1" role="dialog" aria-labelledby="modalNovoInstrutorLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalNovoInstrutorLabel">Cadastre um novo Instrutor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulário de Cadastro de Novo Instrutor -->
        <form id="formNovoInstrutor" method="POST">
            @csrf
            <hr>
            <h4>Dados Pessoais</h4>
            <!-- Dados Pessoais -->
            <div class="row mb-3 pt-3 border-top border-primary">
                <div class="col-md-6">
                    <label for="novo_nome">Nome</label>
                    <input type="text" class="form-control" id="novo_nome" name="novo_nome" required>
                </div>
                <div class="col-md-6">
                    <label for="novo_email">E-mail</label>
                    <input type="email" class="form-control" id="novo_email" name="novo_email" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="novo_cpf">CPF</label>
                    <input type="text" class="form-control" id="novo_cpf" name="novo_cpf" required>
                </div>
                <div class="col-md-6">
                    <label for="novo_dt_nascimento">Data de Nascimento</label>
                    <input type="date" class="form-control" id="novo_dt_nascimento" name="novo_dt_nascimento" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="novo_status">Status</label>
                    <select class="form-control" id="novo_status" name="novo_status" required>
                        <option value="A">Ativo</option>
                        <option value="I">Inativo</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="novo_sexo">Gênero</label>
                    <select class="form-control" id="novo_sexo" name="novo_sexo" required>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                        <option value="O">Outro</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="novo_salario">Salário</label>
                    <input type="number" step="any" class="form-control" id="novo_salario" name="novo_salario" required />
                </div>
                <div class="col-md-3">
                    <label for="novo_especialidade">Especialidade</label>
                    <select class="form-control" id="novo_especialidade" name="novo_especialidade" required>
                        <option value="">Selecione uma Especialidade</option>
                        <option value="Musculação">Musculação</option>
                        <option value="Dança">Dança</option>
                        <option value="Natação">Natação</option>
                        <option value="Hidroginástica">Hidroginástica</option>
                        <option value="Crossfit">Crossfit</option>
                    </select>
                </div>
            </div>
       
            <!-- Endereço -->
            <h4>Endereço</h4>
            <div class="row mb-3 pt-3 border-top border-primary">
                <div class="col-md-6">
                    <label for="novo_rua">Rua</label>
                    <input type="text" class="form-control" id="novo_rua" name="novo_rua">
                </div>
                <div class="col-md-6">
                    <label for="novo_numero">Número</label>
                    <input type="text" class="form-control" id="novo_numero" name="novo_numero">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="novo_complemento">Complemento</label>
                    <input type="text" class="form-control" id="novo_complemento" name="novo_complemento">
                </div>
                <div class="col-md-6">
                    <label for="novo_bairro">Bairro</label>
                    <input type="text" class="form-control" id="novo_bairro" name="novo_bairro">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="novo_cidade">Cidade</label>
                    <input type="text" class="form-control" id="novo_cidade" name="novo_cidade">
                </div>
                <div class="col-md-6">
                    <label for="novo_cep">CEP</label>
                    <input type="text" class="form-control" id="novo_cep" name="novo_cep">
                </div>
            </div>

            <!-- Contato -->
            <h4>Contato</h4>
            <div class="row pt-3 mb-3 border-top border-primary">
                <div class="col-md-6">
                    <label for="novo_celular1">Celular 1</label>
                    <input type="text" class="form-control" id="novo_celular1" name="novo_celular1">
                </div>
                <div class="col-md-6">
                    <label for="novo_celular2">Celular 2</label>
                    <input type="text" class="form-control" id="novo_celular2" name="novo_celular2">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="novo_instagram">Usuário Instagram</label>
                    <input type="text" class="form-control" id="novo_instagram" name="novo_instagram">
                </div>
            </div>

        </form>
    </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnSalvarNovo">Cadastrar Instrutor</button>
      </div>
    </div>
  </div>
</div>

{{ view('footer') }}

<!-- DataTables  & Plugins -->
<script src="adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="adminlte/plugins/jszip/jszip.min.js"></script>
<script src="adminlte/plugins/pdfmake/pdfmake.min.js"></script>
<script src="adminlte/plugins/pdfmake/vfs_fonts.js"></script>
<script src="adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

<!-- Script de configuração da tabela -->
<script>
  $(document).ready(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "order": [[6, "desc"]],
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ resultados por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidade"
            }
        }
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>

<!-- Script de exclusão de Instrutores da tabela -->
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
        deleteInstrutor(id);
      }
    });
  }

  function deleteInstrutor(id) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    });

    $.ajax({
      type: 'POST',
      url: '{{ route("Excluir Instrutor") }}',
      data: {'id':id},
      success: function (response) {
        // Recarregar a página
        location.reload();
      },
      error: function (error) {
        //exclusão com erro
        console.error('Erro ao excluir o aluno -- '+error);
      }
    });
  }
</script>

<!-- Script de edição de Instrutores da tabela -->
<script>

    // função para exbir e carregar a modal com a ficha do Instrutor
    function showModal(instrutor) {

      $('#formEditarInstrutor')[0].reset();

      // Dados Pessoais
      $('#instrutor_id').val(instrutor.id_pessoa_master);
      $('#nome').val(instrutor.nome);
      $('#email').val(instrutor.email);
      $('#cpf').val(instrutor.cpf);
      $('#dt_nascimento').val(instrutor.dt_nascimento);
      $('#status').val(instrutor.status);
      $('#sexo').val(instrutor.sexo);
      $('#salario').val(instrutor.salario);
      $('#especialidade').val(instrutor.especialidade);
      
      // Endereço
      $('#rua').val(instrutor.rua);
      $('#numero').val(instrutor.numero);
      $('#complemento').val(instrutor.complemento);
      $('#bairro').val(instrutor.bairro);
      $('#cidade').val(instrutor.cidade);
      $('#cep').val(instrutor.cep);

      // Contato
      $('#celular1').val(instrutor.celular1);
      $('#celular2').val(instrutor.celular2);
      $('#instagram').val(instrutor.instagram);

      //máscara dos telefone
      $('#celular1, #celular2').mask('(00)00000-0000');

      // Máscara do CEP
      $('#cep').mask('00000-000');

      // Máscara do CPF
      $('#cpf').mask('000.000.000-00');

      $('#modalEditarInstrutor').modal('show');
    }

    // evento que deispara e carrega a janela modal
    $('.btnEditarInstrutor').click(function() {
      var instrutorData = $(this).data('instrutor');
      showModal(instrutorData);
    });

    // envio da requisição para permaneer os dados do instrutor
    $('#btnSalvarEdicao').click(function() {
        // Serializar o formulário
        var formData = $('#formEditarInstrutor').serialize();

        // Fazer a requisição para edição
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          }
        });

        $.ajax({
            type: 'POST',
            url: '{{ route("Editar Instrutor") }}',
            data: formData,
            success: function(response) {
                // Lógica de sucesso, se necessário
                console.log('Edição realizada com sucesso.');
                $('#modalEditarInstrutor').modal('hide');
                location.reload(); 
            },
            error: function(error) {
                // Lógica de erro, se necessário
                console.error('Erro na edição: ' + error.responseText);
            }
        });
    });
</script>

<!-- Script de criação de novo instrutor -->
<script>
  
  // evento que deispara e carrega a janela modal vazia
    $('.btnNovoInstrutor').click(function() {
     
      // Máscara do CEP
      $('#novo_cep').mask('00000-000');

      // Máscara do CPF
      $('#novo_cpf').mask('000.000.000-00');

      //máscara dos telefone
      $('#novo_celular1, #novo_celular2').mask('(00)00000-0000');

      $('#modalNovoInstrutor').modal('show');

    });

    // envio da requisição para permaneer os dados do aluno
    $('#btnSalvarNovo').click(function() {
        // Serializar o formulário
        var formData = $('#formNovoInstrutor').serialize();

        // Fazer a requisição AJAX de Edição
        $.ajax({
            type: 'POST',
            url: '{{ route("Novo Instrutor") }}',
            data: formData,
            success: function(response) {
                // Lógica de sucesso, se necessário
                console.log('Cadastro realizada com sucesso.');
                $('#modalNovoInstrutor').modal('hide');
                location.reload();               
            },
            error: function(error) {
                // Lógica de erro, se necessário
                console.log(error.responseText);
            }
        });
    });
</script>


</body>
</html>