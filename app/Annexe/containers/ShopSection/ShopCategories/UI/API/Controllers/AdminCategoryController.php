<?php

namespace App\Annexe\containers\ShopSection\ShopCategories\UI\API\Controllers;

use App\Annexe\containers\ShopSection\ShopCategories\Repositories\CategoryRepository;
use App\Annexe\containers\ShopSection\ShopCategories\UI\API\Requests\CategoryRequest;
use App\Annexe\Ship\Core\Abstracts\Controllers\ApiControllerCore;
use Illuminate\Http\JsonResponse;

class AdminCategoryController extends ApiControllerCore
{
    /**
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    private $categoryRepository;

    /**
     * AdminOrdersController constructor.
     * @var categoryRepository
     */
    public function __construct()
    {
        $this->categoryRepository = app(CategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $categories = $this->categoryRepository->getAllCategories();

        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryRepository->addNewCategory($request->all());
    }

    /**
     * Get one cost category record by id
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $category = $this->categoryRepository->getOneCategory($id);

        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $this->categoryRepository->updateCategory($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categoryRepository->deleteCategory($id);
    }
}
