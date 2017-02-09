<?php
/**
 * Object able to contain other object in int.
 * Objekt schopný do sebe pojmou jiné objekty.
 *
 * @author     Vitex <vitex@hippy.cz>
 * @copyright  2009-2014 Vitex@hippy.cz (G)
 */
namespace Ease;

class Container extends Sand
{
    /**
     * Pole objektů a fragmentů k vykreslení.
     *
     * @var array
     */
    public $pageParts = [];

    /**
     * Byla jiz stranka vykreslena.
     *
     * @var bool
     */
    public $drawStatus = false;

    /**
     * Is class finalized ?
     * Prošel už objekt finalizací ?
     *
     * @var bool
     */
    private $finalized = false;

    /**
     * Které objekty převzít od přebírajícího objektu.
     *
     * @var array
     */
    public $raiseItems = [];

    /**
     * Odkaz na webstránku.
     *
     * @var Page
     */
    public $webPage = null;

    /**
     * Kontejner, který může obsahovat vložené objekty, které se vykreslí.
     *
     * @param mixed $initialContent hodnota nebo EaseObjekt s metodou draw()
     */
    public function __construct($initialContent = null)
    {
        parent::__construct();
        if (!is_null($initialContent)) {
            $this->addItem($initialContent);
        }
    }

    /**
     * Projde $this->raiseItems (metoda_potomka=>proměnná_rodiče) a pokud v
     * objektu najde metodu potomka, zavolá jí s parametrem
     * $this->proměnná_rodiče.
     *
     * @param object $childObject  vkládaný objekt
     * @param array  $itemsToRaise pole položek k "protlačení"
     */
    public function raise(&$childObject, $itemsToRaise = null)
    {
        if (!$itemsToRaise) {
            $itemsToRaise = $childObject->raiseItems;
        }

        foreach ($itemsToRaise as $method => $property) {
            if (method_exists($childObject, $method)) {
                if (isset($this->$property)) {
                    $childObject->$method($this->$property);
                }
            } else {
                if (isset($this->$property)) {
                    $childObject->$property = &$this->$property;
                }
            }
        }
    }

    /**
     * Vloží další element do objektu.
     *
     * @param mixed  $pageItem     hodnota nebo EaseObjekt s metodou draw()
     * @param mixed  $context      Objekt do nějž jsou prvky/položky vkládány
     * @param string $pageItemName Pod tímto jménem je objekt vkládán do stromu
     *
     * @return pointer Odkaz na vložený objekt
     */
    public static function &addItemCustom($pageItem, $context,
                                          $pageItemName = null)
    {
        $itemPointer = null;
        if (is_object($pageItem)) {
            if (method_exists($pageItem, 'draw')) {
                $duplicity = 1;
                if (is_null($pageItemName) || !strlen($pageItemName)) {
                    $pageItemName = $pageItem->getObjectName();
                }

                while (isset($context->pageParts[$pageItemName])) {
                    $pageItemName = $pageItemName.$duplicity++;
                }

                $context->pageParts[$pageItemName] = $pageItem;
                $context->pageParts[$pageItemName]->parentObject = &$context;

                if (isset($context->pageParts[$pageItemName]->raiseItems) && is_array($context->pageParts[$pageItemName]->raiseItems)
                    && count($context->pageParts[$pageItemName]->raiseItems)
                ) {
                    $context->raise($context->pageParts[$pageItemName]);
                }
                if (method_exists($context->pageParts[$pageItemName], 'AfterAdd')) {
                    $context->pageParts[$pageItemName]->afterAdd();
                }
                $context->lastItem = &$context->pageParts[$pageItemName];
                $itemPointer = &$context->pageParts[$pageItemName];
            } else {
                $context->addStatusMessage('Page Item object without draw() method',
                    $pageItem,'error');
            }
        } else {
            if (is_array($pageItem)) {
                $addedItemPointer = $context->addItems($pageItem);
                $itemPointer = &$addedItemPointer;
            } else {
                if (!is_null($pageItem)) {
                    $context->pageParts[] = $pageItem;
                    $endPointer = end($context->pageParts);
                    $itemPointer = &$endPointer;
                }
            }
        }
        Shared::instanced()->registerItem($itemPointer);

        return $itemPointer;
    }

    /**
     * Include next element into current object.
     *
     * @param mixed  $pageItem     value or EaseClass with draw() method
     * @param string $pageItemName Custom 'storing' name
     *
     * @return mixed Pointer to included object
     */
    public function addItem($pageItem, $pageItemName = null)
    {
        return self::addItemCustom($pageItem, $this, $pageItemName);
    }

    /**
     * Vloží jako první element do objektu.
     *
     * @param mixed  $pageItem     hodnota nebo EaseObjekt s metodou draw()
     * @param string $pageItemName Pod tímto jménem je objekt vkládán do stromu
     *
     * @return pointer Odkaz na vložený objekt
     */
    public function &addAsFirst($pageItem, $pageItemName = null)
    {
        if (is_null($pageItemName)) {
            $pageItemName = '1st';
        }
        $swap = $this->pageParts;
        $this->emptyContents();
        $itemPointer = $this->addItem($pageItem, $pageItemName);
        $this->pageParts = array_merge($this->pageParts, $swap);

        return $itemPointer;
    }

    /**
     * Umožní již vloženému objektu se odstranit ze stromu k vykreslení.
     */
    public function suicide()
    {
        if (isset($this->parentObject) && isset($this->parentObject->pageParts[$this->getObjectName()])) {
            unset($this->parentObject->pageParts[$this->getObjectName()]);

            return true;
        } else {
            return false;
        }
    }

    /**
     * Vrací počet vložených položek.
     * Obtain number of enclosed items in current or given object.
     *
     * @param Container $object hodnota nebo EaseObjekt s polem ->pageParts
     *
     * @return int nuber of parts enclosed
     */
    public function getItemsCount($object = null)
    {
        $itemCount = null;
        if (is_null($object)) {
            $itemCount = count($this->pageParts);
        }
        if (is_object($object) && isset($object->pageParts)) {
            $itemCount = count($object->pageParts);
        }

        return $itemCount;
    }

    /**
     * Vloží další element za stávající.
     *
     * @param mixed $pageItem hodnota nebo EaseObjekt s metodou draw()
     *
     * @return pointer Odkaz na vložený objekt
     */
    public function &addNextTo($pageItem)
    {
        $itemPointer = $this->parentObject->addItem($pageItem);

        return $itemPointer;
    }

    /**
     * Vrací odkaz na poslední vloženou položku.
     *
     * @return EaseBrick|mixed
     */
    public function &lastItem()
    {
        $lastPart = end($this->pageParts);

        return $lastPart;
    }

    /**
     * Přidá položku do poslední vložené položky.
     *
     * @param object $pageItem hodnota nebo EaseObjekt s metodou draw()
     *
     * @return bool success
     */
    public function &addToLastItem($pageItem)
    {
        if (!method_exists($this->lastItem, 'addItem')) {
            return false;
        }

        return $this->lastItem->addItem($pageItem);
    }

    /**
     * Vrací první vloženou položku.
     *
     * @param Container|mixed $pageItem kontext
     */
    public function &getFirstPart($pageItem = null)
    {
        if (!$pageItem) {
            $pageItem = &$this;
        }
        if (count($pageItem->pageParts)) {
            $firstPart = reset($pageItem->pageParts);
        } else {
            $firstPart = null;
        }

        return $firstPart;
    }

    /**
     * Insert an array of elemnts
     * Vloží pole elementů.
     *
     * @param array $itemsArray pole hodnot nebo EaseObjektů s metodou draw()
     */
    public function addItems($itemsArray)
    {
        $itemsAdded = [];
        foreach ($itemsArray as $itemID => $item) {
            $itemsAdded[$itemID] = $this->addItem($item);
        }

        return $itemsAdded;
    }

    /**
     * Vyprázní obsah objektu.
     * Empty container contents
     */
    public function emptyContents()
    {
        $this->pageParts = null;
    }

    /**
     * Převezme JavaScripty.
     *
     * @param EasePage|array $scripts pole skriptiptů nebo EaseObjekt s
     *                                vloženými skripty v poli ->javaScripts
     */
    public function takeJavascripts(&$scripts)
    {
        if (is_object($scripts)) {
            $scriptsToProcess = $scripts->javaScripts;
        } else {
            $scriptsToProcess = $scripts;
        }
        if (count($scriptsToProcess)) {
            foreach ($scriptsToProcess as $scriptID => $script) {
                if ($script[0] == '#') {
                    $this->includeJavaScript(substr($script, 1), $scriptID);
                } else {
                    $this->addJavaScript(substr($script, 1), $scriptID);
                }
            }
        }
    }

    /**
     * Převezme kaskádove styly.
     *
     * @param EasePage|array $styles pole definic stylů nebo objekt s nimi
     */
    public function takeCascadeStyles($styles)
    {
        if (is_object($styles)) {
            $stylesToProcess = &$styles->webPage->head->cascadeStyles;
        } else {
            $stylesToProcess = &$styles;
        }
        if (count($stylesToProcess)) {
            foreach ($stylesToProcess as $Style) {
                $this->AddCss($Style);
            }
        }
    }

    /**
     * Projde rekurzivně všechny vložené objekty a zavolá jeich draw().
     */
    public function drawAllContents()
    {
        if (count($this->pageParts)) {
            foreach ($this->pageParts as $part) {
                if (is_object($part) && method_exists($part, 'draw')) {
                    $part->draw();
                } else {
                    echo $part;
                }
            }
        }
        $this->drawStatus = true;
    }

    /**
     * Vrací rendrovaný obsah objektů.
     *
     * @return string
     */
    public function getRendered()
    {
        $retVal = '';
        ob_start();
        $this->draw();
        $retVal .= ob_get_contents();
        ob_end_clean();
        
        return $retVal;
    }

    /**
     * Zobrazí schéma hierarchie vložených objektů.
     *
     * @param int $level aktuální uroven zanoření
     */
    public function showContents($level = 0)
    {
        foreach ($this->pageParts as $partName => $partContents) {
            if (is_object($partContents) && method_exists($partContents,
                    'ShowContents')) {
                $partContents->showContents($level + 1);
            } else {
                echo str_repeat('&nbsp;.&nbsp;', $level).$partName.'<br>';
            }
        }
    }

    /**
     * Vykresli se, pokud již tak nebylo učiněno.
     * Draw contents not drawn yet.
     */
    public function drawIfNotDrawn()
    {
        if (!$this->drawStatus) {
            $this->draw();
        }
    }

    /**
     * Vrací stav návěští finalizace části.
     *
     * @return bool
     */
    public function isFinalized()
    {
        return $this->finalized;
    }

    /**
     * Set label of parts finalized.
     * Nastaví návěstí finalizace části.
     *
     * @param bool $flag příznak finalizace
     */
    public function setFinalized($flag = true)
    {
        $this->finalized = $flag;
    }

    /**
     * Naplní vložené objekty daty.
     *
     * @param type $data asociativní pole dat
     */
    public function fillUp($data = null)
    {
        if (is_null($data)) {
            $data = $this->getData();
        }
        self::fillMeUp($data, $this);
    }

    /**
     * Projde všechny vložené objekty a pokud se jejich jména shodují s klíči
     * dat, nastaví se jim hodnota.
     *
     * @param array           $data asociativní pole dat
     * @param Container|mixed $form formulář k naplnění
     */
    public static function fillMeUp(&$data, &$form)
    {
        if (isset($form->pageParts) && is_array($form->pageParts) && count($form->pageParts)) {
            foreach ($form->pageParts as $partName => $part) {
                if (isset($part->pageParts) && is_array($part->pageParts) && count($part->pageParts)) {
                    self::fillMeUp($data, $part);
                }
                if (is_object($part)) {
                    if (method_exists($part, 'setValue') && method_exists($part,
                            'getTagName')) {
                        $tagName = $part->getTagName();
                        if (isset($data[$tagName])) {
                            $part->setValue($data[$tagName], true);
                        }
                    }
                    if (method_exists($part, 'setValues')) {
                        $part->setValues($data);
                    }
                }
            }
        }
    }

    /**
     * Je element prázdný ?
     *
     * @param Container $element Ease Html Element
     *
     * @return bool prázdnost
     */
    public function isEmpty($element = null)
    {
        if (is_null($element)) {
            $element = &$this;
        }

        return !count($element->pageParts);
    }

    /**
     * Vykreslí objekt z jeho položek.
     */
    public function draw()
    {
        foreach ($this->pageParts as $part) {
            if (is_object($part)) {
                if (method_exists($part, 'drawIfNotDrawn')) {
                    $part->drawIfNotDrawn();
                } else {
                    $part->draw();
                }
            } else {
                echo $part;
            }
        }
    }

    /**
     * Vyrendruje objekt.
     *
     * @return string
     */
    public function __toString()
    {
        ob_start();
        $this->draw();
        $objectOut = ob_get_contents();
        ob_end_clean();

        return $objectOut;
    }
}
