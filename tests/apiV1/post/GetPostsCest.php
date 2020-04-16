<?php

namespace tests\apiV1\post;

use ApiV1Tester;
use Codeception\Util\HttpCode;
use tests\apiV1\BaseCest;
use tests\fixtures\activeRecords\CategoryFixture;
use tests\fixtures\activeRecords\PostFixture;

class GetPostsCest extends BaseCest
{
    public function _before(ApiV1Tester $I)
    {
        parent::_before($I);

        $I->haveFixtures([
            'category' => [
                'class'    => CategoryFixture::class,
                'dataFile' => CategoryFixture::getDataFile(),
            ],
            'post'     => [
                'class'    => PostFixture::class,
                'dataFile' => PostFixture::getDataFile(),
            ],
        ]);
    }

    // tests
    public function getPostsTest(ApiV1Tester $I)
    {
        $I->sendGET('/posts');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->canSeeResponseMatchesJsonType([
            'id'          => 'integer',
            'preview'     => 'string',
            'publishedAt' => 'integer|null',
        ], '$[0]');
    }
}
