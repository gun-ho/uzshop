<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class Image
 * @package App\Models
 * @property int $id
 * @property int $imageable_id
 * @property string $imageable_type
 * @property string $name
 * @property string $path
 * @property string $original_name
 * @property bool $is_main
 * @property string $ext
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Image extends Model
{
    use HasFactory;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param UploadedFile $file
     * @param string $type
     * @param int $parentId
     * @param bool $isMain
     * @return bool
     */
    public function create(UploadedFile $file, string $type, int $parentId, bool $isMain = false): bool
    {
        $extension            = $file->getClientOriginalExtension();
        $path                 = 'uploads/' . $type;
        $this->name           = session()->get('admin_id') . '_' . time() . '.' . $extension;
        $this->imageable_id   = $parentId;
        $this->imageable_type = $type;
        $this->path           = $path;
        $this->original_name  = $file->getClientOriginalName();
        $this->is_main        = $isMain;
        $this->ext            = $extension;
        $this->save();

        $file->move(public_path() . '/' . $path, $this->name);

        return true;
    }

    /**
     * @param UploadedFile $file
     * @param bool $isMain
     * @return bool
     */
    public function updateImage(UploadedFile $file, bool $isMain = false): bool
    {
        if(File::exists($this->getUrl()))
            File::delete($this->getUrl());

        $extension            = $file->getClientOriginalExtension();
        $path                 = 'uploads/' . $this->imageable_type;
        $this->name           = session()->get('admin_id') . '_' . time() . '.' . $extension;
        $this->path           = $path;
        $this->original_name  = $file->getClientOriginalName();
        $this->is_main        = $isMain;
        $this->ext            = $extension;
        $this->save();

        $file->move(public_path() . '/' . $path, $this->name);

        return true;
    }

    /**
     * @return bool|null
     */
    public function delete()
    {
        $callback = false;
        $path = $this->getFullPath();

        if(File::exists($path))
            $callback =  File::delete($path);
        if($callback === true)
            return parent::delete();
        return false;
    }

    /**
     * @return Application|UrlGenerator|string
     */
    public function getUrl()
    {
        return url($this->path . '/' . $this->name);
    }

    /**
     * @return string
     */
    public function getFullPath(): string
    {
        return public_path() . '/' . $this->path . '/' . $this->name;
    }

    /**
     * @return MorphTo
     */
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
