<?php

/**
 * @brief PRFLR log router for Yii Framework
 * @note following options should be enabled in config
 *     Yii::getLogger()->autoFlush = 1;
 *     Yii::getLogger()->autoDump = 1;
 *
 * @author     Alexey Spiridonov <forspall@gmail.com>
 */
class PRFLRLogRoute extends CLogRoute
{
    public $apikey;
    public $source;
    public $category = 'CONFIGURE_YOUR_CATEGORY_HERE';
    public $active = false;


    /**
     * @brief init log router
     */
    public function init()
    {
        parent::init();
        if ($this->active) {
            include_once(__DIR__ . '/prflr.php');
            try {
                PRFLR::init($this->source, $this->apikey);
            } catch (Exception $e) {
                $this->active = false;
                Yii::log('Unnable to init PRFLR: ' . $e->getMessage(), CLogger::LEVEL_ERROR, 'PRFLRLogRoute.init');
            }
        }
    }

    /**
     * Stores log messages 
     * @param array $logs list of log messages
     */
    protected function processLogs($logs)
    {
        // work only with first element
        $_log = $logs[0];
        // profile log message have begin: and end: prefixes
        if ($_log[1] == 'profile' && $this->active) {
            if ($_log[0][0] == 'b') {
                // begin
                PRFLR::Begin(substr($_log[0], 6, strlen($_log[0])));
            } else {
                // base category if category not set 
                $category = !empty($_log[2]) && $_log[2] != 'application' ? $_log[2] : $this->category;
                PRFLR::End(substr($_log[0], 4, strlen($_log[0])), $category);
            }
        }
    }
}
