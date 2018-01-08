@layout('commons/index')
@section('title')SPK@end

@section('breadcrump')
<li class="breadcrumb-item"><a href="{{site_url()}}">Beranda</a></li>
<li class="breadcrumb-item"><a href="{{site_url('spk')}}">SPK/SP/Kontrak</a></li>
<li class="breadcrumb-item active">{{isset($spk) ? 'Sunting' : 'Tambah'}}</li>
@end

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">{{isset($spk) ? 'Sunting' : 'Tambah'}} SPK/SP/Kontrak</div>
			<div class="card-body">
				<form action="{{isset($spk) ? site_url('spk/update') : site_url('spk/insert')}}" method="POST">
					
					<input type="hidden" name="id" value="{{isset($spk) ? $spk->id : ''}}">
					<input type="hidden" name="id_organisasi" value="{{$organisasi->id}}">
					
					<div class="form-group row">
						<label class="col-md-3 col-form-label text-right">Organisasi</label>
						<div class="col-md-4">
							<input type="text" class="form-control" value="{{$organisasi->nama}}" readonly/>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 col-form-label text-right">Kegiatan</label>
						<div class="col-md-4">
							<select name="id_kegiatan" class="form-control">
								<option value="">Pilih Kegiatan. . .</option>
								@foreach($kegiatan AS $keg)
								<option value="{{$keg->id}}" {{isset($spk) && $keg->id===$spk->id_kegiatan?'selected':''}}>{{$keg->kode.' - '.$keg->nama}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 col-form-label text-right">Nomor SPK/SP/Kontrak</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="nomor" placeholder="Kode SPK/SP/Kontrak" value="{{isset($spk) ? $spk->nomor : ''}}" required/>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 col-form-label text-right">Tanggal SPK/SP/Kontrak</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="tanggal" placeholder="Tanggal SPK/SP/Kontrak" value="{{isset($spk) ? $spk->tanggal : ''}}" required/>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 col-form-label text-right">Uraian Pekerjaan</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="uraian_pekerjaan" placeholder="Uraian Pekerjaan" value="{{isset($spk) ? $spk->uraian_pekerjaan : ''}}"/>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 col-form-label text-right">Nama Rekanan</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="nama_rekanan" placeholder="Nama Rekanan" value="{{isset($spk) ? $spk->nama_rekanan : ''}}"/>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 col-form-label text-right">Alamat Rekanan</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="alamat_rekanan" placeholder="Alamat Rekanan" value="{{isset($spk) ? $spk->alamat_rekanan : ''}}"/>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 col-form-label text-right">Nilai</label>
						<div class="col-md-4">
							<input type="number" class="form-control" name="nilai" placeholder="Nilai" value="{{isset($spk) ? $spk->nilai : ''}}"/>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 col-form-label text-right">Addendum</label>
						<div class="col-md-4">
							<div class="form-check form-check-inline">
								<label class="form-check-label">
									<input class="form-check-input" type="radio" name="adde" value="0" checked> Tidak ada perubahan
								</label>
							</div>
							<div class="form-check form-check-inline">
								<label class="form-check-label">
									<input class="form-check-input" type="radio" name="adde" value="1"> Ada perubahan
								</label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 col-form-label text-right">Nomor SPK/SP/Kontrak</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="addendum_nomor" placeholder="Kode SPK/SP/Kontrak" value="{{isset($spk) ? $spk->addendum_nomor : ''}}" readonly />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 col-form-label text-right">Tanggal SPK/SP/Kontrak</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="addendum_tanggal" placeholder="Tanggal SPK/SP/Kontrak" value="{{isset($spk) ? $spk->addendum_tanggal : ''}}" readonly />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 col-form-label text-right">Uraian Pekerjaan</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="addendum_uraian_pekerjaan" placeholder="Uraian Pekerjaan" value="{{isset($spk) ? $spk->addendum_uraian_pekerjaan : ''}}" readonly />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 col-form-label text-right">Nilai</label>
						<div class="col-md-4">
							<input type="number" class="form-control" name="addendum_nilai" placeholder="Nilai" value="{{isset($spk) ? $spk->addendum_nilai : ''}}" readonly />
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-3 col-form-label"></label>
						<div class="col-md-4">
							<button class="btn btn-primary"><i class="fa fa-save mr-2"></i>Simpan</button>
							<a href="{{site_url('spk')}}" class="btn btn-warning"><i class="fa fa-arrow-left mr-2"></i>Kembali</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@end

@section('script')
<script type="text/javascript">
	var spk = (function(){
		theme.activeMenu('.nav-spk');
		$("[name=adde]").click(function(){
			if ($(this).val() == 0) {
				$("input[name*=addendum]").val('').attr('readonly', 'true');
			} else {
				$("input[name*=addendum]").removeAttr('readonly');
			}
		});
	})();
</script>
@end