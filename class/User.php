<?php
session_start();

class User
{

    // errors variable is used to collect any possible errors from logIn method
    public $errors;

    public $result;
    public $id;
    public $db_pass;


    /**
     *  logIN method is used to check user provided details and log in Administrator if details are correct.
     *
     * @param $username
     * @param $password
     * @return bool
     *
     */



    public function logIn($username, $password)
    {
        if (isset($_POST[$username]) && isset($_POST[$password])) {

            $field = [
                'username' => $_POST[$username],
                'password' => $_POST[$password]
            ];

            if (empty($field['username']) || empty($field['password'])) {
                $this->errors = 'Please fill all fields.';
                return false;
            } else {

                require_once('Database.php');
                $db = new Database();
                $query = $db->connection->prepare(" SELECT * FROM admin WHERE username= :username LIMIT 1 ");
                $query->execute(array(':username' => $field['username']));

                if ($query->rowCount() === 1) {
                    $this->result = $query->fetch(PDO::FETCH_OBJ);
                    $this->db_pass = $this->result->password;
                    $this->id = $this->result->id;
                }
                if (password_verify($field['password'], $this->db_pass)) {
                    $_SESSION['username'] = $field['username'];
                    $_SESSION['id'] = $this->id;
                    header('location:admincpanel.php');
                    return true;
                } else {
                    $this->errors = 'Incorrect login details.';
                    return false;
                }
            }
        }
        return false;
    }
} // END OF CLASS




