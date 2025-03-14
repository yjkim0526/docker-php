<?php
require 'inc/connect.php';
require 'inc/function.php';

session_start();
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != '' ) {
	$user_id = $_SESSION['user_id'];
	$user_name = $_SESSION['user_name'];
} else {
	$user_id = '';
}

?>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="theme-color" content="#712cf9" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link href="signin.css" rel="stylesheet" />
  </head>
  <body class="">

    <main class="form-signin w-100 m-auto">
      <form method="post" action="login_check.php">
				<input type="hidden" name="code" value="free">
        <div class="form-floating">
          <input
            type="text"
            class="form-control"
            id="userid"
						name="userid"
            placeholder="id"
          />
          <label for="userid">User ID</label>
        </div>
        <div class="form-floating mt-2">
          <input
            type="password"
            class="form-control"
            id="userpassword"
						name="userpassword"
            placeholder="Password"
          />
          <label for="userpassword">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-dark">
          로그인
        </button>
				<div class="form-floating mt-2">로그인 테스트 : test / test1234</div>
      </form>

    </main>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
