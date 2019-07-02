<?php

namespace App\Data;


class CategoryDTO
{
    private $id;
    private $name;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return CategoryDTO
     */
    public function setId($id): CategoryDTO
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return CategoryDTO
     */
    public function setName($name): CategoryDTO
    {
        $this->name = $name;

        return $this;
    }



}