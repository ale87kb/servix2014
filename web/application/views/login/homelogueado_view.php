<!--Prueba para ver si el usuario iniciaba secion-->

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <title>Login en Servix - Mi perfil</title>
</head>
<body>
   <h1>Servix</h1>
   <h2>Bienvenido <?php echo $usuario; ?>!</h2>
   <a href="<?php echo site_url('logout');?>">Logout</a>
</body>
</html>