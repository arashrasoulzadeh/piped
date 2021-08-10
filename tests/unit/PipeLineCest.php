<?php
use arashrasoulzadeh\piped\Piped;

class PipeLineCest
{

    // tests
    public function sampleEmptyPipeTest(UnitTester $I)
    {
        $pipe = Piped::build()->pipe(null);
        $I->assertNull($pipe->output());
    }
     public function sampleEmptyPipeThroughTest(UnitTester $I)
    {
        $pipe = Piped::build()->pipe(null)->through();
        $I->assertNull($pipe->output()[0]);
    }
}
