<?php

namespace App\Repositories\GeneralImagesProperty;

use App\Models\GeneralImagesProperty;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class GeneralImagesPropertyEloquentRepository extends BaseRepository implements GeneralImagesPropertyRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return GeneralImagesProperty::class;
    }

    /**
     * Remove image by FileName
     *
     * @param $fileName
     */
    public function removeImageByFileName($fileName)
    {
        $record = $this->model->where('image_name_thumbnail', $fileName)->first();
        if ($record) {
            $record->forceDelete();
        }
    }

    /**
     * get Images
     *
     * @param $propertyId
     * @return array
     */
    public function getImages($propertyId)
    {
        $mapImages = $this->model->where([
            'property_id' => $propertyId,
        ])->get();
        if ($mapImages) {
            return $mapImages->toArray();
        }
        return [];
    }

    /**
     * find by Attribute
     *
     * @param $attribute
     * @param $value
     * @return mixed|null
     */
    public function findByAttribute($attribute, $value)
    {
        $record = $this->model->where($attribute, $value)->first();
        if ($record) {
            return $record;
        }
        return null;
    }

    /**
     * Delete record by propertyId
     *
     * @param $propertyId
     */
    public function deleteRecordByPropertyId($propertyId)
    {
        DB::beginTransaction();
        try {
            $listRecord = $this->model->where('property_id', $propertyId)->get();
            foreach ($listRecord as $record) {
                removeImagesInFolder('/public/' . FOLDER_NAME_SAVE_GENERAL_INFO, $record->image_name);
                $record->delete();
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            report($exception);
        }
    }
}
