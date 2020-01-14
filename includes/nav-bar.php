<div class="nano">
	<div class="nano-content">
		<nav id="menu" class="nav-main" role="navigation">

			<ul class="nav nav-main">
				<li>
					<a class="nav-link" href="dashboard.php">
						<i class="fa fa-home" aria-hidden="true"></i>
						<span>Dashboard</span>
					</a>
				</li>

				<li class="nav-parent">
					<a class="nav-link" href="#">
						<i class="fas fa-user-lock" aria-hidden="true"></i>
						<span>Profile Details</span>
					</a>
					<ul class="nav nav-children">
						<li>
							<a class="nav-link" href="profile-upd.php">
								<i class="fa fa-pencil-square" aria-hidden="true"></i>
								Update Profile
							</a>
						</li>
						<li>
							<a class="nav-link" href="profile-pic.php">
								<i class="fa fa-pencil-square" aria-hidden="true"></i>
								Profile Picture Update
							</a>
						</li>
						<li>
							<a class="nav-link" href="passwd-upd.php">
								<i class="fas fa-key" aria-hidden="true"></i>
								Change Password
							</a>
						</li>
						<li>
							<a class="nav-link" href="tabs-add.php">
								<i class="fa fa-tags" aria-hidden="true"></i>
								Add New Profile Tab
							</a>
						</li>
						<li>
							<a class="nav-link" href="tabs-view.php">
								<i class="fa fa-eye" aria-hidden="true"></i>
								Tabs View
							</a>
						</li>
					</ul>
				</li>

				<li class="nav-parent">
					<a class="nav-link" href="#">
						<i class="fa fa-calendar" aria-hidden="true"></i>
						<span>Events</span>
					</a>
					<ul class="nav nav-children">
						<li>
							<a class="nav-link" href="event-add.php">
								<i class="fa fa-plus-square" aria-hidden="true"></i>
								Add Event
							</a>
						</li>
						<li>
							<a class="nav-link" href="event-del.php">
								<i class="fa fa-pencil-square" aria-hidden="true"></i>
								View Event
							</a>
						</li>
					</ul>
				</li>

				<li class="nav-parent">
					<a class="nav-link" href="#">
						<i class="fas fa-bookmark" aria-hidden="true"></i>
						<span>Central Facility Booking </span>
					</a>
					<ul class="nav nav-children">
						<li>
							<a class="nav-link" href="cf-booking.php">
								<i class="fa fa-plus-square" aria-hidden="true"></i>
								Book Central Facility
							</a>
						</li>
						<li>
							<a class="nav-link" href="cf-booking-view.php">
								<i class="fa fa-pencil-square" aria-hidden="true"></i>
								View My Bookings
							</a>
						</li>
					</ul>
				</li>

				<?php
				if ($_SESSION['fac_role'] == 0) {
					?>
					<li class="nav-parent">
						<a class="nav-link" href="#">
							<i class="fas fa-calendar-check" aria-hidden="true"></i>
							<span>Approvals</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a class="nav-link" href="event-approvals.php">
									<i class="fa fa-thumbs-up" aria-hidden="true"></i>
									Events Approvals
								</a>
							</li>
						</ul>
					</li>
				<?php } ?>

				<?php
				if ($_SESSION['fac_cf'] == 1) {
					?>
					<li class="nav-parent">
						<a class="nav-link" href="#">
							<i class="fas fa-clipboard-check" aria-hidden="true"></i>
							<span>Central Facility Approvals</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a class="nav-link" href="cf-booking-approvals.php">
									<i class="fa fa-thumbs-up" aria-hidden="true"></i>
									Booking Approvals
								</a>
							</li>
						</ul>
					</li>
				<?php } ?>

				<li class="nav-parent">
					<a class="nav-link" href="#">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
						<span>Class Update</span>
					</a>
					<ul class="nav nav-children">
						<li>
							<a class="nav-link" href="upd-add.php">
								<i class="fa fa-plus-square" aria-hidden="true"></i>
								Add Class Updates
							</a>
						</li>
						<li>
							<a class="nav-link" href="upd-del.php">
								<i class="fas fa-eye" aria-hidden="true"></i>
								View Class Updates
							</a>
						</li>
					</ul>
				</li>

				<li class="nav-parent">
					<a class="nav-link" href="#">
						<i class="fa fa-group" aria-hidden="true"></i>
						<span>Members</span>
					</a>
					<ul class="nav nav-children">
						<li>
							<a class="nav-link" href="member-add.php">
								<i class="fa fa-plus-square" aria-hidden="true"></i>
								Add Member
							</a>
						</li>
						<li>
							<a class="nav-link" href="member-upd.php">
								<i class="fa fa-pencil-square" aria-hidden="true"></i>
								Update Member details
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-parent">
					<a class="nav-link" href="#">
						<i class="fa fa-sticky-note" aria-hidden="true"></i>
						<span>Publications</span>
					</a>
					<ul class="nav nav-children">
						<li>
							<a class="nav-link" href="pub-add.php">
								<i class="fa fa-plus-square" aria-hidden="true"></i>
								Add Publication
							</a>
						</li>
						<li>
							<a class="nav-link" href="pub-del.php">
								<i class="fa fa-minus-square" aria-hidden="true"></i>
								Update/Remove Publication
							</a>
						</li>
						<li>
							<a class="nav-link" href="pub-csv.php">
								<i class="fas fa-file-archive" aria-hidden="true"></i>
								Bulk Import
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-parent">
					<a class="nav-link" href="#">
						<i class="fa fa-copyright" aria-hidden="true"></i>
						<span>Patents</span>
					</a>
					<ul class="nav nav-children">
						<li>
							<a class="nav-link" href="patent-add.php">
								<i class="fa fa-plus-square" aria-hidden="true"></i>
								Add Patents
							</a>
						</li>
						<li>
							<a class="nav-link" href="patent-del.php">
								<i class="fa fa-minus-square" aria-hidden="true"></i>
								Update/Remove Patents
							</a>
						</li>
					</ul>
				</li>
				<?php
				if ($_SESSION['fac_role'] == 0) {
					?>

					<li class="nav-parent">
						<a class="nav-link" href="#">
							<i class="fas fa-project-diagram" aria-hidden="true"></i>
							<span>Projects</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a class="nav-link" href="pro-add.php">
									<i class="fas fa-plus" aria-hidden="true"></i>
									Add Project
								</a>
							</li>
							<li>
								<a class="nav-link" href="pro-del.php">
									<i class="fas fa-eye" aria-hidden="true"></i>
									View Project
								</a>
							</li>
						</ul>
					</li>

					<li class="nav-parent">
						<a class="nav-link" href="#">
							<i class="fab fa-cloudscale" aria-hidden="true"></i>
							<span>Counters</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a class="nav-link" href="upd-counter.php">
									<i class="fas fa-chart-pie" aria-hidden="true"></i>
									Update Counters
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-parent">
						<a class="nav-link" href="#">
							<i class="fas fa-bell" aria-hidden="true"></i>
							<span>News</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a class="nav-link" href="news-add.php">
									<i class="fa fa-plus-square" aria-hidden="true"></i>
									Add News
								</a>
							</li>
							<li>
								<a class="nav-link" href="news-del.php">
									<i class="fas fa-eye" aria-hidden="true"></i>
									View News
								</a>
							</li>
						</ul>
					</li>

					<li class="nav-parent">
						<a class="nav-link" href="#">
							<i class="fas fa-user" aria-hidden="true"></i>
							<span>Faculty</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a class="nav-link" href="fac-add.php">
									<i class="fas fa-plus" aria-hidden="true"></i>
									Add Faculty
								</a>
							</li>
							<li>
								<a class="nav-link" href="fac-view.php">
									<i class="fas fa-eye" aria-hidden="true"></i>
									View Faculty
								</a>
							</li>

						</ul>
					</li>

					<li>
						<a class="nav-link" href="sto-add.php">
							<i class="fas fa-user-cog" aria-hidden="true"></i>
							<span>Senior Technichal Officer</span>
						</a>
					</li>


					<li class="nav-parent">
						<a class="nav-link" href="#">
							<i class="fas fa-bullhorn" aria-hidden="true"></i>
							<span>Circulars</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a class="nav-link" href="cir-add.php">
									<i class="fa fa-plus-square" aria-hidden="true"></i>
									Add Circulars
								</a>
							</li>
							<li>
								<a class="nav-link" href="cir-del.php">
									<i class="fas fa-eye" aria-hidden="true"></i>
									View Circulars
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a class="nav-link" href="cf-upd.php">
							<i class="fa fa-pencil-square"></i>
							<span>Update Central Facilities incharge</span>
						</a>
					</li>
					<li>
						<a class="nav-link" href="compose.php">
							<i class="fas fa-envelope-square"></i>
							<span>Compose Mail</span>
						</a>
					</li>

					<?php
					if ($_SESSION['fac_role'] == 0 || $_SESSION['fac_role'] == 1) {
						?>
						<li>
							<a class="nav-link" href="alumni.php">
								<i class="fas fa-user-clock"></i>
								<span>Alumni</span>
							</a>
						</li>

					<?php } ?>

				<?php } ?>
				<?php
				if ($_SESSION['fac_role'] == 1) {
					?>
					<li class="nav-parent">
						<a class="nav-link" href="#">
							<i class="fas fa-university" aria-hidden="true"></i>
							<span>Department Updates</span>
						</a>
						<ul class="nav nav-children">
							<li>
								<a class="nav-link" href="department.php">
									<i class="fa fa-eye" aria-hidden="true"></i>
									Department Details Update
								</a>
							</li>
							<li>
								<a class="nav-link" href="timetable.php">
									<i class="fas fa-eye" aria-hidden="true"></i>
									Update Timetables
								</a>
							</li>
						</ul>
					</li>
				<?php } ?>
				<?php
				$cf_q = "SELECT `cf_id`, `cf_name`, `cf_disc`, `fac_id` from `cf` where fac_id=" . $_SESSION['fac_id'];
				$cf_q = mysqli_query($conn, $cf_q);
				if (mysqli_num_rows($cf_q) > 0) {
					?>
					<li>
						<a class="nav-link" href="cf.php">
							<i class="fa fa-university" aria-hidden="true"></i>
							<span>Central Facilities Update</span>
						</a>
					</li>
				<?php } ?>
				<li>
					<a class="nav-link" href="bug-report.php">
						<i class="fas fa-bug"></i>
						<span>Bug Report</span>
					</a>
				</li>
				<li>
					<a class="nav-link" href="<?php echo $_SERVER['PHP_SELF'] . "?lo"; ?>">
						<i class="fa fa-power-off" aria-hidden="true"></i>
						<span>LogOut</span>
					</a>
				</li>
			</ul>
		</nav>
	</div>
</div>