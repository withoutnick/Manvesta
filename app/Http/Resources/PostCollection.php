<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{   
    
    public function paginationInformation($request, $paginated, $default)
    {
        unset($default['meta']['links']);
        return $default;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {       
        return $this->collection;
    }

    
}
