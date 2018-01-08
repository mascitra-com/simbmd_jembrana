@layout('commons/index')
@section('title')Pengdaan - SP2D@end

@section('breadcrump')
<li class="breadcrumb-item"><a href="{{site_url()}}">Beranda</a></li>
<li class="breadcrumb-item"><a href="{{site_url('pengadaan')}}">Pengadaan</a></li>
<li class="breadcrumb-item active">SP2D Penunjang</li>
@end

@section('content')
<div class="btn-group mb-3">
	<a href="{{site_url('pengadaan/detail')}}" class="btn btn-primary">Detail SPK</a>
	<a href="{{site_url('pengadaan/sp2d')}}" class="btn btn-primary">SP2D</a>
	<a href="{{site_url('pengadaan/sp2d_penunjang')}}" class="btn btn-primary active">SP2D Penunjang</a>
	<a href="{{site_url('pengadaan/rincian')}}" class="btn btn-primary">Rincian Aset</a>
</div>
<div class="row mb-3">
	<div class="col">
		<div class="card">
			<div class="card-header">Detail Kontrak</div>
			<div class="card-body row">
				<div class="col">
					<div class="row">
						<div class="col">No. Kontrak</div><div class="col"> : 123/ABC/Kontrak/2017</div>
						<div class="w-100"></div>
						<div class="col">Tanggal Kontrak</div><div class="col"> : 20/06/2017</div>
						<div class="w-100"></div>
						<div class="col">Jangka Waktu</div><div class="col"> : 12 Bulan</div>
					</div>
				</div>
				<div class="col">
					<div class="row">
						<div class="col">Nilai Kontrak</div><div class="col"> : 12.000.000,00</div>
						<div class="w-100"></div>
						<div class="col">Total SP2D</div><div class="col"> : 12.000.000,00</div>
						<div class="w-100"></div>
						<div class="col">Sisa Kontrak</div><div class="col"> : 0,00</div>
						<div class="w-100"></div>
						<div class="col">Total SP2D Penunjang</div><div class="col"> : 0,00</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header form-inline">
				<span class="mr-auto">SP2D</span>
				<button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus"></i> Tambah SP2D Penunjang</button>
			</div>
			<div class="card-body table-responsive px-0 py-0">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center text-nowrap">No. SP2D</th>
							<th>Tanggal</th>
							<th>Keterangan</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-center">0026</td>
							<td>26/05/2017</td>
							<td>Pengadaan dan Pemasangan Rambu Rambu Lalu Lintas keperluan Dinas Perhubungan Kabupaten Pasuruan</td>
							<td class="text-center text-nowrap btn-group">
								<button class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Rincian</button>
								<button class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></button>
								<button class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@end

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="modal-tambah">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Form SP2D Penunjang</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form action="#">
					<div class="form-group">
						<label>Nomor SP2D</label>
						<input type="text" class="form-control form-control-sm" placeholder="Nomor" />
					</div>
					<div class="form-group">
						<label>Tanggal</label>
						<input type="text" class="form-control form-control-sm" placeholder="Tanggal" />
					</div>
					<div class="form-group">
						<label>Keterangan</label>
						<textarea class="form-control form-control-sm" placeholder="Nomor" ></textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Simpan</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@end