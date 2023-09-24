@php
    $nip = isset($_GET['nip']) ? $_GET['nip'] : null;
    $nama_lengkap = isset($_GET['nama_lengkap']) ? $_GET['nama_lengkap'] : null;
    $id_skpd = isset($_GET['id_skpd']) ? $_GET['id_skpd'] : null;
@endphp
@push('styles')
<link href="{{asset('vendor/select2/select2.min.css')}}" rel="stylesheet" />
<style>
  .highlight-nip{ 
    content: '';
    /* position: absolute; */
    z-index: -1;
    top: 60%;
    left: -0.1em;
    right: -0.1em;
    bottom: 0;
    transition: top 200ms cubic-bezier(0, 0.8, 0.13, 1);
    background-color: #fed700;
  }
  .highlight-nama-lengkap{ 
    content: '';
    /* position: absolute; */
    z-index: -1;
    top: 60%;
    left: -0.1em;
    right: -0.1em;
    bottom: 0;
    transition: top 200ms cubic-bezier(0, 0.8, 0.13, 1);
    background-color: #ffbe99;
  }
</style>
@endpush
@push('scripts')
<script src="{{asset('vendor/select2/select2.min.js')}}"></script>

<script>

  function showDetail(params) {
      var id_pegawai = params;
      fetch("{{url('mahasiswa-detail')}}/"+id_pegawai)
      .then(response =>response.json())
      .then(data => {
        if (data.data != null) {
          var detail = data.data;
          console.log(detail.nip);
          $('#nip_').html(detail.nip);
          $('#nama_lengkap_').html(detail.nama_lengkap);
          $('#nama_skpd_').html(detail.nama_skpd);
        }
      });
      
      $('#detail').appendTo('body').modal('show');
  }

</script>
@if ($nip != null)
    <script>
      $("body").find(".highlight-nip").removeClass("highlight-nip");

      var searchword = $("#nip").val();

      var custfilter = new RegExp(searchword, "ig");
      var repstr = "<span class='highlight-nip'>" + searchword + "</span>";

      if (searchword != "") {
          $('#content').each(function() {
              $(this).html($(this).html().replace(custfilter, repstr));
          })
      }
    </script>
@endif
@if ($nama_lengkap != null)
    <script>
      $("body").find(".highlight-nama-lengkap").removeClass("highlight-nama-lengkap");

      var searchword = $("#nama_lengkap").val();

      var custfilter = new RegExp(searchword, "ig");
      var repstr = "<span class='highlight-nama-lengkap'>" + searchword + "</span>";

      if (searchword != "") {
          $('#content').each(function() {
              $(this).html($(this).html().replace(custfilter, repstr));
          })
      }
    </script>
@endif

@endpush

@push('title')
    Mahasiswa - 
@endpush
<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Data Mahasiswa') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Mahasiswa</a></div>
            <div class="breadcrumb-item"><a href="{{ route('mahasiswa') }}">Data Mahasiswa</a></div>
        </div>
    </x-slot>

    <div>
      <div class="card">
        <div class="container-fluid">
          <form method="GET">
            <div class="row mt-3">
              <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label">NIM</label>
                    <input type="text" name="nip" id="nip" class="form-control" value="{{$nip}}" placeholder="Masukan nim" id="">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Nama</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="{{$nama_lengkap}}" placeholder="Masukan nama lengkap" id="">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Desa</label>
                    <select name="id_skpd" class="form-control select2">
                        <option value="">-- Pilih Desa --</option>
                        @foreach ($skpd as $item)
                          <option value="{{$item->id_skpd}}" {{($item->id_skpd = $id_skpd) ? 'selected' : null}} >{{$item->nama_skpd}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="col-md-3">
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
        <div class="row" id="content">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>List Mahasiswa</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                      <thead>                                 
                        <tr>
                          <th class="text-center">
                            #
                          </th>
                          <th></th>
                          <th>NIM</th>
                          <th>Nama</th>
                          <th>Desa</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if ($mahasiswa)
                          @foreach ($mahasiswa as $item)
                            <tr>
                              <td class="text-center">
                                {{$loop->iteration}}
                              </td>
                              <td>
                                <img alt="image" src="{{asset('stisla')}}/avatar.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                              </td>
                              <td>{{$item->nip}}</td>
                              <td>{{$item->nama_lengkap}}</td>
                              <td>{{$item->nama_skpd}}</td>
                              <td><a href="#" onclick="showDetail({{$item->id_pegawai}})" class="btn btn-secondary">Detail</a></td>
                            </tr>
                          @endforeach     
                        @else 
                          <tr>
                            <td colspan="100%">Belum ada data</td>  
                          </tr>                            
                        @endif
                      </tbody>
                    </table>
                  </div>
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
                <h5 class="modal-title" id="exampleModalLabel">Detail Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <table>
                  <tr>
                    <td>NIM</td>
                    <td class="pr-2 pl-2"> : </td>
                    <td style="font-weight: bold" id="nip_">A2.1800086</td>
                  </tr>
                  <tr>
                    <td>NAMA</td>
                    <td class="pr-2 pl-2"> : </td>
                    <td style="font-weight: bold" id="nama_lengkap_">MUHAMAD IQBAL RIVALDI</td>
                  </tr>
                  <tr>
                    <td>DESA </td>
                    <td class="pr-2 pl-2"> : </td>
                    <td style="font-weight: bold" id="nama_skpd_">SUKAJAYA</td>
                  </tr>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
</x-app-layout>