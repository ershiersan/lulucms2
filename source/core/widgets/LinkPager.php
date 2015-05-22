<?php
namespace source\core\widgets;

use Yii;
use yii\helpers\Html;
use source\core\base\IBaseWidget;

class LinkPager extends \yii\widgets\LinkPager implements IBaseWidget
{

    public function init()
    {
        parent::init();
        
        $this->prevPageLabel = '上一页';
        $this->nextPageLabel = '下一页';
    }

    protected function renderPageButtons()
    {
        $buttons = $this->getButtonItems();
        if ($buttons === '')
        {
            return '';
        }
        
        return Html::tag('div', '<ul>' . implode("\n", $buttons) . '</ul>', $this->options);
    }

    protected function getButtonItems()
    {
        $pageCount = $this->pagination->getPageCount();
        if ($pageCount < 2 && $this->hideOnSinglePage)
        {
            return '';
        }
        
        $buttons = [];
        $currentPage = $this->pagination->getPage();
        
        // first page
        if ($this->firstPageLabel !== false)
        {
            $buttons[] = $this->renderPageButton($this->firstPageLabel, 0, $this->firstPageCssClass, $currentPage <= 0, false);
        }
        
        // prev page
        if ($this->prevPageLabel !== false)
        {
            if (($page = $currentPage - 1) < 0)
            {
                $page = 0;
            }
            $buttons[] = $this->renderPageButton($this->prevPageLabel, $page, $this->prevPageCssClass, $currentPage <= 0, false);
        }
        
        // internal pages
        list($beginPage, $endPage) = $this->getPageRange();
        for ($i = $beginPage; $i <= $endPage; ++ $i)
        {
            $buttons[] = $this->renderPageButton($i + 1, $i, null, false, $i == $currentPage);
        }
        
        // next page
        if ($this->nextPageLabel !== false)
        {
            if (($page = $currentPage + 1) >= $pageCount - 1)
            {
                $page = $pageCount - 1;
            }
            $buttons[] = $this->renderPageButton($this->nextPageLabel, $page, $this->nextPageCssClass, $currentPage >= $pageCount - 1, false);
        }
        
        // last page
        if ($this->lastPageLabel !== false)
        {
            $buttons[] = $this->renderPageButton($this->lastPageLabel, $pageCount - 1, $this->lastPageCssClass, $currentPage >= $pageCount - 1, false);
    	}
    
    	return $buttons;
    }
    
   
}
