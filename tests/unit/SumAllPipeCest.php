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
    public function sumAllTest(UnitTester $I)
    {
        $range=$this->createRange(4); // 10
        $pipe = Piped::build()->pipe(...$range)->through(
            SumAllPipe::class
        );
        $I->assertEquals($pipe->output(),10);
    }


    public function sumAllSmallArrayTest(UnitTester $I)
    {
        $range=$this->createRange(5000); // 12502500
        $pipe = Piped::build()->pipe(...$range)->through(
            SumAllPipe::class
        );
        $I->assertEquals($pipe->output(),12502500);
    }


    public function sumAllLargeArrayTest(UnitTester $I)
    {
        $range=$this->createRange(10000); // 50005000
        $pipe = Piped::build()->pipe(...$range)->through(
            SumAllPipe::class
        );
        $I->assertEquals($pipe->output(),50005000);
    }

    public function sumAllHugeArrayTest(UnitTester $I)
    {
        $range=$this->createRange(999999); // 499999500000
        $pipe = Piped::build()->pipe(...$range)->through(
            SumAllPipe::class
        );
        $I->assertEquals($pipe->output(),499999500000);
    }

    public function sumAllWithNullArrayWithBreakTest(UnitTester $I)
    {
        $range=[1,2,null,3,null,4]; // 10
        $pipe = Piped::build()->pipe(...$range)->through(
            [SumAllPipe::class,false]
        );
        $I->assertEquals($pipe->output(),10);
    }

    public function sumAllWithNullArrayWithoutBreakTest(UnitTester $I)
    {
        $range=[1,2,null,3,null,4]; // 10
        $pipe = Piped::build()->pipe(...$range)->through(
            SumAllPipe::class
        );
        $I->assertEquals($pipe->output(),$range);
    }

}
