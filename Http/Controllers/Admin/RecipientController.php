<?php

namespace Modules\Icampaign\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Icampaign\Entities\Recipient;
use Modules\Icampaign\Http\Requests\CreateRecipientRequest;
use Modules\Icampaign\Http\Requests\UpdateRecipientRequest;
use Modules\Icampaign\Repositories\RecipientRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class RecipientController extends AdminBaseController
{
    /**
     * @var RecipientRepository
     */
    private $recipient;

    public function __construct(RecipientRepository $recipient)
    {
        parent::__construct();

        $this->recipient = $recipient;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$recipients = $this->recipient->all();

        return view('icampaign::admin.recipients.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('icampaign::admin.recipients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRecipientRequest $request
     * @return Response
     */
    public function store(CreateRecipientRequest $request)
    {
        $this->recipient->create($request->all());

        return redirect()->route('admin.icampaign.recipient.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('icampaign::recipients.title.recipients')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Recipient $recipient
     * @return Response
     */
    public function edit(Recipient $recipient)
    {
        return view('icampaign::admin.recipients.edit', compact('recipient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Recipient $recipient
     * @param  UpdateRecipientRequest $request
     * @return Response
     */
    public function update(Recipient $recipient, UpdateRecipientRequest $request)
    {
        $this->recipient->update($recipient, $request->all());

        return redirect()->route('admin.icampaign.recipient.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('icampaign::recipients.title.recipients')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Recipient $recipient
     * @return Response
     */
    public function destroy(Recipient $recipient)
    {
        $this->recipient->destroy($recipient);

        return redirect()->route('admin.icampaign.recipient.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('icampaign::recipients.title.recipients')]));
    }
}
