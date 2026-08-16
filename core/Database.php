<?php
    namespace Core;

use Exception;
use PDO;

    class Database 
    {
        private $connection;
        private $statement;

        protected string $table = '';
        protected array $wheres = [];
        protected array $bindings = [];
        protected array $orders = [];
        protected array $columns = ['*'];
        protected ?int $limit = null;
        protected ?int $offset = null;
        protected bool $distinct = false;
        

        public function __construct($config, $username = 'root', $password = '') 
        {
            $dsn = 'mysql:' . http_build_query($config,'',';');

            $this->connection = new PDO($dsn, $username,$password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
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
            if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $table)) {
            throw new Exception('Invalid table name');
            }

            $this->table = $table;

            return $this;
        }

        public function where($column, $operator, $value)
        {
            $allowedOperators = [
                '=',
                '!=',
                '<>',
                '<',
                '>',
                '<=',
                '>=',
            ];

            if (!in_array($operator, $allowedOperators, true)) {
                throw new Exception('Invalid operator');
            }

            $this->wheres[] = [
                'column'   => $column,
                'operator' => $operator,
                'value'    => $value,
                'boolean' => 'AND',
            ];
            return $this;   
        }

        public function orWhere($column, $operator, $value) 
        {
            $this->wheres[] = [
                'column'   => $column,
                'operator' => $operator,
                'value'    => $value,
                'boolean' => 'OR',
            ];
            
            return $this;   
        }

        protected function buildSelect()
        {
            return "
                SELECT {$this->buildColumns()}
                FROM {$this->table}
                {$this->buildWhere()}
                {$this->buildOrder()}
                {$this->buildLimit()}
                {$this->buildOffset()}
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
                
                $condition = "{$where['column']} {$where['operator']} :{$placeholder}";

                if ($index > 0) {
                    $condition = "{$where['boolean']} " . $condition;
                }

                $conditions [] = $condition;
            }

            return "WHERE " . implode(' ', $conditions);
        }

        protected function reset()
        {
            $this->table = '';

            $this->wheres = [];

            $this->bindings = [];

            $this->orders = [];

            $this->columns = ['*'];

            $this->limit = null;

            $this->offset = null;

            $this->distinct = false;
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

        public function select(...$columns) 
        {

            if (empty($columns)) {
                throw new Exception('At least one column is required');
            }

            if (in_array('*', $columns) && count($columns) > 1) {
                throw new Exception('Cannot combine * with other columns');
            }

            foreach ($columns as $column) {
                if (
                    $column != '*' &&
                    ! preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $column)
                    ){
                        throw new Exception('invalid columns');
                    }
            }
            $this->columns = $columns;

            return $this;
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

        protected function buildLimit() {
            if ($this->limit === null) {
                return '';
            }

            return "LIMIT {$this->limit}";
        }

        public function offset($offset) {
           if (! is_int($offset) || $offset < 0) {
                throw new Exception("offset invalid");
            }
            
            $this->offset = $offset;
            return $this;
        }

        protected function buildOffset() 
        {
            if ($this->offset === null) {
                return '';
            }

            return "OFFSET {$this->offset}";
        }

        protected function buildColumns() 
        {
            $columns = implode(', ', $this->columns);

            if ($this->distinct) {
                $columns = 'DISTINCT ' . $columns;
            }

            return $columns;
        }

        public function distinct() {
            $this->distinct = true;

            return $this;
        }
    }