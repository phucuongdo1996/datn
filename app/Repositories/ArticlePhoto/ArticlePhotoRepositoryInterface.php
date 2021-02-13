<?php


namespace App\Repositories\ArticlePhoto;


interface ArticlePhotoRepositoryInterface
{
    /**
     * Insert new data article-photo
     *
     * @param array $params
     *
     * @return boolean
     */
    public function insertData($params);
}
