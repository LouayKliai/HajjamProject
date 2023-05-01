<?php
include_once("../config.php");
include_once("../model/User.php");




class UserC
{
    //***********************************Function add
    function addUser($user)
    {
        
        $sql = "INSERT INTO user VALUES(NULL,:lastName,:firstName,:email,:passwordd,:dob)";
        $db = config::getConnexion();
        $result = $db->prepare("SELECT * from `user` where email =:email1 "); 
        $result->bindValue(':email1',$user->getEmail());
        $result->execute();
        $row_count =$result->fetchColumn();
        if($row_count==0){
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'email' => $user->getEmail(),
                'passwordd' => $user->getPassword(),
                'dob' => $user->getDob()->format('Y/m/d')
            ]);
        } catch (Exception $e) {
            echo "error=:" . $e->getMessage();
        }
    }
    $error=$row_count>0;
    if($error){
        //echo "nope bro";
        return false;
    }
    return true;
    }
    //****************************fonction afficher
    function listUser()
    {
        $sql = "SELECT * FROM user";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    //*****************************fonction supprimer
    function deleteUser($id)
    {
        $sql = "DELETE FROM user WHERE id =:id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    //***********************************fonction Modifier
    function updateUser($user, $id)
    {
        $sql="UPDATE user SET lastName=:lastName,firstName=:firstName,email=:email,passwordd=:passwordd,dob=:dob where id=:idUser";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'idUser' => $id,
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'email' => $user->getEmail(),
                'passwordd' => $user->getPassword(),
                'dob' => $user->getDob()->format('Y/m/d')
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";;
        } catch (Exception $e) {
            echo "error=:" . $e->getMessage();
        }
    }

    //***********************************fonction login
    function login($emailL,$passwordL){
            $sql="SELECT * FROM user WHERE email = :email and passwordd = :passwordL";
            $db = config::getConnexion();
            $req = $db->prepare($sql);
            $req->bindValue(':email',$emailL);
            $req->bindValue(':passwordL',$passwordL);
        try{
            $req->execute();
            $row_count =$req->fetchColumn();
            if($row_count!=0){
                return true;
            }else{
                return false;
            }
        }catch(Exception $e){
            echo "error=:" . $e->getMessage();
        }
    } 

    //***********************************fonction remplissage des champs
    function showUser($id){
    $sql = "SELECT * from user where id = :id";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();

        $user = $query->fetch();
        return $user;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
}
