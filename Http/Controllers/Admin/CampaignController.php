<?php

namespace Modules\Icampaign\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Icampaign\Entities\Campaign;
use Modules\Icampaign\Http\Requests\CreateCampaignRequest;
use Modules\Icampaign\Http\Requests\UpdateCampaignRequest;
use Modules\Icampaign\Repositories\CampaignRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CampaignController extends AdminBaseController
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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$campaigns = $this->campaign->all();

        return view('icampaign::admin.campaigns.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('icampaign::admin.campaigns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCampaignRequest $request
     * @return Response
     */
    public function store(CreateCampaignRequest $request)
    {
        $this->campaign->create($request->all());

        return redirect()->route('admin.icampaign.campaign.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('icampaign::campaigns.title.campaigns')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Campaign $campaign
     * @return Response
     */
    public function edit(Campaign $campaign)
    {
        return view('icampaign::admin.campaigns.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Campaign $campaign
     * @param  UpdateCampaignRequest $request
     * @return Response
     */
    public function update(Campaign $campaign, UpdateCampaignRequest $request)
    {
        $this->campaign->update($campaign, $request->all());

        return redirect()->route('admin.icampaign.campaign.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('icampaign::campaigns.title.campaigns')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Campaign $campaign
     * @return Response
     */
    public function destroy(Campaign $campaign)
    {
        $this->campaign->destroy($campaign);

        return redirect()->route('admin.icampaign.campaign.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('icampaign::campaigns.title.campaigns')]));
    }
}
