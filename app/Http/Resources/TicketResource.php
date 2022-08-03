<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
          'id'=>$this->id,
          'subject'=>$this->subject,
          'users'=>$this->users->pluck('id'),
          'content'=>$this->content,
          'settings'=>$this->settings,
          'creator'=>$this->creator->first_name.' '.$this->creator->last_name,
          'created_at'=>Carbon::parse($this->created_at)->format('M d Y H:m')
        ];
    }
}
