<?php

namespace App\Repositories\ArticlePhoto;

use App\Models\ArticlePhoto;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArticlePhotoEloquentRepository extends BaseRepository implements ArticlePhotoRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return ArticlePhoto::class;
    }

    /**
     * @param integer $userId
     *
     * @return integer
     */
    public function countRecord($userId)
    {
        return $this->model->where('user_id', $userId)->count();
    }

    /**
     * Insert new data article-photo
     *
     * @param array $params
     *
     * @return boolean
     */
    public function insertData($params)
    {
        try {
            $this->saveImages($params);
            return $this->create($params);
        } catch (\Exception $exception) {
            report($exception);
            return false;
        }
    }

    /**
     * Update data article-photo
     *
     * @param integer $id
     * @param array $params
     *
     * @return boolean
     */
    public function updateData($id, $params)
    {
        try {
            $this->saveImages($params);
            $this->update($id, $params);
            return true;
        } catch (\Exception $exception) {
            report($exception);
            return false;
        }
    }

    /**
     * Save images
     *
     * @param array $params
     */
    public function saveImages(&$params)
    {
        if (isset($params['image_1'])) {
            $params['image_1'] = $this->pushImageIntoStorage($params['image_1']);
        }
        if (isset($params['image_2'])) {
            $params['image_2'] = $this->pushImageIntoStorage($params['image_2']);
        }
        if (isset($params['image_3'])) {
            $params['image_3'] = $this->pushImageIntoStorage($params['image_3']);
        }
    }

    /**
     * Save images into storage
     *
     * @param  UploadedFile  $image
     *
     * @return string|null
     */
    public function pushImageIntoStorage(UploadedFile $image)
    {
        try {
            $imageName = time() . $image->hashName();
            Storage::disk('public')->putFileAs(FOLDER_NAME_SAVE_ARTICLE_PHOTO, $image, $imageName);
            $imageResized = $this->resizeImage(getimagesize($image));
            Image::make($image->path())->resize($imageResized[FLAG_ZERO], $imageResized[FLAG_ONE])
                ->save(storage_path('/app/public' . FOLDER_NAME_SAVE_ARTICLE_PHOTO . $imageName));
            return $imageName;
        } catch (\Exception $exception) {
            report($exception);
            return null;
        }
    }

    /**
     * Resize image
     *
     * @param  array  $image
     *
     * @return array
     */
    public function resizeImage(array $image)
    {
        if ($image[FLAG_ZERO] > $image[FLAG_ONE] && $image[FLAG_ZERO] > ARTICLE_PHOTO_MAX_SIZE) {
            $image[FLAG_ONE] = round($image[FLAG_ONE] * divisionNumber(ARTICLE_PHOTO_MAX_SIZE, $image[FLAG_ZERO]));
            $image[FLAG_ZERO] = ARTICLE_PHOTO_MAX_SIZE;
        } elseif ($image[FLAG_ONE] > $image[FLAG_ZERO] && $image[FLAG_ONE] > ARTICLE_PHOTO_MAX_SIZE) {
            $image[FLAG_ZERO] = round($image[FLAG_ZERO] * divisionNumber(ARTICLE_PHOTO_MAX_SIZE, $image[FLAG_ONE]));
            $image[FLAG_ONE] = ARTICLE_PHOTO_MAX_SIZE;
        } elseif ($image[FLAG_ZERO] == $image[FLAG_ONE] && $image[FLAG_ZERO] > ARTICLE_PHOTO_MAX_SIZE) {
            $image[FLAG_ZERO] = $image[FLAG_ONE] = ARTICLE_PHOTO_MAX_SIZE;
        }

        return $image;
    }

    /**
     * Remove images in storage and reset prams image
     *
     * @param $params
     * @param $currentArticlePhoto
     */
    public function removeCurrentImages(&$params, $currentArticlePhoto)
    {
        $changePhotos = ['image_1' => $params['base_image_1'],
                         'image_2' => $params['base_image_2'],
                         'image_3' => $params['base_image_3']];
        foreach ($changePhotos as $key => $photo) {
            if ($photo !== $currentArticlePhoto[$key]) {
                Storage::disk('public')->delete(FOLDER_NAME_SAVE_ARTICLE_PHOTO . $currentArticlePhoto[$key]);
                isset($params[$key]) ? $params[$key] : $params[$key] = null;
            }
        }
    }

    /**
     * Get attribute by value
     *
     * @param $attribute
     * @param $value
     * @param $paginate
     * @return mixed
     */
    public function getAttributeByValue($attribute, $value, $paginate)
    {
        return $this->model->where($attribute, $value)->orderBy('id', 'asc')->paginate($paginate);
    }

    /**
     * Get data article photo by id
     *
     * @param integer $id
     * @param integer $userId
     *
     * @return mixed
     */
    public function getDataByIdOfUser($id, $userId)
    {
        return $this->where('user_id', $userId)->find($id);
    }

    /**
     * function count data for user normal
     *
     * @return mixed
     */
    public function countDataForUserNormal($userId)
    {
        return $this->model->where('user_id', $userId)->count();
    }

    /**
     * Get number page
     *
     * @param int $perPage
     * @param int $page
     *
     * @return int
     */
    public function getPageNumber($perPage, $page): int
    {
        if ($this->count() == ($page - FLAG_ONE) * $perPage) {
            return $page - FLAG_ONE;
        }

        return $page;
    }

    /**
     * Get records with number
     *
     * @param $userId
     * @param $number
     * @return mixed
     */
    public function getNumberRecords($userId, $number)
    {
        return $this->model->where('user_id', $userId)
            ->orderBy('id', 'asc')
            ->limit($number)
            ->get();
    }

    /**
     * Get data with table relation by id
     *
     * @param int $id
     * @return mixed
     */
    public function getDataWithRelationById($id)
    {
        return $this->model->with(['user' => function ($query) {
               $query->with('profile:user_id,nick_name,person_charge_last_name,person_charge_first_name');
        }])->find($id);
    }

    /**
     * get list by condition
     *
     * @param integer $userId
     * @param array $params
     * @param integer $paginate
     * @return mixed
     */
    public function getListByCondition($userId, $params, $paginate)
    {
        return $this->model->selectRaw('article_photos.id, article_photos.image_1, article_photos.image_2, article_photos.image_3
                , article_photos.caption, article_photos.created_at, CONCAT(profiles.person_charge_last_name, profiles.person_charge_first_name) as user_name
                , profiles.avatar_thumbnail, profiles.company_name, profiles.user_id')
            ->join('profiles', 'article_photos.user_id', 'profiles.user_id')
            ->when(isset($params['user_name']), function ($query) use ($params) {
                return $query->whereRaw('CONCAT(profiles.person_charge_last_name, profiles.person_charge_first_name) like "%' . $params['user_name'] . '%"');
            })
            ->when(isset($userId), function ($query) use ($userId) {
                return $query->where('profiles.user_id', $userId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($paginate);
    }

    /**
     * Get data with table relation by id
     *
     * @param int $id
     * @return mixed
     */
    public function getDataWithRelationByIdWithTrash($id)
    {
        return $this->model->withTrashed()->with(['user' => function ($query) {
            $query->with('profile:user_id,nick_name,person_charge_last_name,person_charge_first_name');
        }])->find($id);
    }

    /**
     * function delete photo
     * @param array $params
     * @param int $id
     * @return bool
     */
    public function deletePhoto($params, $id)
    {
        DB::beginTransaction();
        try {
            $params['unblock_status'] = FLAG_ONE;
            $data = $this->update($id, $params);
            $data->delete();
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return false;
        }
    }

    /**
     * Get new article photos
     *
     * @return mixed
     */
    public function getNewArticlePhotos()
    {
        return $this->model->with('profile:user_id,avatar_thumbnail,company_name')
            ->with('user:id,role')
            ->orderBy('created_at', 'DESC')->take(FLAG_SIX)->get()->toArray();
    }

    /**
     * Get new article photos user
     *
     * @param $user
     * @return array
     */
    public function getNewArticlePhotosUser($user)
    {
        if ($user) {
            return $this->model->with('profile:user_id,person_charge_last_name,person_charge_first_name,avatar_thumbnail,company_name')
                ->where('user_id', $user->id)->orderBy('created_at', 'DESC')->take(FLAG_SIX)->get()->toArray();
        }
        return [];
    }

    /**
     * Get all article photos
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPhotos()
    {
        return $this->model->with('profile:user_id,avatar_thumbnail,company_name,person_charge_last_name,person_charge_first_name')
            ->orderBy('created_at', 'DESC')->paginate(FLAG_TWENTY_ONE);
    }
}
