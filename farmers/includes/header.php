	<script src="js/custom.js"></script>

	<header class="header">
	    <div class="logo-container">
	        <a href="dashboard.php" class="logo">
	            <img src="img/logo.png" width="130" height="40" alt="Porto Admin" />
	        </a>
	        <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
	            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
	        </div>
	    </div>
	    <?php
        if (!isset($_SESSION['farmer_id']) || isset($_GET['lo'])) {
            session_destroy();
            header('Location: index.php');
        }
        $fac = "SELECT `fac_name`, `fac_designation`, `fac_qualification`,`dept_id` FROM `faculty` WHERE fac_id=" . $_SESSION['fac_id'];
        $fac = mysqli_query($conn, $fac);
        $fac = mysqli_fetch_assoc($fac);
        ?>
	    <!-- start: search & user box -->
	    <div class="header-right">
	        <span class="separator"></span>
	        <div id="userbox" class="userbox">
	            <a href="#" data-toggle="dropdown">
	                <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
	                    <span class="name"><?php echo $_SESSION['farmer_id']; ?></span>
	                    <span class="role"><?php echo $_SESSION['farmer_name']; ?></span>
	                </div>

	                <i class="fa custom-caret"></i>
	            </a>

	            <div class="dropdown-menu">
	                <ul class="list-unstyled mb-2">
	                    <li class="divider"></li>
	                    <li>
	                        <a role="menuitem" tabindex="-1" href="../fac_details.php?fac_id=<?php echo $_SESSION['fac_id']; ?>" target='_blank'><i class="fas fa-user"></i> My Profile</a>
	                    </li>
	                    <li>
	                        <a role="menuitem" tabindex="-1" href="<?php echo $_SERVER['PHP_SELF'] . "?lo"; ?>"><i class="fas fa-power-off"></i> Logout</a>
	                    </li>
	                </ul>
	            </div>
	        </div>
	    </div>
	    <script>

	    </script>
	    <!-- end: search & user box -->
	</header>