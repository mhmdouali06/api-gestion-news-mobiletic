<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategorieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);

        if ($this->children) {
            $data['children'] = $this->transformChildren($this->children);
        }

        return $data;   
     }

     // function recursive children
    protected function transformChildren($children)
    {
        return $children->map(function ($child) {
            $childData = $child->toArray();
            if ($child->children) {
                $childData['children'] = $this->transformChildren($child->children);
                $childData['news']=$this->transformChildren($child->news);
            }
            return $childData;
        });
    }
}
