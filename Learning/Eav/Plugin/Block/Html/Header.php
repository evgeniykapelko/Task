<?php

namespace Learning\Eav\Plugin\Block\Html;
/**
 * Class Header
 * @package Learning\Eav\Plugin\Block\Html
 */
class Header
{
    /**
     * @param \Magento\Theme\Block\Html\Header $block
     */
    public function beforeToHtml(\Magento\Theme\Block\Html\Header $block)
    {
        $block->setTemplate('Learning_Eav::html/header.phtml');
    }
}