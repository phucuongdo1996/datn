<?php

namespace App\Libraries\Export\User;

use App\Libraries\Export\BaseExportAbstract;
use App\Repositories\Profile\ProfileRepositoryInterface;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ListUser extends BaseExportAbstract implements FromView
{
    /**
     * list user result csv
     *
     * @var array $users
     */
    private $users;

    /**
     * set list total money sub user
     *
     * @var array $totalMoneySubUser
     */
    private $totalMoneySubUser;

    /**
     * role
     *
     * @var integer $role
     */
    private $role;

    /**
     * ListUser constructor.
     *
     */
    public function __construct()
    {
        $this->setName();
        $this->setExtension();
    }

    /**
     * set role
     *
     * @param integer $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * set list user result csv
     *
     * @param array $users
     * @param array $totalMoneySubUser
     */
    public function setUser($users, $totalMoneySubUser)
    {
        $this->users = $users;
        $this->totalMoneySubUser = $totalMoneySubUser;
    }

    /**
     * Set file name
     *
     * @return mixed
     */
    protected function setName()
    {
        $this->fileName = CSV_NAME . '_' . date('Ymdhis');
    }

    /**
     * Set extension file
     *
     * @return mixed
     */
    protected function setExtension()
    {
        $this->extension = EXTENSION_CSV;
    }

    /**
     * Render data to view
     *
     * @return View
     */
    public function view(): View
    {
        return view('backend.admin.users.csv.export_user_result')->with([
            'role' => $this->role,
            'users' => $this->users,
            'totalMoneySubUser' => $this->totalMoneySubUser,
        ]);
    }
}
