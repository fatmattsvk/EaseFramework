<?php

/**
 * Abstraktní databázová třída
 *
 * @deprecated since version 200
 * @package EaseFrameWork
 * @author    Vitex <vitex@hippy.cz>
 * @copyright 2009-2014 Vitex@vitexsoftware.cz (G)
 */
require_once 'Ease/EaseSand.php';

/**
 * Virtuálni třída pro práci s databází
 *
 * @author Vitex <vitex@hippy.cz>
 */
class EaseSQL extends EaseSand
{

    /**
     * SQL operation result handle
     * @var resource
     */
    public $result = null;

    /**
     * SQL Handle
     * @var resource
     */
    public $sqlLink = null;

    /**
     * IP serveru
     * @var string
     */
    public $server = null;

    /**
     * DB Login
     * @var string
     */
    public $username = null;

    /**
     * DB heslo
     * @var string
     */
    public $password = null;

    /**
     * Database to connect by default
     * @var string
     */
    public $database = null;

    /**
     * Status připojení
     * @var bool
     */
    public $status = null;

    /**
     * Hodnota posledního voloženeho AutoIncrement sloupečku
     * @var int unsigned
     */
    public $lastIsnertID = null;

    /**
     * Poslední vykonaná SQL Query
     * @var string
     */
    public $lastQuery = '';

    /**
     * Počet ovlivněných nebo vrácených řádek při $this->LastQuery
     * @var string
     */
    public $numRows = 0;

    /**
     * Pole obsahující informace o základních paramatrech SQL přiopojení
     * @var array
     */
    public $report = array('LastMessage' => 'Please extend');

    /**
     * Klíčový sloupeček pro SQL operace
     * @var string
     */
    public $keyColumn = '';

    /**
     * Název práve zpracovávané tabulky
     * @var string
     */
    public $tableName = '';

    /**
     * Pole obsahující strukturu SQL tabulky
     * @var array
     */
    public $tableStructure = array();

    /**
     * Poslední Chybová zpráva obdržená od SQL serveru
     * @var string
     */
    public $errorText = null;

    /**
     * Kod SQL chyby
     * @var int
     */
    public $errorNumber = null;

    /**
     * Pole obsahující výsledky posledního SQL příkazu
     * @var array
     */
    public $resultArray = array();

    /**
     * Pomocná proměnná pro datové operace
     * @var array
     */
    public $data = null;

    /**
     * Poslední zpráva obdžená od SQL serveru
     * @var string
     */
    public $lastMessage = null;

    /**
     * Prodlevy v sekundách pro znovupřipojení k databázi
     * @var array
     */
    public $reconectTimeouts = array('web' => 1, 'cgi' => 10);

    /**
     * Nastavení vlastností přípojení
     * @var array
     */
    public $connectionSettings = array();

    /**
     * Indikátor nastavení připojení - byly vykonány SET příkazy
     * @var boolean
     */
    protected $connectAllreadyUP = false;

    /**
     * Obecný objekt databáze
     */
    public function __construct()
    {
        parent::__construct();
        if (!isset($this->server) && defined('DB_SERVER')) {
            $this->server = constant('DB_SERVER');
        }
        if (!isset($this->username) && defined('DB_SERVER_USERNAME')) {
            $this->username = constant('DB_SERVER_USERNAME');
        }
        if (!isset($this->password) && defined('DB_SERVER_PASSWORD')) {
            $this->password = constant('DB_SERVER_PASSWORD');
        }
        if (!isset($this->database) && defined('DB_DATABASE')) {
            $this->database = constant('DB_DATABASE');
        }
        $this->connect();
    }

    /**
     * Připojení k databázi
     */
    public function connect()
    {
        $this->setUp();
        $this->status = true;
    }

    /**
     * Přepene databázi
     *
     * @param  type    $dbName
     * @return boolean
     */
    public function selectDB($dbName = null)
    {
        if (!is_null($dbName)) {
            $this->database = $dbName;
        }

        return null;
    }

    /**
     * Id vrácené po INSERTu
     *
     * @return int
     */
    public function getInsertID()
    {
        return $this->lastInsertID;
    }

    /**
     * Otestuje moznost pripojeni k sql serveru
     *
     * @param boolean $succes vynucený výsledek
     *
     * @return $Success
     */
    public function ping($succes = null)
    {
        return $succes;
    }

    /**
     * Po deserializaci se znovu připojí
     */
    public function __wakeup()
    {
        parent::__wakeup();
        $this->connect();
    }

    /**
     * Odstraní z SQL dotazu "nebezpečné" znaky
     *
     * @param string $queryRaw SQL Query
     *
     * @return string SQL Query
     */
    public function sanitizeQuery($queryRaw)
    {
        $sanitizedQuery = trim($queryRaw);

        return $sanitizedQuery;
    }

    public function makeReport()
    {
        $this->report['LastMessage'] = $this->lastMessage;
        $this->report['ErrorText'] = $this->errorText;
        $this->report['Database'] = $this->database;
        $this->report['Username'] = $this->username;
        $this->report['Server'] = $this->server;
    }

    /**
     * Nastaví připojení
     *
     * @deprecated since version 210
     */
    public function setUp()
    {
        if (!$this->connectAllreadyUP) {
            if (isset($this->connectionSettings) && is_array($this->connectionSettings) && count($this->connectionSettings)) {
                foreach ($this->connectionSettings as $setName => $SetValue) {
                    if (strlen($setName)) {
                        $this->exeQuery("SET $setName $SetValue");
                    }
                }
                $this->connectAllreadyUP = true;
            }
        }
    }

    public function setTable($TableName)
    {
        $this->tableName = $TableName;
    }

    /**
     * Otestuje všechny náležitosti pro vytvoření tabulky
     *
     * @param  array   $tableStructure
     * @param  string  $tableName
     * @return boolean
     */
    public function createTableQuery(&$tableStructure, $tableName = null)
    {
        if (!$tableStructure) {
            $tableStructure = $this->tableStructure;
        }
        if (!is_array($tableStructure)) {
            $this->error('Missing table structure for creating TableCreate QueryRaw');

            return false;
        }
        if (!$tableName) {
            $tableName = $this->tableName;
        }
        if (!$tableName) {
            $this->error('Missing table name for creating TableCreate QueryRaw');

            return false;
        }

        return true;
    }

    /**
     * Opraví délky políček u nichž je překročena délka
     *
     * @param array $data asociativní pole dat
     *
     * @return array
     */
    protected function fixColumnsLength($data)
    {
        foreach ($this->tableStructure as $column => $columnProperties) {
            if (array_key_exists($column, $this->tableStructure)) {
                $Regs = array();
                if (@ereg("(.*)\((.*)\)", $columnProperties['type'], $Regs)) {
                    list(, $Type, $Size) = $Regs;
                    switch ($Type) {
                        case 'varchar':
                        case 'string':
                            if (array_key_exists($column, $data) && $Size) {
                                if (strlen($data[$column]) > $Size) {
                                    $this->addToLog('Column ' . $this->tableName . '.' . $column . ' content truncated: ' . substr($data[$column], $Size - strlen($data[$column])), 'warning');
                                    $data[$column] = substr($data[$column], 0, $Size - 1) . '_';
                                }
                            }
                            break;
                        default:
                            break;
                    }
                }
            }
        }

        return $data;
    }

    /**
     * Zkontroluje předpoklady pro vytvoření tabulky ze struktury
     *
     * @param array  $tableStructure struktura tabulky
     * @param string $tableName      název tabulky
     *
     * @return boolean Success
     */
    public function createTable(&$tableStructure = null, $tableName = null)
    {
        if (!$tableName) {
            $tableName = $this->tableName;
        }
        if (!$tableStructure) {
            $tableStructure = $this->tableStructure;
        }

        if (!$tableStructure) {
            $tableStructure = $this->tableStructure;
        }

        if (!strlen($tableName)) {
            $this->error('Missing table name for table creating');

            return false;
        }
        if (!is_array($tableStructure)) {
            $this->error('Missing table structure for table creating');

            return false;
        }

        return true;
    }

    /**
     * Vrací počet řádků vrácených nebo ovlivněným posledním sql dotazem.
     *
     * @return int počet řádků
     */
    public function getNumRows()
    {
        return $this->numRows;
    }

    /**
     * Poslední vykonaný dotaz
     *
     * @return int počet řádků
     */
    public function getLastQuery()
    {
        return $this->lastQuery;
    }

    /**
     * Poslední genrované ID
     *
     * @return int ID
     */
    public function getlastInsertID()
    {
        return $this->lastInsertID;
    }

    /**
     * Vrací chybovou zprávu SQL
     *
     * @return string
     */
    public function getLastError()
    {
        if ($this->errorText) {
            if (isset($this->errorNumber)) {
                return '#' . $this->errorNumber . ': ' . $this->errorText;
            } else {
                return $this->errorText;
            }
        } else {
            return null;
        }
    }

    /**
     * Vrací strukturu SQL tabulky jako pole
     *
     * @param  string       $tableName
     * @return null|boolean
     */
    public function describe($tableName = null)
    {
        if (!$tableName) {
            $tableName = $this->tableName;
        }
        if (!$this->tableExist($tableName)) {
            $this->addToLog('Try to describe nonexistent table: ' . $tableName, 'waring');

            return null;
        }

        return true;
    }

    /**
     * Ověří existenci tabulky
     *
     * @param  string       $tableName
     * @return null|boolean
     */
    public function tableExist($tableName = null)
    {
        if (!$tableName) {
            $tableName = $this->tableName;
        }
        if (!$tableName) {
            $this->error('TableExist: $TableName not known');

            return null;
        }

        return true;
    }

    /**
     * Zaznamená SQL Chybu
     *
     * @param string $title volitelný popisek, většinou název volající funkce
     */
    public function logError($title = null)
    {
        if (is_null($title)) {
            list(, $caller) = debug_backtrace(false);
            $title = $caller['function'];
        }
        if (isset($this->easeShared->User) && is_object($this->easeShared->User)) {
            return $this->easeShared->User->addStatusMessage($title . ': #' . $this->errorNumber . ' ' . $this->errorText, 'error');
        } else {
            return $this->addToLog($title . ': #' . $this->errorNumber . ' ' . $this->errorText, 'error');
        }
    }

    /**
     * Znovu se připojí k databázi
     */
    public function reconnect()
    {
        $this->close();
        sleep($this->reconectTimeouts[$this->easeShared->runType]);
        $this->connect();
    }

    /**
     * Při serializaci vynuluje poslední Query
     *
     * @return boolean
     */
    public function __sleep()
    {
        $this->lastQuery = null;

        return parent::__sleep();
    }

    /**
     * Zavře databázové spojení
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * Vrací výsledek dotazu jako dvourozměrné pole
     *
     * @param string $queryRaw SQL příkaz
     *
     * @return array|null
     */
    public function queryTo2DArray($queryRaw)
    {
        $result = $this->queryToArray($queryRaw);
        if (count($result)) {
            $values = array();
            foreach ($result as $value) {
                $values[] = current($value);
            }

            return $values;
        }

        return $result;
    }

    /**
     * Vrací první položku výsledku dotazu
     *
     * @param string $queryRaw SQL příkaz vracející jednu hodnotu
     *
     * @return string|null
     */
    public function queryToValue($queryRaw)
    {
        $result = $this->queryToArray($queryRaw);
        if (count($result)) {
            return current(current($result));
        } else {
            return null;
        }
    }

    /**
     * Vrací počet výsledku dotazu
     *
     * @param string $queryRaw SQL příkaz vracející jednu hodnotu
     *
     * @return int
     */
    public function queryToCount($queryRaw)
    {
        return count($this->queryToArray($queryRaw));
    }

    /**
     * Vrací databázový objekt Pear::DB
     *
     * @link http://pear.php.net/manual/en/package.database.mdb2.php
     * @todo SET,mdb2
     *
     * @return DB|null objekt databáze
     */
    public static function & getPearObject()
    {
        require_once 'DB.php';
        $DbHelper = new DB;

        $dsn = array(
          'phptype' => 'mysql', //TODO - pořešit v EaseMySQL
          'username' => DB_SERVER_USERNAME,
          'password' => DB_SERVER_PASSWORD,
          'hostspec' => DB_SERVER
        );

        $db = & $DbHelper->connect($dsn);

        if (PEAR::isError($db)) {
            return null;
        }

        $db->query('USE ' . DB_DATABASE);

        return $db;
    }

}
