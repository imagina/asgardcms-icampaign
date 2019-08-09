<?php

namespace Modules\Icampaign\Http\Controllers\Api;

// Requests & Response
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Icampaign\Http\Requests\CreateCampaignRequest;
use Modules\Icampaign\Http\Requests\UpdateCampaignRequest;

// Base Api
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

// Transformers
use Modules\Icampaign\Transformers\CampaignTransformer;

// Repositories
use Modules\Icampaign\Repositories\CampaignRepository;

class CampaignApiController extends BaseApiController
{
  /**
   * @var CampaignRepository
   */
  private $campaign;

  public function __construct(CampaignRepository $campaign)
  {
      parent::__construct();

      $this->campaign = $campaign;
  }

  /**
   * GET ITEMS
   *
   * @return mixed
   */
  public function index(Request $request)
  {
    try {
      //Get Parameters from URL.
      $params = $this->getParamsRequest($request);
      //Request to Repository
      $categories = $this->campaign->getItemsBy($params);
      //Response
      $response = ["data" => CampaignTransformer::collection($categories)];
      //If request pagination add meta-page
      $params->page ? $response["meta"] = ["page" => $this->pageTransformer($categories)] : false;
    } catch (\Exception $e) {
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }
    //Return response
    return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
  }
  /**
   * GET A ITEM
   *
   * @param $criteria
   * @return mixed
   */
  public function show($criteria, Request $request)
  {
    try {
      //Get Parameters from URL.
      $params = $this->getParamsRequest($request);
      //Request to Repository
      $category = $this->campaign->getItem($criteria, $params);
      //Break if no found item
      if (!$category) throw new Exception('Item not found', 204);
      //Response
      $response = ["data" => new CampaignTransformer($category)];
      //If request pagination add meta-page
      $params->page ? $response["meta"] = ["page" => $this->pageTransformer($category)] : false;
    } catch (\Exception $e) {
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }
    //Return response
    return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
  }
  /**
   * CREATE A ITEM
   *
   * @param Request $request
   * @return mixed
   */
  public function create(Request $request)
  {
    \DB::beginTransaction();
    try {
      $data = $request->input('attributes') ?? [];//Get data
      //Validate Request
      $this->validateRequestApi(new CreateCampaignRequest($data));
      //Create item
      $category = $this->campaign->create($data);
      //Response
      $response = ["data" => new CampaignTransformer($category)];
      \DB::commit(); //Commit to Data Base
    } catch (\Exception $e) {
      \DB::rollback();//Rollback to Data Base
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }
    //Return response
    return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
  }
  /**
   * Update the specified resource in storage.
   * @param  Request $request
   * @return Response
   */
  public function update($criteria, Request $request)
  {
    \DB::beginTransaction();
    try {
      $params = $this->getParamsRequest($request);
      $data = $request->input('attributes');
      //Validate Request
      $this->validateRequestApi(new UpdateCampaignRequest($data));
      //Update data
      $category = $this->campaign->updateBy($criteria, $data, $params);
      //Response
      $response = ['data' => 'Item Updated'];
      \DB::commit(); //Commit to Data Base
    } catch (\Exception $e) {
      \DB::rollback();//Rollback to Data Base
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }
    return response()->json($response, $status ?? 200);
  }
  /**
   * Remove the specified resource from storage.
   * @return Response
   */
  public function delete($criteria, Request $request)
  {
    \DB::beginTransaction();
    try {
      //Get params
      $params = $this->getParamsRequest($request);
      //Delete data
      $this->campaign->deleteBy($criteria, $params);
      //Response
      $response = ['data' => ''];
      \DB::commit(); //Commit to Data Base
    } catch (\Exception $e) {
      \DB::rollback();//Rollback to Data Base
      $status = $this->getStatusError($e->getCode());
      $response = ["errors" => $e->getMessage()];
    }
    return response()->json($response, $status ?? 200);
  }
}
