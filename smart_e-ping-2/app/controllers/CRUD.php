<?php
require_once ('RequisicaoHTTP.php');


class CRUD extends Controller {
    public function completeTranslation(){
       $orionIP = $_POST['orionIP'];
       $orionPort = $_POST['orionPort'];
        // $orionIP = "localhost";
        // $orionPort = 1026;

        session_start();
        $select = $_SESSION['select'];

        $database = $_SESSION['database'];
        $url = $_SESSION['url'];
        $user = $_SESSION['user'];
        $password = $_SESSION['password'];


        $this->model('Connection');
        $conn = Connection::connect($database, $url, $user, $password);
        $conn->set_charset("utf8");

        $sql = "";


        $dataJSON = [];
        foreach ($select as $item) {
            $i = 0;
            $len = count($item['column']);

            $sql = "SELECT ";
            foreach ($item['column'] as $col){
                if($i == $len - 1){
                    $sql .= $col['field'] . ' ';
                }else{
                    $sql .= $col['field'] . ', ';
                }

                $i++;
            }

            $sql .= "FROM " . $item['table'] . ";";

            $result = Connection::query($conn, $sql);

            $dataJSON = $this->toJSON($result, $item['table'], $item['column'], $database);
        }

        $conn->close();

        //Enviando dados para o ORION
        $status = RequisicaoHTTP::insert($dataJSON, $orionIP, $orionPort);

//        echo json_encode($status);
    }

    public function toJSON($rows, $tb, $column, $database){
        $json = [];
        $i = 0;
        foreach ($rows as $item){
            $entities = array(
                "id" => $tb . '_' . $i,
                "type" => $database . "_" . $tb
            );

            foreach ($column as $col){
                $type = self::typeForOrion(explode("(", $col['type'])[0]);

                switch ($type){
                    case "DateTime":
                                 //Y-m-d h:m:s
                        $value = $item[$col['field']];
                        $type = "Text";

                        break;

                    case "Date":
                                 //Y-m-d
                        $value = $item[$col['field']];
                        $type = "Text";

                        break;
                    case "Time":

                                 //h:m:s
                        $value = $item[$col['field']];
                        $type = "Text";

                        break;
                    case "Year":

                        $value = $item[$col['field']];
                        $type = "Text";

                        break;
                    case "TimeStamp":

                        $value = $item[$col['field']];
                        $type = "Text";

                        break;

                    case "Text":
                        $value = $item[$col['field']];
                        break;

                    default:

                        $value = $item[$col['field']];

                        break;
                }

                if(!is_null($value)){

                    //Substituindo caracteres que não são aceitos pelo fiware-orion.
                    if($type == "Text"){
                        if((stripos($value, '(') !== false) || ($indice = stripos($value, ')') !== false)){
                            $value = str_replace(['('], '.&28.', $value);
                            $value = str_replace([')'], '.&29.', $value);
                        }else if((stripos($value, '<') !== false) || ($indice = stripos($value, '>') !== false)){
                            $value = str_replace(['<'], '.&3C.', $value);
                            $value = str_replace(['>'], '.&3E.', $value);
                        }
                    }

                    $attr = array(
                        "type" => $type,
                        "value" => $value
                    );

                    $entities[$col['field']] = $attr;
                }
            }

            $json[] = $entities;

            $i++;
        }
        return $json;
    }

    public static function typeForOrion($type){
        switch ($type){
            case "varchar":
                return "Text";
                break;
            case "text":
                return "Text";
                break;
            case "int":
                return "Integer";
                break;
            case "datetime":
                return "DateTime";
                break;
            case "date":
                return "Date";
                break;
            case "time":
                return "Time";
                break;
            case "year":
                return "Year";
                break;
            case "timestamp":
                return "TimeStamp";
                break;
            default:
                return $type;
                break;
        }
    }
}
