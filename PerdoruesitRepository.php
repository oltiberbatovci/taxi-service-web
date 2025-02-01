<?php
    include_once 'DatabaseConnection.php';

    class PerdoruesitRepository{
        private $connection;

        function __construct(){
            $conn = new DatabaseConnection;
            $this->connection = $conn->startConnection();
        }

        function insertUser($user){
            $conn = $this->connection;
            
            $name = $user->getName();
            $email = $user->getEmail();
            $password = $user->getPassword();
            $confirm = $user->getConfirm();
            $role = $user->getRole();

            $sql = "INSERT INTO user(name, email, password, confirm, role) VALUES (?,?,?,?,?)";
            $statement = $conn->prepare($sql);
            $statement->execute([$name, $email, $password, $confirm, $role]);

            // echo "<script> alert('Register was successful!');</script>";
        }

        function getAllUsers(){
            $conn = $this->connection;

            $sql = "SELECT * FROM user";
            $statement = $conn->query($sql);
            $users = $statement->fetchAll();

            return $users;
        }

        function getUserById($id){
            $conn = $this->connection;
            $sql = "SELECT * FROM user WHERE id=?";
            
            $statement = $conn->prepare($sql);
            $statement->execute([$id]);
            $user = $statement->fetch();

            return $user;
        }

        function updateUser($name, $email, $password, $confirm, $role){
            $conn = $this->connection;
            $sql = "UPDATE user SET name=?, email=?, password=?, confirm=?, role=? WHERE id=?";
            
            $statement = $conn->prepare($sql);
            $statement->execute([$name, $email, $password, $confirm, $role, $id]);

            // echo "<script>alert('Update was successful');</script>";
        }

        function deleteUser($id){
            $conn = $this->connection;

            $sql = "DELETE FROM user WHERE id=?";            
            
            $statement = $conn->prepare($sql);
            $statement->execute([$id]);

            // echo "<script>alert('Delete was successful!');</script>";
        }

        function emailExists($email){
            $conn = $this->connection;

            $sql = "SELECT COUNT(*) FROM user WHERE email = ?";
            $statement = $conn->prepare($sql);
            $statement->execute([$email]);
            $count = $statement->fetchColumn();

            return ($count > 0);
        }
    }
?>