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
                                        <h1 class="h4 text-gray-900 mb-4">Création compte</h1>
                                    </div>
                                    <form class="user" action="
                                        <?= URL_BASE . DS . 'registerUser' ?>
                                    " method="post">
                                        <div class="form-group">
                                            <input type="name" name="nom" class="form-control form-control-user"
                                                id="name" aria-describedby="name" placeholder="Nom..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="forname" name="prenom" class="form-control form-control-user"
                                                id="forname" aria-describedby="forname" placeholder="Prenom..."
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="email" aria-describedby="email" placeholder="Adresse e-mail..."
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <input type="date" name="dateNaissance" class="form-control datepicker"
                                                id="dateNaissance" aria-describedby="Date de naissance"
                                                placeholder="Date de naissance" data-date-format="Y-m-d H:i:s">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password_1"
                                                class="form-control form-control-user" id="pass1"
                                                placeholder="Mot de passe" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password_2"
                                                class="form-control form-control-user" id="pass2"
                                                placeholder="Confirmation Mot de passe" required>
                                        </div>
                                        <input type="submit" name="action" value="Inscription"
                                            class="btn btn-primary btn-user btn-block">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="
                                            <?= URL_BASE . DS . '' ?>
                                        ">Vous
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