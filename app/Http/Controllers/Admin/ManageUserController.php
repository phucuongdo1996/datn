<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExportCsvRequest;
use App\Repositories\Profile\ProfileRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Libraries\Export\User\ListUser;
use Maatwebsite\Excel\Facades\Excel;

class ManageUserController extends Controller
{
    /**
     * @var UserRepositoryInterface|\App\Repositories\User\UserEloquentRepository
     */
    private $userRepository;

    /**
     * @var ProfileRepositoryInterface|\App\Repositories\Profile\ProfileEloquentRepository
     */
    private $profileRepository;

    /**
     * ManageUserController constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param ProfileRepositoryInterface $profileRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        ProfileRepositoryInterface $profileRepository
    ) {
        $this->userRepository = $userRepository;
        $this->profileRepository = $profileRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = $request->all();
        return view('backend.admin.manage_user', [
            'users' => $this->userRepository->getListUserForManager($params, OPTION_PAGINATE_MANAGER_USER),
            'param' => $params
        ]);
    }

    /**
     * get from csv
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFromCsv()
    {
        return view('backend.admin.users.manage_user_csv')->with([
            'roles' => array_combine(
                array_column($this->userRepository->countMembershipByRole(), 'role'),
                $this->userRepository->countMembershipByRole()
            ),
            'totalSubUser' => array_combine(
                array_column($this->userRepository->countMembershipByRole(SUB_USER), 'role'),
                $this->userRepository->countMembershipByRole(SUB_USER)
            ),
        ]);
    }

    /**
     * download csv
     *
     * @param ExportCsvRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadCsv(ExportCsvRequest $request)
    {
        $params = $request->all();
        $users = $this->userRepository->getListDataDownCsv($params);
        if (empty($users)) {
            return redirect(route(ADMIN_MANAGE_USER_LIST_CSV))
                ->with(STR_ERROR_FLASH, __('messages.no_data'));
        }
        $export = new ListUser();
        $export->setRole(array_flip(ROLE)[$params['role']]);
        $export->setUser($users, $this->profileRepository->getTotalMoneySubUser($params));
        return Excel::download($export, $export->getFileName());
    }
}
