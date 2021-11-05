<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAdTagAPIRequest;
use App\Http\Requests\API\UpdateAdTagAPIRequest;
use App\Models\AdTag;
use App\Repositories\AdTagRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\AdTagResource;
use Response;

/**
 * Class AdTagController
 * @package App\Http\Controllers\API
 */

class AdTagAPIController extends AppBaseController
{
    /** @var  AdTagRepository */
    private $adTagRepository;

    public function __construct(AdTagRepository $adTagRepo)
    {
        $this->adTagRepository = $adTagRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/adTags",
     *      summary="Get a listing of the AdTags.",
     *      tags={"AdTag"},
     *      description="Get all AdTags",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/AdTag")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $adTags = $this->adTagRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(AdTagResource::collection($adTags), 'Ad Tags retrieved successfully');
    }

    /**
     * @param CreateAdTagAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/adTags",
     *      summary="Store a newly created AdTag in storage",
     *      tags={"AdTag"},
     *      description="Store AdTag",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="AdTag that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/AdTag")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/AdTag"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAdTagAPIRequest $request)
    {
        $input = $request->all();

        $adTag = $this->adTagRepository->create($input);

        return $this->sendResponse(new AdTagResource($adTag), 'Ad Tag saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/adTags/{id}",
     *      summary="Display the specified AdTag",
     *      tags={"AdTag"},
     *      description="Get AdTag",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of AdTag",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/AdTag"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var AdTag $adTag */
        $adTag = $this->adTagRepository->find($id);

        if (empty($adTag)) {
            return $this->sendError('Ad Tag not found');
        }

        return $this->sendResponse(new AdTagResource($adTag), 'Ad Tag retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateAdTagAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/adTags/{id}",
     *      summary="Update the specified AdTag in storage",
     *      tags={"AdTag"},
     *      description="Update AdTag",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of AdTag",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="AdTag that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/AdTag")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/AdTag"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAdTagAPIRequest $request)
    {
        $input = $request->all();

        /** @var AdTag $adTag */
        $adTag = $this->adTagRepository->find($id);

        if (empty($adTag)) {
            return $this->sendError('Ad Tag not found');
        }

        $adTag = $this->adTagRepository->update($input, $id);

        return $this->sendResponse(new AdTagResource($adTag), 'AdTag updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/adTags/{id}",
     *      summary="Remove the specified AdTag from storage",
     *      tags={"AdTag"},
     *      description="Delete AdTag",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of AdTag",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var AdTag $adTag */
        $adTag = $this->adTagRepository->find($id);

        if (empty($adTag)) {
            return $this->sendError('Ad Tag not found');
        }

        $adTag->delete();

        return $this->sendSuccess('Ad Tag deleted successfully');
    }
}
