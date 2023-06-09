<?php

namespace Forix\Unit06\Model;

use Magento\Framework\Model\AbstractModel;

class Game extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Game::class);
    }

    public function getCustomAttributes()
    {
        return ['game_id', 'name', 'type', 'trial_period', 'release_date', 'image'];
    }
}
