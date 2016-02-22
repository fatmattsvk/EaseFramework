<?php

namespace Ease\Html;

/**
 * Html element pro adresu
 */
class AddressTag extends PairTag
{

    /**
     * Html element pro adresu
     *
     * @param string $content       text adresy
     * @param array  $TagProperites vlastnosti tagu
     */
    function __construct($content = null, $tagProperties = null)
    {
        parent::__construct('address', $tagProperties, $content);
    }
}
