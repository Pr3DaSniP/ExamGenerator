<!DOCTYPE html>
<html lang="en">
<?php include VIEWS . DS . '_common' . DS . 'html.head.php'; ?>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">

                                    <?php include_once VIEWS . DS . '_common' . DS . 'html.errors.php' ?>
                                    <?php include_once VIEWS . DS . '_common' . DS . 'html.success.php' ?>

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Connexion utilisateur</h1>
                                    </div>
                                    <form action="
                                        <?= URL_BASE . DS . 'checkUser' ?>
                                    " method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email"
                                                aria-describedby="email" placeholder="Adresse e-mail..." name="email"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password"
                                                placeholder="Mot de passe" name="password" required>
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block"
                                            value="Connexion">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="
                                            <?= URL_BASE . DS . 'password_reset' ?>
                                        ">Mot
                                            de passe oublié ?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="
                                            <?= URL_BASE . DS . 'register' ?>
                                        ">Créer
                                            un compte
                                            élève</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <?php include VIEWS . DS . '_common' . DS . 'html.body.js.php'; ?>

</body>

</html>