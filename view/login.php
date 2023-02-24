<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form class="mt-5" id="form" action="" method="post">
        <div class="form-group">
                <label>Email address</label>
                <input type="email" name="email"
                    class="form-control <?php print(!empty($params['errors']['email'])) ? 'is-invalid' : '' ;?>
                                        use model\LoginModel;" aria-describedby="emailHelp"
                    placeholder="Enter email">
                <div class="invalid-feedback">
                    <?php
                    if(!empty($params['errors']['email'])) {
                        ?>
                            <?php
                            print($params['errors']['email'][0]);
                            ?>
                        <?php
                    }
                    ?>
                </div>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password"
                    class="form-control <?php print(!empty($params['errors']['password'])) ? 'is-invalid' : ''  ?>" id="exampleInputPassword1"
                    placeholder="Password">
                <div class="invalid-feedback">
                    <?php
                    if(!empty($params['errors']['password'])) {
                        ?>
                            <?php
                            print($params['errors']['password'][0]);
                            ?>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <button type="submit" class="mb-3 btn btn-primary">Submit</button>
        </form>
        <a class="position-absolute start-50 translate-middle nav-link" href="/register">Register</a>
    </div>
</body>

</html>