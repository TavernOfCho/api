<?php

namespace App\Serializer;

use ApiPlatform\Core\JsonLd\Serializer\ItemNormalizer;
use ApiPlatform\Core\Serializer\AbstractItemNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class BattleNetNormalizer implements NormalizerInterface, DenormalizerInterface, SerializerAwareInterface
{
    /** @var ItemNormalizer $normalizer */
    private $normalizer;

    const OPERATIONS = ['character_items', 'character_stats', 'character_guild'];

    public function __construct(NormalizerInterface $normalizer)
    {
        if (!$normalizer instanceof DenormalizerInterface) {
            throw new \InvalidArgumentException('The normalizer must implement the DenormalizerInterface');
        }
        if (!$normalizer instanceof AbstractItemNormalizer) {
            throw new \InvalidArgumentException('The normalizer must be an instance of AbstractItemNormalizer');
        }

        $this->normalizer = $normalizer;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        return $this->normalizer->denormalize($data, $class, $format, $context);
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $this->normalizer->supportsDenormalization($data, $type, $format);
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $normalize = $this->normalizer->normalize($object, $format, $context);

        if (in_array($context['item_operation_name'], self::OPERATIONS)) {
            $normalize['@id'] = $context['request_uri'];
        }

        return $normalize;
    }

    public function supportsNormalization($data, $format = null)
    {
        return $this->normalizer->supportsNormalization($data, $format);
    }

    public function setSerializer(SerializerInterface $serializer)
    {
        if($this->normalizer instanceof SerializerAwareInterface) {
            $this->normalizer->setSerializer($serializer);
        }
    }
}
