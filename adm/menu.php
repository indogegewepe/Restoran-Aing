<?php
require '../function.php';
require '../cekSesiLogin.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />

	<title>Menu</title>

	<!-- Custom fonts for this template-->
	<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

	<!-- Data Table -->
	<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
	<link href="cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous" />

	<!-- Custom styles for this template-->
	<link href="../css/sb-admin-2.min.css" rel="stylesheet" />

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">

</head>

<body id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper">
		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
				<div class="sidebar-brand-icon">
					<i class="fas fa-id-card"></i>
				</div>
				<div class="sidebar-brand-text mx-3"><?php echo $_SESSION["jenisPegawai"] ?></div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider my-0" />

			<!-- Nav Item - Dashboard -->
			<li class="nav-item">
				<a class="nav-link" href="index.php">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span></a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider" />

			<!-- Nav Item - Menu -->
			<li class="nav-item active">
				<a class="nav-link" href="menu.php">
					<i class="fas fa-utensils"></i>
					<span>Menu</span></a>
			</li>

			<!-- Nav Item - Pegawai -->
			<li class="nav-item">
				<a class="nav-link" href="pegawai.php">
					<i class="fas fa-user"></i>
					<span>Pegawai</span></a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider d-none d-md-block" />

			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>
		</ul>
		<!-- End of Sidebar -->

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">
			<!-- Main Content -->
			<div id="content">
				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
					<!-- Toggler Sidebar -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>
					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">
						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow show">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['name']; ?></span>
								<img class="img-profile rounded-circle" src="../img/undraw_profile_2.svg" />
							</a>
							<!-- Dropdown - User Information -->
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Logout
								</a>
							</div>
						</li>
					</ul>
				</nav>
				<!-- End of Topbar -->

				<!-- Begin Page Content -->
				<div class="container-fluid">
					<!-- Page Heading -->
					<h1 class="h3 mb-2 text-gray-800">Tabel Menu</h1>
					<p class="mb-4">Admin dapat mengedit keseluruhan menu</p>

					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Tabel Menu</h6>
						</div>

						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>Nama Menu</th>
											<th>Harga</th>
											<th>Kategori</th>
											<th>Ketersediaan</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$makanan = mysqli_query($conn, "SELECT * FROM menu");
										while ($row = mysqli_fetch_array($makanan)) {
										?>
											<tr>
												<td><?php echo $row['nama_menu'] ?></td>
												<td><?php echo "Rp. " . number_format($row['harga']) ?></td>
												<td><?php echo $row['kategori'] ?></td>
												<td>
													<?php if ($row['ketersediaan'] == 'ada') { ?>
														<div class="custom-control custom-checkbox small">
															<input class="custom-control-input" type="checkbox" id="stok1" name="stok1" value="1" checked onclick="return false">
															<label class="custom-control-label" for="stok1">Stok</label>
														</div>
													<?php } else { ?>
														<div class="custom-control custom-checkbox small">
															<input class="custom-control-input" type="checkbox" id="stok2" name="stok2" value="1" onclick="return false">
															<label class="custom-control-label" for="stok2">Stok</label>
														</div>
													<?php } ?>
												</td>
												<td>
													<a type="button" href="editMenu.php?id=<?php echo $row['id_menu'] ?>" class="btn btn-info btn-icon-split">
														<span class="icon text-white">
															<i class="fas fa-pen"></i>
														</span>
													</a>
													<a type="button" href="javascript:remove('hapusMenu.php?id=<?php echo $row['id_menu'] ?>')" class="btn btn-danger btn-icon-split">
														<span class="icon text-white">
															<i class="fas fa-times"></i>
														</span>
													</a>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<button type="button" data-toggle="modal" data-target="#ModalMenu" class="btn btn-primary btn-icon-split">
								<span class="icon text-white">
									<i class="fas fa-plus"></i>
								</span>
								<span class="text">Add Menu</span>
							</button>
						</div>
					</div>
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- End of Main Content -->

			<!-- Footer -->
			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright &copy; Basis Data 2021</span>
					</div>
				</div>
			</footer>
			<!-- End of Footer -->
		</div>
		<!-- End of Content Wrapper -->
	</div>
	<!-- End of Page Wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<!-- Masukin menu baru -->
	<div class="modal fade" id="ModalMenu" tabindex="-1" role="dialog" aria-labelledby="ModalMenu" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="ModalLongTitle">Add Menu</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form class="user" method="POST" action="../function.php">
						<div class="form-group">
							<input type="text" name="nama" class="form-control" placeholder="Nama" required>
						</div>
						<div class="form-group">
							<input type="number" name="harga" class="form-control" placeholder="Harga" required>
						</div>
						<div class="text-center my-3">
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="kategori" id="makanan" value="Makanan" required>
								<label class="form-check-label" for="makanan">Makanan</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="kategori" id="minuman" value="Minuman">
								<label class="form-check-label" for="minuman">Minuman</label>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
							<button type="submit" name="insertMenu" class="btn btn-primary">Save changes</button>
						</div>
				</div>
				</form>
			</div>
		</div>
	</div>
	</div>

	<!-- Edit menu baru -->
	<?php while ($row = mysqli_fetch_array($makanan)) { ?>
		<div class="modal fade" id="ModalMenu<?php echo $row['id_menu'] ?>" tabindex="-1" role="dialog" aria-labelledby="ModalMenu" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="ModalLongTitle">Edit Menu <?php echo $row['nama_menu'] ?></h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form class="user" method="POST" action="">
							<div class="form-group">
								<input class="form-control" type="text" placeholder="<?php echo $row['id_menu'] ?>" readonly>
							</div>
							<div class="form-group">
								<input type="text" name="nama" class="form-control" placeholder="<?php echo $row['nama_menu'] ?>" required>
							</div>
							<div class="form-group">
								<input type="number" name="harga" class="form-control" placeholder="<?php echo $row['harga'] ?>" required>
							</div>
							<div class="text-center my-3">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="jenisPegawai" id="makanan" value="Makanan" required>
									<label class="form-check-label" for="makanan">Makanan</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="jenisPegawai" id="minuman" value="Minuman">
									<label class="form-check-label" for="minuman">Minuman</label>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
								<button type="submit" name="submit" class="btn btn-primary">Save changes</button>
							</div>
					</div>
					</form>
					<?php
					if (isset($_POST["submit"])) {
						$nama = htmlspecialchars($_POST['nama']);
						$harga = htmlspecialchars($_POST['harga']);
						$kategori = htmlspecialchars($_POST['Kategori']);

						$query = "INSERT INTO menu VALUES('',$nama,$harga,$kategori,'ada')";

						mysqli_query($conn, $query);
					}
					?>
				</div>
			</div>
		</div>
		</div>
	<?php } ?>

	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a class="btn btn-primary" href="../logout.php">Logout</a>
				</div>
			</div>
		</div>
	</div>

	<!-- js  -->
	<script>
		function remove(URL) {
			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.value) {
					window.location.href = URL
				}
			})
		}
	</script>


	<!-- Bootstrap core JavaScript-->
	<script src="../vendor/jquery/jquery.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="../js/sb-admin-2.min.js"></script>

	<!-- Page level plugins -->
	<script src="../vendor/chart.js/Chart.min.js"></script>

	<!-- Page level custom scripts -->
	<script src="../js/demo/chart-area-demo.js"></script>
	<script src="../js/demo/chart-pie-demo.js"></script>
	<script src="../js/demo/chart-bar-demo.js"></script>

	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
	<script src="../js/demo/datatables-demo.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

</body>

</html>