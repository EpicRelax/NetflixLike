<?php
session_start();
require_once("../Controller/UserController.php");
$userController = new UserController;
$login = $userController->login($_POST,$_SESSION);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- LIEN BOOTSWATCH  -->
    <link rel="stylesheet" href="https://bootswatch.com/5/cyborg/bootstrap.min.css">
    <!--  LIEN CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <section id="connect">
        <div class="container">
            <form action="" method="POST">
                <!-- LOGIN OR EMAIL -->
                <div class="form-group">
                    <label class="col-form-label mt-4" for="inputDefault">Login or Email</label>
                    <input type="text" class="form-control" placeholder="Entrez votre pseudo ou votre email" name="login"
                    value="<?= isset($userController->post['login']) ? $userController->post['login'] : "" ?>">
                    <?= isset($userController->errors['login']) ? '<span>' . $userController->errors['login'] . '</span>' : "" ?>
                </div>
                <!-- PASSWORD -->
                <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Entrez votre mot de passe" name="pwd"
                    value="<?= isset($userController->post['pwd']) ? $userController->post['pwd'] : "" ?>">
                    <?= isset($userController->errors['pwd']) ? '<span>' . $userController->errors['pwd'] . '</span>' : "" ?>
                </div>
                <br><br>
                <input type="submit" class="btn btn-danger" name="submited" value="S'identifier">
            </form>
        </div>
    </section>
</body>

</html>