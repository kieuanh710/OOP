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
abstract class Animals{
    // protected $className;
    // public function canSpeak(){
    //     return ($className == $this->className);
    // }
    abstract public function speak();
} 
class Cat extends Animals{
    // protected $classname = "Meo";
    // public function canSpeak($className){
    //     switch ($className){
    //         case "Meo":
    //         case "MeoTamthe":
    //             return true;        
    //     }
    //     return false;
    // }
    public function speak(){
        echo "moew moew moew";
    }
} 
class Dog extends Animals{
    public function speak(){
        echo "gau gau gau";
    }
} 
class Cow extends Animals{
    public function speak(){
        echo "bo bo bo";
    }
}  

class God{
    public static function generateAnimal($className){
        switch ($className){
            case 'Meo':
            case 'MeoTamThe':
                return new Cat();
            case 'Cho':
                return new Dog();
            case 'Bo':
                return new Cow();
        }
        return null;
    }
}
class Main{
    public static function run(){
        if(!empty($_POST['name'])){
            $className = $_POST['name'];
            $animal = God::generateAnimal($className);
            if($animal){
                $animal->speak();
            }
        }
    }
}
Main::run();   
?>