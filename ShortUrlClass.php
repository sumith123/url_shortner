<?php
class ShortUrlClass
{

    protected $conn;
  
    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function GetShortUrl($url)
    {
        $query = "SELECT * FROM url_shorten WHERE url = '" . $url . "' ";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['short_code'];
        } else {
            $short_code = $this->generateUniqueID();
            $sql = "INSERT INTO url_shorten (url, short_code, hits)
            VALUES ('" . $url . "', '" . $short_code . "', '0')";
            if ($this->conn->query($sql) === TRUE) {
                return $short_code;
            } else {
                return "unknown error occured";
            }
        }
    }


    public function generateUniqueID()
    {

        $token = substr(md5(uniqid(rand(), true)), 0, 6);
        $query = "SELECT * FROM url_shorten WHERE short_code = '" . $token . "' ";
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
            generateUniqueID();
        } else {
            return $token;
        }
    }
    function GetRedirectUrl($slug){
        $query = "SELECT * FROM url_shorten WHERE short_code = '".addslashes($slug)."' "; 
        $result = $this->conn->query($query);
        if ($result->num_rows > 0) {
       $row = $result->fetch_assoc();
       $hits=$row['hits']+1;
       $sql = "update url_shorten set hits='".$hits."' where id='".$row['id']."' ";
       $this->conn->query($sql);
       return $row['url'];
       }
       else 
        { 
       die("Invalid Link!");
       }
       }
}

