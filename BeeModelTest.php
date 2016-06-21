<?php
use PHPUnit\Framework\TestCase;

include 'BeeModel.php';

class BeeModelTest extends TestCase
{
    public function testIsAlive()
    {
		$testItem = new BeeModel(BeeModel::QUEEN);
		$this->assertEquals(true, $testItem->isAlive());
		
		$testItem->kill();
		$this->assertEquals(false, $testItem->isAlive());
    }
	
    public function testIsQueen()
    {
		$testItem = new BeeModel(BeeModel::QUEEN);
		$this->assertEquals(true, $testItem->isQueen());
		
		$testItem = new BeeModel(BeeModel::WORKER);
		$this->assertEquals(false, $testItem->isQueen());
		
		$testItem = new BeeModel(BeeModel::DRONE);
		$this->assertEquals(false, $testItem->isQueen());
    }
	
    public function testIsWorker()
    {
		$testItem = new BeeModel(BeeModel::QUEEN);
		$this->assertEquals(false, $testItem->isWorker());
		
		$testItem = new BeeModel(BeeModel::WORKER);
		$this->assertEquals(true, $testItem->isWorker());
		
		$testItem = new BeeModel(BeeModel::DRONE);
		$this->assertEquals(false, $testItem->isWorker());
    }
	
    public function testIsDrone()
    {
		$testItem = new BeeModel(BeeModel::QUEEN);
		$this->assertEquals(false, $testItem->isDrone());
		
		$testItem = new BeeModel(BeeModel::WORKER);
		$this->assertEquals(false, $testItem->isDrone());
		
		$testItem = new BeeModel(BeeModel::DRONE);
		$this->assertEquals(true, $testItem->isDrone());
    }
	
    public function testKill()
    {
		$testItem = new BeeModel(BeeModel::QUEEN);
		$testItem->kill();
		$this->assertEquals(false, $testItem->isAlive());
    }
	
    public function testHit()
    {
		$testItem = new BeeModel(BeeModel::QUEEN);
		$testItem->hit();
		$expectedValue = BeeModel::LIFESPAN[BeeModel::QUEEN] - BeeModel::HITPOINT[BeeModel::QUEEN];
		$this->assertEquals($expectedValue, $testItem->lifespan);
    }
	
	public function testCreateRandomHive(){
		$testItem = BeeModel::createRandomHive();
		
		$this->assertGreaterThanOrEqual(4, count($testItem));
		
		$expectedTrue = true;
		foreach($testItem as $value) {
			$expectedTrue = $expectedTrue && ($value instanceof BeeModel);
		}
		$this->assertTrue($expectedTrue);
		
		$this->assertTrue($testItem[0]->isQueen());
		
		$expectedTrue = true;
		foreach($testItem as $key=>$value) {
			if($key!=0){
				$expectedTrue = $expectedTrue && ($value->isWorker() || $value->isDrone());
			}
		}
		$this->assertTrue($expectedTrue);
	}
}
?>