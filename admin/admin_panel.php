<?php
session_start();
// echo $t_email = $_SESSION["uname"];
if (!isset($_SESSION["user_name"])) {
  header("Location: ../admin/login.php");
  exit();
}

$page_title = "Admin Panel";
include('../templates/header.php');
?> 	

<div id="contentArea">

			<main class="content sdl_home">
				<div class="container-fluid p-0">
					<h1 class="h3 mb-3 fw-bold"> Dashboard</h1>
					<div class="row">
						<div class="col-xl-6 col-xxl-5 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total Students</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle fa-solid fa-graduation-cap" data-feather="truck"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">975</h1>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total Teachers</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle fa-solid fa-person-chalkboard" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h2 class="mt-1 mb-3">45</h2>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total Employee</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle fa-solid fa-users-gear" data-feather="dollar-sign"></i>
														</div>
													</div>
												</div>
												<h2 class="mt-1 mb-3">80</h2>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total Earnings</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle fa-solid fa-sack-dollar" data-feather="shopping-cart"></i>
														</div>
													</div>
												</div>
												<h2 class="mt-1 mb-3">64</h2>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0">Calendar</h5>
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="chart">
											<div id="datetimepicker-dashboard"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
			<?php include('../templates/footer.php'); ?>    <!-- FOOTER include from (footer.php) page -->
		