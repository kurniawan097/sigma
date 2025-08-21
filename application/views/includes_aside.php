<aside id="sidebar-left" class="sidebar-left">
	<input type="hidden" name="token" value="<?= $this->security->get_csrf_hash() ?>">
	<div class="nano">
		<div class="nano-content">
			<nav id="menu" class="nav-main" role="navigation">
				<ul class="nav nav-main">


						<li class="nav-group-label">Main Menu</li>

						<li class="<?= in_array($page_name, ['dashboard']) ? 'nav-active' : '' ?>">
							<a class="nav-link" href="<?= base_url('Dashboard') ?>">
								<i class="fas fa-tachometer-alt" aria-hidden="true"></i>
								<span>Dashboard</span>
							</a>
						</li>

						<li class="<?= $page_name == 'barang/v_kategori_barang' ? 'nav-active' : '' ?>">
							<a class="nav-link" href="<?= base_url('barang/show/kategori') ?>">
								<i class="fas fa-box" aria-hidden="true"></i>
								<span>Kategori Barang</span>
							</a>
						</li>

						<li class="<?= $page_name == 'barang/v_barang' ? 'nav-active' : '' ?>">
							<a class="nav-link" href="<?= base_url('barang/show/barang') ?>">
								<i class="fas fa-cubes" aria-hidden="true"></i>
								<span>Data Barang</span>
							</a>
						</li>

						<li class="<?= $page_name == 'barang/v_pembelian' ? 'nav-active' : '' ?>">
							<a class="nav-link" href="<?= base_url('barang/show/pembelian') ?>">
								<i class="fas fa-shopping-cart" aria-hidden="true"></i>
								<span>Pembelian</span>
							</a>
						</li>

						<li class="<?= $page_name == 'barang/v_penjualan' ? 'nav-active' : '' ?>">
							<a class="nav-link" href="<?= base_url('barang/show/penjualan') ?>">
								<i class="fas fa-shopping-basket" aria-hidden="true"></i>
								<span>Penjualan</span>
							</a>
						</li>

					
			    

					<li class="nav-group-label">Lain Lain</li>
					<?php if (isAdmin()) { ?>
						<li class="<?= $page_name == 'log' || $this->uri->segment(1) == 'log' ? 'nav-active' : '' ?>">
							<a class="nav-link" href="<?= base_url('log') ?>">
								<i class="fas fa-list-alt " aria-hidden="true"></i>
								<span>Log Aktivitas</span>
							</a>
						</li>
					<?php } ?>
					<li>
						<a class="nav-link text-danger" href="<?= base_url('auth/logout') ?>">
							<i class="fas fa-sign-out-alt text-danger" aria-hidden="true"></i>
							<span>Logout</span>
						</a>
					</li>
				</ul>
			</nav>

		</div>
	</div>
</aside>

<script>
    document.getElementById("switch_menu").onchange = function() {
        if (this.value!=="") {
            window.location.href = this.value;
        }        
    };
</script>