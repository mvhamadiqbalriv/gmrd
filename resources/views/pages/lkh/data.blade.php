@push('styles')
<link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet" />
@endpush
@push('scripts')
<script href="{{asset('vendor/select2/select2.min.js')}}" ></script>
@endpush
@push('title')
    LKH - 
@endpush
<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Laporan Kinerja Harian') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Laporan Kinerja Harian</a></div>
            <div class="breadcrumb-item"><a href="{{ route('lkh') }}">Data Laporan Kinerja Harian</a></div>
        </div>
    </x-slot>
    <div>
        <div class="card">
          <div class="container-fluid">
            <form method="GET">
              <div class="row mt-3">
                <div class="col-md-3">
                  <div class="form-group">
                      <label class="control-label">Desa</label>
                      <select name="id_skpd" class="form-control select2">
                          <option value="">-- Pilih Desa --</option>
                          @foreach ($skpd as $item)
                            <option value="{{$item->id_skpd}}" {{isset($_GET['id_skpd']) ? (($_GET['id_skpd'] == $item->id_skpd) ? 'selected' : null) : null}} >{{$item->nama_skpd}}</option>
                          @endforeach
                      </select>
                  </div>
                </div>
                <div class="col-md-2">

                    <div class="form-group">
                        <label class="control-label"> Bulan</label>
                        <select class="form-control select2" name="bulan" id="bulan">
                            <?php
                                for($i=1; $i <= 12; $i++)
                                {
                                    $selected = isset($_GET['bulan']) ? (($_GET['bulan'] == $i) ? 'selected' : null) : ((date('m') != $i) ?: 'selected');
                                    $b = date("M",strtotime(date("Y")."-".$i."-01"));
                                    echo "<option $selected value='$i' >$b</option>";

                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">


                    <div class="form-group">
                        <label class="control-label"> Tahun</label>
                        <select class="form-control select2" id="tahun" name="tahun">
                          <?php
                              for($i=2021; $i <= date('Y'); $i++)
                              {
                                  $selected = isset($_GET['tahun']) ? (($_GET['tahun'] == $i) ? 'selected' : null) : ((date('Y') != $i) ?: 'selected');
                                  echo "<option $selected value='$i' >$i</option>";
                              }
                          ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                      <br>
                      <button type="submit" value="1" name="filter"
                          class="btn btn-primary btn-lg m-t-5 btn-outline"><i
                              class="ti-filter"></i>Filter</button>
                      {{-- <button type="submit" value="1" name="download" class="btn btn-primary m-t-5"><i
                              class="ti-download"></i>Download PDF</button>
                      <button type="submit" value="1" name="download_zip" class="btn btn-primary m-t-5"><i
                              class="ti-file"></i>Download Semua pegawai(.zip)</button> --}}
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
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th style="text-align:center">Jumlah LKH</th>
                                    <th style="text-align:center">Hari Kerja Efektif</th>
                                    <th style="text-align:center">Persentase</th>
                                    <th style="text-align:center" width="300px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                              @php
                                  $bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
                                  $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
                              @endphp
                              @if ($lkh)
                                @if ($lkh->list)
                                    @foreach ($lkh->list as $item)
                                        @php
                                            if($item->jumlah_lkh==0||$lkh->efektif==0){
                                                    $persentase = 0;
                                                }else{
                                                    $persentase = round(($item->jumlah_lkh / $lkh->efektif) * 100,2);
                                                }
                                        @endphp   
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->nip}}</td>
                                            <td>{{$item->nama_lengkap}}</td>
                                            <td style="text-align:center">{{$item->jumlah_lkh}}</td>
                                            <td style="text-align:center">{{$lkh->efektif}}</td>
                                            <td style="text-align:center">Persentase</td>
                                            <td style="text-align:center" width="300px">
                                                <a href="https://e-officedesa.sumedangkab.go.id/laporan_kinerja_harian/download_rekap_lkh/{{$item->id_pegawai}}/{{$bulan}}/{{$tahun}}" class="btn btn-primary"><i class="ti-download"></i> Download</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else 
                                    <tr>
                                        <td colspan="100%">
                                            @if (isset($_GET['id_skpd']))
                                                @if ($_GET['id_skpd'] != null)
                                                    Belum ada data
                                                @else 
                                                    Pilih desa terlebih dahulu
                                                @endif
                                            @else
                                                Pilih desa terlebih dahulu
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                              @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>