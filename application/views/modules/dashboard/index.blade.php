@layout('commons/index')
@section('title')Beranda@end

@section('breadcrump')
<li class="breadcrumb-item"><a href="{{site_url()}}">Beranda</a></li>
<li class="breadcrumb-item active">Dashboard</li>
@end

@section('content')
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Selamat Datang</h4>
				<p class="card-text"><p>SIMBMD Online adalah kepanjangan dari Sistem Informasi Manajemen Barang Milik Daerah berbasis Online</p>

<p> Sistem Informasi Aset Tanah </br>			
 Spesifikasi : 			</br>
 1 	Sistem berbasis web ( Open Source )</br>		
 2 	Menggunakan Database MySql atau lainnya	</br>	
 3 	Dapat menampilkan informasi/data tanah meliputi : Nama Instansi, data pejabat, detail data tanah sesuai kib A, letak tanah berdasarkan koordinat, foto lokasi dan gambar pendukung.		</br>
 4 	Terhubung dengan map online		</br>
 5 	Tersedia form input data		</br>
 6 	Tersedia menu export import data	</br>	
 7 	Tersedia berbagai type user		</br>
 8 	Instalasi		</br>
 9 	Buku Panduan		</br>
</p>
                <img src="http://simbmd-jembrana.mascitra.com/res/images/logo.png"
                             alt="Logo Kabupaten Jembrana" class="img-responsive" width="200px"></br></br>
                <p>Badan Pengelolaan Keuangan dan Aset Daerah (BPKAD) </br>Pemerintah Kabupaten Jembrana</br>Jalan Mayor Sugianyar No. 19 Negara - Bali - Indonesia</p>
                </p>
                <p>© Copyright 2017 Badan Pengelolaan Keuangan dan Aset Daerah Pemerintah Kabupaten Jembrana. Powered by <a href="https://mascitra.com">mascitra.com</a></p>
			</div>
		</div>
	</div>
</div>
@end

@section('script')
<script>theme.activeMenu('.nav-dashboard')</script>
@end
