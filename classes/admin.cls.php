<?php 

require_once "../classes/connection.cls.php";
require_once "../classes/user.cls.php";
require_once "../classes/note.cls.php";

class admin extends user{


    public function setAdminLevel($adminLevel)
    {
        $this->adminLevel=$adminLevel;    
    }
    public function getAdminLevel()
    {
        return $this->adminLevel;
    }
    public function __construct($id,$username,$firstname,$lastname,$email,$password,$admin) {
        parent::__construct($id,$username,$firstname,$lastname,$email,$password,$admin);
    }

    public function changeToAdmin($id)
    {
        $result=false;
        $sql = "update users set admin = true where id = '$id'";
        $return = connection::actionOnDB($sql);
        if($return){
            $result = true;        
        }
        return $result ; 
    }
    public function changeToUser($id){
        $result=false;
        $sql = "update users set admin = false where id = '$id'";
        $return = connection::actionOnDB($sql);
        if($return){
            $result = true;        
        }
        return $result ; 
    }
    public function deleteUser($id){
        $result=false;
        $sql = "delete from users where id = '$id'";
        $return = connection::actionOnDB($sql);
        if($return){
            $result = true;        
        }
        return $result ; 
    }

    public function allUsers(){
        $result=false;
        $sql = "select * from users";
        $return = connection::selectionFromDb($sql);
        if($return){
            $result = $result;        
        }
        return $result ; 
    }
    public function allNotes(){
        $result=false;
        $sql = "select * from notes";
        $return = connection::selectionFromDb($sql);
        if($return){
            $result = $result;        
        }
        return $result ; 
    }
    public function allNotesByUser($id){
        $result=false;
        $sql = "select * from notes where user_id='$id'";
        $return = connection::selectionFromDb($sql);
        if($return){
            $result = $result;        
        }
        return $result ; 
    }
    public function deleteNote($note_id)
    {
        $result=false;
        $sql = "delete from note where note_id = '$note_id'";
        $return = connection::actionOnDB($sql);
        if($return){
            $result = true;        
        }
        return $result ; 
    }






}