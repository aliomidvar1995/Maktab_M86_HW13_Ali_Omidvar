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
        <h1>Register</h1>
        <form class="mt-5" id="form" action="/register" method="post">
            <div class="row">
                <div class="col">
                    <label>First name</label>
                    <input type="text" name="first_name" 
                    class="form-control <?php print(!empty($params['errors']['first_name'])) ? 'is-invalid' : ''  ?>" placeholder="First name">
                    <div class="invalid-feedback">
                        <?php
                        if(!empty($params['errors']['first_name'])) {
                            ?>
                                <?php
                                print($params['errors']['first_name'][0]);
                                ?>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col">
                    <label>Last name</label>
                    <input type="text" name="last_name" 
                        class="form-control <?php print(!empty($params['errors']['last_name'])) ? 'is-invalid' : ''  ?>" placeholder="Last name">
                    <div class="invalid-feedback">
                        <?php
                        if(!empty($params['errors']['last_name'])) {
                            ?>
                                <?php
                                print($params['errors']['last_name'][0]).'<br>';
                                ?>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Select your rule</label>
                <select name="rule" class="form-select <?php print(!empty($params['errors']['rule'])) ? 'is-invalid' : ''  ?>">
                    <option selected value="">Select your rule</option>
                    <option value="manager">Manager</option>
                    <option value="doctor">Doctor</option>
                    <option value="patient">Patient</option>
                </select>
                <div class="invalid-feedback">
                    <?php
                    if(!empty($params['errors']['rule'])) {
                        ?>
                            <?php
                            print($params['errors']['rule'][0]).'<br>';
                            ?>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label>Email address</label>
                <input type="email" name="email" 
                    class="form-control <?php print(!empty($params['errors']['email'])) ? 'is-invalid' : ''  ?>" aria-describedby="emailHelp"
                    placeholder="Enter email">
                <div class="invalid-feedback">
                    <?php
                    if(!empty($params['errors']['email'])) {
                        ?>
                            <?php
                            print($params['errors']['email'][0]).'<br>';
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
                            print($params['errors']['password'][0]).'<br>';
                            ?>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="comfirm_password"
                    class="form-control <?php print(!empty($params['errors']['comfirm_password'])) ? 'is-invalid' : ''  ?>"
                    placeholder="Comfirm password">
                <div class="invalid-feedback">
                    <?php
                    if(!empty($params['errors']['comfirm_password'])) {
                        ?>
                            <?php
                            print($params['errors']['comfirm_password'][0]).'<br>';
                            ?>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <button class="mt-3 btn btn-primary" type="submit" class="btn btn-primary">Submit</button>
        </form>
        <a class="position-absolute start-50 translate-middle nav-link" href="/">Login</a>
    </div>
</body>
</html>