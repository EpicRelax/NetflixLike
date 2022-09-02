<?php
session_start();
require_once("../Controller/UserController.php");
$userController = new UserController;
$register = $userController->register($_POST);
/* var_dump($userController->errors);
var_dump($userController->post); */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
    <!-- LIEN BOOTSWATCH  -->
    <link rel="stylesheet" href="https://bootswatch.com/5/cyborg/bootstrap.min.css">
    <!--  LIEN CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <section id="connect">
        <div class="container">
            <form action="" method="POST">
                <!-- LOGIN -->
                <div class="form-group">
                    <label class="col-form-label mt-4" for="inputDefault">Login</label>
                    <input type="text" class="form-control" placeholder="Entrez votre pseudo" name="login" 
                    value="<?= isset($userController->post['login']) ? $userController->post['login'] : "" ?>">
                    <?= isset($userController->errors['login']) ? '<span>' . $userController->errors['login'] . '</span>' : "" ?>
                </div>
                <!-- EMAIL -->
                <div class="form-group">
                    <label for="exampleInputEmail1" class="form-label mt-4">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Entrez votre email" name="email" 
                    value="<?= isset($userController->post['email']) ? $userController->post['email'] : "" ?>">
                    <?= isset($userController->errors['email']) ? '<span>' . $userController->errors['email'] . '</span>' : "" ?>
                </div>
                <!-- PASSWORD -->
                <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Entrez votre mot de passe" name="pwd" 
                    value="<?= isset($userController->post['pwd']) ? $userController->post['pwd'] : "" ?>">
                    <?= isset($userController->errors['pwd']) ? '<span>' . $userController->errors['pwd'] . '</span>' : "" ?>

                </div>
                <!-- CONFIRM PASSWORD -->
                <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label mt-4">Confirm Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirmez votre mot de passe" name="confirmPwd" 
                    value="<?= isset($userController->post['confirmPwd']) ? $userController->post['confirmPwd'] : "" ?>">
                    <?= isset($userController->errors['confirmPwd']) ? '<span>' . $userController->errors['confirmPwd'] . '</span>' : "" ?>
                </div>
                <br><br>
                <input type="submit" class="btn btn-danger" name="submited" value="S'inscrire"> <a href="login.php" type="button" class="btn btn-danger">S'identifier</a>
            </form>
        </div>
    </section>
</body>

</html>