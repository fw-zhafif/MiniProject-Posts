    <?php

    class Database 
    {
        private $connection;
        private $statement;

        public function __construct($config, $username = 'root', $password = '') 
        {
            $dsn = 'mysql:' . http_build_query($config,'',';');

            $this->connection = new PDO($dsn, $username,$password);
        }

        public function query($query,$params = []) 
        {
            $this->statement = $this->connection->prepare($query);
            $this->statement->execute($params);
            return $this;
        }

        public function get() 
        {
           return $this->statement->fetchAll();
        }

        public function find() 
        {
            return $this->statement->fetch();
        }

        public function findOrFail() 
        {
            $result = $this->statement->fetch();

            if ($result === false) {
                abort();
            }
            
            return $result;
        }
    }

    ?>