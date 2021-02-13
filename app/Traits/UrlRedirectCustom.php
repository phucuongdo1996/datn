<?php

namespace App\Traits;

use App\Repositories\Property\PropertyRepositoryInterface;

trait UrlRedirectCustom
{
    /**
     * @var int $page PerPage default
     */
    private $page;

    /**
     * @var int $perPage PerPage
     */
    private $perPage;

    /**
     * Check has screen param request
     *
     * @return bool
     */
    public function hasScreenParam()
    {
        if (request()->has('screen') && in_array(request('screen'), SCREEN_ALLOWED)) {
            return true;
        }

        return false;
    }

    /**
     * Set per page
     *
     * @return $this|void
     */
    protected function setPerPage()
    {
        if (!$this->hasScreenParam()) {
            return;
        }

        if (request('screen') == 'property') {
            $this->perPage = LIMIT_RECORD_LIST_HOUSE_DEFAULT;
            return $this;
        }

        $this->perPage = request('paginate_previous') ?? LIMIT_RECORD_DEFAULT;
        return $this;
    }

    /**
     * Set page number
     *
     * @param int $propertyId
     * @return $this
     */
    protected function setNumberPage($propertyId)
    {
        $this->page = resolve(PropertyRepositoryInterface::class)
            ->getPageNumber($propertyId, $this->perPage);

        return $this;
    }

    /**
     * Build url redirect custom
     *
     * @return string
     */
    public function buildUrlRedirect()
    {
        return url('/' . request('screen')) . '?' .
            http_build_query(['option_paginate' => request('paginate_previous'), 'page' => $this->page]);
    }
}
