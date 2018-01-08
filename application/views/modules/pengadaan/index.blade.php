@layout('commons/index')
@section('title')Pengadaan@end

@section('breadcrump')
<li class="breadcrumb-item"><a href="{{site_url()}}">Beranda</a></li>
<li class="breadcrumb-item active">Pengadaan</li>
@end

@section('content')
<div class="card">
	<div class="card-header form-inline">
		<form action="{{site_url('aset/kiba')}}" method="GET" class="mr-auto">
			<div class="input-group">
				<select name="id_organisasi" class="select-chosen" data-placeholder="Pilih UPB...">
					<option></option>
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
			<button class="btn btn-primary" data-toggle="modal" data-target="#modal-spk"><i class="fa fa-plus mr-2"></i>Baru</button>
			<button class="btn btn-primary" data-toggle="modal" data-target="#modal-filter"><i class="fa fa-filter mr-2"></i>Filter</button>
			<button class="btn btn-primary btn-refresh"><i class="fa fa-refresh mr-2"></i>Segarkan</button>
		</div>
	</div>
	<div class="card-body table-responsive px-0 py-0">
		<table class="table table-hover table-striped table-bordered">
			<thead>
				<thead>
					<tr>
						<th>No. SPK/Perjanian/Kontrak</th>
						<th>Tanggal</th>
						<th>Jangka Waktu</th>
						<th>Keterangan</th>
						<th class="text-center"></th>
					</tr>
				</thead>
				<tbody>
					@for($i=0;$i<3;$i++)
					<tr>
						<td>777/123/PPK.2/424.054/2017</td>
						<td>26/05/2017</td>
						<td>12 Bulan</td>
						<td>Integrasi Axle load ke Brake tester</td>
						<td class="text-center">
							<div class="btn-group btn-group-sm">
								<a href="{{site_url('pengadaan/detail')}}" class="btn btn-primary"><i class="fa fa-eye"></i> rincian</a>
								<button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
								<button class="btn btn-danger"><i class="fa fa-trash"></i></button>
							</div>
						</td>
					</tr>
					@endfor
				</tbody>
			</thead>
		</table>
	</div>
</div>
@end

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="modal-spk">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Pengandaan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
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