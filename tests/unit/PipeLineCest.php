<?php
use arashrasoulzadeh\piped\Piped;
use arashrasoulzadeh\piped\Pipes\MapPipe;

class PipeLineCest
{

    // tests
    public function emptyPipeTest(UnitTester $I)
    {
        $pipe = Piped::build()->pipe(null);
        $I->assertNull($pipe->output());
    }
    public function emptyPipeThroughTest(UnitTester $I)
    {
        $pipe = Piped::build()->pipe(null)->through();
        $I->assertNull($pipe->output()[0]);
    }
    public function mapPipeThroughTest(UnitTester $I)
    {
        $pipe = Piped::build()->pipe(2)->through(
            [MapPipe::class,function($item,$index){
                return $item*2;
            }]
        );
        $I->assertEquals($pipe->output()[0],4);
    }
    public function multipleMapPipeThroughTest(UnitTester $I)
    {
        $pipe = Piped::build()->pipe(2)->through(
            [MapPipe::class,function($item,$index){
                return $item*2;
            }],
            [MapPipe::class,function($item,$index){
                return $item+2;
            }],
            [MapPipe::class,function($item,$index){
                return $item/2;
            }],

        );
        $I->assertEquals($pipe->output()[0],3);
    }
}
