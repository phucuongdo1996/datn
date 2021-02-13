<?php


namespace App\Repositories\Topic;


interface TopicRepositoryInterface
{
    /**
     * get all
     *
     * @return mixed
     */
    public function getAll();

    /**
     * Get data by id of user
     *
     * @param $idTopic
     * @param $idUser
     * @return mixed
     */
    public function getDataByIdOfUser($idTopic, $idUser);
}
