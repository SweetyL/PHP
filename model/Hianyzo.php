<?php

class Hianyzo {
    
    private $id;

    public function set_hianyzo($id, $conn) {
        $sql = "SELECT id FROM hianyzok WHERE id = $id ";
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

    public function hianyzokListaja($conn) {
        $lista = array();
        $sql = "SELECT id FROM hianyzok";
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