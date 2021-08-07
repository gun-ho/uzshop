<?php


namespace App\Repository\Eloquent;


use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminLoginRepository extends BaseRepository
{
    /**
     * AdminLoginRepository constructor.
     * @param Admin $model
     */
    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function auth(Request $request): bool
    {
        /**
         * @var Admin $user
         */
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only([
            'username',
            'password'
        ]);

        try {

            $user = $this->model->where([
                'username' => $credentials['username'],
            ])->firstOrFail();

            if(Hash::check($credentials['password'], $user->password)) {
                $request->session()->put('admin_login', true);
                $request->session()->put('admin_id', $user->id);
            } else
                throw new ModelNotFoundException('Логин или парол не правильно!');

            return true;

        } catch (ModelNotFoundException $exception) {
            return false;
        }
    }
}
