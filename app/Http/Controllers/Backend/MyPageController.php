<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\ArticlePhoto\ArticlePhotoRepositoryInterface;
use App\Repositories\Profile\ProfileRepositoryInterface;
use App\Repositories\Topic\TopicRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    /**
     * @var UserRepositoryInterface|\App\Repositories\User\UserEloquentRepository
     */
    private $userRepository;

    /**
     * Variable property repository
     *
     * @var \App\Repositories\Topic\TopicEloquentRepository;
     */
    private $topicRepository;

    /**
     * Variable articlePhoto repository
     *
     * @var \App\Repositories\ArticlePhoto\ArticlePhotoEloquentRepository;
     */
    private $articlePhotoRepository;

    /**
     * UserController constructor.
     * @param UserRepositoryInterface $userRepository
     * @param TopicRepositoryInterface $topicRepository
     * @param ArticlePhotoRepositoryInterface $articlePhotoRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        TopicRepositoryInterface $topicRepository,
        ArticlePhotoRepositoryInterface $articlePhotoRepository
    ) {
        $this->userRepository = $userRepository;
        $this->topicRepository = $topicRepository;
        $this->articlePhotoRepository = $articlePhotoRepository;
    }

    /**
     * Show data user in view
     *
     * @param $role
     * @param $userId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($role, $userId)
    {
        abort_if(!in_array($role, array_keys(ROLE_MY_PAGES)), 404);
        $userProfile = $this->userRepository->getTypeOfUserById($userId, ROLE_MY_PAGES[$role]);
        abort_if(!$userProfile, 404);
        return view('backend.my_pages.my_page', [
            'userProfile' => $userProfile,
            'countDataTopic' => $this->topicRepository->countDataForUserNormal($userId),
            'dataTopic' => $this->topicRepository->getListData($userId, LIMIT_POST_USER_NORMAL),
            'numberPhotoPost' => $this->articlePhotoRepository->countRecord($userId),
            'countDataPhoto' => $this->articlePhotoRepository->countDataForUserNormal($userId),
            'articlePhotos' =>  $this->articlePhotoRepository->getNumberRecords($userId, FLAG_THREE),
        ]);
    }
}
