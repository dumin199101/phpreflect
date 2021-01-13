<?php

/**
 * PHP 反射机制
 */
class Student
{
    private $name;
    private $age;

    /**
     * Student constructor.
     * @param $name
     * @param $age
     */
    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    public function say()
    {
        echo $this->name . ":" . $this->age . PHP_EOL;
    }



}

/**
 * 通过普通方式调用
 */
$student = new Student();
$student->setAge(22);
$student->setName("lisi");
$student->say();

/**
 * 通过反射方式调用
 */

//获取属性列表
$reflectionClass = new ReflectionClass(Student::class);
$reflectionProperties = $reflectionClass->getProperties();
foreach ($reflectionProperties as $reflectionProperty) {
    echo $reflectionProperty->getName() . PHP_EOL;
}

//获取方法列表
$reflectionMethods = $reflectionClass->getMethods();
foreach ($reflectionMethods as $reflectionMethod) {
    echo $reflectionMethod->getName() . PHP_EOL;
}

//调用方法
$newInstance = $reflectionClass->newInstance("zhangfei", 55);
$method = $reflectionClass->getMethod("say");
$method->invoke($newInstance);





