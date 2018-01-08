<div id="sidebar">
	<div class="wrapper">
		<div class="title">
			<h3 class="mb-0 text-bolder">SIMBMD</h3>
			<span>Jembrana</span>
		</div>
		<ul class="sidebar-nav">
			<li class="nav nav-title">UTAMA</li>
			<li class="nav nav-dashboard"><a href="{{site_url()}}"><i class="fa fa-dashboard fa-fw icon"></i>Beranda</a></li>
			<li class="nav nav-profil"><a href="{{site_url('profil')}}"><i class="fa fa-user fa-fw icon"></i>Profil</a></li>

			<li class="nav nav-title">INVENTARIS</li>
			<li class="nav nav-pengadaan"><a href="{{site_url('aset/kiba')}}"><i class="fa fa-cube fa-fw icon"></i>Aset Tanah</a></li>
			<li class="nav nav-pengadaan"><a href="{{site_url('aset/kiba/maps')}}" target="blank"><i class="fa fa-cube fa-fw icon"></i>Maps</a></li>

			<li class="nav nav-title">LAPORAN</li>
			<li class="nav nav-report1"><a href="{{site_url('report/rekap_aset')}}"><i class="fa fa-file-o fa-fw icon"></i>Rekapitulasi Aset Tetap</a></li>

			@if($this->session->auth['is_superadmin'] == 1)
			<li class="nav nav-title">KAMUS</li>
			<li class="nav nav-organisasi"><a href="{{site_url('organisasi')}}"><i class="fa fa-briefcase fa-fw icon"></i>Organisasi</a></li>
			<li class="nav nav-kategori"><a href="{{site_url('kategori')}}"><i class="fa fa-tag fa-fw icon"></i>Kategori</a></li>
			<li class="nav nav-pegawai"><a href="{{site_url('pegawai')}}"><i class="fa fa-users fa-fw icon"></i>Pegawai</a></li>

			<li class="nav nav-title">IMPORT DATA</li>
			<li class="nav nav-backup">
				<a href="#menu-backup" data-toggle="collapse"><i class="fa fa-user fa-fw icon"></i>Manajemen Data<i class="fa fa-angle-down ml-auto"></i></a>
				<ul class="sidebar-nav sidebar-child collapse collapseable" id="menu-backup">
					<li class="nav"><a href="{{site_url('backup/import')}}"><i class="fa fa-download fa-fw icon"></i>Import Saldo Awal</a></li>
				</ul>
			</li>
			@endif
		</ul>
	</div>
</div>