<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    /**
     * 运行测试
     */
    public function test()
    {
        $this->_exec('codecept run');
    }
}