<?php
/**
 * Created by PhpStorm.
 * User: mohith
 * Date: 3/10/18
 * Time: 1:29 PM
 */
namespace Codilar\CustomerProfilePicture\Block\Adminhtml\Customer\Edit;

class EdditionalBlock extends \Magento\Config\Block\System\Config\Form\Field
{
    const JS_TEMPLATE = 'customer/js.phtml';

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param array                                 $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Set JS template to itself.
     *
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (!$this->getTemplate()) {
            $this->setTemplate(static::JS_TEMPLATE);
        }

        return $this;
    }
}