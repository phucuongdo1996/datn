<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Topic\TopicRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

class ListTopicController extends Controller
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
     * UserController constructor.
     * @param UserRepositoryInterface $userRepository
     * @param TopicRepositoryInterface $topicRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        TopicRepositoryInterface $topicRepository
    ) {
        $this->userRepository = $userRepository;
        $this->topicRepository = $topicRepository;
    }

    /**
     * function list topic
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        $userProfile = $this->userRepository->getTypeOfUserById($id);
        abort_if(!$userProfile || !in_array($userProfile->role, ROLE_MY_PAGES), 404);
        $dataTopic = $this->topicRepository->getListData($userProfile->id, LIMIT_PAGINATION_MY_PAGE_TOPIC);
        return view('backend.my_pages.topic', compact('userProfile', 'dataTopic'));
    }

    /**
     * Function show all topic
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showTopics()
    {
        return view('user.list_topic')->with(['topics' => $this->topicRepository->getTopics()]);
    }
}
