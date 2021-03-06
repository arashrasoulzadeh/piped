<?php
use arashrasoulzadeh\piped\Piped;
use arashrasoulzadeh\piped\Pipes\NotNullPipe;
use arashrasoulzadeh\piped\Pipes\ConcatAllPipe;

class NotNullPipeCest
{


    // tests
    public function notNullBreakTest(UnitTester $I)
    {
        $pipe = Piped::build()->pipe(null,'b','c')->through(
            NotNullPipe::class,
            ConcatAllPipe::class
        );
        $I->assertEquals($pipe->output(),[null,'b','c']);
    }
    public function notNullAllItemsBreakTest(UnitTester $I)
    {
        $pipe = Piped::build()->pipe('a',null,'c')->through(
            [NotNullPipe::class,'*'],
            ConcatAllPipe::class
        );
        $I->assertEquals($pipe->output(),['a',null,'c']);
    }
    public function notNullCustomItemBreakTest(UnitTester $I)
    {
        $pipe = Piped::build()->pipe('a',null,'c')->through(
            [NotNullPipe::class,[1]],
            ConcatAllPipe::class
        );
        $I->assertEquals($pipe->output(),['a',null,'c']);
    }
}
