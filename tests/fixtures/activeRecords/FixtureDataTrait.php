<?php

namespace tests\fixtures\activeRecords;

use yii\test\Fixture;

trait FixtureDataTrait
{
    public static function getDataFile() {
        /** @var Fixture $holder */
        $holder = new self();

        return $holder->dataFile;
    }
}
