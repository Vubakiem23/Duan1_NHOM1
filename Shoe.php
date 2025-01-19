<?php

class Shoe extends BaseModel
{
    protected $table = 'shoes';

    public function getAll()
    {
        $sql = "
            SELECT 
                s.id                s_id,
                s.title             s_title,
                s.price             s_price,
                s.img_cover         s_img_cover,
                s.published_year    s_published_year,
                s.created_at        s_created_at,
                s.updated_at        s_updated_at,
                c.id                c_id,
                c.name              c_name
            FROM shoes s
            JOIN categories c ON c.id = s.category_id
            ORDER BY s.id DESC
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getByID($id)
    {
        $sql = "
            SELECT 
                s.id                s_id,
                s.title             s_title,
                s.price             s_price,
                s.img_cover         s_img_cover,
           
                s.created_at        s_created_at,
                s.updated_at        s_updated_at,
                c.id                c_id,
                c.name              c_name
            FROM shoes s
            JOIN categories c ON c.id = s.category_id
            WHERE s.id = :id;
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    }
}
