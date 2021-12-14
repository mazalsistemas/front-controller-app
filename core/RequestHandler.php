<?php


class RequestHandler{

    public static function tratyRequest()
    {
        $data = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            sleep(1);
            foreach ($_POST as $key => $g) {
                $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_STRING);
                $data[$key] = addslashes($data[$key]);
                $data[$key] = self::handlerString($data[$key]);
            }

        }else{
            foreach ($_GET as $key => $g){
                $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_STRING);
                $data[$key] = addslashes($data[$key]);
                $data[$key] = self::handlerString($data[$key]);
            }

        }

        $params = $data;

            if (isset($params['class'])){

                if (class_exists($params['class'])){

                    $class = new $params['class'];

                    if (isset($params['method'])){

                        $method = $data['method'];

                        if(method_exists($class,"$method")){
                            $class->$method($params);
                        }else{
                            echo "Este Metodo Não Existe";
                        }
                    }
                }else{
                    echo "Está classe Não Existe";
                }
        }

    }


    public static function handlerString($data){
        $data = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|;|\*|--|\\\\)/", "" ,$data); // remove words where contains sql syntax
        $data = trim($data); // clear empty spaces
        $data = strip_tags($data); // remove tags php & html
        $data = addslashes($data); //  add backslashes to a string
        return $data;
    }

}

