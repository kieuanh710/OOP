<section>
    <form action="" method="post">
        <h3>Nhập số</h3>
        <input type="text" name="array">
        <h3>Chọn thuật toán sắp xếp</h3>
        <select name="name">
            <option value="Quick_Sort">Quick Sort</option>
            <option value="Insersion_Sort">Insersion Sort</option>
            <option value="Merge_Sort">Merge Sort</option>
        </select>
        <select name="kieuxuat">
            <option value="thuong">Simple</option>
            <option value="table">Table</option>
        </select>
        <button type="submit">Nhấn để sắp xếp</button>
    </form>
</section>


<?php 


interface IThuatToan{
  public function sort($arr);
}

interface IXuatDanhSach{
  public function xuatSapXep($arr);
}

class XuatDuLieu implements IXuatDanhSach{
  public function xuatSapXep($arr){
    echo implode(" ", $arr);
  }
}

class XuatTable implements IXuatDanhSach{
  
	/**
	 * @param mixed $arr
	 * @return mixed
	 */
	public function xuatSapXep($arr) {
    $output = [];
    $output[] = '<table>';
    $output[] = '<tr>';
    foreach($arr as $num){
      $output[] = sprintf('<td>%d</td>', $num);
    }
    $output[] = '</tr>';
    $output[] = '</table>';
    echo implode('', $output);
	}
}


class QuickSort implements IThuatToan{
  public function sort($arr){
    $length = count($arr);
    if($length <= 1){
      return $arr;
    } 
    else{
      $pivot = $arr[0];
      $left = array();
      $right = array();
      for ($i = 1; $i < count($arr); $i++){
        if($arr[$i] < $pivot){
          $left[] = $arr[$i];
        } else {
          $right[] = $arr[$i];
        }
      }
      return (
        array_merge(
          self::sort($left),
          array($pivot), 
          self::sort($right)
        )
      );
    }
  }
}

class InsersionSort implements IThuatToan{
  public function sort($arr){
    $lenght = count($arr);
    for($i = 0; $i < $lenght; $i++){
      $val = $arr[$i];
      $j = $i - 1;
      while($j >= 0 && $arr[$j] > $val){
        $arr[$j + 1] = $arr[$j];
        $j--;
      }
      $arr[$j + 1] = $val;
    }
    return $arr;
  }
}

class MergeSort implements IThuatToan{
  public function sort($arr){
    $length = count($arr);
    if($length == 1 ) 
      return $arr;
    $mid = $length / 2;
      $left = array_slice($arr, 0, $mid);
      $right = array_slice($arr, $mid);
    $left = self::sort($left);
    $right = self::sort($right);
    return $this->merge($left, $right);
  }
  public function merge($left, $right){
    $res = array();
    while (count($left) > 0 && count($right) > 0){
      if($left[0] > $right[0]){
        $res[] = $right[0];
        $right = array_slice($right , 1);
      }else{
        $res[] = $left[0];
        $left = array_slice($left, 1);
      }
    }
    while (count($left) > 0){
      $res[] = $left[0];
      $left = array_slice($left, 1);
    }
    while (count($right) > 0){
      $res[] = $right[0];
      $right = array_slice($right, 1);
    }
    return $res;
  }
}

class QuanLyThuatToan{
  
  /**
   * Summary of layDuLieu
   * @param string $name
   * @return IThuatToan
   */
  public static function khoiTaoThuatToan($name){
    // $arr = [5,3,8,6,2,7];
    switch($name){
      case 'Quick_Sort':
        return new QuickSort();
      case 'Insersion_Sort':
        return new InsersionSort();
    }
    return new MergeSort();
    // var_dump ($arr);
    // return $arr;
  }
}

class Main{
  public static function run()
  {
    if(!empty($_POST['name'])){
      $className = $_POST['name'];
      $thuat_toan = QuanLyThuatToan::khoiTaoThuatToan($className);
      
      $arr = explode(',', $_POST['array']);
      $attr = $thuat_toan->sort($arr);
      
      switch($_POST['kieuxuat']){
        case 'table':
           $xuatDuLieu = new XuatTable();
          break;
        default:
          $xuatDuLieu = new XuatDuLieu();
      }

      $xuatDuLieu->xuatSapXep($attr);
    }
  }
}
Main::run();   
?>