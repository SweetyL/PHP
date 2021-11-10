<?php

class Admin {
    
    private $id;

    public function set_admin($id, $conn) {
        $sql = "SELECT id FROM adminok WHERE id = $id ";
        $result = $conn->query($sql);
        if ($conn->query($sql)) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $this->id = $row['id'];
            }
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    public function get_id() {
        return $this->id;
    }

    public function adminokListaja($conn) {
        $lista = array();
        $sql = "SELECT id FROM adminok";
        if($result = $conn->query($sql)) {
            if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
                    $lista[] = $row['id'];
                }
            }
        }
        return $lista;
    }
}

?>