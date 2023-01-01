<?php
class Student{
    public $name, $year, $pointMath, $pointPhys, $pointChems, $point;
    public function __construct($name, $year, $pointMath, $pointPhys, $pointChems){
        $this->name = $name;
        $this->year = $year;
        $this->pointMath = $pointMath;
        $this->pointPhys = $pointPhys;
        $this->pointChems = $pointChems;
    }
    
    public function getListStudent(){
        echo implode(" ", [
            $this->name,
            $this->year,
            $this->pointMath,
            $this->pointChems,
            $this->pointPhys
        ]);
    }
    
    public function average(){
        $average = number_format((($this->pointChems + $this->pointPhys + $this->pointMath) / 3), 2)."<br/>";
        echo $average;
        
    }
    
    public function averageBigger5(){
        if(number_format((($this->pointChems + $this->pointPhys + $this->pointMath) / 3), 2) > 5){
            echo implode(" ", [
                $this->name,
                $this->year,
                $this->pointMath,
                $this->pointChems,
                $this->pointPhys
            ]);
        }
    }
    public function BornIn2001(){
        if($this->year == 2001){
            echo implode(" ", [
                $this->name,
                $this->year,
                $this->pointMath,
                $this->pointChems,
                $this->pointPhys
            ]);
        }
    }
}


class ListStudent{
    public static function getList(){
        return [
            ["A", 2001, 7, 8,9],
            ["B", 2002, 8, 7,7],
            ["C", 2001, 10, 10,9],
            ["D", 2002, 9, 8,9],
            ["E", 2000, 4, 5,5],
        ];
    }
}
// class AverageBigger5 extends Student{
//     public function averageBigger5($average){
//         if($average > 5){
//             echo implode(" ", [
//                 $this->name,
//                 $this->year,
//             ]);
//         }
//     }
// }

// class BornIn2001 extends Student{
//     public function BornIn2001(){
//         if($this->year == 2001){
//             echo implode(" ", [
//                 $this->name,
//                 $this->year,
//             ]);
//         }
//     }
// }

class Main{
    public static function run(){
        $list = [];
        foreach (ListStudent::getList() as $student){
            list($name, $year, $pointMath, $pointPhys, $pointChems) = $student;
            $list[]= new Student($name, $year, $pointMath, $pointPhys, $pointChems);
        }
        
        foreach($list as $item => $value){
            $value->getListStudent();
            echo " | Điểm trung bình:";
            $value->average();
        }
        
        echo "</br>";
        echo "Điểm trung bình lớn hơn 5:";
        foreach($list as $item){
            echo "</br>";
            $item->averageBigger5();
        }
        
        
        echo "</br>";
        echo "Năm sinh 2001";
        foreach($list as $item){
            echo "</br>";
            $item->BornIn2001();
        }
    }
}
Main::run();
?>