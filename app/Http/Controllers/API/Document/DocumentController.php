<?php

namespace App\Http\Controllers\API\Document;

use App\Exceptions\NotFoundException;
use App\Exceptions\UnprocessibleEntityException;
use App\Exceptions\UpdateDisallowException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Document\Requests\UpdateDocumentRequest;
use App\Http\Controllers\Document\Requests\GetPageRequest;
use App\Services\Document\DocumentService;
use Illuminate\Http\JsonResponse;

class DocumentController extends Controller
{
    protected $documentService;

    public function __construct(
        DocumentService $documentService
    ) {
        $this->documentService = $documentService;
    }

    /**
     * Create new document draft
     */
    public function create()
    {
        $document = $this->documentService->create();

        return response()->json($document->toResponseArray());
    }

    /**
     * get single document by id
     * @param String $id
     */
    public function find(string $id)
    {
        try {
            $document = $this->documentService->find((int) $id);

        } catch (UnprocessibleEntityException $exc) {
            return response()->json([
                'error' => 'wrong id format'
            ], 422);
        }

        if ($document) {
            return response()->json($document->toResponseArray());
        }

        return response()->json([
            'error' => 'document not found'
        ], 404);
    }

    /**
     * update document
     * Can't use UpdateDocumentRequest because of validation fail returns 422 code
     * @param Request $request
     * @param String $id
     */
    public function update(Request $request, string $id)
    {

        if (!is_numeric($id) || $id <= 0) {
            return response()->json([
                'error' => 'wrong id format'
            ], 422);
        }

        $data = $request->toArray();
        $data['id'] = (int) $id;

        try {
            $document = $this->documentService->update($data);

        } catch (NotFoundException $exc) {
            return response()->json([
                'error' => 'document not found'
            ], 404);

        } catch (UnprocessibleEntityException $exc) {
            return response()->json([
                'error' => 'request data error'
            ], 400);

        } catch (UpdateDisallowException $exc) {
            return response()->json([
                'error' => 'Document already published. Can\'t update'
            ], 400);
        }

        if ($document) {
            return response()->json($document->toResponseArray());
        }

        return response()->json([
            'error' => 'internal error'
        ], 500);
    }

    /**
     * publish document
     * @param String $id
     */
    public function publish(string $id)
    {
        if (!is_numeric($id)) {
            return response()->json([
                'error' => 'wrong id format'
            ], 422);
        }

        try {
            $document = $this->documentService->publish($id);

        } catch (UnprocessibleEntityException $exc) {
            return response()->json([
                'error' => 'wrong id format'
            ], 422);

        } catch (NotFoundException $exc) {
            return response()->json([
                'error' => 'document not found'
            ], 404);
        }

        if ($document) {
            return response()->json($document->toResponseArray());
        }

        return response()->json([
            'error' => 'internal error'
        ], 500);
    }

    /**
     * get page
     * @param GetPageRequest $request
     */
    public function getPage(GetPageRequest $request)
    {
        if ($request->page <= 0) {
            return null;
        }

        $perPage = 20;
        if ($request->perPage) {
            $perPage = $request->perPage;
        }

        $page = $this->documentService->getPage($request->page, $perPage);

        return response()->json($page);
    }
}
