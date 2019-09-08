<?php
//databaseConnection

class Dbcon
{
    //define the variable needed
    public static $host = '127.0.0.1';
    public static $username = 'root';
    public static $password = '';
    public static $dbname = 'test';
    public static $conn;
    static $error;


    //Connect to the database
    public static function connect()
    {
        try {
            self::$conn = mysqli_connect(self::$host, self::$username, self::$password, self::$dbname);
        } catch (Exception $e) {
            echo "<pre>" . $e . "</pre>";
        }
    }

    //select data from the table
    function select($table, $data = null, $value = null)
    {
        $this->connect();
        $value = $this->clean($value);
        if ($value !== "" and $data !== "") {
            $query = "SELECT * FROM $table WHERE $data=$value";
        } else {
            $query = "SELECT * FROM $table";
        }
        if ($result = mysqli_query($this->conn, $query)) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return "error";
        }
        $this->close();
    }

    public static function update($table, array $data, array $where)
    {
        $sql = "UPDATE {$table} SET ";
        foreach ($data as $key => $value) {
            if ($key === array_key_last($data)) {
                $sql .= " {$key} = '{$value}' ";
            } else {
                $sql .= " {$key} = '{$value}', ";
            }
        }
        $sql .= "WHERE true ";
        foreach ($where as $key => $value) {
            $sql .= " AND {$key} = '{$value}'";
        }
        return self::execute($sql);
    }

    /**
     *  Insert data into
     * @param $table name of table
     * @param $data
     * @return bool|int|string
     */
    public static function insert($table, $data)
    {
        $fields = implode(',', array_keys($data));
        $data = implode("','", $data);

        $query = "INSERT INTO {$table} ({$fields}) VALUES ('{$data}')";
        try {
            self::connect();
            mysqli_query(self::$conn, $query);
            return mysqli_insert_id(self::$conn);
        } catch (Exception $e) {
            self::$error = $e;
            return false;
        }
    }

    public static function execute($query)
    {
        self::connect();
        if ($result = mysqli_query(self::$conn, $query)) {
            return $result;
        } else {
            self::$error = mysqli_error(self::$conn);
            return false;
        }
    }

    public function fetch_all_assoc($object)
    {
        //handle database object
        if (!empty($object)) {
            $result = mysqli_fetch_all($object, MYSQLI_ASSOC);
            mysqli_free_result($object);
            self::close();
            return $result;
        }
    }

    public function fetch_all_array($object)
    {
        //handle database object
        if (!empty($object)) {
            $result = mysqli_fetch_all($object, MYSQLI_NUM);
            mysqli_free_result($object);
            self::close();
            return $result;
        }
    }

    public function fetch_array($object)
    {
        //handle database object
        if (!empty($object)) {
            $result = mysqli_fetch_array($object, MYSQLI_NUM);
            mysqli_free_result($object);
            self::close();
            return $result;
        }
    }

    public function fetch_assoc($object)
    {
        //handle database object
        if (!empty($object)) {
            $result = mysqli_fetch_assoc($object);
            mysqli_free_result($object);
            self::close();
            return $result;
        }
    }

    public function fetch_row($object)
    {
        if (!empty($object)) {
            $result = mysqli_fetch_row($object);
            mysqli_free_result($object);
            self::close();
            return $result;
        }
    }


    //delete the file from database
    public static function delete($table, $where)
    {
        $query = "DELETE FROM {$table} WHERE true ";
        foreach ($where as $key => $value) {
            $query .= "AND {$key} = '{$value}' ";
        }
        self::execute($query);
    }

    //just making debug easier
    function debug($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
    }

    //clean the data before posting it to the data base
    public static function clean($x)
    {
        self::connect();
        if ($x <> null) {
            $x = stripcslashes($x);
            $x = mysqli_real_escape_string(self::$conn, $x);
            return $x;
        } else {
            return false;
        }
    }


    public static function close()
    {
        mysqli_close(self::$conn);
    }

    //destroy the connection everytime the page is closed
    function __destruct()
    {
        mysqli_close($this->conn);
    }


    function page_selectAll($offset = 1, $rowsperpage = 1)
    {
        $query = 'SELECT * FROM content LIMIT 3 OFFSET 0';
        $data = mysqli_fetch_assoc($this->execute($query));
        return $data;
    }
}
