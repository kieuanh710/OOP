<?php 
abstract class NhanVien{
    protected $ten, $nam_sinh, $chuc_vu, $luong_co_ban, $nam_kinh_nghiem;
    public function __construct($ten, $nam_sinh, $chuc_vu, $nam_kinh_nghiem, $luong_co_ban){
        $this->ten = $ten;
        $this->nam_sinh = $nam_sinh;
        $this->chuc_vu = $chuc_vu;
        $this->nam_kinh_nghiem = $nam_kinh_nghiem;
        $this->luong_co_ban = $luong_co_ban;
    } 
    public function xuatThongTinNhanVien(){
        echo implode(" ", [
            $this->ten,
            $this->nam_sinh,
            $this->chuc_vu,
            $this->getLuong(),
        ]);
    }
    abstract public function getLuong();
} 
class LapTrinh extends NhanVien{
    public function getLuong(){
        return $this->luong_co_ban * 150 + $this->luong_co_ban * (0.5 * $this->nam_kinh_nghiem);
    }
} 
class BanHang extends NhanVien{
    private $doanh_so;
    public function __construct($ten, $nam_sinh, $chuc_vu, $nam_kinh_nghiem, $luong_co_ban, $doanh_so){
        parent::__construct($ten, $nam_sinh, $chuc_vu, $nam_kinh_nghiem, $luong_co_ban);
        $this->doanh_so = $doanh_so;
    } 
    public function getLuong(){
        return $this->luong_co_ban * 30 + intval($this->doanh_so) * 15;
    }
}
class LeTan extends NhanVien{
    public function getLuong(){
        return intval($this->luong_co_ban * 30 + $this->luong_co_ban * (0.2 * $this->nam_kinh_nghiem));
    }
}  
class GiamDoc extends NhanVien{
    public function getLuong(){
        return $this->luong_co_ban * $this->nam_kinh_nghiem;
    }
}

class QuanLyNhanVien{
    public function layDuLieuNhanVien(){
        $dataNV = [
            ["Van A", 1997, "LeTan", null, 1, 7000], 
            ["Le B", 1995, "LeTan", null, 3, 12000],
            ["Ma C", 1999, "BanHang", 5, 1, 7500],
            ["Nguyen D", 1994, "BanHang", 12, 3, 15000],              
            ["Mai E", 1988, "BanHang", 23, 7, 25000],              
            ["Tran F", 1993, "LapTrinh", null, 5, 40000],              
            ["Ly G", 2000, "LapTrinh", null, 1, 8000],              
            ["Pham H", 1997, "LapTrinh", null, 2, 1500],              
            ["Hoang I", 1997, "BanHang", 8, 2, 100000],           
            ["Trinh J", 1998, "LeTan", null, 1, 7000],         
            ["Dao K", 1985, "GiamDoc", null, 7, 50000],
        ];
        
        $listNhanVien = [];
        foreach($dataNV as $nhanvien){
            list($ten, $nam_sinh, $chuc_vu, $doanh_so, $nam_kinh_nghiem, $luong_co_ban) = $nhanvien;
            if(($chuc_vu == "LapTrinh")){
                $listNhanVien[] = new LapTrinh($ten, $nam_sinh, $chuc_vu, $nam_kinh_nghiem, $luong_co_ban);
            } else if(($chuc_vu == "BanHang")){
                $listNhanVien[] = new BanHang($ten, $nam_sinh, $chuc_vu, $nam_kinh_nghiem, $luong_co_ban, $doanh_so);
            } else if(($chuc_vu == "LeTan")){
                $listNhanVien[] = new LeTan($ten, $nam_sinh, $chuc_vu, $nam_kinh_nghiem, $luong_co_ban);
            } else if(($chuc_vu == "GiamDoc")){
                $listNhanVien[] = new GiamDoc($ten, $nam_sinh, $chuc_vu, $nam_kinh_nghiem, $luong_co_ban); 
            }
        }
        return $listNhanVien;
    }

    // public function xuatThongTin($listNhanVien){
    //     foreach ($listNhanVien as $item) {
    //         $item->xuatThongTinNhanVien();
    //         echo "<br>";
    //     }  
    // }
    public function tinhTongLuong($listNhanVien){
        $tongLuong = 0;
        foreach($listNhanVien as $item){
            $tongLuong += $item->getLuong();        
        }
        return $tongLuong;
    }
    public function xuatTongLuong($listNhanVien){
        echo $this->tinhTongLuong($listNhanVien);
        echo "<br>";
    }
      
    public function xuatLuongCaoNhat($listNhanVien){
        $max = $listNhanVien[0]->getLuong();
        foreach($listNhanVien as $item){
            if (($item->getLuong()) > $max) {
                $max = $item->getLuong();
            }
        }
        foreach($listNhanVien as $item){
            if (($item->getLuong()) ==  $max) {
                $item->xuatThongTinNhanVien();
                echo "<br>";
            }
        }
        // echo $max;
    }

    public function xuatLuongThapNhat($listNhanVien){
        $min = $listNhanVien[0]->getLuong();
        foreach($listNhanVien as $item){
            if (($item->getLuong()) < $min) {
                $min = $item->getLuong();
            }
        }
        foreach($listNhanVien as $item){
            if (($item->getLuong()) ==  $min) {
                $item->xuatThongTinNhanVien();
                echo "<br>";
            }
        }
        // echo $min;
    }

    public function tinhTBLuong($listNhanVien){
        $length = count($listNhanVien);
        $tbLuong = 0;
        $tongLuong = $this->tinhTongLuong($listNhanVien);
        $tbLuong = floatval($tongLuong / $length);
        return $tbLuong;
    }
    public function xuatTBLuong($listNhanVien){
        echo $this->tinhTBLuong($listNhanVien);
        echo "<br>";
    }
    
    public function xuatNVLuongNhoHonTB($listNhanVien){
        foreach($listNhanVien as $item){
            if ($item->getLuong() < $this->tinhTBLuong($listNhanVien)) {
                $item->xuatThongTinNhanVien();
                echo "<br>";
            }
        }
    }
    public function xuatNVLuongLonHonTB($listNhanVien){
        foreach($listNhanVien as $item){
            if ($item->getLuong() > $this->tinhTBLuong($listNhanVien)) {
                $item->xuatThongTinNhanVien();
                echo "<br>";
            }
        }
    }
}
class Main{
    public static function run(){
        $congty = new QuanLyNhanVien();
        $listNhanVien = $congty->layDuLieuNhanVien();
        // $congty->xuatThongTin($listNhanVien);     
        
        echo "Tong luong phai tra: <br>";  
        $congty->xuatTongluong($listNhanVien);     
        
        echo "<br>Luong cao nhat: <br>";
        $congty->xuatLuongCaoNhat($listNhanVien);   
        
        echo "<br>Luong thap nhat: <br>";
        $congty->xuatLuongThapNhat($listNhanVien);
        
        echo "<br>Trung binh luong: ";
        $congty->xuatTBLuong($listNhanVien);
        
        echo "<br>Danh sach nhan vien luong nho hon TB: <br>";
        $congty->xuatNVLuongNhoHonTB($listNhanVien);     
        
        echo "<br>Danh sach nhan vien luong lon hon TB: <br>";
        $congty->xuatNVLuongLonHonTB($listNhanVien);   

    }
}
Main::run();   
?>