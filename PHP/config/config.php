<?php

class Config
{
    private $HOSTNAME = "localhost";
    private $USERNAME = "root";
    private $PASSWORD = "";
    private $DB_DATA = "ppr";

    public $connection;


    // connect Method
    public function connect()
    {
        // mysqli_connect() 
        //return bool
        // $this->connection = mysqli_connect($this->HOSTNAME, $this->USERNAME, $this->PASSWORD, $this->$DB_DATA);
        $this->connection = mysqli_connect($this->HOSTNAME, $this->USERNAME, $this->PASSWORD, $this->DB_DATA);

        return $this->connection;

    }

    public function insertEmployes($Name, $Age, $Job_Title, $Department, $Email, $Contact)
    {

        $this->connect();

        $query = "INSERT INTO employes (Name, Age, Job_Title, Department, Email, Contact) VALUES('$Name', $Age,'$Job_Title', '$Department', '$Email', $Contact);";

        return mysqli_query($this->connection, $query); // return bool

    }
    public function fetchEmployes()
    {
        $this->connect();
        $query = "SELECT * FROM employes;";
        $res = mysqli_query($this->connection, $query);// return obj mysqli_result

        return $res;
    }
    public function deleteEmployes($id)
    {
        $this->connect();
        $query = "DELETE FROM employes WHERE Id = $id ;";
        $res = mysqli_query($this->connection, $query);// return 1 || 0    bool
        return $res;
    }

    public function fetchingSingleEmployes($id)
    {
        $this->connect();

        $query = "SELECT * FROM employes WHERE Id = $id ;";

        $res = mysqli_query($this->connection, $query);// return obj mysqli_result
        
        return $res;
    }

    public function updateEmployes($Name, $Age, $Job_Title, $Department, $Email, $Contact, $id)
    {
        $this->connect();
        $query = "UPDATE employes SET Name = '$Name', Age = $Age, Job_Title = '$Job_Title', Department = '$Department', Email = '$Email', Contact = $Contact WHERE Id = $id ;";
        $res = mysqli_query($this->connection, $query);
        return $res;
    }

}
?>