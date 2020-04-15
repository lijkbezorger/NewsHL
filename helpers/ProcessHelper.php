<?php

namespace app\helpers;

use Yii;

class ProcessHelper
{
    /**
     * @param array $cmd
     * @param string $applicationName
     *
     * @return string|null
     */
    public static function runConsoleAction(array $cmd, string $applicationName)
    {
        $applicationName = $applicationName ?? 'yii';
        $application = realpath(Yii::getAlias('@app/' . $applicationName));
        $cmd = array_merge(['/usr/bin/nohup /usr/bin/php', $application], $cmd);
        $output = shell_exec(implode(' ', $cmd));

        return $output;
    }

    /**
     * @param array $cmd
     * @param string $applicationName
     */
    public static function runForkedConsoleAction(array $cmd, string $applicationName)
    {
        $applicationName = $applicationName ?? 'yii';
        $application = realpath(Yii::getAlias('@webroot/../' . $applicationName));
        $output = '/dev/null';
        $cmd = array_merge(['/usr/bin/nohup /usr/bin/php', $application], $cmd, ['>' . $output . ' 2>&1 &']);
        exec(implode(' ', $cmd));
    }
}
