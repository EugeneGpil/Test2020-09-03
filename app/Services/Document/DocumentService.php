<?php

namespace App\Services\Document;

use App\Services\Document\Repositories\DocumentRepositoryInterface;
use App\Services\User\Repositories\UserRepositoryInterface;
use App\Models\Document;
use App\Exceptions\UnprocessibleEntityException;
use App\Exceptions\NotFoundException;
use App\Exceptions\UpdateDisallowException;

class DocumentService
{
    protected $documentRepository;
    protected $userRepository;

    public function __construct(
        DocumentRepositoryInterface $documentRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->documentRepository = $documentRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * create fresh document
     * @return Document
     */
    public function create()
    {
        return $this->documentRepository->create();
    }

    /**
     * get single document by id
     * @param int $id
     * @throws UnpocessibleEntityEcxeption
     * @return Document|null
     */
    public function find(int $id) :?Document
    {
        return $this->documentRepository->find($id);
    }

    /**
     * update document
     * @param array $data,
     * @throws UnprocessibleEntityException
     * @throws NotFoundException
     * @throws UpdateDissalowException
     * @return Document|null
     */
    public function update(array $data) :?Document
    {
        return $this->documentRepository->update($data);
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
        return $this->documentRepository->publish($id);
    }

    /**
     * get page
     * @param int $page
     * @param int $perPage
     * @return array
     */
    public function getPage(int $page, int $perPage) :array
    {
        if ($perPage < 1 || $perPage > 1000) {
            return [
                'documents' => [],
                'pagination' => []
            ];
        }

        $paginator = $this->documentRepository->getPage($page, $perPage);

        $documentArray = [];

        foreach ($paginator as $document) {
            $documentArray[] = $document->toResponseArray();
        }

        $toRespPage = [
            'documents' => $documentArray,
            'pagination' => [
                'page' => $page,
                'perPage' => $paginator->perPage(),
                'total' => $paginator->total()
            ]
        ];

        return $toRespPage;
    }
}