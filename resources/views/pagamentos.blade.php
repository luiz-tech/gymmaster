{{ view('header') }}

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6 text-center">
          <h1>Financeiro - Pagamentos</h1>
        </div>
        <div class="col-sm-6 text-center">
          <button class="btn btn-lg btn-info"data-toggle="modal" data-target="#modalInfo"><i class="fa fa-info-circle" aria-hidden="true"></i></button>
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
              <h3 class="card-title">Pagamentos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Código</th>
                  <th>Aluno</th>
                  <th>Celular</th>
                  <th>Plano</th>
                  <th>Mensalidade</th>
                  <th>Situação</th>
                  <th>Data Vencimento</th>
                  <th>Data Pagamento</th>
                  <th>Método de Pagamento</th>
                </tr>
                </thead>

                <tbody>
                  @foreach($pagamentos as $pagamento)
                    <tr>
                      <td>{{ $pagamento->id }}</td>
                      <td>{{ $pagamento->nome_aluno }}</td>
                      <td>{{ $pagamento->celular1 }}</td>
                      <td>{{ $pagamento->plano }}</td>
                      <td>{{ $pagamento->mensalidade }}</td>
                      <td>
                          @php
                          $dataPagamento = new DateTime($pagamento->dt_pagamento);
                          $hoje = new DateTime();
                          $intervalo = $hoje->diff($dataPagamento);
                          if ($hoje < $dataPagamento) {
                              echo '<span class="badge bg-success">Em Dia</span>';
                          } elseif ($intervalo->days <= 7) {
                              echo '<span class="badge bg-warning text-dark">Atraso ' . $intervalo->days . ' dias</span>';
                              
                          } else {
                              echo '<span class="badge bg-danger">Vencido ' . $intervalo->days . ' dias</span>';
                              
                          }
                          @endphp
                      </td>

                      <td>{{ date('d/m/Y', strtotime($pagamento->dt_vencimento)) }}</td>
                      <td>
                        @if($hoje < $dataPagamento)
                        {{ $pagamento->metodo_pagamento }}
                        @else
                        <span class="badge bg-warning">Aguardando Pagamento</span>
                        @endif
                      </td>

                      <td>{{ $pagamento->metodo_pagamento}}</td>
                    
                    </tr>
               	  @endforeach
                </tbody>

                <tfoot>
                <tr>
                  <th>Código</th>
                  <th>Aluno</th>
                  <th>Celular</th>
                  <th>Plano</th>
                  <th>Mensalidade</th>
                  <th>Situação</th>
                  <th>Data Vencimento</th>
                  <th>Data Pagamento</th>
                  <th>Método de Pagamento</th>
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




{{ view('footer') }}


<div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="modalInfoLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalInfoLabel">Informações Sobre Pagamentos <i class="fa fa-info" aria-hidden="true"></i></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <h5>Os pagamentos são realizados diretamente na plataforma de pagamento a qual o usuário contratou o plano e registrados neste sistema de gerenciamento.</h5>
        <h5>Após o usuário concluir o pagamento, o sistema de gerenciamento {{ env('APP_NAME') }} calculará e registrará o pagamento para o aluno correspondente, juntamente com o plano escolhido.</h5>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Entendi</button>
      </div>
    </div>
  </div>
</div>

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

</body>
</html>