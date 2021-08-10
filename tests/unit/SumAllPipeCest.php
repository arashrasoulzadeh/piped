<?php
use arashrasoulzadeh\piped\Piped;
use arashrasoulzadeh\piped\Pipes\SumAllPipe;

class SumAllPipeCest
{

    private function createRange(int $max){
        $range = [];
        for ($i = 0;$i<=$max;$i++){
            $range[]=$i;
        }
        return $range;
    }

    // tests
    public function sampleSumAllTest(UnitTester $I)
    {
        $range=$this->createRange(4); // 10
        $pipe = Piped::build()->pipe(...$range)->through(
            SumAllPipe::class
        );
        $I->assertEquals($pipe->output(),10);
    }


    public function sampleSumAllSmallArrayTest(UnitTester $I)
    {
        $range=$this->createRange(5000); // 50005000
        $pipe = Piped::build()->pipe(...$range)->through(
            SumAllPipe::class
        );
        $I->assertEquals($pipe->output(),12502500);
    }


    public function sampleSumAllLargeArrayTest(UnitTester $I)
    {
        $range=$this->createRange(10000); // 50005000
        $pipe = Piped::build()->pipe(...$range)->through(
            SumAllPipe::class
        );
        $I->assertEquals($pipe->output(),50005000);
    }

    public function sampleSumAllHugeArrayTest(UnitTester $I)
    {
        $range=$this->createRange(999999); // 50005000
        $pipe = Piped::build()->pipe(...$range)->through(
            SumAllPipe::class
        );
        $I->assertEquals($pipe->output(),499999500000);
    }

}
