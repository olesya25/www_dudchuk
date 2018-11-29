<?php
/**
 * Created by PhpStorm.
 * User: olesya
 * Date: 08/11/2018
 * Time: 22:55
 */

class Model{
    protected $db, $table, $modelName, $delete = false, $columnNames =[];
    public $id;

    /**
     * Model constructor.
     * @param $table   Název tabuky, kterou reprezentuje model
     */
    public function __construct($table){
        $this->db = DB::getInstance();
        $this->table = $table;
        $this->setTableColumns();
        $this->modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->table)));
    }

    /**
     * Metoda  nastaví nazvý sloupcu tabulky databazi
     */
    protected function setTableColumns(){
        $columns = $this->getColumns();
        foreach ($columns as $column){
            $columnName = $column->Field;
            $this->columnNames[] = $column->Field;
            $this->{$columnName} = null;
        }
    }

    /**
     *
     * @return mixed   Vratí objekt, obsahujicí sloupci dané tabulky z databazi
     */
    public function getColumns(){
        return $this->db->getColumns($this->table);
    }

    /**
     * Hledá v databazi řadky ktere splní vlastnosti, zadané v předaném argumentu $params
     * @param array $params    Kriteria podle kterých chcemé vyhledat řadky v tabulce
     * @return array           Pole z vysledky vyhledavaní
     */
    public function find($params =[]){
        $result = [];
        $resultQuery = $this->db->find($this->table, $params);
        if(is_array($resultQuery)){
            foreach ($resultQuery as $res){
                $obj = new $this->modelName($this->table);
                $obj->populateData($res);
                $result [] = $obj;
            }
        }

        return $result;

    }

    /**
     *
     * @return array  Vrací pole se všemi řadky s dané tabulky
     */
    public function showAll(){
        $result =[];
        $sql = "SELECT * FROM {$this->table}";
        $result [] = $this->db->query($sql);
             return $result;
    }

    /**
     * Vloží do dané tabulky data
     * @param $fields     pole s daty, které chcemé vložit
     * @return bool       true pokud operace se provedla, jinak false
     */
    public function insert($fields){
        if(empty($fields)){
            return false;
        }else{
            return $this->db->insert($this->table, $fields);
        }
    }

    /**
     * Aktualizuje data v tabulce
     * @param $id       id řadky kterou potřebujemé aktualizovat
     * @param $field    sloupce a hodnoty, které chcemé aktualizovat
     * @return bool     true pokud operace se provedla, jinak false
     */
    public function update($id, $field){
        if(empty($field) || $id == ''){
            return false;
        }else{
            return $this->db->update($this->table, $id,$field);
        }
    }

    /**
     * Odstraní data s tabulky. Pokud atribut deleted je nastavený na true,
     * tak řadka se fyzicky nesmaže, pouze se nastaví hodnota sloupce deleted na 1,
     * co znamená že uživatel je zablokovaný, ale admin pořad muže ho vidět  databazi
     * @param string $id řadky kterou chceme odstranit
     * @return bool
     */
    public function delete($id = ''){
        if($id == '' && $this->id == ''){
            return false;
        }
        if($id == ''){
            $id = $this->id;
        }
        if($this->delete){
            return $this->update($id,  ['deleted' => 1]);
        }

        return $this->db->delete($this->table, $id);

    }

    /**
     *
     * Hledá v databazi řadky ktere splní vlastnosti, zadané v předaném argumentu $params
     * @param array $params    Kriteria podle kterých chcemé vyhledat řadky v tabulce
     * @return array           Pole z prvním z obdržených vysledků vyhledavaní
     */
    public function findFirst($params=[]){
        $resultQuery = $this->db->findFirst($this->table, $params);
        $result = new $this->modelName($this->table);
        if($resultQuery){
            $result->populateData($resultQuery);
        }

        return $result;

    }

    /**
     * Hledá v databazi řadek podle id
     * @param $id     id
     * @return mixed  Pole z vysledkem
     */
    public function findById($id){
        return $this->findFirst(['condition'=>"id = ?", 'bind' => [$id]]);
    }

    /**
     *
     * @param $sql   sql dotaz
     * @param array $bind  parametrý co se boubindovát v dotazu
     */
    public function query($sql, $bind=[]){
        $this->db->query($sql,$bind);
    }

    /**
     * Uloží do databazí
     *
     * @return bool  true pokud operace se provedla, jinak false
     */
    public function save(){
        $fields = [];
        foreach ($this->columnNames as $columnName) {
            $fields[$columnName] = $this->$columnName;
        }
        if(property_exists($this, 'id') && $this->id != ''){
            return $this->update($this->id, $fields);
        }else{
            return $this->insert($fields);
        }
    }

    /**
     * Vloží do každého sloupce hodnotu
     *
     * @param $params   Hodnoty které se vkladají
     * @return bool     true pokud operace se provedla, jinak false
     */
    public function assign($params){
        if(!empty($params)){
            foreach ($params as $key => $value){
                if(in_array($key, $this->columnNames)){
                    $this->$key = sanit($value);
                }
            }
            return true;
        }
        return false;
    }

    /**
     * Pomocná metoda
     * @param $result
     */
    public function populateData($result){
        foreach($result as $key=>$value){
            $this->$key = $value;
        }
    }


}