<?php

namespace App\Services\Document\Repositories;

use App\Models\Document;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Exceptions\UnprocessibleEntityException;
use App\Exceptions\NotFoundException;
use App\Exceptions\UpdateDisallowException;

interface DocumentRepositoryInterface
{
    // /**
    //  * create document draft
    //  * @param array $data
    //  * @return Document|null
    //  */
    // public function create(array $data) :?Document;

    /**
     * crate fresh document
     * @return Document
     */
    public function create() :Document;

    /**
     * get single document by id
     * @param int $id
     * @throws UnprocessibleEntityException
     * @return Document|null
     */
    public function find(int $id) :?Document;

    /**
     * find and update document
     * @param array $data
     * @throws UnprocessibleEntityException
     * @throws NotFoundException
     * @throws UpdateDisallowException
     * @return Document|null
     */
    public function update(array $data) :?Document;

    /**
     * publish document
     * @param int $id
     * @throws UnprocessibleEntityException
     * @throws NotFoundException
     * @return Document|null
     */
    public function publish(int $id) :?Document;

    /**
     * get page
     * @param int $page
     * @param int $perPage
     * @return array
     */
    public function getPage(int $page, int $perPage) :LengthAwarePaginator;
}