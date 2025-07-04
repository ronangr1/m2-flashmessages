<?php
/**
 * Copyright © Ronangr1, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Ronangr1\FlashMessages\Plugin;

use Magento\Framework\Message\Manager as CoreMessageManager;
use Ronangr1\FlashMessages\Api\FlashMessagesInterface;
use Ronangr1\FlashMessages\Handler\Message as MessageHandler;

class MessageManager
{
    public function __construct(
        private readonly MessageHandler         $handler,
        private readonly FlashMessagesInterface $flash,
    )
    {
    }

    public function afterAddSuccess(CoreMessageManager $subject, $result, $message)
    {
        $text = $this->handler->getText($message);
        $this->flash->setFlash(['message' => $text, 'type' => FlashMessagesInterface::TYPE_SUCCESS]);

        return $result;
    }

    public function afterAddSuccessMessage(CoreMessageManager $subject, $result, $message)
    {
        $text = $this->handler->getText($message);
        $this->flash->setFlash(['message' => $text, 'type' => FlashMessagesInterface::TYPE_SUCCESS]);

        return $result;
    }

    public function afterAddError(CoreMessageManager $subject, $result, $message)
    {
        $text = $this->handler->getText($message);
        $this->flash->setFlash(['message' => $text, 'type' => FlashMessagesInterface::TYPE_ERROR]);

        return $result;
    }

    public function afterAddErrorMessage(CoreMessageManager $subject, $result, $message)
    {
        $text = $this->handler->getText($message);
        $this->flash->setFlash(['message' => $text, 'type' => FlashMessagesInterface::TYPE_ERROR]);

        return $result;
    }

    public function afterAddNotice(CoreMessageManager $subject, $result, $message)
    {
        $text = $this->handler->getText($message);
        $this->flash->setFlash(['message' => $text, 'type' => 'info']);

        return $result;
    }

    public function afterAddNoticeMessage(CoreMessageManager $subject, $result, $message)
    {
        $text = $this->handler->getText($message);
        $this->flash->setFlash(['message' => $text, 'type' => FlashMessagesInterface::TYPE_INFO]);

        return $result;
    }

    public function afterAddWarning(CoreMessageManager $subject, $result, $message)
    {
        $text = $this->handler->getText($message);
        $this->flash->setFlash(['message' => $text, 'type' => FlashMessagesInterface::TYPE_WARNING]);

        return $result;
    }

    public function afterAddWarningMessage(CoreMessageManager $subject, $result, $message)
    {
        $text = $this->handler->getText($message);
        $this->flash->setFlash(['message' => $text, 'type' => FlashMessagesInterface::TYPE_WARNING]);

        return $result;
    }

    public function afterAddMessage(CoreMessageManager $subject, $result, $message, $group = null)
    {
        $identifier = $this->handler->getIdentifier($message);
        $data = $this->handler->getData($message);
        $url = $data['url'] ?? '#';
        $type = FlashMessagesInterface::TYPE_SUCCESS;

        switch ($identifier) {
            case 'confirmAccountSuccessMessage':
                $message = __(
                    'You must confirm your account. Please check your email for the confirmation link or <a href="%1">click here</a> for a new link.',
                    $url
                );
                break;
            case 'customerAlreadyExistsErrorMessage':
                $message = __(
                    'There is already an account with this email address. If you are sure that it is your email address, <a href="%1">click here</a> to get your password and access your account.',
                    $url
                );
                $type = FlashMessagesInterface::TYPE_ERROR;
                break;
            default:
                $message = $this->handler->getText($message);
        }

        if ($message) {
            if ($message instanceof \Magento\Framework\Phrase) {
                $message = $this->handler->getText($message);
            }
            $message = str_replace('%1', $url, $message);
            $this->flash->setFlash(['message' => $message, 'type' => $type]);
        }

        return $result;
    }

    public function afterAddComplexSuccessMessage(CoreMessageManager $subject, $result, $identifier, array $data = [], $group = null)
    {
        $text = $data['html'];
        $this->flash->setFlash(['message' => $text, 'type' => FlashMessagesInterface::TYPE_SUCCESS]);

        return $result;
    }

    public function afterAddComplexErrorMessage(CoreMessageManager $subject, $result, $identifier, array $data = [], $group = null)
    {
        $text = $data['html'];
        $this->flash->setFlash(['message' => $text, 'type' => FlashMessagesInterface::TYPE_ERROR]);

        return $result;
    }

    public function afterAddComplexWarningMessage(CoreMessageManager $subject, $result, $identifier, array $data = [], $group = null)
    {
        $text = $data['html'];
        $this->flash->setFlash(['message' => $text, 'type' => FlashMessagesInterface::TYPE_WARNING]);

        return $result;
    }

    public function afterAddComplexNoticeMessage(CoreMessageManager $subject, $result, $identifier, array $data = [], $group = null)
    {
        $text = $data['html'];
        $this->flash->setFlash(['message' => $text, 'type' => FlashMessagesInterface::TYPE_NOTICE]);

        return $result;
    }
}
