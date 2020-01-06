<?php
interface CanGiveMilk {
    public function getMilk();
}

interface CanGiveEggs {
    public function getEggs();
}
// Коровы
class Cow implements CanGiveMilk {
    public $id;

    public function __construct() {
        $this->id = substr(md5(rand()), 0, 6); // Получаем 6-значный ID коровы
    }

    public function getMilk() {
        return rand(8, 12);
    }
}
// Курицы
class Hen implements CanGiveEggs {
    public $id;

    public function __construct() {
        $this->id = substr(md5(rand()), 0, 6); // Получаем 6-значный ID курицы
    }

    public function getEggs() {
        return rand(0, 1);
    }
}
// Хлев
class Barn {
    private $milkLiters = 0;
    private $eggsCount = 0;
    private $animals = [];
    

    public function addAnimal($animal) {
        $this->animals[] = $animal;
    }

    public function addMilk($liters) {
        $this->milkLiters += $liters;
    }
    public function addEggs($eggs) {
        $this->eggsCount += $eggs;
    }

    public function collectProducts() { //Сбор продукции
        foreach ($this->animals as $animal) {
            if ($animal instanceof CanGiveMilk) {
                $milkLiters = $animal->getMilk();
                $this->addMilk($milkLiters);
            }
            if ($animal instanceof CanGiveEggs) {
                $eggsCount = $animal->getEggs();
                $this->addEggs($eggsCount);
            }
        }
    }

    public function howMuchMilk() {
        return $this->milkLiters;
    }
    public function howMuchEggs() {
        return $this->eggsCount;
    }

    public function returnMilk() {
       return $this->howMuchMilk();
    }

    public function returnEggs() {
       return $this->howMuchEggs();
    }
}

$barn = new Barn();
for ($i=0; $i <= 10; $i++) { // Добавляем 10 коров
    $barn->addAnimal(new Cow());
}
for ($i=0; $i <= 20; $i++) { // Добавляем 20 куриц
    $barn->addAnimal(new Hen());
}
$barn->collectProducts();
echo 'Ферма дядюшки Боба' . "\n";
echo 'Молока собрано: ' . $barn->returnMilk() . ' л.' . "\n";
echo 'Яиц собрано: ' . $barn->returnEggs() . ' шт.';
?>