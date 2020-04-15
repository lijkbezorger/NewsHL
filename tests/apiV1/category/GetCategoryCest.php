<?php

namespace tests\apiV1\post;

use ApiV1Tester;
use Codeception\Util\HttpCode;
use tests\apiV1\BaseCest;
use tests\fixtures\activeRecords\CategoryFixture;

class GetCategoryCest extends BaseCest
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
    public function getCategoryTest(ApiV1Tester $I)
    {
        $I->sendGET('/category/' . $this->category->id);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->canSeeResponseMatchesJsonType([
            'id'          => 'integer',
            'name'        => 'string',
            'isActive'    => 'integer',
            'postsAmount' => 'integer',
        ]);
    }
}
