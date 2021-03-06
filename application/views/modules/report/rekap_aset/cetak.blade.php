<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Rekapitulasi Aset Tetap</title>
	<link rel="stylesheet" href="{{base_url('res/plugins/bootstrap/css/bootstrap.min.css')}}">
	<style type="text/css">
		.container{
			margin: 0;
		}

		.header{font-size: .8em}
		.bold{font-weight: bold;}
		.small{font-size: .8em;}
		.title{
			width: 100%;
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="header">
			<table>
				<tr><td class="bold">PROVONSI</td><td>:</td><td>JAWA TIMUR</td></tr>
				<tr><td class="bold">KABUPATEN</td><td>:</td><td>JEMBRANA</td></tr>
				<tr><td class="bold">UPB</td><td>:</td><td>{{ $detail['upb'] }}</td></tr>
			</table>
		</div>
		<div class="title bold mt-4">
			REKAPITULASI ASET TETAP PER {{($detail['jenis']==1)?'JENIS':(($detail['jenis']==2)?'OBJEK':'RINCIAN OBJEK')}}
			<br>
			{{$detail['header']}}
		</div>
		<div class="mt-3">
			<table class="table table-bordered table-sm">
				<thead>
					<tr>
						<th>KODE</th>
						<th>URAIAN</th>
						<th class="text-center">JUMLAH</th>
						<th class="text-right">NILAI (Rp.)</th>
					</tr>
				</thead>
				<tbody>
					<?php $jumlah = 0;?>
					@foreach($rekap AS $rek)
					<tr>
						<td class="{{($detail['jenis']>1)?'bold':''}}">01.03.{{zerofy($rek->kd_golongan)}}</td>
						<td class="{{($detail['jenis']>1)?'bold':''}}">{{$rek->kategori}}</td>
						<td class="text-center">{{monefy($rek->jumlah_aset)}}</td>
						<td class="text-right {{($detail['jenis']>1)?'bold':''}}">{{monefy($rek->jumlah_nilai)}}</td>
						<?php $jumlah += $rek->jumlah_nilai; ?>
					</tr>
					@if($detail['jenis'] > 1)
					@foreach($rek->detail AS $rek2)
					<tr>
						<td class="{{($detail['jenis']>2)?'bold':''}}">01.03.{{zerofy($rek2->kd_golongan)}}.{{zerofy($rek2->kd_bidang)}}</td>
						<td class="{{($detail['jenis']>2)?'bold':''}}">{{$rek2->kategori}}</td>
						<td class="text-center">{{monefy($rek2->jumlah_aset)}}</td>
						<td class="text-right {{($detail['jenis']>2)?'bold':''}}">{{monefy($rek2->jumlah_nilai)}}</td>
					</tr>
					@if($detail['jenis'] > 2)
					@foreach($rek2->detail AS $rek3)
					<tr>
						<td>01.03.{{zerofy($rek3->kd_golongan)}}.{{zerofy($rek3->kd_bidang)}}</td>
						<td>{{$rek3->kategori}}</td>
						<td class="text-center">{{monefy($rek3->jumlah_aset)}}</td>
						<td class="text-right">{{monefy($rek3->jumlah_nilai)}}</td>
					</tr>
					@endforeach
					@endif
					@endforeach
					@endif
					@endforeach
					<tr>
						<td colspan="3" class="text-center bold">TOTAL</td>
						<td class="text-right bold">{{monefy($jumlah)}}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="mt-3">
			<table style="width: 100%">
				<tr>
					<td class="text-center small" width="50%"></td>
					<td class="text-center small" width="50%">{{$detail['nama_kota']}}, {{datify($detail['tanggal'],'d/m/Y')}}</td>
				</tr>
				<tr>
					<td class="text-center small">Mengetahui</td>
					<td class="text-center small">Yang Melaporkan</td>
				</tr>
				<tr>
					<td class="text-center small">{{strtoupper($detail['mengetahui_jabatan'])}}</td>
					<td class="text-center small">{{strtoupper($detail['lapor_jabatan'])}}</td>
				</tr>
				<tr>
					<td class="py-4"></td>
					<td class="py-4"></td>
				</tr>
				<tr>
					<td class="text-center small">{{strtoupper($detail['mengetahui_nama'])}}</td>
					<td class="text-center small">{{strtoupper($detail['lapor_nama'])}}</td>
				</tr>
				<tr>
					<td class="text-center small">{{strtoupper($detail['mengetahui_nip'])}}</td>
					<td class="text-center small">{{strtoupper($detail['lapor_nip'])}}</td>
				</tr>
			</table>
		</div>
	</div>
	<script>
		window.print();
	</script>
</body>
</html>