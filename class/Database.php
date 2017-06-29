<?php



require_once('/database/db_info.php');


class Database
{

    public $host = HOST;
    public $dbname = DBNAME;
    public $dbuser = DBUSER;
    public $dbpass = DBPASS;


    public $connection;

    /**
     * Class constructor.
     */

    public function __construct()
    {
        try {

            $this->connection = new PDO("mysql:host=" . $this->host . "; dbname=" . $this->dbname, $this->dbuser, $this->dbpass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {

            echo $e->getMessage();
            die();
        }
    }

    /**
     * retriveData is method that accepts one parameter (SQL query) than check if there are rows in database.
     *
     * @param SQL $statement is variable/statement.
     * @return bool|PDOStatement.
     *
     */

    public function retriveData($statement)
    {
        $result = $this->connection->query($statement);
        if ($result->rowCount() > 0) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     * insertPost is method that is used to insert posts in database from index.php page.
     *
     * @param $name
     * @param $email
     * @param $title
     * @param $body
     * @return bool|PDOStatement
     *
     */

    public function insertPost($name, $email, $title, $body)
    {
        $result = $this->connection->prepare(' INSERT INTO posts
                                              (name , email , title , body , date)
                                              VALUES
                                              ( ? , ? , ? , ? , NOW() ) ');
        $result->execute([
            $name,
            $email,
            $title,
            $body
        ]);
        if ($result) {
            return $result;
        }
        return false;
    }

    /**
     * updatePost is method that is used to update and approve posts from admin CP.
     *
     * @param $id
     * @param $name
     * @param $email
     * @param $title
     * @param $body
     * @return bool
     *
     */

    public function updatePost($id, $name, $email, $title, $body)
    {
        if (isset($_POST[$id], $_POST[$name], $_POST[$email], $_POST[$title], $_POST[$body])) {

            $id = $_POST[$id];
            $name = $_POST[$name];
            $email = $_POST[$email];
            $title = $_POST[$title];
            $body = $_POST[$body];

            $result = $this->connection->prepare(' UPDATE posts SET
                                                       name = :name,
                                                       email = :email,
                                                       title = :title,
                                                       body = :body,
                                                       approved = 1
                                                  WHERE
                                                          id = :id ');

            $result->execute(array(
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'title' => $title,
                'body' => $body,
            ));
            if ($result) {
                header('Location:admincpanel.php');
                return true;
            }
        }
        return false;
    }


} // END OF CLASS



























































































































































