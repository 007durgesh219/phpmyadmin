<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 *
 * @package phpMyAdmin
 */

require_once './libraries/Message.class.php';

/**
 * Handles the recently used tables.
 *
 * @TODO Add documentation about configuration LeftRecentTable
 * @TODO Add documentation about table pma_recent (#recent) in Documentation.html
 * @TODO Add SQL script to generate pma_recent table
 *
 * @package phpMyAdmin
 */
class RecentTable
{
    /**
     * Defines the internal PMA table which contains recent tables.
     *
     * @access  private
     * @var string
     */
    private $pma_table;

    /**
     * Reference to session variable containing recently used tables.
     *
     * @access public
     * @var array
     */
    public $tables;

    /**
     * RecentTable instance.
     *
     * @var RecentTable
     */
    private static $_instance;

    public function __construct()
    {
        if (strlen($GLOBALS['cfg']['Server']['pmadb']) &&
            strlen($GLOBALS['cfg']['Server']['recent'])) {
            $this->pma_table = PMA_backquote($GLOBALS['cfg']['Server']['pmadb']) .".".
                               PMA_backquote($GLOBALS['cfg']['Server']['recent']);
        }
        if (!isset($_SESSION['tmp_user_values']['recent_tables'])) {
            $_SESSION['tmp_user_values']['recent_tables'] =
                isset($this->pma_table) ? $this->getFromDb() : array();
        }
        $this->tables =& $_SESSION['tmp_user_values']['recent_tables'];
    }

    /**
     * Returns class instance.
     *
     * @return RecentTable
     */
    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new RecentTable();
        }
        return self::$_instance;
    }

    /**
     * Returns recently used tables from phpMyAdmin database.
     *
     * @uses $pma_table
     * @uses PMA_query_as_controluser()
     * @uses PMA_DBI_fetch_array()
     * @uses json_decode()
     *
     * @return array
     */
    public function getFromDb()
    {
        // Read from phpMyAdmin database, if recent tables is not in session
        $sql_query =
        " SELECT `tables` FROM " . $this->pma_table .
        " WHERE `username` = '" . $GLOBALS['cfg']['Server']['user'] . "'";

        $row = PMA_DBI_fetch_array(PMA_query_as_controluser($sql_query));
        if (isset($row[0])) {
            return json_decode($row[0]);
        } else {
            return array();
        }
    }

    /**
     * Save recent tables into phpMyAdmin database.
     *
     * @uses PMA_query_as_controluser()
     * @uses PMA_DBI_fetch_value()
     * @uses PMA_DBI_try_query()
     * @uses json_decode()
     * @uses PMA_Message
     * 
     * @return true|PMA_Message
     */
    public function saveToDb()
    {
        $username = $GLOBALS['cfg']['Server']['user'];
        $sql_query =
        " SELECT COUNT(*) FROM " . $this->pma_table .
        " WHERE `username` = '" . $username . "'";

        $exist = PMA_DBI_fetch_value(PMA_query_as_controluser($sql_query));
        if ($exist) {
            $sql_query =
            " UPDATE " . $this->pma_table .
            " SET `tables` = '" . PMA_sqlAddslashes(json_encode($this->tables)) . "'" .
            " WHERE `username` = '" . $username . "'";

            $success = PMA_DBI_try_query($sql_query, $GLOBALS['controllink']);
        } else {
            $sql_query =
            " INSERT INTO " . $this->pma_table . " (`username`, `tables`)" .
            " VALUES ('" . $username . "', '" . PMA_sqlAddslashes(json_encode($this->tables)) . "')";

            $success = PMA_DBI_try_query($sql_query, $GLOBALS['controllink']);
        }

        if (!$success) {
            $message = PMA_Message::error(__('Could not save configuration'));
            $message->addMessage('<br /><br />');
            $message->addMessage(PMA_Message::rawError(PMA_DBI_getError($GLOBALS['controllink'])));
            return $message;
        }
        return true;
    }

    /**
     * Trim recent table according to the LeftRecentTable configuration.
     */
    public function trim()
    {
        while (count($this->tables) > $GLOBALS['cfg']['LeftRecentTable']) {
            array_pop($this->tables);
        }
    }

    /**
     * Return HTML code "select" for recently used tables.
     *
     * @return string
     */
    public function getHtmlSelect()
    {
        $this->trim();
        
        $html = '<select onchange="if (this.value != \'\') {'.
                        'arr=this.value.split(\'.\');'.
                        'window.parent.setDb(arr[0]);'.
                        'window.parent.setTable(arr[1]);'.
                        'window.parent.refreshMain(\'' . $GLOBALS['cfg']['LeftDefaultTabTable'] . '\');'.
                    '}">';
        $html .= '<option value="">(' . __('Recent tables') . ') ...</option>';
        foreach ($this->tables as $table) {
            $html .= '<option value="' . $table . '">' . $table . '</option>';
        }
        $html .= '</select>';
        
        return $html;
    }

    /**
     * Add recently used tables.
     *
     * @param string $db Database name where the table is located
     * @param string $table Table name
     *
     * @return true|PMA_Message True if success, PMA_Message if not
     */
    public function add($db, $table)
    {
        $table_str = $db . '.' . $table;

        // add only if this is new table
        if (!isset($this->tables[0]) || $this->tables[0] != $table_str) {
            array_unshift($this->tables, $table_str);
            $this->tables = array_unique($this->tables);
            $this->trim();
            if (isset($this->pma_table)) {
                return $this->saveToDb();
            }
        }
        return true;
    }

}
?>
