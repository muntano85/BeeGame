<?php
use PHPUnit\Framework\TestCase;

include 'BeeModel.php';
include 'BeeController.php';

class BeeControllerTest extends TestCase
{
    public function testHit()
    {
		$testModel = array(
			new BeeModel(BeeModel::QUEEN), 
			new BeeModel(BeeModel::QUEEN), 
			new BeeModel(BeeModel::QUEEN)
		);
		$initialLifespan = 0;
		foreach($testModel as $value) {
			$initialLifespan += $value->lifespan;
		}
		$testItem = new BeeController($testModel);
		$testItem->hit();
		$finalLifespan = 0;
		foreach($testModel as $value) {
			$finalLifespan += $value->lifespan;
		}
		$this->assertEquals(BeeModel::HITPOINT[BeeModel::QUEEN], ($initialLifespan-$finalLifespan));
		
		$testModel = array(
			new BeeModel(BeeModel::WORKER), 
			new BeeModel(BeeModel::WORKER), 
			new BeeModel(BeeModel::WORKER)
		);
		$initialLifespan = 0;
		foreach($testModel as $value) {
			$initialLifespan += $value->lifespan;
		}
		$testItem = new BeeController($testModel);
		$testItem->hit();
		$finalLifespan = 0;
		foreach($testModel as $value) {
			$finalLifespan += $value->lifespan;
		}
		$this->assertEquals(BeeModel::HITPOINT[BeeModel::WORKER], ($initialLifespan-$finalLifespan));
		
		$testModel = array(
			new BeeModel(BeeModel::DRONE), 
			new BeeModel(BeeModel::DRONE), 
			new BeeModel(BeeModel::DRONE)
		);
		$initialLifespan = 0;
		foreach($testModel as $value) {
			$initialLifespan += $value->lifespan;
		}
		$testItem = new BeeController($testModel);
		$testItem->hit();
		$finalLifespan = 0;
		foreach($testModel as $value) {
			$finalLifespan += $value->lifespan;
		}
		$this->assertEquals(BeeModel::HITPOINT[BeeModel::DRONE], ($initialLifespan-$finalLifespan));
		
		
		$testModel = array(
			new BeeModel(BeeModel::QUEEN), 
			new BeeModel(BeeModel::WORKER), 
			new BeeModel(BeeModel::DRONE)
		);
		$testItem = new BeeController($testModel);
		while($testModel[0]->isAlive()){
			$testItem->hit();
		}
		$this->assertFalse($testModel[1]->isAlive() && $testModel[1]->isAlive());
    }
	
}
?>