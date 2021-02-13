<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Repositories\ArticlePhoto\ArticlePhotoRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Topic\TopicRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TopicController extends Controller
{
    /**
     * Variable property repository
     *
     * @var \App\Repositories\Topic\TopicEloquentRepository;
     */
    private $topicRepository;

    /**
     * Variable property repository
     *
     * @var \App\Repositories\Category\CategoryEloquentRepository;
     */
    private $categoryRepository;

    /**
     * @var UserRepositoryInterface|\App\Repositories\User\UserEloquentRepository
     */
    private $userRepository;

    /**
     * Variable articlePhoto repository
     *
     * @var \App\Repositories\ArticlePhoto\ArticlePhotoEloquentRepository;
     */
    private $articlePhotoRepository;

    /**
     * User Proxy
     *
     * @var
     */
    private $userProxy;

    /**
     * TaxController constructor.
     * @param TopicRepositoryInterface $topicRepository
     * @param CategoryRepositoryInterface $categoryRepository
     *  @param UserRepositoryInterface $userRepository
     * @param ArticlePhotoRepositoryInterface $articlePhotoRepository
     */
    public function __construct(
        TopicRepositoryInterface $topicRepository,
        CategoryRepositoryInterface $categoryRepository,
        ArticlePhotoRepositoryInterface $articlePhotoRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->topicRepository = $topicRepository;
        $this->categoryRepository = $categoryRepository;
        $this->userRepository = $userRepository;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $perPage = isset($request->option_paginate) && in_array($request['option_paginate'], array_keys(LIST_OPTION_PAGINATE))
            ? $request['option_paginate'] : LIMIT_RECORD_DEFAULT;
        $data = $this->topicRepository->getListData($this->userProxy->id, $perPage);
        return view('backend.my_pages.topic.list', [
            'data' => $data,
            'perPage' => $perPage,
            'totalPage' => ceil(($data->total()) / ($data->perPage())),
            'countData' => $this->topicRepository->countDataForUserNormal($this->userProxy->id),
            'numberPhotoPost' => $this->articlePhotoRepository->countRecord($this->userProxy->id)
        ]);
    }

    /**
     * show detail topic
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $dataTopic = $this->topicRepository->findTopicById($id);
        abort_if(!$dataTopic, 404);
        $userProfile = $this->userRepository->getTypeOfUserById($dataTopic->user_id);
        return view('backend.my_pages.topic_detail', [
            'userProfile' => $userProfile,
            'role' => $userProfile->role,
            'dataTopic' => $dataTopic,
            'uid' => $dataTopic->user_id
        ]);
    }

    /**
     * function create data
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $dataRedirect = $this->topicRepository->getRedirectName($request->all());
        return view('backend.my_pages.topic.add', [
            'categories' => $this->categoryRepository->getAll(),
            'perPage' => $dataRedirect['perPage'],
            'screen' => $dataRedirect['screen'],
            'userProxy' => $this->userProxy,
            'countData' => $this->topicRepository->countDataForUserNormal($this->userProxy->id)
        ]);
    }

    /**
     * function store data
     *
     * @param TopicRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TopicRequest $request)
    {
        if (in_array($this->userProxy->getMemberStatus(), [FREE, BASIC]) && $this->topicRepository->countDataForUserNormal($this->userProxy->id) >= LIMIT_POST_USER_NORMAL) {
            Session::flash(STR_ERROR_FLASH, trans('attributes.article_photo.error_max_post'));
            return redirect()->back();
        }

        if ($this->topicRepository->create($request->all())) {
            $dataRedirect = $this->topicRepository->getRedirectName($request->all());
            Session::flash(STR_FLASH_SUCCESS, trans('messages.topic.create_success'));
            if ($dataRedirect['screen'] == NAME_ARTICLE_TEXT) {
                return redirect()->route(USER_ARTICLE_TEXT, ['option_paginate' => $request->option_paginate]);
            }
            return redirect()->route(USER_ARTICLE_TEXT);
        } else {
            Session::flash(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
            return redirect()->back();
        }
    }

    /**
     *  Function edit data
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function edit(Request $request, $id)
    {
        $data = $request->all();
        $topic = $this->topicRepository->getDataByIdOfUser($id, $this->userProxy->id);
        if (!$topic) {
            return abort(404);
        }
        $optionPaginate = isset($data['option_paginate']) && in_array($data['option_paginate'], array_keys(LIST_OPTION_PAGINATE))
            ? $data['option_paginate'] : LIMIT_RECORD_DEFAULT;
        $totalPage = ceil($this->topicRepository->count() / $optionPaginate);
        return view('backend.my_pages.topic.edit')->with([
            'topic' => $topic,
            'userProxy' => $this->userProxy,
            'categories' => $this->categoryRepository->getAll(),
            'optionPaginate' => $optionPaginate,
            'page' => isset($data['page']) && $data['page'] <= $totalPage  ? $data['page'] : FLAG_ONE,
            'screen' => isset($data['screen']) && in_array($data['screen'], SCREEN_MY_PAGE) ? $data['screen'] : SCREEN_MY_PAGE[0]
        ]);
    }

    /**
     *  Function update data
     *
     * @param TopicRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TopicRequest $request)
    {
        $data = $request->all();
        $topic = $this->topicRepository->getDataByIdOfUser($data['id'], $this->userProxy->id);
        if (!$topic) {
            return abort(404);
        }
        if (date_format($topic['updated_at'], 'Y/m/d H:i:s') > $data['time_open_page']) {
            return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
        }
        if ($this->topicRepository->update($data['id'], $data)) {
            return redirect()->route(USER_ARTICLE_TEXT, ['option_paginate' => $data['option_paginate'], 'page' => $data['page']])
                ->with(STR_FLASH_SUCCESS, trans('messages.topic.edit_success'));
        }
        return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
    }

    /**
     * function delete topic
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $data = $this->topicRepository->getDataById($this->userProxy->id, $id);
        abort_if(!$data, 404);
        if (!$data->delete()) {
            Session::flash(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
        }
        return redirect()->route(USER_ARTICLE_TEXT, [
            'option_paginate' => $request->option_paginate,
            'page' => $this->topicRepository->getPageNumberRedirect($request->option_paginate, $request->page)
        ])->with(STR_FLASH_SUCCESS, trans('messages.email.topic.delete_success'));
    }
}
