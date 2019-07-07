<?php

namespace App\Http;


use App\Data\EditOfferDTO;
use App\Data\ErrorDTO;
use App\Data\OfferDTO;
use App\Service\RoomsServiceInterface;
use App\Service\TownsServiceInterface;
use App\Service\OfferServiceInterface;
use Core\DataBinderInterface;
use Core\TemplateInterface;

class OfferHttpHandler extends HttpHandlerAbstract
{
    /**
     * @var TownsServiceInterface
     */
    private $townService;

    /**
     * @var RoomsServiceInterface
     */
    private $roomService;

    /**
     * @var OfferServiceInterface
     */
    private $itemService;

    public function __construct(TemplateInterface $template,
                                DataBinderInterface $dataBinder,
                                TownsServiceInterface $categoryService,
                                RoomsServiceInterface $roomsService,
                                OfferServiceInterface $itemService)
    {
        parent::__construct($template, $dataBinder);
        $this->townService = $categoryService;
        $this->roomService = $roomsService;
        $this->itemService = $itemService;
    }

    public function add(array $formData = [])
    {
        if (isset($formData['add'])) {
            $this->handleAddProcess($formData);
        } else {
            $this->render("offers/add", [
                'towns' => $this->townService->getAll(),
                'rooms' => $this->roomService->getAll()
            ]);
        }
    }

    public function myItems()
    {
        $this->render("offers/mine", $this->itemService->getByUserId($_SESSION['id']));
    }

    public function all()
    {
        $this->render("offers/all", $this->itemService->getAll());
    }

    public function edit(array $formData = [])
    {
        if (isset($formData['edit'])) {
            $this->handleEditProcess($formData);
        } else {
            $dto = $this->getEditDTO();
            $this->render("offers/edit", $dto);
        }
    }

    private function handleAddProcess(array $formData)
    {
        try {
            /** @var OfferDTO $dto */
            $dto = $this->dataBinder->bind($formData, OfferDTO::class);
            $dto->setUserId($_SESSION['id']);
            $this->itemService->create($dto);
            $this->redirect("my_offers.php");
        } catch (\Exception $ex) {
            $this->render("offers/add", [
                'towns' => $this->townService->getAll(),
                'rooms' => $this->roomService->getAll()
                ],
                [$ex->getMessage()]);
        }
    }


    private function handleEditProcess(array $formData)
    {
        try {
            /** @var EditOfferDTO $dto */
            $dto = $this->dataBinder->bind($formData, EditOfferDTO::class);
            $dto->setUserId($_SESSION['id']);
            $dto->setId($_GET['id']);
            $this->itemService->edit($dto, $_SESSION['id']);
            $this->redirect("my_offers.php");
        } catch (\Exception $ex) {
            $dto = $this->getEditDTO();

            $this->render("offers/edit", $dto,
                [$ex->getMessage()]);
        }
    }

    public function delete(array $queryData = [])
    {
        $this->itemService->delete($queryData['id'], $_SESSION['id']);
        $this->redirect('my_offers.php');
    }

    public function rent(array $queryData = [])
    {
        $this->itemService->rent($queryData['id'], $_SESSION['id']);
        $this->redirect('all_offers.php');
    }

    public function view(array $queryData = [])
    {
        $item = $this->itemService->getOne($queryData['id']);
        $this->render('offers/view', $item);
    }

    /**
     * @return EditOfferDTO
     * @throws \Exception
     */
    private function getEditDTO(): EditOfferDTO
    {
        $item = $this->itemService->getOne($_GET['id']);
        $dto = new EditOfferDTO();
        $dto->setTowns($this->townService->getAll());
        $dto->setRooms($this->roomService->getAll());
        $dto->setId($item->getId());
        $dto->setPrice($item->getPrice());
        $dto->setDays($item->getDays());
        $dto->setDescription($item->getDescription());
        $dto->setPictureurl($item->getPictureUrl());
        return $dto;
    }


}
