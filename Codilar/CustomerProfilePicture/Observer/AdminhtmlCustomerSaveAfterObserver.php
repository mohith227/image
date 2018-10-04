<?php
/**
 * Created by PhpStorm.
 * User: mohith
 * Date: 3/10/18
 * Time: 1:42 PM
 */
namespace Codilar\CustomerProfilePicture\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;

/**
 * Webkul Marketplace AdminhtmlCustomerSaveAfterObserver Observer.
 */
class AdminhtmlCustomerSaveAfterObserver implements ObserverInterface
{
    /**
     * File Uploader factory.
     *
     * @var \Magento\MediaStorage\Model\File\UploaderFactory
     */
    protected $_fileUploaderFactory;

    protected $_mediaDirectory;

    /**
     * @param Filesystem                                       $filesystem,
     * @param \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory
     */
    public function __construct(
        Filesystem $filesystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory
    ) {
        $this->_mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        $this->_fileUploaderFactory = $fileUploaderFactory;
    }

    /**
     * admin customer save after event handler.
     *
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $target = $this->_mediaDirectory->getAbsolutePath('customimage/image/');
        try {
            /** @var $uploader \Magento\MediaStorage\Model\File\Uploader */
            $uploader = $this->_fileUploaderFactory->create(
                ['fileId' => 'custom_image_field']
            );
            $uploader->setAllowedExtensions(
                ['jpg', 'jpeg', 'gif', 'png']
            );
            $uploader->setAllowRenameFiles(true);
            $resul = $uploader->save($target);
        } catch(\Exception $e) {
            return '';
        }

        return $this;
    }
}