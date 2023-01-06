<?php
class Student{
    protected $name, $year, $pointMath, $pointPhy, $pointChem;
    public function __construct($name, $year, $pointMath, $pointPhy, $pointChem){
        $this->name = $name;
        $this->year = $year;
        $this->pointMath = $pointMath;
        $this->pointPhy = $pointPhy;
        $this->pointChem = $pointChem;
    } 
    public function layDuLieuHocSinh(){
        echo implode(" ", [
            $this->name,
            $this->year,
            $this->pointMath,
            $this->pointPhy,
            $this->pointChem,
        ]);
    }
}
class Average extends Student{
    protected static $names, $years, $pointMaths, $pointChems, $pointPhys;
    public static function setAverage($name, $year, $pointChem, $pointMath, $pointPhy){
        self::$pointChems = $pointChem;
        self::$pointMaths = $pointMath;
        self::$pointPhys = $pointPhy;
        self::$names = $name;
        self::$years = $year;
        
        return number_format((($pointChem + $pointPhy + $pointMath) / 3), 2);
    }
    public static function getAverage($name, $year, $pointChem, $pointMath, $pointPhy){
        echo implode(" ", [
            "Diem trung binh ",
            $name, 
            $year, 
            Average::setAverage($name, $year, $pointChem, $pointMath, $pointPhy),
        ]);
    }
    
    public static function getAverage5($name, $year, $pointChem, $pointMath, $pointPhy){
        $average = Average::setAverage($name, $year, $pointChem, $pointMath, $pointPhy);
        if($average >= 5 ){
            echo implode(" ", [
                "Trung binh lon hon 5",
                $name, 
                $average,
            ]);
        }
    }
}
class Year extends Student{
    public function getYear()
    {     
        if($this->year == 2001){
            echo implode(" ",[ 
                $this->name,
                $this->year,
            ]);
        }
        return $this;
    }
}

class ListStudent{
    public static function getList(){
        return [
            ["A", 2001, 7, 8,9],
            ["B", 2002, 5, 4,3],
            ["C", 2001, 10, 10,9],
            ["D", 2002, 9, 8,9],
            ["E", 2000, 4, 5,5],
        ];
    }
}

class Main{
    public static function run()
    {
        $list = [];
        foreach (ListStudent::getList() as $student) {
            list($name, $year, $pointMath, $pointPhy, $pointChem) = $student;
            
            $list_average = new Average($name, $year, $pointMath, $pointPhy, $pointChem);
            echo "<br/>";
            echo "<br/>";
            $list_average->getAverage($name, $year, $pointMath, $pointPhy, $pointChem);
            // Lay danh sach trung binh
            $list_average5 = new Average($name, $year, $pointMath, $pointPhy, $pointChem);
            echo "<br/>";
            // danh sach diem lon hon 5
            $list_average5->getAverage5($name, $year, $pointMath, $pointPhy, $pointChem);
            
            // danh sach sinh nam 2001
            $list[] = new Year($name, $year, $pointMath, $pointPhy, $pointChem);
        }
        
        echo "<br/>";
        echo "Sinh nam 2001";
        foreach($list as $item){
            echo "<br/>";
            $item->getYear();
        }

    }
}
Main::run();
?>