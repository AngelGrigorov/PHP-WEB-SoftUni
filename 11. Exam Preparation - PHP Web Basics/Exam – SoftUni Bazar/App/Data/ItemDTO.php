<?php

namespace App\Data;


class ItemDTO
{
    private const TITLE_MIN_LENGTH = 3;
    private const TITLE_MAX_LENGTH = 255;

    private const PRICE_MIN = 1;
    private const PRICE_MAX = 50;

    private const DESCRIPTION_MIN_LENGTH = 10;
    private const DESCRIPTION_MAX_LENGTH = 10000;

    private const IMAGE_MIN_LENGTH = 3;
    private const IMAGE_MAX_LENGTH = 255;


    private $id;
    private $title;
    private $price;
    private $description;
    private $image;
    private $categoryId;
    private $userId;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return ItemDTO
     * @throws \Exception
     */
    public function setTitle($title): ItemDTO
    {
        DTOValidator::validate(self::TITLE_MIN_LENGTH, self::TITLE_MAX_LENGTH,
            $title, "text", "Title");

        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param $price
     * @return ItemDTO
     * @throws \Exception
     */
    public function setPrice(float $price): ItemDTO
    {
        DTOValidator::validate(self::PRICE_MIN, self::PRICE_MAX,
            $price, "number", "Price");

        $this->price = $price;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $description
     * @return ItemDTO
     * @throws \Exception
     */
    public function setDescription($description): ItemDTO
    {
        DTOValidator::validate(self::DESCRIPTION_MIN_LENGTH, self::DESCRIPTION_MAX_LENGTH,
            $description, "text", "Description");

        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param $image
     * @return ItemDTO
     * @throws \Exception
     */
    public function setImage($image): ItemDTO
    {

        DTOValidator::validate(self::IMAGE_MIN_LENGTH, self::IMAGE_MAX_LENGTH,
            $image, "text", "Image");

        $this->image = $image;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param mixed $categoryId
     */
    public function setCategoryId($categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }





}