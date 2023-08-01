<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <?php
        $state = $_GET['state'] ?? null;
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 offset-3">

                <?php if($state === 'fail'): ?>
                    <p class="text-center my-2"> username or password empty !</p>
                <?php endif; ?>

                <?php if($state === 'error'): ?>
                    <p class="text-center my-2"> Account invalid </p>
                <?php endif; ?>

                <form class="border p-3 mt-3" method="POST" action="./handle-login.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input
                            type="text"
                            class="form-control"
                            id="username"
                            aria-describedby="emailHelp"
                            name="username"
                        >
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="exampleInputPassword1"
                            name="password"
                        >
                    </div>
                    <button
                        type="submit"
                        class="btn btn-primary"
                        name="btnLogin"
                    >Login</button>
                </form>
            </div>
        </div>
    </div>

    <!-- <script src="" async defer></script> -->
</body>

</html>