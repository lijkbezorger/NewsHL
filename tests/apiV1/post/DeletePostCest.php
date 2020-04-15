<?php

namespace tests\apiV1\post;

use ApiV1Tester;
use Codeception\Util\HttpCode;
use tests\apiV1\BaseCest;
use tests\fixtures\activeRecords\PostFixture;

class DeletePostCest extends BaseCest
{
    private $post;

    public function _before(ApiV1Tester $I)
    {
        parent::_before($I);

        $I->haveFixtures([
            'post' => [
                'class'    => PostFixture::class,
                'dataFile' => PostFixture::getDataFile(),
            ],
        ]);

        $this->post = $I->grabFixture('post', 'post0');
    }

    // tests
    public function deletePostTest(ApiV1Tester $I)
    {
        $I->sendDELETE('/post/' . $this->post->id);
        $I->seeResponseCodeIs(HttpCode::NO_CONTENT);
        $I->seeResponseEquals(null);
    }
}
