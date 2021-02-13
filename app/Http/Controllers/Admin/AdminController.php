<?php

namespace App\Http\Controllers\Admin;

use App\Events\EditPhoto;
use App\Events\SendMailDeletePhoto;
use App\Events\SendMailTopic;
use App\Http\Controllers\Controller;
use App\Repositories\ArticlePhoto\ArticlePhotoRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\VerifiedRegister\VerifiedRegisterRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\Topic\TopicRepositoryInterface;

class AdminController extends Controller
{
    /**
     * @var UserRepositoryInterface|\App\Repositories\User\UserEloquentRepository
     */
    private $userRepository;

    /**
     * @var \App\Repositories\ArticlePhoto\ArticlePhotoEloquentRepository;
     */
    private $articlePhotoRepository;

    /**
     * @var \App\Repositories\Topic\TopicEloquentRepository
     */
    private $topicRepository;

    /**
     * AdminController constructor.
     * @param UserRepositoryInterface $userRepository
     * @param ArticlePhotoRepositoryInterface $articlePhotoRepository
     * @param TopicRepositoryInterface $topicRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        ArticlePhotoRepositoryInterface $articlePhotoRepository,
        TopicRepositoryInterface $topicRepository
    ) {
        $this->userRepository = $userRepository;
        $this->articlePhotoRepository = $articlePhotoRepository;
        $this->topicRepository = $topicRepository;
    }

    /**
     * Show Admin Top screen
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.admin.top', ['dataUser' => $this->userRepository->getListUserForManager($request->all(), LIMIT_RECORD_ADMIN_TOP)]);
    }

    /**
     * get article photo
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getArticlePhoto(Request $request)
    {
        abort_if(!$request->ajax(), 403);
        return response()->json(['data' => view('backend.admin.photo.table_top', [
            'photos' => $this->articlePhotoRepository->getListByCondition(null, $request->all(), LIMIT_RECORD_ADMIN_TOP)])->render()]);
    }

    /**
     * list article photo
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listArticlePhoto(Request $request)
    {
        $params = $request->all();
        return view('backend.admin.photo.index')->with([
            'photos' => $this->articlePhotoRepository->getListByCondition(null, $params, ADMIN_LIMIT_PAGINATION_MY_PAGE_TOPIC),
            'params' => $params,
        ]);
    }

    /**
     * Show the form for editing the article-photo resource.
     *
     * @param int $articlePhotoId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editArticlePhoto($articlePhotoId)
    {
        $data = $this->articlePhotoRepository->getDataWithRelationById($articlePhotoId);
        abort_if(!$data, 404);
        return view('backend.admin.photo.edit_photo', ['data' => $data->toArray()]);
    }

    /**
     * Update the article-photo resource in storage.
     *
     * @param  Request  $request
     * @param int $articlePhotoId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateArticlePhoto(Request $request, $articlePhotoId)
    {
        $params = $request->all();
        $currentArticlePhoto = $this->articlePhotoRepository->getDataWithRelationById($articlePhotoId);
        abort_if(!$currentArticlePhoto, 404);
        if ($currentArticlePhoto['updated_at'] > $params['current_time']) {
            return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
        }
        $this->articlePhotoRepository->removeCurrentImages($params, $currentArticlePhoto->toArray());
        if ($this->articlePhotoRepository->updateData($articlePhotoId, $params)) {
            event(new EditPhoto($params, $currentArticlePhoto['user']->toArray()));
            if (isset($params['url_redirect']) && $params['url_redirect'] === 'user_detail') {
                return redirect()->route(ADMIN_MANAGE_USER_DETAIL_INDEX, $currentArticlePhoto['user']['id']);
            }
            return redirect()->route(ADMIN_TOP);
        } else {
            return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
        }
    }

    /**
     * Get topics
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTopics(Request $request)
    {
        if (!$request->ajax()) {
            abort(403);
        }
        $topics = $this->topicRepository->getRecordsByParams($request->all(), LIMIT_RECORD_ADMIN_TOP);
        return view('backend.admin.topics.table', compact('topics'));
    }

    /**
     * Show list topic screen
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showListTopicScreen(Request $request)
    {
        $topics = $this->topicRepository->getRecordsByParams($request->all(), ADMIN_LIMIT_PAGINATION_MY_PAGE_TOPIC);
        return view('backend.admin.topics.manage_list_topic', compact('topics'));
    }

    /**
     * function delete topic
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function topicDestroy(Request $request, $id)
    {
        if (!$this->topicRepository->deleteTopic($request->all(), $id)) {
            return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
        }
        event(new SendMailTopic($this->topicRepository->getDataWithRelationByIdWithTrash($id)));
        if ($request->ajax()) {
            return response()->json(['delete' => true]);
        }
        return redirect()->back()->with(STR_SUCCESS_FLASH, trans('messages.email.topic.delete_success'));
    }

    /**
     * function delete photo
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function photoDestroy(Request $request, $id)
    {
        $result = $this->articlePhotoRepository->deletePhoto($request->all(), $id);

        if (!$result) {
            return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.user.delete_user'));
        }
        event(new SendMailDeletePhoto($this->articlePhotoRepository->getDataWithRelationByIdWithTrash($id)));

        if ($request->ajax()) {
            return response()->json(['delete' => true]);
        }

        return redirect()->back()->with(STR_SUCCESS_FLASH, trans('messages.email.delete_photo.delete_success'));
    }
}
