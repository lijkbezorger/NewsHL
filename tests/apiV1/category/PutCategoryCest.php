<?php

namespace tests\apiV1\post;

use ApiV1Tester;
use Codeception\Util\HttpCode;
use tests\apiV1\BaseCest;
use tests\fixtures\activeRecords\CategoryFixture;

class PutCategoryCest extends BaseCest
{
    private $category;

    public function _before(ApiV1Tester $I)
    {
        parent::_before($I);

        $I->haveFixtures([
            'post' => [
                'class'    => CategoryFixture::class,
                'dataFile' => CategoryFixture::getDataFile(),
            ],
        ]);

        $this->category = $I->grabFixture('category', 'category0');
    }

    // tests
    public function putPostTest(ApiV1Tester $I)
    {
        $post = [
            'name'     => $this->category->name,
            'isActive' => false,
        ];

        $I->sendPUT('/category/' . $this->category->id, $post);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContains(json_encode($post['name']));
        $I->seeResponseContains(json_encode($post['isActive']));
    }
}
