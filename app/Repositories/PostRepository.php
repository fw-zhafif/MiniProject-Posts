<?php

namespace App\Repositories;
use Core\Database;

class PostRepository
{
    protected Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function create(array $attributes)
    {
        $this->db->query(
            "
            INSERT INTO posts (title, body)
            VALUES (:title, :body)
            ",
            [
                'title' => $attributes['title'],
                'body'  => $attributes['body']
            ]
        );
    }

    public function update($id, array $attributes)
    {
        $this->db->query(
            "
            UPDATE posts

            SET

                title = :title,

                body = :body

            WHERE id = :id
            ",
            [
                'id' => $id,

                'title' => $attributes['title'],

                'body' => $attributes['body']
            ]
        );
    }

    public function delete($id)
    {
        $this->db->query(
            "
            DELETE FROM posts

            WHERE id = :id
            ",
            [
                'id' => $id
            ]
        );
    }

    public function all()
    {
        return $this->db
            ->query("
                SELECT *
                FROM posts
            ")
            ->get();
    }

    public function find($id)
    {
        return $this->db
            ->query(
                "
                SELECT *
                FROM posts
                WHERE id = :id
                ",
                [
                    'id' => $id
                ]
            )
            ->findOrFail();
    }


}