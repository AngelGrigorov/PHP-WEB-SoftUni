<?php

namespace App\Data;


class RoomDTO
{
    private $id;
    private $type;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return TownDTO
     */
    public function setId($id): TownDTO
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return TownDTO
     */
    public function setType($type): TownDTO
    {
        $this->type = $type;

        return $this;
    }



}
