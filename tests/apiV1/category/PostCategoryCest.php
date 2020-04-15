<?php

namespace tests\apiV1\post;

use ApiV1Tester;
use Codeception\Util\HttpCode;
use tests\apiV1\BaseCest;

class PostCategoryCest extends BaseCest
{
    public function _before(ApiV1Tester $I)
    {
        parent::_before($I);
    }

    // tests
    public function postCategoryTest(ApiV1Tester $I)
    {
        $post = [
            'name'     => 'Category',
            'isActive' => true,
        ];

        $I->sendPOST('/post', $post);
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseContains(json_encode($post['name']));
        $I->seeResponseContains(json_encode($post['isActive']));
    }
}
