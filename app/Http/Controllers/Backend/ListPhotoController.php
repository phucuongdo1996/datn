<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\ArticlePhoto\ArticlePhotoRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class ListPhotoController extends Controller
{
    /**
     * @var \App\Repositories\ArticlePhoto\ArticlePhotoEloquentRepository;
     */
    private $articlePhotoRepository;

    /**
     * @var UserRepositoryInterface|\App\Repositories\User\UserEloquentRepository
     */
    private $userRepository;

    /**
     * ArticlePhotoController constructor.
     * @param UserRepositoryInterface $userRepository
     * @param ArticlePhotoRepositoryInterface $articlePhotoRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        ArticlePhotoRepositoryInterface $articlePhotoRepository
    ) {
        $this->userRepository = $userRepository;
        $this->articlePhotoRepository = $articlePhotoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $articlePhotos = $this->articlePhotoRepository->getAttributeByValue('user_id', $id, FLAG_TWENTY);
        $roleUser = $this->userRepository->getRoleUserById($id);
        abort_if(!$articlePhotos || !$roleUser, 404);
        $countData = $this->articlePhotoRepository->countDataForUserNormal($id);
        return view('backend.my_pages.photo_archive.photo_list')->with([
            'userProfile' => $this->userRepository->getTypeOfUserById($id, $roleUser->role),
            'articlePhotos' => $articlePhotos,
            'countData' => $countData
        ]);
    }

    /**
     * Function show all photo
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPhotos()
    {
        return view('user.list_photo')->with(['articlePhotos' => $this->articlePhotoRepository->getPhotos()]);
    }
}
