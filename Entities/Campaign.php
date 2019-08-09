<?php

namespace Modules\Icampaign\Entities;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
  protected $table = 'icampaign__campaigns';

  protected $fillable = [
    'user_id',
    'name',
    'project_id',
    'init_message',
    'auth_token',
    'account_sid',
    'sender',
    'credentials',
  ];

  public function recipients()
  {
    return $this->hasMany(Recipient::class);
  }
}
