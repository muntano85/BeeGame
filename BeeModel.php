<?php
class BeeModel
{
	const QUEEN = 1;
	const WORKER = 2;
	const DRONE = 3;
	
	const LIFESPAN = array(
		self::QUEEN => 100,
		self::WORKER => 75,
		self::DRONE => 50,
	);
	
	const HITPOINT = array(
		self::QUEEN => 8,
		self::WORKER => 10,
		self::DRONE => 12,
	);
	
	public $type;
	public $lifespan;
	
    public function __construct($type){
		$this->type = $type;
		$this->lifespan = self::LIFESPAN[$type];
    }
	
	public function isAlive(){
		return ($this->lifespan>0 ? true : false);
	}
	
	public function isQueen(){
		return ($this->type==self::QUEEN);
	}
	
	public function isWorker(){
		return ($this->type==self::WORKER);
	}
	
	public function isDrone(){
		return ($this->type==self::DRONE);
	}
	
	public function kill(){
		$this->lifespan = 0;
	}
	
	public function hit(){
		$this->lifespan = $this->lifespan - self::HITPOINT[$this->type];
	}
	
	public static function createRandomHive(){
		
		$MIN_LENGTH = 3;
		$MAX_LENGTH = 10;
		
		$numberOfBees = rand($MIN_LENGTH , $MAX_LENGTH);
		$hive = array(
			new BeeModel(self::QUEEN)	
		);
		for($i=1; $i<=$numberOfBees; $i++){
			$randomBeeType = rand(self::WORKER , self::DRONE);
			array_push($hive , new BeeModel($randomBeeType));
		}
		return $hive;
	}

}