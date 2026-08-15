<?php
    namespace Core;

use Exception;
use PDO;

    class Database 
    {
        private $connection;
        private $statement;

        protected string $table;
        protected array $wheres = [];
        protected array $bindings = [];
        protected array $orders = [];
        protected ?int $limit = null;
        protected ?int $offset = null;

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

        protected function buildSelect()
        {
            return "
                SELECT *
                FROM {$this->table}
                {$this->buildWhere()}
                {$this->buildOrder()}
                {$this->buildLimit()}
            ";
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

        protected function reset()
        {
            $this->table = '';

            $this->wheres = [];

            $this->bindings = [];
        }

        public function all()
        {
            $sql = $this->buildSelect();

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

        public function orderBy($column, $direction = 'ASC') 
        {   
            $direction = strtoupper($direction);

            if (! in_array($direction, ['ASC', 'DESC'])) {
                throw new Exception("Invalid order direction");
            }
            
            if (! preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $column)) {
                throw new Exception("Invalid order column");
            }

            $this->orders[] = [
                'column' => $column,
                'direction' => $direction,
            ];

            return $this;
        }

        protected function buildOrder()
        {
            if (empty($this->orders)) {
                return '';
            }

            $orders = [];

            foreach ($this->orders as $order) {
                $orders[] =
                    "{$order['column']} {$order['direction']}";
            }

            return "ORDER BY " . implode(', ', $orders);
        }

        public function limit($limit) 
        {
            if (! is_int($limit) || $limit < 0) {
                throw new Exception("limit invalid");
            }

            $this->limit = $limit;
            return $this;
        }

        public function offset($offset) {
           if (! is_int($offset) || $offset < 0) {
                throw new Exception("limit invalid");
            }
            
            $this->offset = $offset;
            return $this;
        }

        public function buildLimit() {
            if ($this->limit === null) {
                return '';
            }

            return "LIMIT {$this->limit}";
        }
    }