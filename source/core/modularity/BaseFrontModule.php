<?php
namespace source\core\modularity;

class BaseFrontModule extends BaseModule
{

    public function init()
    {
        parent::init();
        
        $this->setViewPath($this->getBasePath() . '/home/views');
    }
}
