@layout('commons/index')
@section('title')Beranda@end

@section('breadcrump')
<li class="breadcrumb-item"><a href="{{site_url()}}">Beranda</a></li>
<li class="breadcrumb-item"><a href="{{site_url('pengadaan')}}">Pengadaan</a></li>
<li class="breadcrumb-item active">Rincian</li>
@end

@section('content')
<div class="btn-group mb-3">
	<a href="{{site_url('pengadaan/detail')}}" class="btn btn-primary active">Detail SPK</a>
	<a href="{{site_url('pengadaan/sp2d')}}" class="btn btn-primary">SP2D</a>
	<a href="{{site_url('pengadaan/sp2d_penunjang')}}" class="btn btn-primary">SP2D Penunjang</a>
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
			<div class="card-header">Form</div>
			<div class="card-body">
				<form action="#" method="POST">
					<div class="row">
						<div class="col">
							<div class="form-row">
								<div class="form-group col">
									<label>No. Kontrak</label>
									<input type="text" class="form-control form-control-sm" placeholder="No. SPK/Kontrak/Perjanjian" />
								</div>
								<div class="form-group col">
									<label>Tgl. Kontrak</label>
									<input type="date" class="form-control form-control-sm" placeholder="Tanggal kontrak" />
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col">
									<label>Jangka Waktu</label>
									<input type="number" class="form-control form-control-sm" placeholder="Jangka waktu" />
								</div>
								<div class="form-group col">
									<label>Nilai</label>
									<input type="number" class="form-control form-control-sm" placeholder="Nilai" />
								</div>
							</div>
							<div class="form-group">
								<label>Keterangan</label>
								<textarea class="form-control form-control-sm" rows="5" placeholder="Keterangan"></textarea>
							</div>
						</div>
						<div class="col">
							<div class="form-row">
								<div class="form-group col">
									<label>Nama Perusahaan</label>
									<input type="text" class="form-control form-control-sm" placeholder="Nama perusahaan" />
								</div>
								<div class="form-group col">
									<label>Bentuk</label>
									<input type="text" class="form-control form-control-sm" placeholder="Bentuk" />
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col">
									<label>Alamat</label>
									<input type="text" class="form-control form-control-sm" placeholder="Alamat" />
								</div>
								<div class="form-group col">
									<label>Pimpinan</label>
									<input type="text" class="form-control form-control-sm" placeholder="Pimpinan" />
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col">
									<label>NPWP</label>
									<input type="text" class="form-control form-control-sm" placeholder="NPWP" />
								</div>
								<div class="form-group col">
									<label>Bank</label>
									<input type="text" class="form-control form-control-sm" placeholder="Bank" />
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col">
									<label>Atas Nama</label>
									<input type="text" class="form-control form-control-sm" placeholder="Atas Nama" />
								</div>
								<div class="form-group col">
									<label>No. Rekening</label>
									<input type="text" class="form-control form-control-sm" placeholder="No. Rekening" />
								</div>
							</div>
						</div>
					</div>
					<hr>
					<div class="form-row">
						<div class="col text-right">
							<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
							<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@end

@section('script')
<script>
	theme.activeMenu('.nav-pengadaan')
</script>
@end