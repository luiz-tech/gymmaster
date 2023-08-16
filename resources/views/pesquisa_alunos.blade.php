{{ view('header') }}

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Lista de Alunos</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a class="btn btn-md btn-success btnNovoAluno" type="button" href="#"><i class="fas fa-plus"></i> Novo Aluno</a>
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
              <h3 class="card-title">Alunos da Academia</h3>
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
                  <th>Plano</th>
                  <th>Celular1</th>
                  <th>Entrou em:</th>
                  <th>Ações</th>
                </tr>
                </thead>

                <tbody>
                @foreach($alunos as $aluno)
                <tr>
                  <td>{{ $aluno->nome }}</td>
                  <td>{{ $aluno->email }}</td>
                  <td>{{ $aluno->cpf }}</td>
                  <td>{{ date('d/m/Y', strtotime($aluno->dt_nascimento)) }}</td>
                  <td>
                    @if ($aluno->status === 'A')
                        <span class="badge badge-success">Ativo</span>
                    @else
                        <span class="badge badge-danger">Inativo</span>
                    @endif
                  </td>
                  <td>{{ $aluno->plano }}</td>
                  <td>{{ $aluno->celular1 }}</td>
                  <td>{{ date('d/m/Y H:i:s', strtotime($aluno->created_at)) }}</td>
                  <td>
                     <button class="btn btn-primary btn-sm btnEditarAluno" 
                          data-aluno="{{ json_encode($aluno) }}">
                        <i class="fas fa-edit"></i> Editar
                    </button>

                    <a onClick="confirmDelete({{ $aluno->id_pessoa_master }},'{{ $aluno->nome }}');" class="btn btn-danger btn-sm">
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
                  <th>Plano</th>
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

<!-- Janela Modal da ficha do Aluno --> 

<!-- Modal de Edição de Aluno -->
<div class="modal fade" id="modalEditarAluno" tabindex="-1" role="dialog" aria-labelledby="modalEditarAlunoLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalEditarAlunoLabel">Ficha de Matrícula do Aluno <i class="fa fa-user-plus" aria-hidden="true"></i></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulário de Edição de Aluno -->
        <form id="formEditarAluno" method="POST">
          @csrf
          <input type="hidden" name="aluno_id" id="aluno_id">

          <hr>
          <h4>Dados Pessoais | <i class="fa fa-user" aria-hidden="true"></i></h4>
          <!-- Dados Pessoais -->
          <div class="row mb-3 pt-3 border-top border-primary">
            <div class="col-md-6">
              <label for="nome">Nome</label>
              <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o nome completo do aluno" required>
            </div>
            <div class="col-md-6">
              <label for="email">E-mail</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Informe um endereço de e-mail válido" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="cpf">CPF</label>
              <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Informe o CPF do aluno" required>
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
                <select class="form-control" id="sexo" name="sexo" required >
                  <option value="">Selecione o Gênero do Aluno</option>
                  <option value="M">Masculino</option>
                  <option value="F">Feminino</option>
                  <option value="O">Outro</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="peso">Peso (Kg)</label>
                <input type="number" step="any" class="form-control" id="peso" name="peso" placeholder="Informe o Peso em kilogramas" required>
            </div>
            <div class="col-md-3">
                <label for="altura">Altura (m)</label>
                <input type="text" class="form-control" id="altura" name="altura" placeholder="Informe a altura em metros"  required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-8">
              <label for="objetivos">Objetivos</label>
              <textarea rows="4" class="form-control" id="objetivos" name="objetivos" placeholder="Descreva brevemente os objetivos desse aluno com sua matrícula na academia Gymmaster"  required></textarea>
            </div>
            <div class="col-4">
              <label for="plano">Planos</label>
              <select class="form-control" id="plano" name="plano" required>
                  @foreach($planos as $plano)
                    <option value="{{ $plano->id }}">{{ $plano->plano}}</option>
                  @endforeach
              </select>
            </div>
          </div> 

          <!-- Endereço -->
          <h4>Endereço | <i class="fa fa-map-marker" aria-hidden="true"></i></h4>
          <div class="row mb-3 pt-3 border-top border-primary">
            <div class="col-md-6">
              <label for="rua">Rua</label>
              <input type="text" class="form-control" id="rua" name="rua" placeholder="Informe a rua do aluno" required >
            </div>
            <div class="col-md-6">
              <label for="numero">Número</label>
              <input type="text" class="form-control" id="numero" name="numero" placeholder="Informe o número da residência do aluno" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="complemento">Complemento</label>
              <small>Opcional</small>
              <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Informe o Complemento" >
            </div>
            <div class="col-md-6">
              <label for="bairro">Bairro</label>
              <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Informe o Bairro" required>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="cidade">Cidade</label>
              <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Informe a Cidade" required >
            </div>
            <div class="col-md-6">
              <label for="cep">CEP</label>
              <input type="text" class="form-control" id="cep" name="cep" placeholder="Informe o CEP" required >
            </div>
          </div>

          <!-- Contato -->
          <h4>Contato | <i class="fa fa-phone" aria-hidden="true"></i></h4>
          <div class="row pt-3 mb-3 border-top border-primary">
            <div class="col-md-6">
              <label for="celular1">Celular 1</label>
              <input type="text" class="form-control" id="celular1" name="celular1" placeholder="Informe um telefone para contato" required >
            </div>
            <div class="col-md-6">
              <label for="celular2">Celular 2</label>
              <small>Opcional</small>
              <input type="text" class="form-control" id="celular2" name="celular2" placeholder="Informe outro telefone para contato" >
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-12">
              <label for="instagram">Usuário Instagram</label><small>Opcional</small>
              <input type="text" class="form-control" id="instagram" name="instagram" placeholder="@ do instagram" >
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

<!-- Modal de Cadastro de Aluno -->
<div class="modal fade" id="modalNovoAluno" tabindex="-1" role="dialog" aria-labelledby="modalEditarAlunoLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalEditarAlunoLabel">Cadastre Nova Ficha de Matrícula do Aluno <i class="fa fa-user-plus" aria-hidden="true"></i></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulário de Cadastro de Novo Aluno -->
        <form id="formNovoAluno" method="POST">
            @csrf
            <hr>
            <h4>Dados Pessoais | <i class="fa fa-user" aria-hidden="true"></i></h4>
            <!-- Dados Pessoais -->
            <div class="row mb-3 pt-3 border-top border-primary">
                <div class="col-md-6">
                    <label for="novo_nome">Nome</label>
                    <input type="text" class="form-control" id="novo_nome" name="novo_nome" placeholder="Informe o nome do aluno"  required>
                </div>
                <div class="col-md-6">
                    <label for="novo_email">E-mail</label>
                    <input type="email" class="form-control" id="novo_email" name="novo_email" placeholder="Informe o e-mail do aluno"  required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="novo_cpf">CPF</label>
                    <input type="text" class="form-control" id="novo_cpf" name="novo_cpf" placeholder="Informe o CPF do aluno"  required>
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
                        <option value="">Selecione o Gênero</option>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                        <option value="O">Outro</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="novo_sexo">Peso (Kg)</label>
                    <input type="float" class="form-control" id="novo_peso" name="novo_peso" placeholder="Informe o Peso em kilogramas" required>
                </div>
                <div class="col-md-3">
                    <label for="novo_sexo">Altura (m)</label>
                    <input type="text" class="form-control" id="novo_altura" name="novo_altura" placeholder="Informe a altura em metros"  required>
                </div>
            </div>
            <div class="row mb-3">
              <div class="col-8">
                <label for="novo_sexo">Objetivos</label>
                <textarea rows="4" class="form-control" id="novo_objetivos" name="novo_objetivos" required placeholder="Descreva brevemente os objetivos do aluno na academia Gymmaster"  ></textarea>
              </div>
              <div class="col-4">
                <label for="novo_plano">Planos</label>
                <select class="form-control" id="novo_plano" name="novo_plano" required>
                    <option value="">Selecione um Plano</option>
                    @foreach($planos as $plano)
                      <option value="{{ $plano->id }}">{{ $plano->plano}}</option>
                    @endforeach
                </select>
              </div>
            </div>    

            <!-- Endereço -->
            <h4>Endereço | <i class="fa fa-map-marker" aria-hidden="true"></i></h4>
            <div class="row mb-3 pt-3 border-top border-primary">
                <div class="col-md-6">
                    <label for="novo_rua">Rua</label>
                    <input type="text" class="form-control" id="novo_rua" placeholder="Informe a rua"  name="novo_rua" required>
                </div>
                <div class="col-md-6">
                    <label for="novo_numero">Número</label>
                    <input type="text" class="form-control" id="novo_numero" placeholder="Informe o Numero da residência do aluno" required name="novo_numero">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="novo_complemento">Complemento</label><small> Opcional</small>
                    <input type="text" class="form-control" id="novo_complemento" name="novo_complemento" placeholder="Informe o Numero da residência do aluno">
                </div>
                <div class="col-md-6">
                    <label for="novo_bairro">Bairro</label>
                    <input type="text" class="form-control" id="novo_bairro" name="novo_bairro" placeholder="Informe o bairro" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="novo_cidade">Cidade</label>
                    <input type="text" class="form-control" id="novo_cidade" name="novo_cidade" placeholder="Informe a cidade" required >
                </div>
                <div class="col-md-6">
                    <label for="novo_cep">CEP</label>
                    <input type="text" class="form-control" id="novo_cep" name="novo_cep" placeholder="Informe o CEP" required>
                </div>
            </div>

            <!-- Contato -->
            <h4>Contato | <i class="fa fa-phone" aria-hidden="true"></i></h4>
            <div class="row pt-3 mb-3 border-top border-primary">
                <div class="col-md-6">
                    <label for="novo_celular1">Celular 1</label>
                    <input type="text" class="form-control" id="novo_celular1" name="novo_celular1" placeholder="Informe um telefone para contato" required>
                </div>
                <div class="col-md-6">
                    <label for="novo_celular2">Celular 2</label>
                    <small>Opcional</small>
                    <input type="text" class="form-control" id="novo_celular2" name="novo_celular2" placeholder="Informe outro telefone para contato" >
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="novo_instagram">Usuário Instagram</label><small> Opcional</small>
                    <input type="text" class="form-control" id="novo_instagram" name="novo_instagram" placeholder="@ do Instagram">
                </div>
            </div>

        </form>
    </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnSalvarNovo">Matricular Aluno</button>
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
        "order": [[7, "desc"]],
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

<!-- Script de exclusão de alunos da tabela -->
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
        deleteAluno(id);
      }
    });
  }

  function deleteAluno(id) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      }
    });

    $.ajax({
      type: 'POST',
      url: '{{ route("Excluir Aluno") }}',
      data: {'id':id},
      success: function (data) {
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

<!-- Script de edição de alunos da tabela -->
<script>

    // função para exbir e carregar a modal com a ficha do aluno
    function showModal(aluno) {

      $('#formEditarAluno')[0].reset();

      // Fazer a requisição AJAX para obter os planos
      $.ajax({
        url: '{{ route("load_planos") }}',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          // Preencher o select de planos
          var selectPlanos = $('#plano');
          selectPlanos.empty();

          $.each(response, function(index, plano) {
            var option = $('<option>', {
              value: plano.id,
              text: plano.plano
            });

            // Verificar e selecionar o plano atual do aluno
            if (plano.id === aluno.id_plano) {
              option.attr('selected', 'selected');
            }
            selectPlanos.append(option);
          });
        },
        error: function(error) {
          console.log('Erro ao carregar os planos:', error);
        }
      });

      // Dados Pessoais
      $('#aluno_id').val(aluno.id_pessoa_master);
      $('#nome').val(aluno.nome);
      $('#email').val(aluno.email);
      $('#cpf').val(aluno.cpf);
      $('#dt_nascimento').val(aluno.dt_nascimento);
      $('#status').val(aluno.status);
      $('#sexo').val(aluno.sexo);
      $('#peso').val(aluno.peso);
      $('#altura').val(aluno.altura);
      $('#objetivos').val(aluno.objetivos);

      // Endereço
      $('#rua').val(aluno.rua);
      $('#numero').val(aluno.numero);
      $('#complemento').val(aluno.complemento);
      $('#bairro').val(aluno.bairro);
      $('#cidade').val(aluno.cidade);
      $('#cep').val(aluno.cep);

      // Contato
      $('#celular1').val(aluno.celular1);
      $('#celular2').val(aluno.celular2);
      $('#instagram').val(aluno.instagram);

      //Configurando as máscaras de cada input
 
      //máscara dos telefone
      $('#celular1, #celular2').mask('(00)00000-0000');

      // Máscara do CEP
      $('#cep').mask('00000-000');

      // Máscara do CPF
      $('#cpf').mask('000.000.000-00');

      // Máscara da Altura
      $('#altura').mask('0.00');

      $('#modalEditarAluno').modal('show');
    }

    // evento que deispara e carrega a janela modal
    $('.btnEditarAluno').click(function() {
      var alunoData = $(this).data('aluno');
      showModal(alunoData);
    });

    // envio da requisição para permaneer os dados do aluno
    $('#btnSalvarEdicao').click(function() {
        // Serializar o formulário
        var formData = $('#formEditarAluno').serialize();

        // Fazer a requisição AJAX do Cadastro

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          }
        });

        $.ajax({
            type: 'POST',
            url: '{{ route("Editar Aluno") }}',
            data: formData,
            success: function(response) {
                // Lógica de sucesso, se necessário
                console.log('Edição realizada com sucesso.');
                $('#modalEditarAluno').modal('hide');
                location.reload(); 
            },
            error: function(error) {
                // Lógica de erro, se necessário
                console.error('Erro na edição: ' + error.responseText);
            }
        });
    });
</script>

<!-- Script de criação de novo usuario -->
<script>
  
  // evento que deispara e carrega a janela modal vazia
    $('.btnNovoAluno').click(function() {
     
      // Máscara do CEP
      $('#novo_cep').mask('00000-000');

      // Máscara do CPF
      $('#novo_cpf').mask('000.000.000-00');

      //máscara dos telefone
      $('#novo_celular1, #novo_celular2').mask('(00)00000-0000');

      // Máscara da Altura
      $('novo_#altura').mask('0.00');

      $('#modalNovoAluno').modal('show');

    });

  // envio da requisição para permaneer os dados do aluno
    $('#btnSalvarNovo').click(function() {
        // Serializar o formulário
        var formData = $('#formNovoAluno').serialize();

        // Fazer a requisição AJAX de Edição
        $.ajax({
            type: 'POST',
            url: '{{ route("Novo Aluno") }}',
            data: formData,
            success: function(response) {
                // Lógica de sucesso, se necessário
                console.log('Edição realizada com sucesso.');
                $('#modalEditarAluno').modal('hide');
                location.reload();               
            },
            error: function(error) {
                // Lógica de erro, se necessário
                console.error('Erro na criação: ' + error.responseText);
            }
        });
    });
</script>


</body>
</html>