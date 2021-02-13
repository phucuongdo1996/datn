<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\ArticlePhoto\ArticlePhotoRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ArticlePhotoController extends Controller
{
    /**
     * @var \App\Repositories\ArticlePhoto\ArticlePhotoEloquentRepository;
     */
    private $articlePhotoRepository;

    /**
     * User proxy
     *
     * @var
     */
    private $userProxy;

    /**
     * ArticlePhotoController constructor.
     * @param ArticlePhotoRepositoryInterface $articlePhotoRepository
     */
    public function __construct(
        ArticlePhotoRepositoryInterface $articlePhotoRepository
    ) {
        $this->articlePhotoRepository = $articlePhotoRepository;
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->userProxy = Auth::user()->userProxy(CHANGE_MYPAGE);
                abort_if(!$this->userProxy, 403);
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articlePhotos = $this->articlePhotoRepository->getAttributeByValue('user_id', $this->userProxy->id, FLAG_TWENTY);
        abort_if(!$articlePhotos, 404);
        return view('backend.my_pages.photo_archive.index', compact('articlePhotos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        abort_if($this->userProxy->role === INVESTOR, 404);
        return view('backend.my_pages.photo_archive.photo_add', [
            'numberPhotoPost' => $this->articlePhotoRepository->countRecord($this->userProxy->id),
            'userProxy' => $this->userProxy,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if (in_array($this->userProxy->getMemberStatus(), [FREE, BASIC]) && $this->articlePhotoRepository->countRecord($this->userProxy->id) >= ARTICLE_PHOTO_MAX_POST) {
            return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.article_photo.error_max_post'));
        }
        if ($this->articlePhotoRepository->insertData($request->all())) {
            return redirect()->route(USER_PHOTO_ARCHIVE_INDEX)->with(STR_SUCCESS_FLASH, trans('messages.photo.create_success'));
        } else {
            Session::flash(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        abort_if($this->userProxy->role === INVESTOR, 404);
        $articlePhoto = $this->articlePhotoRepository->getDataByIdOfUser($id, $this->userProxy->id);
        abort_if(!$articlePhoto, 404);
        return view('backend.my_pages.photo_archive.photo_edit')->with([
            'articlePhoto' => $articlePhoto->toArray(),
            'userProxy' => $this->userProxy
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $params = $request->all();
        $currentArticlePhoto = $this->articlePhotoRepository->getDataByIdOfUser($id, $this->userProxy->id);
        abort_if(!$currentArticlePhoto, 404);
        if ($currentArticlePhoto['updated_at'] > $params['current_time']) {
            return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
        }
        $this->articlePhotoRepository->removeCurrentImages($params, $currentArticlePhoto->toArray());
        if ($this->articlePhotoRepository->updateData($id, $params)) {
            return redirect()->route(USER_PHOTO_ARCHIVE_INDEX)->with(STR_SUCCESS_FLASH, trans('messages.photo.edit_success'));
        } else {
            return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request)
    {
        if ($this->articlePhotoRepository->deleteById($request->get('article_photo_id'))) {
            return redirect()->route(USER_PHOTO_ARCHIVE_INDEX, [
                'page' => $this->articlePhotoRepository->getPageNumber(FLAG_TWENTY, request('page'))
            ])->with(STR_FLASH_SUCCESS, trans('messages.email.delete_photo.delete_success'));
        };
        return redirect()->back()->with(STR_ERROR_FLASH, trans('messages.something_wrong'));
    }
}
