    <?php

    class Database 
    {
        public $connection;
        public $statement;

        public function __construct($config, $username = 'root', $password = '') {
            $dsn = 'mysql:' . http_build_query($config,'',';');

            $this->connection = new PDO($dsn, $username,$password);
        }

    }

    ?>