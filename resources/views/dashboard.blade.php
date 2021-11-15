@extends('layouts.master')

@section('content')
    <!-- Card stats -->
    <div class="row">
        <div class="col-md-3">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Buku</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $buku }}</span>
                          
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="ni ni-books"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Anggota</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $anggota }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-single-02"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Transaksi</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $transaksi }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                <i class="ni ni-ruler-pencil"></i>
                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Riwayat</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $riwayat }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-purple text-white rounded-circle shadow">
                                <i class="ni ni-support-16"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    
        <div class="row">
          <div class="col-xl-8">
            <div class="card bg-default">
              <div class="card-header bg-transparent">
                <div class="row align-items-center">
                  <div class="col">
                    <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
                    <h5 class="h3 text-white mb-0">Transaksi</h5>
                  </div>
                  <div class="col">
                   
                  </div>
                </div>
              </div>
              <div class="card-body">
                <!-- Chart -->
                <div class="chart">
                  <!-- Chart wrapper -->
                  <canvas id="myChart" class="chart-canvas"></canvas>
                  @php
                      $trans = '';
                      $jumlah = null;

                      foreach ($transaksi_pinjam as $item) {

                        // echo $item->status;
                      
                      }
                  @endphp
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4">
            <div class="card">
              <div class="card-header bg-transparent">
                <div class="row align-items-center">
                  <div class="col">
                    <h6 class="text-uppercase text-muted ls-1 mb-1">Overview</h6>
                    <h5 class="h3 mb-0">Jenis Kelamin</h5>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <!-- Chart -->
                <div class="chart">
                  <canvas id="donutChart" class="chart-canvas"></canvas>
                  @php
                      $jk = "";
                      $jumlah = null;

                      foreach ($jenis_kelamin as $item) {
                        
                        $jenis = $item->jenis_kelamin;
                        $jk .= "'$jenis'".",";

                        $tot = $item->total;
                        $jumlah .= "'$tot'".",";
                      }
                  @endphp 
                 
                </div>
              </div>
            </div>
          </div>
        </div>
   
   
        
@endsection

@push('script')
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
        type: 'bar',
    data: {
        labels: ['buku','anggota','transaksi','riwayat'],
        datasets: [{
            label: 'jumlah',
            data: ['{{ $buku }}','{{ $anggota }}','{{ $transaksi }}','{{ $riwayat }}'],
            backgroundColor: [
                '#2dce89',
                '#fb9a40',
                '#f63f55',
                '#9365e0'
            ],
            borderColor: [
            //    '#f9fafa',
            //    '#faebd5',
            //    '#f65f38',
            //    '#b965e0'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});



// chart Berdasarkan jeni kelamin
 //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
    labels: [@php echo $jk; @endphp],
      datasets: [
        {
          data:  [@php echo $jumlah; @endphp],
          backgroundColor : [ '#5e72e4','#f63f55', ],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions      
    })
</script>
@endpush
