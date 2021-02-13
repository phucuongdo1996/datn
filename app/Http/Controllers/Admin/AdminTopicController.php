<?php

namespace App\Http\Controllers\Admin;

use App\Events\UpdateTopic;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Topic\TopicRepositoryInterface;

class AdminTopicController extends Controller
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
     * TaxController constructor.
     * @param TopicRepositoryInterface $topicRepository
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        TopicRepositoryInterface $topicRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->topicRepository = $topicRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Function edit data
     *
     * @param $topicId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function edit($topicId)
    {
        return view('backend.admin.topics.manage_topic_edit')->with([
            'topicData' => $this->topicRepository->getDataByTopicId($topicId),
            'categories' => $this->categoryRepository->getAll()->toArray()
        ]);
    }

    /**
     * Function update data
     *
     * @param TopicRequest $request
     * @param $topicId
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update(TopicRequest $request, $topicId)
    {
        $dataUpdateTopic = $request->all();
        $timeUpdate = $this->topicRepository->getDataTimeUpdated($topicId);
        if (!$timeUpdate) {
            return abort(404);
        }

        if (strtotime($timeUpdate['updated_at']) > strtotime($dataUpdateTopic['time_open_page'])) {
            return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
        }

        if ($this->topicRepository->update($dataUpdateTopic['id'], $dataUpdateTopic)) {
            event(new UpdateTopic($dataUpdateTopic));
            if ($dataUpdateTopic['screen'] === 'top') {
                return redirect()->route(ADMIN_TOP);
            }

            return redirect()->route(ADMIN_MANAGE_USER_DETAIL_INDEX, $dataUpdateTopic['user_id']);
        }

        return redirect()->back()->with(STR_ERROR_FLASH, trans('attributes.common.system_error_messages'));
    }
}
