<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SIMBMD - Sistem Informasi Manajemen Barang Milik Daerah Kabupaten Jembrana</title>
    <!-- CSS -->
    <!-- Bootstrap core CSS     -->
    <link rel="icon" type="image/png" href="https://mascitra.com/uploads/partners/29/partner/Logo-Jembrana-Bali-Risize.jpg">
    <link rel="stylesheet" href="{{base_url('res/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{ base_url("res/styles/light-bootstrap-dashboard.css") }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{base_url('res/plugins/fontawesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{base_url('res/plugins/chosen/chosen.min.css')}}">

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{ base_url("res/styles/homepage.css") }}" rel="stylesheet"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
</head>
<body>
<nav class="navbar navbar-trans navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ site_url('/') }}">
                <b>SIMBMD JEMBRANA</b>
            </a>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ site_url('/') }}">Home</a><a href="{{site_url('homepage/maps')}}" target="_blank">Maps</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid" id="content" style="margin-top: 2em">
    <div class='row' id="highlight-container" style="margin-top: -2em">
        <div class="col-md-12" id="highlight"></div>
    </div>
    <div class="row" style="margin-top: 1em" id="table-kib">
        <div class="col">
            <div class="card">
                <div class="card-header form-inline">
                    <form action="{{site_url('homepage')}}" method="GET" class="mr-auto">
                        <div class="input-group">
                            <select name="id_organisasi" class="select-chosen" data-placeholder="Pilih UPB...">
                                <option></option>
                                <option value="0">Semua UPB</option>
                                @foreach($organisasi AS $org)
                                    <option value="{{$org->id}}" {{isset($filter['id_organisasi']) && $org->id === $filter['id_organisasi'] ? 'selected' : ''}}>{{$org->nama}}</option>
                                @endforeach
                            </select>
                            <span class="input-group-btn">
							<button class="btn btn-primary">Pilih</button>
						</span>
                        </div>
                    </form>
                    <div class="btn-group">
                        <a href="{{site_url('homepage/maps')}}" class="btn btn-primary" target="_blank">Maps</a>
                        <button class="btn btn-primary btn-refresh"><i class="fa fa-refresh mr-2"></i>Segarkan</button>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-filter"><i class="fa fa-filter mr-2"></i>Filter</button>
                    </div>
                </div>
                <div class="card-body table-responsive table-scroll px-0 py-0">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                            <th class="text-nowrap text-center">Map</th>
                            <th class="text-nowrap text-center">Kode Barang</th>
                            <th class="text-nowrap">Luas (m3)</th>
                            <th class="text-nowrap">Alamat</th>
                            <th class="text-nowrap">Tgl. Sertifikat</th>
                            <th class="text-nowrap">No. Sertifikat</th>
                            <th class="text-nowrap">Hak Pakai</th>
                            <th class="text-nowrap">Pengguna</th>
                            <th class="text-nowrap">Tgl. Perolehan</th>
                            <th class="text-nowrap">Tgl. Pembukuan</th>
                            <th class="text-nowrap">Asal Usul</th>
                            <th class="text-nowrap text-right">Nilai</th>
                            <th class="text-nowrap">Keterangan</th>
                            <th class="text-nowrap">Kategori</th>
                            <th class="text-nowrap">Koordinat</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(empty($kib))
                            <tr><td colspan="15" class="text-center"><b><i>Data kosong</i></b></td></tr>
                        @endif

                        @foreach($kib AS $item)
                            <tr>
                                <td class="text-nowrap text-center">
                                    @if($item->garis_lintang != "<span class='text-secondary'><i>kosong</i></span>")
                                        <a href="{{site_url('homepage/maps/'.$item->garis_lintang.'/'.$item->garis_bujur)}}" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-map-marker"></i></a>
                                    @else
                                        <a data-toggle="tooltip" data-placement="top" title="Koordinat Tidak Tersedia" class="btn btn-sm btn-primary">
                                            <i class="fa fa-map-marker"></i>
                                        </a>
                                    @endif
                                </td>
                                <td class="text-nowrap text-center">
                                    {{zerofy($item->id_kategori->kd_golongan)}} .
                                    {{zerofy($item->id_kategori->kd_bidang)}} .
                                    {{zerofy($item->id_kategori->kd_kelompok)}} .
                                    {{zerofy($item->id_kategori->kd_subkelompok)}} .
                                    {{zerofy($item->id_kategori->kd_subsubkelompok)}} .
                                    {{zerofy($item->reg_barang,4)}}
                                </td>
                                <td class="text-nowrap">{{$item->luas}}</td>
                                <td class="text-nowrap">{{$item->alamat}}</td>
                                <td class="text-nowrap">{{datify($item->sertifikat_tgl, 'd/m/Y')}}</td>
                                <td class="text-nowrap">{{$item->sertifikat_no}}</td>
                                <td class="text-nowrap">{{$item->hak}}</td>
                                <td class="text-nowrap">{{$item->pengguna}}</td>
                                <td class="text-nowrap">{{datify($item->tgl_perolehan, 'd/m/Y')}}</td>
                                <td class="text-nowrap">{{datify($item->tgl_pembukuan, 'd/m/Y')}}</td>
                                <td class="text-nowrap">{{$item->asal_usul}}</td>
                                <td class="text-nowrap text-right">{{monefy($item->nilai)}}</td>
                                <td class="text-nowrap">{{$item->keterangan}}</td>
                                <td class="text-nowrap">{{$item->id_kategori->nama}}</td>
                                <td class="text-nowrap">{{$item->garis_lintang . ', ' . $item->garis_bujur}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">{{$pagination}}</div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modal-filter">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Filter data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{site_url('homepage')}}" method="GET">
                    <input type="hidden" name="id_organisasi" value="{{isset($filter['id_organisasi'])?$filter['id_organisasi']:''}}">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Reg Barang</label>
                                <input type="text" class="form-control" name="reg_barang" value="{{isset($filter['reg_barang'])?$filter['reg_barang']:''}}" />
                            </div>
                            <div class="form-group">
                                <label>Tgl. Sertifikat</label>
                                <input type="text" class="form-control" name="sertifikat_tgl" value="{{isset($filter['sertifikat_tgl'])?$filter['sertifikat_tgl']:''}}" />
                            </div>
                            <div class="form-group">
                                <label>Pengguna</label>
                                <input type="text" class="form-control" name="pengguna" value="{{isset($filter['pengguna'])?$filter['pengguna']:''}}" />
                            </div>
                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="date" class="form-control" name="tahun" value="{{isset($filter['tahun'])?$filter['tahun']:''}}" />
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" class="form-control" name="keterangan" value="{{isset($filter['keterangan'])?$filter['keterangan']:''}}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="alamat" value="{{isset($filter['alamat'])?$filter['alamat']:''}}" />
                            </div>
                            <div class="form-group">
                                <label>Hak</label>
                                <input type="text" class="form-control" name="hak" value="{{isset($filter['hak'])?$filter['hak']:''}}" />
                            </div>
                            <div class="form-group">
                                <label>Tgl. Pembukuan</label>
                                <input type="text" class="form-control" name="tgl_pembukuan" value="{{isset($filter['tgl_pembukuan'])?$filter['tgl_pembukuan']:''}}" />
                            </div>
                            <div class="form-group">
                                <label>Nilai</label>
                                <input type="text" class="form-control" name="nilai" value="{{isset($filter['nilai'])?$filter['nilai']:''}}" />
                            </div>
                            <div class="form-group">
                                <label>Urutkan Berdasar</label>
                                <select name="ord_by" class="form-control">
                                    <option value="reg_barang">Reg Barang</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Luas</label>
                                <input type="text" class="form-control" name="luas" value="{{isset($filter['luas'])?$filter['luas']:''}}" />
                            </div>
                            <div class="form-group">
                                <label>No. Sertifikat</label>
                                <input type="text" class="form-control" name="sertifikat_no" value="{{isset($filter['sertifikat_no'])?$filter['sertifikat_no']:''}}" />
                            </div>
                            <div class="form-group">
                                <label>Tgl. Perolehan</label>
                                <input type="text" class="form-control" name="tgl_perolehan" value="{{isset($filter['tgl_perolehan'])?$filter['tgl_perolehan']:''}}" />
                            </div>
                            <div class="form-group">
                                <label>Asal Usul</label>
                                <input type="text" class="form-control" name="asal_usul" value="{{isset($filter['asal_usul'])?$filter['asal_usul']:''}}" />
                            </div>
                            <div class="form-group">
                                <label>Jumlah Tampilan Data</label>
                                <select name="limit" class="form-control">
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="300">300</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container-fluid">
        <nav class="pull-left">
            <ul>
                <li>
                    <a href="#">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ base_url('masuk') }}">
                        Masuk
                    </a>
                </li>
            </ul>
        </nav>
        <p class="copyright pull-right">
            Copyright &copy; 2017 Pemerintah Kabupaten Jembrana powered by <a href="http://www.mascitra.com">mascitra.com</a> | Konsultan IT
        </p>
    </div>
</footer>

<!--  Load jQuery -->
<script type="text/javascript" src="{{base_url('res/plugins/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{base_url('res/plugins/bootstrap/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{base_url('res/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{base_url('res/plugins/chosen/chosen.jquery.min.js')}}"></script>
<script type="text/javascript" src="{{base_url('res/scripts/theme.js')}}"></script>

<!--  Load custom JS -->

<script type="text/javascript">
    var kib = (function(){
        theme.activeMenu('.nav-invent');
    })();
</script>
</body>
</html>