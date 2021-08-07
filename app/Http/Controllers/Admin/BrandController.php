<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Repository\Eloquent\BrandRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BrandController extends Controller
{
    /**
     * @var BrandRepository $brandRepository
     */
    private $brandRepository;

    /**
     * CategoryController constructor.
     */
    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $limit = 10;
        $brands = $this->brandRepository->paginate($limit);
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * @param BrandRequest $request
     * @return RedirectResponse
     */
    public function store(BrandRequest $request): RedirectResponse
    {
        $callback = $this->brandRepository->create($request->validated());
        if(is_null($callback))
            return back()->withErrors(['error' => 'Что то пошло не так!'])->withInput();
        else
            return redirect()->route('admin.brand.index')->with('success', 'Успешно сохранен.');
    }

    /**
     * @param Brand $brand
     * @return Application|Factory|View
     */
    public function show(Brand $brand)
    {
        return view('admin.brand.show', compact('brand'));
    }

    /**
     * @param Brand $brand
     * @return Application|Factory|View
     */
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * @param BrandRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(BrandRequest $request, int $id): RedirectResponse
    {
        $callback = $this->brandRepository->update($id, $request->validated());
        if ($callback)
            return back()->with('success', 'Успешно изменрн.');
        else
            return back()->withErrors(['error' => 'Что то пошло не так!'])->withInput();
    }

    /**
     * @param Brand $brand
     * @return RedirectResponse
     */
    public function destroy(Brand $brand): RedirectResponse
    {
        try {
            $this->brandRepository->destroy($brand);

            return back()->with('success', 'Успешно удален бренд ' . $brand->getName());
        } catch (\Exception $exception) {
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
