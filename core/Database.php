<?php
    namespace Core;

    use PDO;

    class Database 
    {
        private $connection;
        private $statement;

        protected string $table;
        protected array $wheres = [];
        protected array $bindings = [];

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

        public function find($id)
        {
            return $this
                ->where('id', '=', $id)
                ->first();
        }

        public function findOrFail($id) 
        {
            $result = $this->find($id);

            if ($result === false) {
                throw new \Exception("Record not found.");
            }
            
            return $result;
        }

        protected function fetchAll()
        {
            return $this->statement->fetchAll();
        }

        protected function fetchOne()
        {
            return $this->statement->fetch();
        }

        public function table($table)
        {
            $this->table = $table;

            return $this;
        }

        public function where($column, $operator, $value)
        {
            $this->wheres[] = [
                'column'   => $column,
                'operator' => $operator,
                'value'    => $value,
            ];

            return $this;   
        }

        protected function buildWhere()
        {
            if (empty($this->wheres)) 
            {
                return '';
            }

            $conditions = [];

            foreach ($this->wheres as $index => $where) {
                $placeholder = "{$where['column']}_{$index}";
                $this->bindings[$placeholder] = $where['value'];
                $conditions[] = 
                "{$where['column']} {$where['operator']} :{$placeholder}";
            }

            return "WHERE " . implode(' AND ', $conditions);
        }
        
        protected function buildSelect()
        {
            return "
                SELECT *
                FROM {$this->table}
                {$this->buildWhere()}
            ";
        }

        protected function reset()
        {
            $this->table = '';

            $this->wheres = [];

            $this->bindings = [];
        }

        public function all()
        {
            $sql = $this->buildSelect();
            dd(
        $this->wheres,
        $this->bindings,
        $sql
    );

            $this->query($sql, $this->bindings);

            $result = $this->fetchAll();

            $this->reset();

            return $result;
        }
        
        public function first()
        {
            $sql = $this->buildSelect();

            $this->query($sql, $this->bindings);

            $result = $this->fetchOne();

            $this->reset();

            return $result;
        }
    }
