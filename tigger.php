<?php

class Tigger {

    public static $roarCount = 0;

    private static $instances = [];

    protected function __construct() {
            echo "Building character...<br/>" . PHP_EOL;
    }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public function roar() {
            echo "Grrr!<br/>" . PHP_EOL ;
            self::$roarCount ++;
    }

    public static function getInstance (): Tigger {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function getCounter() {
        return self::$roarCount;
    }

}


$t1 = Tigger::getInstance();
$t2 = Tigger::getInstance();

//Provem que funcioni el singleton
if ($t1 === $t2) {
    echo "Singleton works, both variables contain the same instance.<br/>";
} else {
    echo "Singleton failed, variables contain different instances.<br/>";
}



$t1->roar();
$t2->roar();
$t1->roar();
$t2->roar();
echo "Amb la variable t1 el nombre de roars és: " . $t1->getCounter() . "<br/>";
echo "Amb la variable t2 el nombre de roars és: " . $t2->getCounter() . "<br/>";
$t1->roar();
$t2->roar();
$t1->roar();
$t2->roar();
$t2->roar();
echo "Amb la variable t1 el nombre de roars és: " . $t1->getCounter() . "<br/>";
echo "Amb la variable t2 el nombre de roars és: " . $t2->getCounter() . "<br/>";
if ($t1->getCounter() === $t2->getCounter()) {
    echo "Funciona, els dos comptadors són iguals.<br/>";
} else {
    echo "Error, els dos comptadors són diferents.<br/>";
}
?>