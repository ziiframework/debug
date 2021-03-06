<?php

namespace yiiunit\debug;

use Yii;
use yii\debug\LogTarget;
use yii\debug\Module;

class LogTargetTest extends TestCase
{
    public function testGetRequestTime()
    {
        Yii::$app->getRequest()->setUrl('dummy');

        $module = new Module('debug');
        $module->bootstrap(Yii::$app);

        $logTarget = new LogTarget($module);
        $data = $this->invoke($logTarget, 'collectSummary');
        self::assertSame($_SERVER['REQUEST_TIME_FLOAT'], $data['time']);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->mockWebApplication();
    }
}
