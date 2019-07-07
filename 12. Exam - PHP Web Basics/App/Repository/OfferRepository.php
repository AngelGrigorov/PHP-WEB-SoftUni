<?php

namespace App\Repository;


use App\Data\EditOfferDTO;
use App\Data\FullOfferDTO;
use App\Data\OfferDTO;
use App\Data\MyOfferDTO;
use Database\DatabaseInterface;

class OfferRepository implements OfferRepositoryInterface
{
    /**
     * @var DatabaseInterface
     */
    private $db;

    /**
     * OfferRepository constructor.
     * @param DatabaseInterface $db
     */
    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }


    public function add(OfferDTO $item)
    {
        $this->db->query("INSERT INTO 
        offers (price, days, description, picture_url, room_id, town_id, user_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?)")
            ->execute([$item->getPrice(), $item->getDays(), $item->getDescription(), $item->getPictureurl(), $item->getRoomId(), $item->getTownId(), $item->getUserId()]);
    }

    /**
     * @param int $userId
     * @return MyOfferDTO[]\Generator
     */
    public function findByUserId(int $userId): \Generator
    {
        return $this->db->query("
            SELECT 
                i.id,
                i.price,
                i.days,
                i.description,
                i.picture_url,
                i.is_occupied as isOccupied,
                i.added_on as addedOn,
                i.user_id as userId,
                t.name AS town,
                r.type AS room
            FROM offers AS i 
            JOIN towns t on i.town_id = t.id
            JOIN rooms r ON i.room_id = r.id
            WHERE i.user_id = ?
            ORDER BY 
              i.added_on DESC
        ")->execute([$userId])
            ->fetch(MyOfferDTO::class);
    }

    /**
     * @return FullOfferDTO[]|\Generator
     */
    public function findAll(): \Generator
    {
        return $this->db->query(
            "SELECT
                    i.id,
                    i.price,
                    i.days,
                    i.description,
                    i.picture_url,
                    i.is_occupied as isOccupied,
                    i.added_on as addedOn,
                    t.name AS town,
                    r.type as room
                   FROM
                    offers i
                    JOIN towns t on i.town_id = t.id
                    JOIN rooms r on i.room_id = r.id
                    ORDER BY i.added_on DESC
            "
        )->execute()->fetch(FullOfferDTO::class);
    }

    public function edit(EditOfferDTO $item)
    {
        $this->db->query(
            "UPDATE offers SET
            price = ?,
            days = ?,
            description = ?,
            picture_url = ?,
            room_id = ?,
            town_id = ?,
            is_occupied = ?
            WHERE id = ?"
        )->execute([
            $item->getPrice(),
            $item->getDays(),
            $item->getDescription(),
            $item->getPictureurl(),
            $item->getRoomId(),
            $item->getTownId(),
            $item->getIsOccupied(),
            $item->getId()
        ]);
    }

    public function findOne(int $id): FullOfferDTO
    {
        return $this->db->query(
            "SELECT
                    i.id,
                    i.price,
                    i.days,
                    i.description,
                    i.picture_url,
                    i.is_occupied as isOccupied,
                    i.added_on as addedOn,
                    t.name AS town,
                    r.type as room,
                    i.user_id AS userId,
                    u.name AS user,
                    u.phone as offerPhone
                   FROM
                    offers i
                    JOIN towns t on i.town_id = t.id
                    JOIN rooms r ON i.room_id = r.id
                    JOIN users u ON i.user_id = u.id
                    WHERE i.id = ?"
        )->execute([$id])->fetchOne(FullOfferDTO::class);
    }

    public function delete(int $id)
    {
        $this->db->query("DELETE FROM offers WHERE id = ?")->execute([$id]);
    }

    public function rent(int $id)
    {
        $this->db->query("UPDATE offers SET is_occupied = 1 WHERE id = ?")->execute([$id]);
    }
}
