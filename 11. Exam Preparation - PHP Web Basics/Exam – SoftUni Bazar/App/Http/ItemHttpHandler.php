<?php

namespace App\Http;


use App\Data\EditItemDTO;
use App\Data\ErrorDTO;
use App\Data\ItemDTO;
use App\Service\CategoryServiceInterface;
use App\Service\ItemServiceInterface;
use Core\DataBinderInterface;
use Core\TemplateInterface;

class ItemHttpHandler extends HttpHandlerAbstract
{
    /**
     * @var CategoryServiceInterface
     */
    private $categoryService;

    /**
     * @var ItemServiceInterface
     */
    private $itemService;

    public function __construct(TemplateInterface $template,
                                DataBinderInterface $dataBinder,
                                CategoryServiceInterface $categoryService,
                                ItemServiceInterface $itemService)
    {
        parent::__construct($template, $dataBinder);
        $this->categoryService = $categoryService;
        $this->itemService = $itemService;
    }

    public function add(array $formData = [])
    {
        if (isset($formData['add'])) {
            $this->handleAddProcess($formData);
        } else {
            $this->render("items/add", $this->categoryService->getAll());
        }
    }

    public function myItems()
    {
        $this->render("items/mine", $this->itemService->getByUserId($_SESSION['id']));
    }

    public function all()
    {
        $this->render("items/all", $this->itemService->getAll());
    }

    public function edit(array $formData = [])
    {
        if (isset($formData['edit'])) {
            $this->handleEditProcess($formData);
        } else {
            $dto = $this->getEditDTO();
            $this->render("items/edit", $dto);
        }
    }

    private function handleAddProcess(array $formData)
    {
        try {
            /** @var ItemDTO $dto */
            $dto = $this->dataBinder->bind($formData, ItemDTO::class);
            $dto->setUserId($_SESSION['id']);
            $this->itemService->create($dto);
            $this->redirect("my_items.php");
        } catch (\Exception $ex) {
            $this->render("items/add", $this->categoryService->getAll(),
                [$ex->getMessage()]);
        }
    }


    private function handleEditProcess(array $formData)
    {
        try {
            /** @var EditItemDTO $dto */
            $dto = $this->dataBinder->bind($formData, EditItemDTO::class);
            $dto->setUserId($_SESSION['id']);
            $dto->setId($_GET['id']);
            $this->itemService->edit($dto, $_SESSION['id']);
            $this->redirect("my_items.php");
        } catch (\Exception $ex) {
            $dto = $this->getEditDTO();

            $this->render("items/edit", $dto,
                [$ex->getMessage()]);
        }
    }

    public function delete(array $queryData = [])
    {
        $this->itemService->delete($queryData['id'], $_SESSION['id']);
        $this->redirect('my_items.php');
    }

    public function view(array $queryData = [])
    {
        $item = $this->itemService->getOne($queryData['id']);
        $this->render('items/view', $item);
    }

    /**
     * @return EditItemDTO
     * @throws \Exception
     */
    private function getEditDTO(): EditItemDTO
    {
        $item = $this->itemService->getOne($_GET['id']);

        $dto = new EditItemDTO();
        $dto->setId($item->getId());
        $dto->setUserId($item->getUserId());
        $dto->setTitle($item->getTitle());
        $dto->setDescription($item->getDescription());
        $dto->setCategoryId($item->getCategoryId());
        $dto->setImage($item->getImage());
        $dto->setPrice($item->getPrice());

        $dto->setCategories($this->categoryService->getAll());
        return $dto;
    }


}