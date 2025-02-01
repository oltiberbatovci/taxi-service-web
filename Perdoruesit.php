<?php
    class Perdoruesit{
        private $id;
        private $name;
        private $email;
        private $password;
        private $confirm;
        private $role;

        public function __construct($id, $name, $email, $password, $confirm, $role){
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
            $this->confirm = $confirm;
            $this->role = $role;
        }

        public function getId(){
            return $this->id;
        }
        public function getName(){
            return $this->name;
        }      
        public function getEmail(){
            return $this->email;
        }
        public function getPassword(){
            return $this->password;
        }  
        public function getConfirm(){
            return $this->confirm;
        }  
        public function getRole(){
            return $this->role;
        } 

        public function setName($name){
            $this->name = $name;
        }  
        public function setEmail($email){
            $this->email = $email;
        }
        public function setPassword($password){
            $this->password = $password;
        }
        public function setConfirm($confirm){
            $this->confirm = $confirm;
        }   
        public function setRole($role){
            $this->role = $role;
        }        
    }
?>
