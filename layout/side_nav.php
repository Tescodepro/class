<div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">
                    <li><a href="dashboard.php"  aria-expanded="false">
							<i class="flaticon-025-dashboard"></i>
							<span class="nav-text">Dashboard</span>
						</a>
                    </li>
					<?php if(!isset($_SESSION['role'])){ ?>
                    <li><a href="profile.php"  aria-expanded="false">
						<i class="fa fa-user"></i>
							<span class="nav-text">Profile</span>
						</a>
                    </li>
					<?php } ?>
                </ul>
			</div>
        </div>