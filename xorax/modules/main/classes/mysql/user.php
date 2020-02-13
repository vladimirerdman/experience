<?php
/**
 * Created by PhpStorm.
 * User: vladimirerdman
 * Date: 2019-08-05
 * Time: 23:13
 */
require_once($_SERVER["DOCUMENT_ROOT"]."/smartnote/xorax/modules/main/classes/general/user.php");

class CUser extends CAllUser {

    /**
     * @param $userId
     * @return array|null
     *
     * Example:
     * $example = $USER->GetByID($USER->GetID());
     *
     */
    public function GetByID($userId) {
        if (empty($userId)) {
            return null;
        }
        global $link;
        $usersTable = mysqli_query($link, "SELECT * FROM users WHERE USER_ID='".$userId."' LIMIT 1");
        if (mysqli_num_rows($usersTable) > 0) {
            $userRow = mysqli_fetch_array($usersTable, MYSQLI_ASSOC);
            return $userRow;
        }
        //close connection to db
        return null;
    }

    public function isAdmin($userId) {
        //here is the code
    }

    /**
     * @param $row
     * @param $table
     * @param null $where
     * @param null $order
     * @return array|bool
     *
     * Example:
     * $example = $USER->Select('*', 'table_name');
     * foreach($example as $ex)
     * echo $ex['ROW_NAME'];
     * echo $ex['ROW_NAME'];
     */
    public function Select($row, $table, $where = null, $order = null) {
        global $link;
		$array = Array();
        $q = 'SELECT '.$row.' FROM ' . $table;
        if ($where != null) {
            $q .= ' WHERE ' . $where;
		}

        if ($order != null) {
            $q .= ' ORDER BY ' . $order;
        }
        $query = mysqli_query($link, $q);
        if ($query) {
            $rows = mysqli_num_rows($query);
            for($i = 0; $i < $rows; $i++) {
                $results = mysqli_fetch_assoc($query);
                $key = array_keys($results);
                $numKeys = count($key);
                for($x = 0; $x < $numKeys; $x++) {
                    $array[$i][$key[$x]] = $results[$key[$x]];
				}
			}
            return $array;
		} else {
            return false;
        }
    }

    /**
     * @param $row
     * @param $table
     * @param null $join
     * @param null $where
     * @param null $and
     * @return array|bool
     *
     * foreach($example as $ex)
     * echo $ex['ROW_NAME'];
     * echo $ex['ROW_NAME'];
     */
    public function SelectJoin($row, $table, $join = null, $where = null, $and = null) {
        global $link;
        $array = Array();
        $q = 'SELECT ' . $row . ' FROM ' . $table;
        if ($join != null) {
            $q .= ' ' . $join;
        }
        if ($where != null) {
            $q .= ' WHERE ' . $where;
        }
        if ($and != null) {
            $q .= ' AND ' . $and;
        }
        $q.= ' LIMIT 1';
        $query = mysqli_query($link, $q);
        if ($query) {
            $rows = mysqli_num_rows($query);
            for($i = 0; $i < $rows; $i++) {
                $results = mysqli_fetch_assoc($query);
                $key = array_keys($results);
                $numKeys = count($key);
                for($x = 0; $x < $numKeys; $x++) {
                    $array[$i][$key[$x]] = $results[$key[$x]];
                }
            }
            return $array;
        } else {
            return false;
        }
    }

    /**
     * @param $row
     * @param $table
     * @param null $where
     * @param null $order
     * @return array|bool
     *
     * Example:
     * $example = $USER->SelectRow('row_name', 'table_name', "where_row='$value'");
     */
    public function SelectRow($row, $table, $where = null, $order = null) {
        global $link;
        $array = Array();
        $q = 'SELECT '.$row.' FROM '.$table;
        if ($where != null) {
            $q .= ' WHERE ' . $where;
        }
        if ($order != null) {
            $q .= ' ORDER BY ' . $order;
        }
        $q .= ' LIMIT 1';
        $query = mysqli_query($link, $q);
        if ($query) {
            $rows = mysqli_num_rows($query);
            for($i = 0; $i < $rows; $i++) {
                $results = mysqli_fetch_assoc($query);
                $key = array_keys($results);
                $numKeys = count($key);
                for($x = 0; $x < $numKeys; $x++) {
                    $array[$key[$x]] = $results[$key[$x]];
                }
            }
            return $array;

        } else {
            return false;
        }
    }

    /**
     * @param $row
     * @param $table
     * @param null $join
     * @param null $where
     * @param null $and
     * @return array|bool
     */
    public function SelectRowJoin($row, $table, $join = null, $where = null, $and = null) {
        global $link;
        $array = Array();
        $q = 'SELECT ' . $row . ' FROM ' . $table;
        if ($join != null) {
            $q .= ' ' . $join;
        }
        if ($where != null) {
            $q .= ' WHERE ' . $where;
        }
        if ($and != null) {
            $q .= ' AND ' . $and;
        }
        $q.= ' LIMIT 1';
        $query = mysqli_query($link, $q);
        if ($query) {
            $rows = mysqli_num_rows($query);
            for($i = 0; $i < $rows; $i++) {
                $results = mysqli_fetch_assoc($query);
                $key = array_keys($results);
                $numKeys = count($key);
                for($x = 0; $x < $numKeys; $x++) {
                    $array[$key[$x]] = $results[$key[$x]];
                }
            }
            return $array;
        } else {
            return false;
        }
    }

    /**
     * @param $table
     * @param null $rows
     * @param $values
     * @return bool
     *
     * Example:
     * $example = $USER->Insert('table_name', 'row_name', "$value");
     */
    public function Insert($table, $rows = null, $values) {
        global $link;
        $q = 'INSERT INTO '.$table;
        if ($rows != null) {
            $q .= ' ('.$rows.')';
        }
        $values = explode(', ', $values);
        $numValues = count($values);
        for ($i = 0; $i < $numValues; $i++) {
            if (is_string($values[$i])) {
                $values[$i] = '"'.$values[$i].'"';
            }
        }
        $values = implode(',', $values);
        $q .= ' VALUES ('.$values.')';
        $insert = mysqli_query($link, $q);
        return ($insert) ? true : false;
    }

    /**
     * @param $table
     * @param $where
     * @return bool
     *
     * Example:
     * $example = $USER->Delete('table_name', "ID=$value");
     */
    public function Delete($table, $where) {
        global $link;
        $q = 'DELETE FROM ' . $table . ' WHERE ' . $where;
        if (mysqli_query($link, $q)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $table
     * @param $value
     * @param $where
     *
     * Example:
     * $example = $USER->Update('table_name', "row_name = '$value'", "where_row = '$value'");
     */
    public function Update($table, $value, $where) {
        global $link;
 
        $q = 'UPDATE ' . $table . ' SET ' . $value . ' WHERE ' . $where;
        if (mysqli_query($link, $q)) {
            return true;
        } else {
            return false;
        }
    }

}
$USER = new CUser ();

?>
