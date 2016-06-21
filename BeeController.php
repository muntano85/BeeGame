<?php
class BeeController
{
    private $model;

    public function __construct($model){
        $this->model = $model;
    }

    public function hit() {
		$hitSuccess = false;
		while(!$hitSuccess){
			$randomBee = rand(0 , (count($this->model)-1));
			if($this->model[$randomBee]->isAlive()) {
				$this->model[$randomBee]->hit();
				if($this->model[$randomBee]->isQueen() && !$this->model[$randomBee]->isAlive()){
					foreach ($this->model as &$value) {
						$value->kill();
					}
				}
				$hitSuccess = true; 
			}
		}
    }

    public function restart() {
		
    }
}