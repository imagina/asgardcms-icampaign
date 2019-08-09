<?php

namespace Modules\Icampaign\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class CampaignTransformer extends Resource
{
  public function toArray($request)
  {
    $data = [
      'id' => $this->when($this->id, $this->id),
      'name' => $this->when($this->name, $this->name),
      'userId' => $this->when($this->user_id, $this->user_id),
      'projectId' => $this->when($this->project_id, $this->project_id),
      'initMessage' => $this->when($this->init_message, $this->init_message),
      'authToken' => $this->when($this->auth_token, $this->auth_token),
      'accountSid' => $this->when($this->account_sid, $this->account_sid),
      'sender' => $this->when($this->sender, $this->sender),
      'credentials' => $this->when($this->credentials, $this->credentials),
      'recipients' =>  RecipientTransformer::collection($this->whenLoaded('recipients')),
    ];
    return $data;
  }
}
