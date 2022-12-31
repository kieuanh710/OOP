<section>
    <form action="" method="post">
        <h2>Chọn con vật</h2>
        <select name="name">
            <option name="name" value="Meo">Mèo</option>
            <option name="name" value="Cho">Chó</option>
            <option name="name" value="Bo">Bò</option>
        </select>
        <button type="submit">Nhấn để nghe tiếng kêu</button>
    </form>
</section>

<?php 
class Animals{
    public $name;
    public function input(){
        $this->name = $_POST['name'];
    }
    public function speak(){
        if($this->name == "Meo"){
            echo "moew moew moew...";
        }
        else if($this->name == "Cho"){
            echo "gau gau gau...";
        }
        else if($this->name == "Bo"){
            echo "cow cow cow...";
        }
        else if($this->name == "Heo"){
            echo "pig pig pig...";
        }
        else{
            echo "Khong nhan dang";
        }
    }
}    
    if(isset($_POST['name'])):
        $animal = new Animals();
        $animal->input();
        $animal->speak();
    endif
?>