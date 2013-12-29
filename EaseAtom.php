<?php

/**
 * Základní pojící element všech objektů v EaseFrameWorku. Jeho hlavní schopnost je:
 * Pojímat do sebe zprávy.
 *
 * @package   EaseFrameWork
 * @author    Vitex <vitex@hippy.cz>
 * @copyright 2009-2012 Vitex@hippy.cz (G)
 */

class EaseAtom
{

    /**
     * Udržuje v sobě jméno objektu.
     * @var string
     */
    public $objectName = 'EaseSand';

    /**
     * Flag debugovacího režimu
     * @var bool
     */
    public $debug = false;

    /**
     * Pole informaci urcenych k logovani inebo zobrazovanych uzivateli
     * @var array
     */
    public $statusMessages = array();

    /**
     * Pocet uchovavanych zprav
     * @var int
     */
    public $messageCount = 0;

    /**
     * Vrací jméno objektu
     *
     * @return string
     */
    public function getObjectName()
    {
        return get_class();
    }

    /**
     * Přidá zprávu do zásobníku pro zobrazení uživateli inbo do logu
     *
     * @param string $message text zpravy
     * @param string $Type    fronta
     */
    public function addStatusMessage($message, $Type = 'info')
    {
        $this->messageCount++;
        $this->statusMessages[$Type][$this->messageCount] = $message;
    }

    /**
     * Přidá zprávy z pole uživateli do zásobníku
     *
     * @param array $statusMessages pole zpráv
     *
     * @return int Počet zpráv přidaných do fronty
     */
    public function addStatusMessages($statusMessages)
    {
        if (is_array($statusMessages) && count($statusMessages)) {
            $AllMessages = array();
            foreach ($statusMessages as $Quee => $Messages) {
                foreach ($Messages as $MesgID => $Message) {
                    $AllMessages[$MesgID][$Quee] = $Message;
                }
            }
            ksort($AllMessages);
            foreach ($AllMessages as $Message) {
                $Quee = key($Message);
                $this->addStatusMessage(reset($Message), $Quee, false, false);
            }

            return count($statusMessages);
        }

        return null;
    }

    /**
     * Vymaže zprávy
     */
    public function cleanMessages()
    {
        $this->messageCount = 0;
        $this->statusMessages = array();
    }

    /**
     * Předá zprávy
     *
     * @param boolean $clean smazat originalni data ?
     *
     * @return array
     */
    public function getStatusMessages($clean = false)
    {
        if ($clean) {
            $StatusMessages = $this->statusMessages;
            $this->cleanMessages();

            return $StatusMessages;
        } else {
            return $this->statusMessages;
        }
    }

    /**
     * Prevezme si zpravy z vnějšího zdroje
     *
     * @param array $statusMessages pole zpráv např. $OUser->StatusMessages
     */
    public function takeStatusMessages($statusMessages)
    {
        if (is_object($statusMessages) && isset($statusMessages->statusMessages)) {
            return $this->addStatusMessages($statusMessages->statusMessages);
        } else {
            return $this->addStatusMessages($statusMessages);
        }
    }

    /**
     * Returns PATH modified for current operating system
     *
     * @param string $path
     *
     * @return string
     */
    public static function sysFilename($path)
    {
        $path = str_replace('//', '/', $path);
        if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
            $path = str_replace('/', '\\', $path);
        } else {
            $path = str_replace('\\', '/', $path);
        }

        return $path;
    }

}
