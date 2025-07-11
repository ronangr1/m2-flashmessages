<?php
/**
 * Copyright © Ronangr1, All rights reserved.
 * See LICENSE bundled with this library for license details.
 */
declare(strict_types=1);

namespace Ronangr1\FlashMessages\Api;

interface FlashMessagesInterface
{
    public const TYPE_ERROR = 'error';

    public const TYPE_WARNING = 'warning';

    public const TYPE_NOTICE = 'notice';

    public const TYPE_SUCCESS = 'success';

    public const TYPE_INFO = 'info';

    public function setFlash(array $message): void;

    public function getFlash(): ?array;
}
