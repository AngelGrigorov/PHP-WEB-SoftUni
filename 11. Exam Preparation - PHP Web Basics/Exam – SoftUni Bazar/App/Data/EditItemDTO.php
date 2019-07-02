<?php

namespace App\Data;


class EditItemDTO extends ItemDTO
{
    private $categories;

    /**
     * @return CategoryDTO[]|\Generator
     */
    public function getCategories(): \Generator
    {
        return $this->categories;
    }

    public function setCategories($categories): void
    {
        $this->categories = $categories;
    }


}