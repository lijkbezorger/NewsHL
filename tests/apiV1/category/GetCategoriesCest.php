<?php

namespace tests\apiV1\category;

use ApiV1Tester;
use Codeception\Util\HttpCode;
use tests\apiV1\BaseCest;
use tests\fixtures\activeRecords\CategoryFixture;

class GetCategoriesCest extends BaseCest
{
    public function _before(ApiV1Tester $I)
    {
        parent::_before($I);

        $I->haveFixtures([
            'category' => [
                'class'    => CategoryFixture::class,
                'dataFile' => CategoryFixture::getDataFile(),
            ],
        ]);
    }

    // tests
    public function getCategoriesTest(ApiV1Tester $I)
    {
        $I->sendGET('/categories');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->canSeeResponseMatchesJsonType([
            'id'          => 'integer',
            'name'        => 'string',
            'postsAmount' => 'integer',
        ], '$[0]');
    }
}
