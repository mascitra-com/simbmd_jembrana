@layout('commons/index')
@section('title')Pengdaan - SP2D@end

@section('breadcrump')
<li class="breadcrumb-item"><a href="{{site_url()}}">Beranda</a></li>
<li class="breadcrumb-item"><a href="{{site_url('pengadaan')}}">Pengadaan</a></li>
<li class="breadcrumb-item active">SP2D</li>
@end

@section('content')
<div class="btn-group mb-3">
	<a href="{{site_url('pengadaan/detail')}}" class="btn btn-primary">Detail SPK</a>
	<a href="{{site_url('pengadaan/sp2d')}}" class="btn btn-primary">SP2D</a>
	<a href="{{site_url('pengadaan/sp2d_penunjang')}}" class="btn btn-primary">SP2D Penunjang</a>
	<a href="{{site_url('pengadaan/rincian')}}" class="btn btn-primary active">Rincian Aset</a>
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
			<div class="card-header">
				<ul class="nav nav-tabs card-header-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#kiba" role="tab">KIB-A</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#kibb" role="tab">KIB-B</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#kibb" role="tab">KIB-C</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#kibb" role="tab">KIB-D</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#kibb" role="tab">KIB-E</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#kibb" role="tab">KIB-G</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#kibb" role="tab">Kapitalisasi</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#kibb" role="tab">KDP</a>
					</li>
				</ul>
			</div>
			<div class="card-body">
			</div>
		</div>
	</div>
</div>
@end