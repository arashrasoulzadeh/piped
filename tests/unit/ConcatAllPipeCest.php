<?php
use arashrasoulzadeh\piped\Piped;
use arashrasoulzadeh\piped\Pipes\ConcatAllPipe;

class ConcatAllPipeCest
{

    // tests
    public function concatAllTest(UnitTester $I)
    {
        $pipe = Piped::build()->pipe('a','b','c')->through(
            ConcatAllPipe::class
        );
        $I->assertEquals($pipe->output(),'a b c');
    }
    public function concatAllCustomParamTest(UnitTester $I)
    {
        $pipe = Piped::build()->pipe('a','b','c')->through(
            [ConcatAllPipe::class,"-"]
        );
        $I->assertEquals($pipe->output(),'a-b-c');
    }
    public function concatAllCustomParamWithNullArgTest(UnitTester $I)
    {
        $pipe = Piped::build()->pipe('a','b',null,'c')->through(
            [ConcatAllPipe::class,"-"]
        );
        $I->assertEquals($pipe->output(),'a-b-c');
    }
    public function concatAllCustomArgParamWithNullArgTest(UnitTester $I)
    {
        $pipe = Piped::build()->pipe('a','b',null,'c')->through(
            [ConcatAllPipe::class,null]
        );
        $I->assertEquals($pipe->output(),'a b c');
    }
}
