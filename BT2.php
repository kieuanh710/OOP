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
    public function xuatThongTinHocSinh(){
        echo implode(" ", [
            $this->name,
            $this->year,
            $this->getAverage(),
        ]);
    }
    public function getAverage(){
        return number_format((($this->pointChem + $this->pointPhy + $this->pointMath) / 3), 2);
        
    }
    public function getYear()
    {     
        return $this->year;
    }
}
class QuanLyHocSinh{
    public function layDuLieuHocSinh(){
        $du_lieu_HS = [
            ["A", 2001, 7, 8,9],
            ["B", 2002, 5, 4,3],
            ["C", 2001, 10, 10,9],
            ["D", 2002, 9, 8,9],
            ["E", 2000, 4, 5,5],
        ];
        $listHocSinh = [];
        foreach($du_lieu_HS as $student){
            list($name, $year, $pointMath, $pointPhy, $pointChem) = $student;
            $listHocSinh[] = new Student($name, $year, $pointMath, $pointPhy, $pointChem);
        }
        return $listHocSinh;
    }
    public function xuatDanhSachHS($listHocSinh){
        foreach($listHocSinh as $item){
            $item->xuatThongTinHocSinh();
        }
    }
    
    public static function xuatTBLonHon5($listHocSinh){
        foreach($listHocSinh as $item){
            if($item->getAverage() > 5){
                $item->xuatThongTinHocSinh();
            }
        }
    }
    public function xuatHSNam2001($listHocSinh){
        foreach($listHocSinh as $item){
            if($item->getyear() == 2001){
                $item->xuatThongTinHocSinh();
            }
        }
    }
}

class Main{
    public static function run()
    {
        $truong = new QuanLyHocSinh();
        $listHocSinh = $truong->layDuLieuHocSinh();

        echo "Danh sach diem trung binh: <br>";
        $truong->xuatDanhSachHS($listHocSinh);        
        
        echo "<br>Danh sach diem trung binh lon hon 5: <br>" ;

        $truong->xuatTBLonHon5($listHocSinh);     

        echo "<br>Danh sach diem trung binh: <br>";
        $truong->xuatHSNam2001($listHocSinh);     
    }
}
Main::run();
?>