<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\Sqs;

use InvalidArgumentException;
use Landingi\AwsBundle\Queue\MessageAttribute;

final class SqsMessageAttribute implements MessageAttribute
{
    // Binary type not supported yet
    private const TYPE_STRING = 'String';
    private const TYPE_NUMBER = 'Number';

    private string $type;
    private string $stringValue;
    private string $name;

    public static function string(string $name, string $stringValue): self
    {
        return new self(self::TYPE_STRING, $name, $stringValue);
    }

    /**
     * @param int|float $numberValue
     *
     * @throws InvalidArgumentException
     */
    public static function number(string $name, $numberValue): self
    {
        if (!is_int($numberValue) && !is_float($numberValue)) {
            throw new InvalidArgumentException('Number value must be an integer or float.');
        }

        return new self(self::TYPE_NUMBER, $name, (string) $numberValue);
    }

    private function __construct(
        string $type,
        string $name,
        string $stringValue,
    ) {
        $this->type = $type;
        $this->name = $name;
        $this->stringValue = $stringValue;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDataType(): string
    {
        return $this->type;
    }

    public function getStringValue(): string
    {
        return $this->stringValue;
    }
}
