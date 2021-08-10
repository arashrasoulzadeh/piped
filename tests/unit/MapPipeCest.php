<?php
use arashrasoulzadeh\piped\Piped;
use arashrasoulzadeh\piped\Pipes\MapPipe;

class MapPipeCest
{


    // tests
    public function mapPipeTest(UnitTester $I)
    {
        $pipe = Piped::build()->pipe(1,2,3)->through(
            [MapPipe::class,function($item,$index){
                return $item*2;
            }]
        );
        $I->assertEquals($pipe->output(),[2,4,6]);
    }
    public function mapPipeIndexTest(UnitTester $I)
    {
        $pipe = Piped::build()->pipe(1,2,3)->through(
            [MapPipe::class,function($item,$index){
                return $item*$index;
            }]
        );
        $I->assertEquals($pipe->output(),[0,2,6]);
    }
}
