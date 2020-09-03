<?php

namespace App\Services\Document\Repositories;

use App\Exceptions\NotFoundException;
use App\Services\Document\Repositories\DocumentRepositoryInterface;
use App\Models\Document;
use App\Services\User\Repositories\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Exceptions\UnprocessibleEntityException;
use App\Exceptions\UpdateDisallowException;

class EloquentDocumentRepository implements DocumentRepositoryInterface
{
    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * create fresh document
     * @return Document
     */
    public function create() :Document
    {
        $document = new Document();

        $document->body = "{}";
        $document->title = "1";
        $document->save();

        return $document;
    }

    /**
     * get single document by id
     * @param int $id
     * @throws UnprocessibleEntityException
     * @return Document|null
     */
    public function find(int $id) :?Document
    {
        if ($id <= 0) {
            throw new UnprocessibleEntityException();
        }

        $document = Document::find($id);

        return $document;
    }

    /**
     * find and update document
     * @param array $data
     * @throws UnprocessibleEntityException
     * @throws NotFoundException
     * @throws UpdateDisallowException
     * @return Document|null
     */
    public function update(array $data) :?Document
    {
        if (
            !isset($data['id']) || !is_int($data['id'])
            || !isset($data['document']) || !is_array($data['document'])
            || !isset($data['document']['payload']) || !is_array($data['document']['payload'])
        ) {
            throw new UnprocessibleEntityException();
        }

        $document = $this->find($data['id']);

        if (!$document) {
            throw new NotFoundException();
        }

        if ($document->published) {
            throw new UpdateDisallowException();
        }

        $document->body = json_encode($data['document']['payload']);
        $document->save();

        return $document;
    }

    /**
     * publish document
     * @param int $id
     * @throws UnprocessibleEntityException
     * @throws NotFoundException
     * @return Document|null
     */
    public function publish(int $id) :?Document
    {
        if ($id <= 0) {
            throw new UnprocessibleEntityException();
        }

        $document = $this->find($id);

        if (!$document) {
            throw new NotFoundException();
        }

        $document->published = true;
        $document->save();

        return $document;
    }

    /**
     * get page
     * @param int $page
     * @param int $perPage
     * @return array
     */
    public function getPage(int $page, int $perPage) :LengthAwarePaginator
    {
        return Document::paginate($perPage, ['*'], 'page', $page);
    }
}