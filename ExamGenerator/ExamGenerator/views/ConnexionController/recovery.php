<!DOCTYPE html>
<html>
<?php include VIEWS . DS . '_common' . DS . 'html.head.php'; ?>

<body class="bg-gradient-primary">

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">

                                    <?php include_once VIEWS . DS . '_common' . DS . 'html.errors.php' ?>
                                    <?php include_once VIEWS . DS . '_common' . DS . 'html.success.php' ?>

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Récupération de mot de passe</h2>
                                    </div>
                                    <form action="./recoveryPassUser" method="post">
                                        <p>
                                            Entrez votre adresse e-mail pour récupérer votre compte
                                        </p>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="email" aria-describedby="email" placeholder="Adresse e-mail...">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="password_lost" value="Envoyer"
                                                class="btn btn-primary btn-user btn-block">
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="./">Vous
                                            avez déjà un compte ?</a>
                                    </div>
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