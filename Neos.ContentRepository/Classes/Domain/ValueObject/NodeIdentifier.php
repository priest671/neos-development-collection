<?php
declare(strict_types=1);

namespace Neos\ContentRepository\Domain\ValueObject;

/*
 * This file is part of the Neos.ContentRepository package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Neos\Cache\CacheAwareInterface;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Utility\Algorithms;

/**
 * The "Node Identifier" will be removed with the Event-Sourced CR in Neos 5.0; but some
 * parts of the ES code still rely on it so far.
 *
 * @Flow\Proxy(false)
 * @deprecated
 */
final class NodeIdentifier implements \JsonSerializable, CacheAwareInterface
{
    /**
     * @var string
     */
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function create(): self
    {
        return new static(Algorithms::generateUUID());
    }

    public static function fromString(string $value): self
    {
        return new static($value);
    }

    public function jsonSerialize(): string
    {
        return $this->value;
    }

    public function getCacheEntryIdentifier(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
