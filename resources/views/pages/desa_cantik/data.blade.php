@push('styles')
<link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet" />
@endpush
@push('scripts')
<script href="{{asset('vendor/select2/select2.min.js')}}" ></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>

    var options = {
        series: [],
        chart: {
        height: 350,
        type: 'line',
        zoom: {
            enabled: false
        }
        },
        dataLabels: {
        enabled: false
        },
        stroke: {
        curve: 'straight'
        },
        title: {
            text: 'by Month',
            align: 'left'
        },
        grid: {
        row: {
            colors: ['#f3f3f3', 'transparent'],
            opacity: 0.5
        },
        },
        xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des'],
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    function showDetail(params, desa) {
        var id_pegawai = params;
        fetch("{{url('desa-cantik/statistik')}}/"+id_pegawai)
        .then(response =>response.json())
        .then(data => {
          if (data.list != null) {
            var detail = data.list;
            chart.updateSeries([{
                name: "Pengisian KK",
                data: detail.jumlah_pengisian
            }]);
          }
        });
        
        $('#nama_desa').html(desa);
        $('#detail').appendTo('body').modal('show');
    }
  
  </script>
@endpush
@push('title')
    Desa Cantik - 
@endpush
<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Desa Cantik') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Desa Cantik</a></div>
            <div class="breadcrumb-item"><a href="{{ route('desa-cantik') }}">Data Desa Cantik</a></div>
        </div>
    </x-slot>
    <div>
        <div class="card">
          <div class="container-fluid">
            <form method="GET">
              <div class="row mt-3">
                <div class="col-md-5">
                  <div class="form-group">
                      <label class="control-label">Desa</label>
                      <input type="text" class="form-control" placeholder="Masukan nama desa" name="keyword" value="{{isset($_GET['keyword']) ? $_GET['keyword'] : null;}}">
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                      <br>
                      <button type="submit"
                          class="btn btn-primary btn-lg m-t-5 btn-outline"><i
                              class="ti-filter"></i>Filter</button>
                  </div>
              </div>
              </div>
            </form>
          </div> 
        </div>

      <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Desa</th>
                                    <th>Jumlah Pengisian</th>
                                    <th>Statistik</th>
                                </tr>
                            </thead>
                            <tbody>
                              @if ($desa_cantik)
                                @if ($desa_cantik->list)
                                    @foreach ($desa_cantik->list as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td><b>{{$item->nama_skpd}}</b></td>
                                            <td><b><?= $item->jumlah_pengisian ?></b> Keluarga <small>dari {{$item->total_kk}} KK </small> ({!!percentage($item->jumlah_pengisian, $item->total_kk)!!}) </td>
                                            <td><a href="#" onclick="showDetail({{$item->id_skpd}}, '{{$item->nama_skpd}}')" class="btn btn-secondary">Detail</a></td>
                                        </tr>
                                    @endforeach
                                @else 
                                    <tr>
                                        <td colspan="100%">
                                            Belum ada data
                                        </td>
                                    </tr>
                                @endif
                              @endif
                            </tbody>
                        </table>
                            {!! $desa_cantik->pagination !!}
                            @if ($desa_cantik)
                                @if ($desa_cantik->list)
                                    @if (count($desa_cantik->list) > 10)
                                    @endif
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <!-- Modal -->
         <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Statistik tahun {{date('Y')}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body text-center">
                    <b id="nama_desa"></b>
                    <div id="chart"></div>
                </div>
              </div>
            </div>
          </div>
    </div>
</x-app-layout>
