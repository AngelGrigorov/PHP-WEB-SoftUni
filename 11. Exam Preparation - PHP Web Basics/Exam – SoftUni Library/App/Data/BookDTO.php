<?php

namespace App\Data;


class BookDTO
{
    private CONST TITLE_MIN_LENGTH=3;
    private CONST TITLE_MAX_LENGTH=50;

    private CONST AUTHOR_MIN_LENGTH=3;
    private CONST AUTHOR_MAX_LENGTH=50;

    private CONST DESCRIPTION_MIN_LENGTH=10;
    private CONST DESCRIPTION_MAX_LENGTH=10000;

    private CONST IMAGE_MIN_LENGTH=10;
    private CONST IMAGE_MAX_LENGTH=10000;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $imageURL;

    /**
     * @var GenreDTO
     */
    private $genre;

    /**
     * @var UserDTO
     */
    private $user;

    /**
     * @var string
     */
    private $addedOn;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @throws \Exception
     */
    public function setTitle(string $title): void
    {
        DtoValidator::validate(
            self::TITLE_MIN_LENGTH,
            self::TITLE_MAX_LENGTH,
            $title,
            'text',
            'Title');
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @throws \Exception
     */
    public function setAuthor(string $author): void
    {
        DtoValidator::validate(
            self::AUTHOR_MIN_LENGTH,
            self::AUTHOR_MAX_LENGTH,
            $author,
            'text',
            'Author');
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @throws \Exception
     */
    public function setDescription(string $description): void
    {
        DtoValidator::validate(
            self::DESCRIPTION_MIN_LENGTH,
            self::DESCRIPTION_MAX_LENGTH,
            $description,
            'text',
            'Description');
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getImageURL(): string
    {
        return $this->imageURL;
    }

    /**
     * @param string $imageURL
     * @throws \Exception
     */
    public function setImageURL(string $imageURL): void
    {
        DtoValidator::validate(
            self::IMAGE_MIN_LENGTH,
            self::IMAGE_MAX_LENGTH,
            $imageURL,
            'text',
            'Image URL');
        $this->imageURL = $imageURL;
    }

    /**
     * @return GenreDTO
     */
    public function getGenre(): GenreDTO
    {
        return $this->genre;
    }

    /**
     * @param GenreDTO $genre
     */
    public function setGenre(GenreDTO $genre): void
    {
        $this->genre = $genre;
    }

    /**
     * @return UserDTO
     */
    public function getUser(): UserDTO
    {
        return $this->user;
    }

    /**
     * @param UserDTO $user
     */
    public function setUser(UserDTO $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getAddedOn(): string
    {
        return $this->addedOn;
    }

    /**
     * @param string $addedOn
     */
    public function setAddedOn(string $addedOn): void
    {
        $this->addedOn = $addedOn;
    }



}