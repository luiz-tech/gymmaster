
  {{ view('header') }}

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">Painel Administrativo</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 id="alunos_totais">{{ App\Models\Pessoas::join('alunos', 'pessoas.id', '=', 'alunos.id_pessoa')
                ->count(); }}
                </h3>
                <p>Alunos Matriculados</p>
              </div>
              <div class="icon">
                <i class="fa fa-check-square" aria-hidden="true"></i>
              </div>
              <a href="{{ route('Lista de Alunos', ['status' => 'all']) }}" class="small-box-footer">Veja Mais<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="alunos_ativos">{{ App\Models\Pessoas::join('alunos', 'pessoas.id', '=', 'alunos.id_pessoa')
                ->where('pessoas.status', 'A')
                ->count();}}</h3>

                <p>Alunos Ativos</p>
              </div>
              <div class="icon">
                <i class="fa fa-user" aria-hidden="true"></i>
              </div>
              <a href="{{ route('Lista de Alunos', ['status' => 'a']) }}" class="small-box-footer">Veja Mais<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box badge-danger">
              <div class="inner">
                <h3 id="alunos_inativos">{{ App\Models\Pessoas::join('alunos', 'pessoas.id', '=', 'alunos.id_pessoa')
                ->where('pessoas.status', 'I')
                ->count();}}</h3>

                <p>Alunos Inativos</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-times" aria-hidden="true"></i>
              </div>
              <a href="{{ route('Lista de Alunos', ['status' => 'i']) }}" class="small-box-footer">Veja Mais<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 id="num_planos">{{ App\Models\Planos::count() }}</h3>

                <p>Planos</p>
              </div>
              <div class="icon">
                <i class="fa fa-bolt" aria-hidden="true"></i>
              </div>
              <a href="{{ route('Lista de Planos') }}" class="small-box-footer">Veja Mais<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <div class="col-12">
           <!-- solid sales graph -->
            <div class="card bg-gradient-light">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Estatísticas Matrículas
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn bg-primary btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <!-- button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button -->
                </div>
              </div>
              <div class="card-body">
                <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
              <!-- div class="card-footer bg-transparent">
                <div class="row">
                
                  <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">Online</div>
                  </div>
              
                  <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">In-Store</div>
                  </div>
          
                </div>
              </div -->
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row (main row) -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  {{ view('footer') }}
  
<!-- Scrips dessa página -->

<!-- ChartJS -->
<script src="adminlte/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="adminlte/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- daterangepicker -->
<script src="adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="adminlte/plugins/summernote/summernote-bs4.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- script src="adminlte/dist/js/demo.js"></script -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="adminlte/dist/js/pages/dashboard.js"></script>

<!-- Script que renderiza o gráfico -->
<script>
    $(document).ready(function() {
        
      request_datacharts() //carrega os dados do gráfico
      
    });

    function request_datacharts() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('load_data_chart') }}",
            dataType: "json",
            success: function(data) {
                renderChart(data);
                console.log(data);
            },
            error: function(error) {
                console.error("Erro ao carregar os dados do gráfico:", error);
            }
        });
    }

    function renderChart(data) {
      var dayMonthLabels = data.map(item => item.day_month);

      var ctx = document.getElementById("line-chart").getContext("2d");
      var myChart = new Chart(ctx, {
        type: "line",
        data: {
          labels: dayMonthLabels,
          datasets: [
            {
              label: "Alunos Matriculados",
              data: data.map(item => item.student_count),
              borderColor: "rgba(0, 255, 89, 1)",
              backgroundColor: "rgba(182, 230, 240, 0.2)",
              borderWidth: 1,
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: {
              beginAtZero: true,
              stepSize: 10,
            },
          },
        },
      });
    }



    //função auxiliar ao gráfico
    function getDayName(dayNumber) {
      var daysOfWeek = ["Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado"];
      return daysOfWeek[dayNumber];
    }

</script>

</body>
</html>
