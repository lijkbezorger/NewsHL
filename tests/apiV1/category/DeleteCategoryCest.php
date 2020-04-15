<?php

namespace tests\apiV1\post;

use ApiV1Tester;
use Codeception\Util\HttpCode;
use tests\apiV1\BaseCest;
use tests\fixtures\activeRecords\CategoryFixture;

class DeleteCategoryCest extends BaseCest
{
    private $category;

    public function _before(ApiV1Tester $I)
    {
        parent::_before($I);

        $I->haveFixtures([
            'category' => [
                'class'    => CategoryFixture::class,
                'dataFile' => CategoryFixture::getDataFile(),
            ],
        ]);

        $this->category = $I->grabFixture('category', 'category0');
    }

    // tests
    public function deleteCategoryTest(ApiV1Tester $I)
    {
        $I->sendDELETE('/category/' . $this->category->id);
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
        $I->seeResponseEquals(null);
    }
}
