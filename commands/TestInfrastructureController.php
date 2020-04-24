<?php

namespace app\commands;

use app\helpers\ProcessHelper;
use yii\console\Controller;
use yii\db\Connection;
use yii\helpers\Console;

/**
 * Class TestInfrastructureController
 * @package app\commands
 */
class TestInfrastructureController extends Controller
{
    const TEST_SUFFIX = '_test';

    /** @var Connection */
    private $connection;

    /** @var array */
    private $paths = [
        '',
        '@app/modules/api/migrations',
    ];

    public function __construct(
        $id,
        $module,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);

        $this->connection = \Yii::$app->getDb();
    }

    /**
     * Run migrations on test database
     */
    public function actionRunMigrations()
    {
        Console::output('Start clear & migrations');
        $result = ProcessHelper::runConsoleAction(['migrate/fresh --interactive=0'], 'yiitest');
        Console::output($result);
        foreach ($this->paths as $path) {
            $migrations = '';
            if ($path) {
                $migrations = ' --migrationPath=' . $path;
            }
            $result = ProcessHelper::runConsoleAction(
                ['migrate/ --interactive=0' . $migrations], 'yiitest'
            );
            Console::output($result);
        }
        Console::output('End clear & migrations');
    }
}
