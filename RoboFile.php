<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    /**
     * 显示代码重复的地方
     */
    public function find_dfiles()
    {
        $this->_exec('jscpd --files="data/web/*.php"');
    }
}