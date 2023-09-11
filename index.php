<?php
session_start();

?>

<head>
	<title>PyIs.Fun</title>
	 <meta charset="UTF-8">
	 <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
</head>
    <script>
		
        function vkLogin() {
            var redirect_uri = 'https://pyis.fun/vk_callback.php';
            var url = 'https://oauth.vk.com/authorize?client_id=51524037&scope=wall&response_type=code&redirect_uri=' + redirect_uri;
			window.location.href = url;
		}
</script>

<body>
<!-- partial:index.partial.html -->
<div class="wrapper">
  <form class="login">
    <p class="title">Авторизация</p>
    <button onclick="vkLogin()">
      <i class="spinner"></i>
      <span class="fa fa-vk"> Login with VK</span>
    </button>
  </form>
  </p>
</div>
<!-- partial -->
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="./script.js"></script>
</body>
</html>