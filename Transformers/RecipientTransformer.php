<?php

namespace Modules\Icampaign\Transformers;
use Illuminate\Http\Resources\Json\Resource;

class RecipientTransformer extends Resource
{
  public function toArray($request)
  {
    $data = [
      'id' => $this->when($this->id, $this->id),
      'name' => $this->when($this->name, $this->name),
      'phone' => $this->when($this->phone, $this->phone),
      'campaignId' => $this->when($this->campaign_id, $this->campaign_id),
      'campaign' => new CampaignTransformer ($this->whenLoaded('campaign')),
    ];
    return $data;
  }
}
