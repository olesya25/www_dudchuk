<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 08/11/2018
 * Time: 13:22
 */

class DB
{
    private static $instance = null;
    private $pdo, $query, $error = false, $result=[], $count, $lastIdInsert = null;

    /**
     * DB constructor. Připojení k databazi.
     *                 Třida je typu Singleton, takže instance třidy lze vytvořit pouze jednou.
     */
    private function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:host=' . HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }

    /**
     * @return DB|null  Pokud instance už byla jednou vytvořená, tak jí pouze vratíme
     *                  Pokud ne, tak jí nejdříve vytvoříme, a potom vratíme
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    /**
     * @param $sql                  SQl dotaz, který pošleme databazi
     * @param array $parameters     Hodnoty, ktere se budou zpracovavat v dotazu
     * @return $this                Vratí objekt s nastavenymí atributy
     */
    public function query($sql, $parameters = []){
        $this->error = false;
        if($this->query = $this->pdo->prepare($sql)){
            $x = 1;
            if(count($parameters)){
                foreach ($parameters as $p){
                    $this->query->bindValue($x, $p);
                    $x++;
                }
            }

        if($this->query->execute()){
            $this->result = $this->query->fetchAll(PDO::FETCH_OBJ);
            $this->count = $this->query->rowCount();
            $this->lastIdInsert = $this->pdo->lastInsertId();
        }else{
            $this->error = true;

        }
        }

        return $this;
    }

    /**
     * Pomocí teto metody vložime hodnoty do tabulky databaze
     * @param $table           Název tabulky, do které chceme vložit hodnoty
     * @param array $fields    Pole hodnot, které chceme vložit
     * @return bool            Vratí true, pokud operace se podaříla, jinak - false.
     */
    public  function insert($table, $fields = []){
        $fieldString = '';
        $valueString = '';
        $values = [];

        foreach ($fields as $field => $value) {
            $fieldString .= '`' .$field. '`,';
            $valueString .= '?,';
            $values[] = $value;
        }
        $fieldString = rtrim($fieldString, ',');
        $valueString = rtrim($valueString, ',');
        $sql = "INSERT INTO {$table} ({$fieldString}) VALUES ({$valueString})";

        if(!$this->query($sql, $values)->error()){
            return true;
        }else{
            return false;
        }



    }

    /**
     * Pomocí teto metody vyhledáme data z tabulky v databazi
     * @param $table            Název tabulky, kde hledat
     * @param array $params     Hodnoty, co hledame
     * @return bool             Vratí true, pokud operace se podaříla, jinak - false.
     */
    public  function find($table, $params=[]){
        if($this->read($table, $params)){
            return $this->getResult();

        }
        return false;
    }

    /**
     * Pomocí teto metody vziskáme prvni položku z vyhledávaných dat, z tabulky v databazi
     * @param $table            Název tabulky, kde hledat
     * @param array $params     Hodnoty, co hledame
     * @return array|bool       Vratí true, pokud operace se podaříla, jinak - false.
     */
    public function findFirst($table, $params=[]){
        if($this->read($table, $params)){
            return $this->getFirst();

        }
            return false;

    }

    /**
     * Pomocní metoda, ktera uchovava v sobě veškerou funkcionalitu, pro metody find() a findFirst()
     * @param $table            Název tabulky, kde hledat
     * @param array $params     Hodnoty, co hledame
     * @return bool             Vratí true, pokud operace se podaříla, jinak - false.
     */
    protected function read($table, $params=[]){
        $condition = '';
        $bind = [];
        $order = '';
        $limit = '';

        //Condition
        if(isset($params['condition'])){
            if(is_array($params['condition'])){
                foreach ($params['condition'] as $c){
                    $condition .= ' ' .$c. ' AND';
                }
                $condition = trim($condition);
                $condition = rtrim($condition, ' AND');
            }else{
                $condition = $params['condition'];
            }

            if($condition != ''){
                $condition = ' WHERE ' .$condition;
            }
        }

        //Bind
        if(array_key_exists('bind', $params)){
            $bind = $params['bind'];
        }

        //Order
        if(array_key_exists('order', $params)){
            $order = ' ORDER BY ' .$params['order'];
        }
        //Limit
        if(array_key_exists('limit', $params)){
            $limit = ' LIMIT ' .$params['limit'];
        }

        $sql = "SELECT * FROM {$table}{$condition}{$order}{$limit}";


        if($this->query($sql, $bind)){
            if(!count($this->result)){
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }

    /**
     * Pomocí teto metody můžeme aktualizovat již existujicí data v tabulce
     * @param $table            Název tabulky, kde chceme aktualizovat
     * @param $id_name          Nazev sloupce s id
     * @param $id               ID
     * @param array $fields     Hodnoty, které chceme měnit
     * @return bool             Vratí true, pokud operace se podaříla, jinak - false.
     */
    public  function update($table, $id, $fields =[]){
        $fieldString = '';
        $values = [];

        foreach ($fields as $field => $value){
            $fieldString .= ' ' .$field. ' = ?,';
            $values[] = $value;
        }

        $fieldString = trim($fieldString);
        $fieldString = rtrim($fieldString, ',');
        $sql = "UPDATE {$table} SET {$fieldString} WHERE id = {$id}";
        //dump_die($sql);
        if(!$this->query($sql, $values)->error()){
            return true;
        }else{
            return false;
        }

    }

    /**
     * Pomocí teto metody můžeme smazat data z tabulky
     * @param $table           Název tabulky, kde chceme mazat
     * @param $id_name         Nazev sloupce s id
     * @param $id              ID
     * @return bool            Vratí true, pokud operace se podaříla, jinak - false.
     */
    public function delete($table, $id){
        $sql = "DELETE FROM {$table} WHERE id = {$id}";
        if(!$this->query($sql)->error()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Getter.
     * @return mixed         Vrati pole s vysledky
     */
    public function getResult(){
        return $this->result;
    }

    /**
     * @return array        Vrati prvni polozku z poli s vysledky
     */
    public function getFirst(){
        if(!empty($this->result)){
            return $this->result[0];
        }else{
            return [];
        }

    }

    /**
     * Getter.
     * @return mixed         Vrati pocet
     */
    public function getCount(){
        return $this->count;
    }

    /**
     * Getter.
     *
     * @param $table         Nazev tabulky
     * @return mixed         Pole s nazvy sloupcu, a jejich parametry
     */
    public function getColumns($table){
        return $this->query("SHOW COLUMNS FROM {$table}")->getResult();
    }

    /**
     * Getter.
     * @return null         Poslední vytvořene id. Pokud nebylo žadné, tak vratí NULL
     */
    public function getLastId(){
        return $this->lastIdInsert;
    }

    /**
     * Getter.
     * @return bool         True, pokud vznikla chyba, jinak false.
     */
    public function error(){
        return $this->error;
    }
}