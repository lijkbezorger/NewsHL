<?php

namespace tests\apiV1\post;

use ApiV1Tester;
use Codeception\Util\HttpCode;
use tests\apiV1\BaseCest;
use tests\fixtures\activeRecords\PostFixture;

class PutPostCest extends BaseCest
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
    public function putPostTest(ApiV1Tester $I)
    {
        $post = [
            'content' => $this->post->content,
            'preview' => 'Preview123',
        ];

        $I->sendPUT('/post/' . $this->post->id, $post);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContains(json_encode($post['content']));
        $I->seeResponseContains(json_encode($post['preview']));
    }
}
