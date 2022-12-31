<?php

class Student{
    
    public $name, $year, $pointMath, $pointPhys, $pointChems, $point;
    
    public function listStudent($students){
        $students = array (
            array("A", 2001, 7, 8,9),
            array("B", 2002, 8, 7,7),
            array("C", 2001, 10, 10,9),
            array("D", 2002, 9, 8,9),
            array("E", 2000, 7, 8,10),
        );
        for ($row = 0; $row < count($students); $row++) {
            echo "<p><b>Row number $row</b></p>";
            for ($col = 0; $col < 5; $col++) {
                echo "<li>".$students[$row][$col]."</li>";
            }
        }
    }

    public function average($pointMath, $pointPhys, $pointChems){
        $this->point = ($pointChems + $pointPhys + $pointMath) / 3;
        return $this->point;
    }
}
$students = new Student();
$students->listStudent($students);

?>