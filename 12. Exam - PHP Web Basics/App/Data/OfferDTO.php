<?php

namespace App\Data;


class OfferDTO
{
    private const PRICE_MIN = 1;
    private const PRICE_MAX = 50;

    private const DAYS_MIN = 1;
    private const DAYS_MAX = 50;

    private const DESCRIPTION_MIN_LENGTH = 10;
    private const DESCRIPTION_MAX_LENGTH = 10000;


    private $id;
    private $price;
    private $days;
    private $description;
    private $pictureUrl;
    private $roomId;
    private $townId;
    private $userId;
    private $isOccupied;
    private $addedOn;


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
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param $price
     * @return OfferDTO
     * @throws \Exception
     */
    public function setPrice(float $price): OfferDTO
    {
        DTOValidator::validate(self::PRICE_MIN, self::PRICE_MAX,
            $price, "price", "Price");

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
     * @return OfferDTO
     * @throws \Exception
     */
    public function setDescription($description): OfferDTO
    {
        DTOValidator::validate(self::DESCRIPTION_MIN_LENGTH, self::DESCRIPTION_MAX_LENGTH,
            $description, "text", "Description");

        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPictureurl()
    {
        return $this->pictureUrl;
    }

    /**
     * @param $pictureUrl
     * @return OfferDTO
     * @throws \Exception
     */
    public function setPictureurl($pictureUrl): OfferDTO
    {
        $this->pictureUrl = $pictureUrl;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoomId()
    {
        return $this->roomId;
    }

    /**
     * @param mixed $roomId
     */
    public function setRoomId($roomId): OfferDTO
    {
        $this->roomId = $roomId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTownId()
    {
        return $this->townId;
    }

    /**
     * @param mixed $townId
     */
    public function setTownId($townId): OfferDTO
    {
        $this->townId = $townId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * @param mixed $days
     */
    public function setDays($days): OfferDTO
    {
        DTOValidator::validate(self::DAYS_MIN, self::DAYS_MAX,
            $days, "days", "Days");

        $this->days = $days;

        return $this;
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

    /**
     * @return mixed
     */
    public function getIsOccupied()
    {
        return $this->isOccupied;
    }

    /**
     * @param mixed $isOccupied
     */
    public function setIsOccupied($isOccupied): void
    {
        $this->isOccupied = $isOccupied;
    }

    /**
     * @return mixed
     */
    public function getAddedOn()
    {
        return $this->addedOn;
    }

    /**
     * @param mixed $addedOn
     */
    public function setAddedOn($addedOn): void
    {
        $this->addedOn = $addedOn;
    }


}
