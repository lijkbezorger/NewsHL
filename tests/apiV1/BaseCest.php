<?php

namespace tests\apiV1;

use ApiV1Tester;

class BaseCest
{
    public function _before(ApiV1Tester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
    }
}
