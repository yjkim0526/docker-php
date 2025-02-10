<header class="p-3 text-bg-dark rounded-1">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="#" class="nav-link px-2 text-white">Full Stack Developer YJ</a></li>
        </ul>

        <div class="text-end">
					<?php if ($user_id != ""){ ?>
						<span class="text-white me-2">Welcome, <?=$user_name?>님</span>
						<button type="button" class="btn btn-outline-light me-2" id="logout-btn" onclick="location.href='logout.php'">Logout</button>
					<?php }else{ ?>
						<button type="button" class="btn btn-outline-light me-2" id="logout-btn" onclick="location.href='login.php'">Login</button>
					<?php } ?>
         
        </div>
      </div>
    </div>
  </header>