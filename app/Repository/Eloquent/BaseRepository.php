<?php


namespace App\Repository\Eloquent;


use App\Repository\Interfaces\EloquentRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model $model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function paginate($limit = 10): LengthAwarePaginator
    {
        return $this->model->query()->orderByDesc('id')->paginate($limit);
    }

    /**
     * @param $id
     * @return Model|null
     */
    public function find($id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes): bool
    {
        $model = $this->find($id);
        return $model->update($attributes);
    }

    /**
     * @param Model $model
     * @return bool
     * @throws \Exception
     */
    public function destroy(Model $model): bool
    {
        try {
            return $model->delete();
        } catch (\Exception $exception) {
            throw new \Exception($exception);
        }
    }
}
