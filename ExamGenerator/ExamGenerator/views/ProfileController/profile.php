<?php include_once VIEWS . DS . '_common' . DS . 'html.errors.php' ?>
<?php include_once VIEWS . DS . '_common' . DS . 'html.success.php' ?>

<style>
    #profile-image1 {
        cursor: pointer;
        width: 100px;
        height: 100px;
        border: 2px solid #03b1ce;
    }

    .title {
        font-size: 16px;
        font-weight: 500;
    }

    .bot-border {
        border-bottom: 1px #f8f8f8 solid;
        margin: 5px 0 5px 0
    }

    .visible {
        display: block;
    }

    .invisible {
        display: none;
    }
</style>
<h1 align="center" class="mt-4" style="color:#17526c">Mon compte</h1>

</br>
<div class="card text-center">
    <div class="card-body">
        <img src="<?= URL_BASE . DS . IMAGES . DS . 'undraw_profile.svg' ?>" alt="Profile Picture" width="100"
            style="border-radius:50%"></br></br>

        <div class="row">
            <div class="col"></div>
            <div class="col">
                <input type="email" class="form-control" id="inputFirstAndLastName" value="
                        <?php
                        $nom = $variables['user']['nom'] . ' ' . $variables['user']['prenom'];
                        if ($variables['user']['Role_idRole'] == 1) {
                            $nom .= ' (Enseignant)';
                        } elseif ($variables['user']['Role_idRole'] == 2) {
                            $nom .= ' (Administrateur)';
                        } elseif ($variables['user']['Role_idRole'] == 3) {
                            $nom .= ' (Etudiant)';
                        }
                        echo $nom;
                        ?>
                    " style="text-align:center;" disabled>
            </div>
            <div class="col">
                <input type="button" class="updatemdp btn btn-primary" value="Modifier mon mot de passe" onclick="
                    const invisible = document.querySelector('.mdp');
                    const button = document.querySelector('.updatemdp');
                    if(invisible.classList.contains('visible')) {
                        invisible.classList.remove('visible');
                        invisible.classList.add('invisible');
                        button.value = 'Modifier mon mot de passe';
                        button.classList.remove('btn-danger');
                        button.classList.add('btn-primary');
                    } else {
                        invisible.classList.remove('invisible');
                        invisible.classList.add('visible');
                        button.value = 'Annuler';
                        button.classList.remove('btn-primary');
                        button.classList.add('btn-danger');
                    }
                ">
                <input type="button" class="updateprofil btn btn-primary" value="Modifier mon compte" onclick="
                    const inputMail = document.getElementsByName('email')[0];
                    const inputNaissance = document.getElementsByName('dateNaissance')[0];
                    const button = document.querySelector('.updateprofil');
                    const buttonUpdate = document.querySelector('.update');
                    if(inputMail.disabled) {
                        inputMail.disabled = false;
                        inputNaissance.disabled = false;
                        button.value = 'Annuler';
                        button.classList.remove('btn-primary');
                        button.classList.add('btn-danger');
                        buttonUpdate.classList.remove('invisible');
                        buttonUpdate.classList.add('visible');
                    } else {
                        inputMail.disabled = true;
                        inputNaissance.disabled = true;
                        button.value = 'Modifier mon compte';
                        button.classList.remove('btn-danger');
                        button.classList.add('btn-primary');
                        buttonUpdate.classList.remove('visible');
                        buttonUpdate.classList.add('invisible');
                    }
                ">
            </div>


        </div>

        </br>

        <form method="post" action="
            <?= URL_BASE . DS . 'profil' . DS . 'save' ?>
        ">
            <!-- MAIL -->
            <div class="form-group row">
                <label for="inputMail" class="col-sm-3 col-form-label">Adresse email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" name="email" value="
                        <?= $variables['user']['email'] ?>" disabled>
                </div>
            </div>

            <!-- DATE DE NAISSANCE -->
            <div class="form-group row">
                <label for="inputNaissance" class="col-sm-3 col-form-label">Date de naissance</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" name="dateNaissance" value="<?php
                    $naissance = new DateTime($variables['user']['dateNaissance']);
                    echo $naissance->format('Y-m-d');
                    ?>" disabled>
                </div>
            </div>

            <!-- DATE DE CREATION -->
            <div class="form-group row">
                <label for="inputCreation" class="col-sm-3 col-form-label">Date de création</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control" name="inputCreation" value="<?php
                    $creation = new DateTime($variables['user']['dateCreation']);
                    echo $creation->format('Y-m-d');
                    ?>" disabled>
                </div>
            </div>

            <!-- DATE DE MISE A JOUR -->
            <div class="form-group row">
                <label for="inputMaj" class="col-sm-3 col-form-label">Date de mise à jour</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" name="inputMaj" value="<?php
                    $maj = new DateTime($variables['user']['dateLastUpdated']);
                    echo $maj->format('d/m/Y');
                    ?>" disabled>
                </div>
            </div>
            <div class="form-group row update invisible">
                <div class="col-sm-12">
                    <input type="submit" class="btn btn-success" value="Enregistrer les modifications">
                </div>
            </div>
        </form>

        <div class="mdp invisible">
            <hr class="border border-primary border-3 opacity-75">
            <form method="POST" action=<?= URL_BASE . DS . 'profil' . DS . 'password' . DS . 'save' ?>>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Mot de passe Actuel</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="mdpActuel">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputNewPassword" class="col-sm-3 col-form-label">Nouveau mot de passe</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="mdpNouveau">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPasswordConfirm" class="col-sm-3 col-form-label">Confirmer le mot de passe</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="mdpNouveauConfirm">
                    </div>
                </div>
                <input type="submit" class="btn btn-success" value="Valider">
            </form>
        </div>

    </div>
</div>