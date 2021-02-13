<?php

namespace App\Repositories\Topic;

use App\Models\Topic;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TopicEloquentRepository extends BaseRepository implements TopicRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return Topic::class;
    }

    /**
     * @param Auth $userId
     * @param int $pagination
     * @return mixed
     */
    public function getListData($userId, $pagination)
    {
        return $this->model->with('category')->where('user_id', $userId)->orderBy('id', 'desc')->paginate($pagination);
    }

    /**
     * function get redirect route name
     * @param $param
     * @return array
     */
    public function getRedirectName($param)
    {
        if (isset($param['screen']) && $param['screen'] == NAME_ARTICLE_TEXT) {
            $perPage = isset($param['option_paginate']) && in_array($param['option_paginate'], array_keys(LIST_OPTION_PAGINATE))
                ? $param['option_paginate'] : LIMIT_RECORD_DEFAULT;
            $screen = NAME_ARTICLE_TEXT;
        } else if (isset($param['screen']) && $param['screen'] == MY_PAGE) {
            $perPage = 0;
            $screen = MY_PAGE;
        } else {
            $screen = NAME_ARTICLE_TEXT;
            $perPage = LIMIT_RECORD_DEFAULT;
        }

        return ['screen' => $screen, 'perPage' => $perPage];
    }

    /**
     * get page number
     *
     * @param int $userId
     * @param int $topicID
     * @param int $recordInOnePage
     * @return int
     */
    public function getPageNumber(int $userId, int $topicID, int $recordInOnePage)
    {
        $data = $this->model->where('user_id', $userId)->orderBy('id', 'desc')->pluck('id')->toArray();

        if (!$data || !in_array($topicID, $data)) {
            return FLAG_ZERO;
        }

        return intval(ceil((array_search($topicID, $data) + FLAG_ONE)  / $recordInOnePage));
    }

    /**
     * function get data redirect for screen my page
     * @return array
     */
    public function getDataRedirectMyPage()
    {
        $user = Auth::user();
        if ($user->role == BROKER) {
            return ['broker', $user->id];
        } elseif ($user->role == EXPERT) {
            return ['expert', $user->id];
        }
    }

    /**
     * function count data for user normal
     * @param Auth $userId
     * @return mixed
     */
    public function countDataForUserNormal($userId)
    {
        return $this->model->where('user_id', $userId)->count();
    }

    /**
     * Get data by id of user
     *
     * @param $idTopic
     * @param $idUser
     * @return array|bool
     */
    public function getDataByIdOfUser($idTopic, $idUser)
    {
        return $this->model->with('category')->where([['user_id', '=', $idUser], ['id', '=', $idTopic]])->first();
    }

    /**
     * get data topic by id
     *
     * @param $userId
     * @param $id
     * @return mixed
     */
    public function getDataById($userId, $id)
    {
        return $this->model->where('user_id', $userId)->where('id', $id)->first();
    }

    /**
     * get data topic by id
     *
     * @param $topicId
     * @return mixed
     */
    public function getDataByTopicId($topicId)
    {
        return $this->model->with(['user' => function ($query) {
            $query->with('profile:user_id,nick_name,person_charge_last_name,person_charge_first_name');
        }])->findOrFail($topicId)->toArray();
    }

    /**
     * Get data time update
     *
     * @param $topicId
     * @return mixed
     */
    public function getDataTimeUpdated($topicId)
    {
        return $this->model->find($topicId, ['updated_at']);
    }

    /**
     * Get number page
     *
     * @param int $perPage
     * @param int $page
     *
     * @return int
     */
    public function getPageNumberRedirect($perPage, $page): int
    {
        if ($this->where('user_id', Auth::user()->id)->count() == ($page - FLAG_ONE) * $perPage) {
            return $page - FLAG_ONE;
        }

        return $page;
    }

    /**
     * function get topic by id
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function findTopicById($id)
    {
        return $this->model->with('category')->where('id', $id)->first();
    }

    /**
     * Get records by prams
     *
     * @param $params
     * @param $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getRecordsByParams($params, $perPage)
    {
        return DB::table('topics')
            ->join('profiles', 'profiles.user_id', 'topics.user_id')
            ->join('categories', 'categories.id', 'topics.category_id')
            ->when(isset($params['user_name']), function ($query) use ($params) {
                return $query->whereRaw("CONCAT(profiles.person_charge_last_name, profiles.person_charge_first_name) like '%" . $params['user_name'] . "%'");
            })
            ->when(isset($params['category_name']), function ($query) use ($params) {
                return $query->where('categories.name', $params['category_name']);
            })
            ->select('topics.id', 'topics.title', 'topics.created_at', 'profiles.person_charge_first_name', 'profiles.person_charge_last_name', 'profiles.user_id', 'categories.name as category_name')
            ->where('topics.deleted_at', null)
            ->orderBy('topics.created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * function delete topic
     * @param array $params
     * @param int $id
     * @return bool
     */
    public function deleteTopic($params, $id)
    {
        DB::beginTransaction();
        try {
            $params['unblock_status'] = FLAG_ONE;
            $data = $this->update($id, $params);
            $data->delete();
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            report($exception);
            DB::rollBack();
            return false;
        }
    }

    /**
     * get list by condition
     *
     * @param $userId
     * @return mixed
     */
    public function getListByCondition($userId)
    {
        return $this->model->selectRaw('topics.id, topics.title, categories.name as category_name')
            ->join('profiles', 'profiles.user_id', 'topics.user_id')
            ->join('categories', 'categories.id', 'topics.category_id')
            ->where('profiles.user_id', $userId)
            ->orderBy('topics.created_at', 'desc')
            ->paginate(LIMIT_RECORD_DEFAULT);
    }

    /**
     * Get data with table relation by id
     *
     * @param int $id
     * @return mixed
     */
    public function getDataWithRelationByIdWithTrash($id)
    {
        return $this->model->withTrashed()->with(['user' => function ($query) {
            $query->with('profile:user_id,nick_name,person_charge_last_name,person_charge_first_name');
        }])->find($id);
    }

    /**
     * Get new topics
     *
     * @return array
     */
    public function getNewTopics()
    {
        return $this->model->with('profile:user_id,avatar_thumbnail,company_name', 'category:id,name')
            ->with('user:id,role')
            ->orderBy('created_at', 'DESC')->take(FLAG_FIVE)->get()->toArray();
    }

    /**
     * Get new topics user
     *
     * @param $user
     * @return array
     */
    public function getNewTopicsUser($user)
    {
        if ($user) {
            return $this->model->with('profile:user_id,person_charge_last_name,person_charge_first_name,avatar_thumbnail,company_name', 'category:id,name')
                ->with('user:id,role')
                ->where('user_id', $user->id)->orderBy('created_at', 'DESC')->take(FLAG_FIVE)->get()->toArray();
        }
        return [];
    }

    /**
     * Get all topics
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getTopics()
    {
        return $this->model->with('profile:user_id,avatar_thumbnail,person_charge_last_name,person_charge_first_name,company_name', 'category:id,name')
            ->with('user:id,role')
            ->orderBy('created_at', 'DESC')
            ->paginate(FLAG_FIFTY);
    }
}
