<?php

namespace tests\apiV1\post;

use ApiV1Tester;
use Codeception\Util\HttpCode;
use tests\apiV1\BaseCest;
use tests\fixtures\activeRecords\CategoryFixture;

class PostPostCest extends BaseCest
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
    public function postPostTest(ApiV1Tester $I)
    {
        $post = [
            'content'     => 'Content',
            'preview'     => 'Preview',
            'isPublished' => true,
            'categoryId'  => $this->category->id,
        ];

        $I->sendPOST('/post', $post);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContains(json_encode($post['content']));
        $I->seeResponseContains(json_encode($post['preview']));
    }
}
