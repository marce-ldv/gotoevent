<?php 
    namespace dao;

    class Connection {

        private $pdo = null;
        private $pdoStatement = null;
        private static $instance = null;

        public function __construct(){
            try {
                $this->pdo = new \PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME, DB_USER, DB_PASS);
                /*con array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION) habilitas al PDO que notifique siempre que ocurra una excepcion en las consultas SQL*/
                $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\Exception $th) {
                throw $th;
            }
        }

        public static function getInstance(){
            if(self::$instance == null)
                self::$instance = new Connection();

            return self::$instance;
        }

        public function execute( $sql , $params = array()){
            try {
                $this->pdoStatement = $this->pdo->prepare($sql);

                foreach ($params as $p => $value) {
                    $this->pdoStatement->bindParam(":".$p, $value);
                }

                $this->pdoStatement->execute();
                return $this->pdoStatement->fetchAll();
            } catch (\Exception $th) {
                throw $th;
            }
        }

        public function executeNonQuery( $sql , $params = [] ){
            try {
                $this->pdoStatement = $this->pdo->prepare($sql);

                foreach ( $params as $p ) {
                    $this->pdoStatement->bindParam(":$p", $params[$p]);
                }
                print_r($this->pdoStatement);
                $this->pdoStatement->execute();
                //en vez de fetchear, devuelve la cantidad de filas, se usa para saber si se cargaron datos
                return $this->pdoStatement->rowCount();
            } catch (\Exception $th) {
                throw $th;
            }
        }
    }
