<?php

namespace Modules\Icampaign\Entities;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    protected $table = 'icampaign__recipients';

    protected $fillable = [
      'name',
      'phone',
      'campaign_id',
    ];

  public function campaign()
  {
    return $this->belongsTo(Campaign::class);
  }
}
