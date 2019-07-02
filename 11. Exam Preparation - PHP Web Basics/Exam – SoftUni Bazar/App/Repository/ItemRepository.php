<?php

namespace App\Repository;


use App\Data\EditItemDTO;
use App\Data\FullItemDTO;
use App\Data\ItemDTO;
use App\Data\MyItemDTO;
use Database\DatabaseInterface;

class ItemRepository implements ItemRepositoryInterface
{
    /**
     * @var DatabaseInterface
     */
    private $db;

    /**
     * ItemRepository constructor.
     * @param DatabaseInterface $db
     */
    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }


    public function add(ItemDTO $item)
    {
        $this->db->query("INSERT INTO 
        items (title, price, description, image, category_id, user_id) 
        VALUES (?, ?, ?, ?, ?, ?)")
            ->execute([$item->getTitle(), $item->getPrice(), $item->getDescription(), $item->getImage(), $item->getCategoryId(), $item->getUserId()]);
    }

    /**
     * @param int $userId
     * @return MyItemDTO[]\Generator
     */
    public function findByUserId(int $userId): \Generator
    {
        return $this->db->query("
            SELECT 
                i.id,
                i.title,
                c.name AS category,
                i.price
            FROM items AS i 
            JOIN categories c on i.category_id = c.id
            WHERE i.user_id = ?
            ORDER BY 
              c.id ASC,
              i.price DESC
        ")->execute([$userId])
            ->fetch(MyItemDTO::class);
    }

    /**
     * @return FullItemDTO[]|\Generator
     */
    public function findAll(): \Generator
    {
        return $this->db->query(
            "SELECT
                    i.id,
                    i.title,
                    c.name AS category,
                    i.price,
                    u.username,
                    u.location,
                    u.phone,
                    i.description,
                    i.image,
                    i.user_id AS userId,
                    i.category_id as categoryId
                   FROM
                    items i
                    JOIN categories c on i.category_id = c.id
                    JOIN users u on i.user_id = u.id
                    ORDER BY location DESC,
                    c.id ASC,
                    i.price ASC
            "
        )->execute()->fetch(FullItemDTO::class);
    }

    public function edit(EditItemDTO $item)
    {
        $this->db->query(
            "UPDATE items SET
            title = ?,
            description = ?,
            price = ?,
            category_id = ?,
            image = ?
            WHERE id = ?"
        )->execute([
            $item->getTitle(),
            $item->getDescription(),
            $item->getPrice(),
            $item->getCategoryId(),
            $item->getImage(),
            $item->getId()
        ]);
    }

    public function findOne(int $id): FullItemDTO
    {
        return $this->db->query(
            "SELECT
                    i.id,
                    i.title,
                    c.name AS category,
                    i.price,
                    u.username,
                    u.location,
                    u.phone,
                    i.description,
                    i.image,
                    i.user_id AS userId,
                    i.category_id as categoryId
                   FROM
                    items i
                    JOIN categories c on i.category_id = c.id
                    JOIN users u on i.user_id = u.id
                    WHERE i.id = ?"
        )->execute([$id])->fetchOne(FullItemDTO::class);
    }

    public function delete(int $id)
    {
        $this->db->query("DELETE FROM items WHERE id = ?")->execute([$id]);
    }
}