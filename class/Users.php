<?php

class Users {
    public static function getByLogin($login){
        global $DB;
        
        $user = $DB->query('SELECT * FROM users WHERE login = :login', array('login'=>$login));
        if (!empty($user) && count($user) == 1) {
            $user = current($user);
            $user['type']        = "etu";
            $user['is_adulte']   = true;
            $user['is_cotisant'] = true;
            return $user;
        }elseif(!empty($user) && count($user) > 1){
            die('Erreur : plusieurs personnes ont le même email ...');
        }elseif(preg_match('/^[a-z-]+[.]+[a-z-]+@([0-9]{4}[.])?icam[.]fr$/', $login)) { // Si l'email n'existe pas déjà, on va le rentrer dans la base...
            $prenomNomPromoIcamFr = explode('@', $login);
            $prenomNom = explode('.', $prenomNomPromoIcamFr[0]);
            $prenom = ucfirst($prenomNom[0]);
            $nom = ucfirst($prenomNom[1]);
            $promo = current(explode('.', $prenomNomPromoIcamFr[1]));
            $user = array(
                "login"            => $login,
                "nom"              => $nom,
                "prenom"           => $prenom,
                "mail"             => $login,
                "badge_uid"        => null,
                "expiration_badge" => null
            );

            $insert = $DB->query('INSERT INTO users ( login, nom, prenom, mail, badge_uid, expiration_badge )
                VALUES ( :login ,:nom ,:prenom ,:mail ,:badge_uid ,:expiration_badge );',
                $user);
            $user['type']        = "etu";
            $user['is_adulte']   = true;
            $user['is_cotisant'] = true;
            return $user;
        }else{
            die("Email inconu & non Icam");
        }
    }

    public static function getByBadge($badge_uid){
        global $DB;
        
        $user = $DB->query('SELECT * FROM users WHERE badge_uid = :badge_uid', array('badge_uid'=>$badge_uid));
        if (!empty($user) && count($user) == 1) {
            $user = current($user);
            $user['type']        = "etu";
            $user['is_adulte']   = true;
            $user['is_cotisant'] = true;
            return $user;
        }elseif(!empty($user) && count($user) > 1){
            die('Erreur : plusieurs personnes ont le badge ...');
        }else{
            die('Badge inconnu');
        }
    }

}