@layout('commons/index')
@section('title')SPK/Kontrak@end

@section('breadcrump')
<li class="breadcrumb-item"><a href="{{site_url()}}">Beranda</a></li>
<li class="breadcrumb-item active">SPK/SP/Kontrak</li>
@end

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header form-inline">
				<form class="mr-auto" action="{{site_url('spk')}}" method="GET">
					<div class="input-group">
						<select name="id_organisasi" class="form-control select-chosen" data-placeholder="Pilih UPB">
							<option></option>
							@foreach($organisasi AS $org)
							<option value="{{$org->id}}" {{isset($id) && $org->id === $id ? 'selected' : ''}}>{{$org->nama}}</option>
							@endforeach
						</select>
						<div class="input-group-btn">
							<button class="btn btn-primary"><i class="fa fa-check mr-2"></i>Pilih</button>
						</div>
					</div>
				</form>
				<div class="btn-group">
					<button class="btn btn-primary btn-refresh"><i class="fa fa-refresh mr-2"></i>Segarkan</button>
					<a href="{{site_url('spk/add/'.$filter['id_organisasi'])}}" class="btn btn-primary"><i class="fa fa-plus mr-2"></i>Tambah</a>
				</div>
			</div>
			<div class="card-body px-0 py-0">
				<table class="table table-striped table-hover table-sm">
					<thead>
						<tr>
							<td colspan="11">
								<form class="mr-3" action="{{site_url('spk')}}" method="GET">
									<input type="hidden" name="id_organisasi" value="{{$filter['id_organisasi']}}">
									<div class="input-group">
										<input type="text" name="q" class="form-control" value="{{isset($filter['q'])?$filter['q']:''}}" placeholder="Cari cepat">
										<div class="input-group-btn">
											<button class="btn btn-primary"><i class="fa fa-search mr-2"></i></button>
										</div>
									</div>
								</form>
							</td>
						</tr>
						<tr>
							<th class="text-center">Nomor</th>
							<th>Tanggal</th>
							<th>Uraian Pekerjaan</th>
							<th>Nama Rekanan</th>
							<th>Alamat Rekanan</th>
							<th>Nilai</th>
							<th class="text-center">Addendum</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@if(empty($spk))
						<tr><td colspan="11" class="text-center">Tidak ada data</td></tr>
						@endif

						@foreach($spk AS $item)
						<tr>
							<td class="text-center">{{$item->nomor}}</td>
							<td>{{date('d/m/y', strtotime($item->tanggal))}}</td>
							<td>{{$item->uraian_pekerjaan}}</td>
							<td>{{$item->nama_rekanan}}</td>
							<td>{{$item->alamat_rekanan}}</td>
							<td>{{monefy($item->nilai)}}</td>
							<td class="text-center"><button class="btn btn-sm btn-primary btn-block" data-id="{{$item->id}}">lihat</button></td>
							<td>
								<div class="btn-group btn-group-sm">
									<a href="{{site_url('spk/edit/'.$item->id)}}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
									<a href="{{site_url('spk/delete/'.$item->id)}}" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="fa fa-trash"></i></a>
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@end

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="modal-addendum">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Addendum</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Nomor SPK/SP/Kontrak</label>
					<input type="text" name="nomor" class="form-control" readonly />
				</div>
				<div class="form-group">
					<label>Tanggal SPK/SP/Kontrak</label>
					<input type="text" name="tanggal" class="form-control" readonly />
				</div>
				<div class="form-group">
					<label>Uraian Pekerjaan</label>
					<input type="text" name="uraian" class="form-control" readonly />
				</div>
				<div class="form-group">
					<label>Nilai</label>
					<input type="text" name="nilai" class="form-control" readonly />
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-warning" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
@end

@section('script')
<script type="text/javascript">
	var spk = (function(){
		theme.activeMenu('.nav-spk');

		$("[data-id]").on("click", eventAddendum);
		function eventAddendum(e) {
			var id = $(e.currentTarget).data('id');
			$.getJSON("{{site_url('spk/get/')}}"+id, function(result){
				$("#modal-addendum [name=nomor]").val(result.addendum_nomor);
				$("#modal-addendum [name=tanggal]").val(result.addendum_tanggal);
				$("#modal-addendum [name=uraian]").val(result.addendum_uraian_pekerjaan);
				$("#modal-addendum [name=nilai]").val(result.addendum_nilai);
				$("#modal-addendum").modal('show');
			});
		}
	})();
</script>
@end