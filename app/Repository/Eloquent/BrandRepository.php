<?php


namespace App\Repository\Eloquent;


use App\Models\Brand;
use App\Models\Image;
use App\Repository\Interfaces\EloquentRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;

class BrandRepository extends BaseRepository implements EloquentRepositoryInterface
{

    /**
     * @var Brand $brand
     */
    protected $brand;

    /**
     * BrandRepository constructor.
     * @param Brand $brand
     */
    public function __construct(Brand $brand)
    {
        parent::__construct($brand);
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        /**
         * @var Brand $callback
         */
        $callback = $this->model->create($attributes);

        if(is_null($callback))
            return $callback;
        else {
            (new Image())->create($attributes['image'], 'Brand', $callback->getId());
            return $callback;
        }
    }

    /**
     * @param Model $model
     * @return bool
     * @throws Exception
     */
    public function destroy(Model $model): bool
    {
        /** @var Brand $model */

        $callback = false;

        $image = $model->image;

        if($image !== null)
            $callback = $image->delete();

        if($callback === true)
            $callback = parent::destroy($model);
        return $callback;
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes): bool
    {
        /** @var Brand $brand */
        $brand = $this->find($id);

        $callback = $brand->update($attributes);

        if($callback)
            $brand->image->updateImage($attributes['image']);
        else
            return $callback;

        return true;
    }

    /**
     * @param $id
     * @return Model|null
     */
    public function find($id): ?Model
    {
        return Brand::query()->findOrFail($id);
    }
}
