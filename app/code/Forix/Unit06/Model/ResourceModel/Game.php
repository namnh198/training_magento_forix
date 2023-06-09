<?php

namespace Forix\Unit06\Model\ResourceModel;

class Game extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Constructor
     */
    protected function _construct()
    {
        $this->_init('computer_games', 'game_id');
    }
}
