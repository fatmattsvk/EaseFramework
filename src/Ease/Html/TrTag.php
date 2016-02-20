<?php

namespace Ease\Html;

/**
 * HTML Table row class
 *
 * @subpackage 
 * @author     Vitex <vitex@hippy.cz>
 */
class TrTag extends PairTag {

    /**
     * TR tag
     *
     * @param mixed $content    vkládaný obsah
     * @param array $properties parametry tagu
     */
    public function __construct($content = null, $properties = null) {
        parent::__construct('tr', $properties, $content);
    }

}
