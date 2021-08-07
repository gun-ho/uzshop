<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repository\Eloquent\CategoryRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository $categoryRepository
     */
    private $categoryRepository;

    /**
     * CategoryController constructor.
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $limit = 10;
        $categories = $this->categoryRepository->paginate($limit);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $callback = $this->categoryRepository->create($request->validated());
        if(is_null($callback))
            return back()->withErrors(['error' => 'Что то пошло не так!'])->withInput();
        else
            return redirect()->route('admin.category.index')->with('success', 'Успешно сохранен.');
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * @param CategoryRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, $id): RedirectResponse
    {
        $callback = $this->categoryRepository->update($id, $request->validated());
        if($callback)
            return back()->with('success', 'Успешно сохранен.');
        else
            return back()->withErrors(['error' => 'Что то пошло не так!'])->withInput();
    }

    /**
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        if($category->delete())
            return back()->with('success', 'Успешно удален.');
        else
            return back()->withErrors(['error' => 'Что то пошло не так!']);
    }
}
