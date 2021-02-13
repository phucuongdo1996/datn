<?php

namespace App\Repositories\GeneralInfoProperty;

use App\Models\GeneralInfoProperty;
use App\Repositories\BaseRepository;
use App\Repositories\GeneralImagesProperty\GeneralImagesPropertyRepositoryInterface;
use Illuminate\Support\Facades\DB;

class GeneralInfoPropertyEloquentRepository extends BaseRepository implements GeneralInfoPropertyRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return GeneralInfoProperty::class;
    }

    /**
     * Create general info Property
     *
     * @param $data
     * @return mixed|null
     */
    public function createRecord($data)
    {
        DB::beginTransaction();
        try {
            $data['price'] = convertStringToNumber($data['price']);
            $generalProperty = $this->findByAttribute('property_id', $data['property_id']);
            $this->saveGeneralImages($generalProperty, $data);
            if ($generalProperty) {
                $generalProperty = $this->update($generalProperty->id, $data);
            } else {
                $generalProperty = $this->create($data);
            }
            DB::commit();
            return $generalProperty;
        } catch (\Exception $exception) {
            DB::rollBack();
            report($exception);
            return null;
        }
    }

    /**
     * Save general images
     *
     * @param $generalProperty
     * @param $data
     */
    public function saveGeneralImages($generalProperty, &$data)
    {
        $this->removeImage($generalProperty, $data);
        $generalImages = resolve(GeneralImagesPropertyRepositoryInterface::class);
        if (isset($data['image_info'])) {
            foreach ($data['image_info'] as $imageItem) {
                $fileName = saveImageInFolder($imageItem, FOLDER_NAME_SAVE_GENERAL_INFO);
                $generalImages->create([
                    'property_id' => $data['property_id'],
                    'image_name' => $fileName['avatar'],
                    'image_name_thumbnail' => $fileName['avatar_thumbnail'],
                    'type_image' => FLAG_ONE,
                ]);
            }
        }
        if (isset($data['map_image_1'])) {
            $data['map_image_1'] = saveImageInFolder($data['map_image_1'], FOLDER_NAME_SAVE_GENERAL_INFO)['avatar'];
        }
        if (isset($data['map_image_2'])) {
            $data['map_image_2'] = saveImageInFolder($data['map_image_2'], FOLDER_NAME_SAVE_GENERAL_INFO)['avatar'];
        }
    }

    /**
     * Remove images
     *
     * @param $generalProperty
     * @param $data
     */
    public function removeImage($generalProperty, $data) {
        if ($generalProperty) {
            if (isset($data['map_image_1'])) {
                removeImagesInFolder('/public/' . FOLDER_NAME_SAVE_GENERAL_INFO, $generalProperty->map_image_1);
            }
            if (isset($data['map_image_2'])) {
                removeImagesInFolder('/public/' . FOLDER_NAME_SAVE_GENERAL_INFO, $generalProperty->map_image_2);
            }
        }
        if (empty($data['image_delete'])) {
            return;
        }
        $generalImages = resolve(GeneralImagesPropertyRepositoryInterface::class);
        foreach ($data['image_delete'] as $item) {
            $split = explode('/', $item);
            $fileName = end($split);
            $fileName = substr($fileName, FLAG_TEN, strlen($fileName) - FLAG_TEN);
            removeImagesInFolder('/public/' . FOLDER_NAME_SAVE_GENERAL_INFO, $fileName);
            $generalImages->removeImageByFileName(end($split));
        }
    }

    /**
     * Find by attribute
     *
     * @param $attribute
     * @param $value
     * @return |null
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
            $record = $this->model->where('property_id', $propertyId)->first();
            removeImagesInFolder('/public/' . FOLDER_NAME_SAVE_GENERAL_INFO, $record->map_image_1);
            removeImagesInFolder('/public/' . FOLDER_NAME_SAVE_GENERAL_INFO, $record->map_image_2);
            $record->delete();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            report($exception);
        }
    }
}
