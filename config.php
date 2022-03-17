<?php
class Model
{
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "DataB";  // database name ##
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO(
                "mysql:host=$this->server;
                dbname=$this->db",
                $this->username,
                $this->password
            );
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function insert()
    {
        if (isset($_POST['submit'])) {
            if (isset($_POST['title']) && isset($_POST['description'])) {
                if (!empty($_POST['title']) && !empty($_POST['description'])) {
                    $title = $_POST['title'];
                    $description = $_POST['description'];

                    $query = "INSERT INTO posts(title,description) VALUES('$title', '$description')";
                    if ($sql = $this->conn->exec($query)) {
                        echo "
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        Post Added Successfully
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>        
                        ";
                    } else {
                        echo "
                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            Faild to add a new post ;
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                        ";
                    }
                } else {
                    echo "
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Empty Failds
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                    ";
                }
            }
        }
    }
    public function fetch()
    {
        $data = null;
        $statment = $this->conn->prepare("SELECT * FROM posts");
        $statment->execute();
        $data = $statment->fetchAll();
        return $data;
    }
    public function delete($delete_id)
    {
        $query = "DELETE FROM posts WHERE id = '$delete_id'";
        if ($sql = $this->conn->exec($query)) {
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                Post Delete Successfully
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>        
                ";
        } else {
            echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Post Not Deleted 
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>        
                ";
        }
    }
    public function read($read_id)
    {
        $data = null;
        $statment = $this->conn->prepare("SELECT * FROM posts WHERE id = $read_id");
        $statment->execute();
        $data = $statment->fetch();
        return $data;
    }
    public function edit($edit_id)
    {
        $data = null;
        $statment = $this->conn->prepare("SELECT * FROM posts WHERE id = $edit_id");
        $statment->execute();
        $data = $statment->fetch();
        return $data;
    }
    public function update($data)
    {
        $query = "UPDATE posts SET title = '$data[edit_title]',description = '$data[edit_description]'WHERE id='$data[edit_id]'";
        if ($sql = $this->conn->exec($query)) {
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                Post Update Successfully
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            <script>
                $('#exampleModal_1').modal('hide')
            </script>
            ";
        } else {
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                Failed to Update
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
    }
}
