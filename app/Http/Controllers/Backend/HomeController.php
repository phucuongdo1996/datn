<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\ArticlePhoto\ArticlePhotoRepositoryInterface;
use App\Repositories\Information\InformationRepositoryInterface;
use App\Repositories\Property\PropertyRepositoryInterface;
use App\Repositories\Topic\TopicRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\UserSubscription\UserSubscriptionRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * @var \App\Repositories\Topic\TopicEloquentRepository
     */
    private $topicRepository;

    /**
     * @var \App\Repositories\ArticlePhoto\ArticlePhotoEloquentRepository
     */
    private $articlePhotoRepository;

    /**
     * @var \App\Repositories\Information\InformationEloquentRepository
     */
    private $informationRepository;

    /**
     * @var \App\Repositories\User\UserEloquentRepository
     */
    private $userRepository;

    /**
     * @var \App\Repositories\UserSubscription\UserSubscriptionEloquentRepository
     */
    private $userSubscriptionRepository;

    /**
     * @var \App\Repositories\Property\PropertyEloquentRepository
     */
    private $propertyRepository;

    /**
     * HomeController constructor.
     * @param TopicRepositoryInterface $topicRepository
     * @param ArticlePhotoRepositoryInterface $articlePhotoRepository
     * @param InformationRepositoryInterface $informationRepository
     * @param UserRepositoryInterface $userRepository
     * @param UserSubscriptionRepositoryInterface $userSubscriptionRepository
     * @param PropertyRepositoryInterface $propertyRepository
     */
    public function __construct(
        TopicRepositoryInterface $topicRepository,
        ArticlePhotoRepositoryInterface $articlePhotoRepository,
        InformationRepositoryInterface $informationRepository,
        UserRepositoryInterface $userRepository,
        UserSubscriptionRepositoryInterface $userSubscriptionRepository,
        PropertyRepositoryInterface $propertyRepository
    ) {
        $this->topicRepository = $topicRepository;
        $this->articlePhotoRepository = $articlePhotoRepository;
        $this->informationRepository = $informationRepository;
        $this->userRepository = $userRepository;
        $this->userSubscriptionRepository = $userSubscriptionRepository;
        $this->propertyRepository = $propertyRepository;
    }

    /**
     * Show home user site
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        if ($user && $user->userProxy(CHANGE_SUB_USER, CHANGE_PLAN, CHANGE_PROPERTY)) {
            $userProxy = $user->userProxy(CHANGE_SUB_USER, CHANGE_PLAN, CHANGE_PROPERTY);
            return view('user.home')->with([
                'information' => $this->informationRepository->getNewInformation(),
                'topics' => $this->topicRepository->getNewTopics(),
                'articlePhotos' => $this->articlePhotoRepository->getNewArticlePhotos(),
                'topicsUser' => $this->topicRepository->getNewTopicsUser($userProxy),
                'articlePhotosUser' => $this->articlePhotoRepository->getNewArticlePhotosUser($userProxy),
                'subUser' => $this->userRepository->getSubUserShowHome($userProxy),
                'userProxy' => $userProxy,
                'amount' => $userProxy->amount_fee,
                'userSubscription' => $this->userSubscriptionRepository->getDataForUser($userProxy->id),
                'dataChart' => $this->propertyRepository->getDataChartBorrowing(),
                'listProperty' => $this->propertyRepository->getListPropertyHome($userProxy),
            ]);
        }
        return view('user.home')->with([
            'information' => $this->informationRepository->getNewInformation(),
            'topics' => $this->topicRepository->getNewTopics(),
            'articlePhotos' => $this->articlePhotoRepository->getNewArticlePhotos(),
        ]);
    }
}
