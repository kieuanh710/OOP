<?php
class Student{
    public $name, $year, $pointMath, $pointPhys, $pointChems;
    public function __construct($name, $year, $pointMath, $pointPhys, $pointChems){
        $this->name = $name;
        $this->year = $year;
        $this->pointMath = $pointMath;
        $this->pointPhys = $pointPhys;
        $this->pointChems = $pointChems;
    }
    
    public function getStudent(){
        return ([
            $this->name,
            $this->year,
            $this->pointMath,
            $this->pointChems,
            $this->pointPhys,
        ]);
    }
    
    public function average(){
        return number_format((($this->pointChems + $this->pointPhys + $this->pointMath) / 3), 2)."<br/>";
    }
    
    public function averageBigger5(){
        if(number_format((($this->pointChems + $this->pointPhys + $this->pointMath) / 3), 2) > 5){
            return self::getStudent();
        }
    }
    public function BornIn2001(){
        if($this->year == 2001){
            return true;
        }
        return false;
    }
}

class ListStudent{
    private $ListSV;
    public function __construct($ListSV){
        foreach ($ListSV as $value) {
            $this->ListSV[]= new Student($value[0], $value[1], $value[2],$value[3], $value[4]);
        }
    }
    public function averageList($min_score = 0){
        $aver_list = [];
        foreach ($this->ListSV as $value) {
            if ($value->average() > $min_score){
                $aver_list[] = $value->average();
            }
        }
        return $aver_list;
    }
    public function averageBigger5(){
        return self::averageList(5);
    }
    public function List2001(){
        $aver_list = [];
        foreach ($this->ListSV as $value) {
            if ($value->BornIn2001()){
                $aver_list[] = $value;
            }
        }
        return $aver_list;
    }
}

class Main{
    public static function run(){
        $list = [
            ["A", 2001, 7, 8, 9],
            ["B", 2002, 8, 7, 7],
            ["C", 2001, 10, 10, 9],
            ["D", 2002, 9, 8, 9],
            ["E", 2000, 4, 5, 5],
        ];
        
        $ds_sv = new ListStudent($list);
        echo "Danh sach sinh vien</br>";
        print_r($ds_sv);
        echo "</br></br> Danh sach diem trung binh</br>";
        print_r($ds_sv->averageList());
        echo "</br></br> Danh sach diem trung binh lon hon 5</br>";
        print_r($ds_sv->averageBigger5());
        echo "</br> Danh sach sinh nam 2001</br>";
        print_r($ds_sv->List2001());
    }
}
Main::run();
?>