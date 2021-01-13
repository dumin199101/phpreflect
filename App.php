<?php

class App
{
    public function run(View $view)
    {
        echo $view->display();
    }
}

class View
{
    private $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function display(): string
    {
        return $this->content;
    }
}

$reflectorApp = new ReflectionClass(App::class);
//获取App::run方法的ReflectionMethod对象
$reflectionMethod = $reflectorApp->getMethod("run");
$params = $reflectionMethod->getParameters();
//params是ReflectionParameter对象的数组
foreach ($params as $param) {
    $reflector = $param->getClass();
    //依赖注入的参数应该由容器来管理，这里仅仅用于展示，就直接new了
    if ($reflector->getName() == 'View') {
        $reflectionViewClass = new ReflectionClass(View::class);
        $reflectionMethod->invoke($reflectorApp->newInstance(),$reflectionViewClass->newInstance('hello'));
    }
}

