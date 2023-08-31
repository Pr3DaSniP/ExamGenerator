<?php

class Utilisateur
{
    public function checkUser($email, $password)
    {
        $email = htmlspecialchars($email);
        $password = sha1(htmlspecialchars($password));

        $db = new Database();
        $res = $db->select(
            "SELECT * FROM utilisateur 
            INNER JOIN utilisateurrole ON utilisateur.id = utilisateurrole.Utilisateur_id 
            WHERE email = '$email' AND mdp = '$password'"
        );

        if (count($res) > 0) {
            $_SESSION['user'] = $res[0];
            return true;
        } else {
            return false;
        }
    }

    public function registerUser($userDatas)
    {
        $pass1 = htmlspecialchars($userDatas['password_1']);
        $pass2 = htmlspecialchars($userDatas['password_2']);
        if ($pass1 != $pass2) {
            $errors = "Les mots de passe ne correspondent pas";
            $title = "Créer un compte";
            include_once ROOT . DS . VIEWS . DS . 'ConnexionController' . DS . 'register.php';
        } else {
            if (!$this->ifAlreadyExist($userDatas['email'])) {
                $db = new Database();
                $db->insert(
                    "INSERT INTO utilisateur (nom, prenom, email, dateNaissance, dateCreation, dateLastUpdated, mdp) 
                    VALUES ('{$userDatas['nom']}', '{$userDatas['prenom']}', '{$userDatas['email']}', '{$userDatas['dateNaissance']}', NOW(), NOW(), '" . sha1($pass1) . "')"
                );
                $db->insert(
                    "INSERT INTO utilisateurrole (Utilisateur_id, Role_idRole) 
                    VALUES (LAST_INSERT_ID(), " . ELEVE . ")"
                );
                return true;
            } else {
                return false;
            }
        }
    }

    public function getAllUtilisateurs()
    {
        $db = new Database();
        $sql = "SELECT id, nom, prenom, email, dateCreation, u.dateLastUpdated, dateNaissance, r.idRole as role FROM utilisateur u 
                inner join UtilisateurRole ur on u.id = ur.Utilisateur_id
                inner join Role r on ur.Role_idRole = r.idRole";
        return $db->select($sql);
    }

    public function recoveryPassUser($mail)
    {
        return true;

        // TODO: Send mail with new password, return true if mail sent, false if not
        /*
        require_once ROOT . DS . 'includes' . DS . 'PHPMailer' . DS . 'PHPMailer.php';
        require_once ROOT . DS . 'includes' . DS . 'PHPMailer' . DS . 'SMTP.php';
        require_once ROOT . DS . 'includes' . DS . 'PHPMailer' . DS . 'Exception.php';
        // PHPMailer
        $mailer = new PHPMailer\PHPMailer\PHPMailer(true);
        try {
        //Server settings
        $mailer->SMTPDebug = 2; // Enable verbose debug output
        $mailer->isSMTP(); // Set mailer to use SMTP
        $mailer->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mailer->SMTPAuth = true; // Enable SMTP authentication
        $mailer->Username = ' ... '; // SMTP username
        $mailer->Password = ' ... '; // SMTP password
        $mailer->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mailer->Port = 587; // TCP port to connect to
        //Recipients
        $mailer->setFrom(' ... ', ' ... ');
        $mailer->addAddress($mail, ' ... '); // Add a recipient
        // Content
        $mailer->isHTML(true); // Set email format to HTML
        $mailer->Subject = ' ... ';
        $mailer->Body = ' ... ';
        $mailer->AltBody = ' ... ';
        $mailer->send();
        echo 'Message has been sent';
        } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        */
    }

    public function delete($datas)
    {
        $json_data = file_get_contents('php://input');
        $datas = json_decode($json_data, true);
        $id = $datas['id'];
        $db = new Database();
        $sql = "DELETE FROM UtilisateurRole where Utilisateur_id = $id ; DELETE FROM Utilisateur WHERE id = $id";
        return $db->delete($sql);
    }


    public function updateUser($userDatas)
    {
        $db = new Database();
        return $db->update(
            "UPDATE utilisateur AS u 
            JOIN UtilisateurRole AS ur ON u.id = ur.Utilisateur_id 
            SET u.nom = '{$userDatas['nom']}', u.prenom = '{$userDatas['prenom']}', 
                u.email = '{$userDatas['email']}', u.dateNaissance = '{$userDatas['dateNaissance']}', 
                u.dateLastUpdated = NOW(),
                ur.Role_idRole = '{$userDatas['roleId']}'
            WHERE u.id = {$userDatas['id']}
            "
        );
    }

    public function checkPassword($id, $pass)
    {
        $db = new Database();
        $res = $db->select(
            "SELECT * FROM utilisateur WHERE id = $id AND mdp = '" . sha1(htmlspecialchars($pass)) . "'"
        );
        return count($res) > 0;
    }

    private function ifAlreadyExist($mail)
    {
        $db = new Database();
        $result = $db->select(
            "SELECT * FROM utilisateur WHERE email = '$mail'"
        );
        return $result != null;
    }
}