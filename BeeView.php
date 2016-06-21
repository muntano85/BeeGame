<?php
class BeeView
{
    private $model;
    private $controller;

    public function __construct($controller,$model) {
        $this->controller = $controller;
        $this->model = $model;
    }

    public function output() {
		$output = "";
		$deadQueen = false;
		foreach ($this->model as $key=>$value) {
			if($value->isQueen()){
				$output.=" QUEEN is ";
				if(!$value->isAlive()){
					$output.="dead <br />";
					$deadQueen = true;
					break;
				}
			}
			if($value->isWorker()){
				$output.=" WORKER ".$key." is ";
			}
			if($value->isDrone()){
				$output.=" DRONE ".$key." is ";
			}
			$output.=($value->isAlive() ? "alive" : "dead")." - LIFESPAN: ".$value->lifespan."<br />";
		}
		if($deadQueen) {
			$output.="<a href='index.php?action=restart'><input type='button' value='Restart!' /></a>";
			session_destroy();
		}else{
			$output.="<a href='index.php?action=hit'><input type='button' value='Hit!' /></a>";
		}
		return $output;
    }
}