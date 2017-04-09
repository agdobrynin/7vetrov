<?php
namespace Models;

use \Core\Model as Model;
use \Core\Db as Db;
class Calculate extends Model{

    protected $body;
    protected $name;

    public function get()
    {
        $sql = "select * from Calcs where id = ".$this->id;
        if ( $result = @Db::query($sql) ){
            $row = $result->fetchArray();
            $this->id = $row['id'];
            $this->body = $row['body'];
            $this->name = $row['name'];
        }else{
            throw new \Exception(Db::getError());
        }
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getName()
    {
        return $this->name;
    }

    public function save( $name, $body )
    {
        if( empty($name) || empty($body) ){
            throw new \Exception("Название и содержание расчета обязательны");
        }
        if( (int)$this->id ){
            $sql = "Update Calcs set name = '".Db::escape($name)."', body = '".Db::escape($body)."' where id=".$this->id;
        }else{
            $sql = "Insert into Calcs (name, body) values ('".Db::escape($name)."', '".Db::escape($body)."')";
        }
        if ( @Db::query($sql) ){
            if( $this->id == null ){
                $this->id = Db::getLastId();
            }
        }else{
            throw new \Exception(Db::getError());
        }
    }

    public function saveCodes(array $codes = [])
    {
        if( $this->id ){
            if( count($codes) ){
                $values = [];
                foreach( $codes as $code){
                    $values[] = "(".$this->id." , ".$code.")";
                }
                $sql = 'Insert into CalcResults values '.join(',', $values);
                if( @Db::query($sql) == false ){
                    throw new \Exception(Db::getError());
                }
            }
        }
    }

    public function getCodes()
    {
        if( $this->id ){
            $sql = 'select * from CalcResults where calc_id = '.$this->id;
            $codes = [];
            if ( $result = @Db::query($sql) ){
                while( $row = $result->fetchArray() ){
                    $codes[] = $row['secret_code'];
                }
            }else{
                throw new \Exception(Db::getError());
            }
            return $codes;
        }
    }

}
