<?php

namespace Modules\QualityControl\Services\Reject;

use Illuminate\Database\Eloquent\Collection;
use Modules\QualityControl\Contracts\Reject\RejectInterface;
use Modules\QualityControl\Transformers\Reject\RejectResource;

class IndexRejectService
{
    /**
     * @param RejectInterface|null $reject
     */
    public function __construct(private ?RejectInterface $reject)
    {
        //
    }

    /**
     * @param $request
     * @return Collection|array
     */
    public function handle($request): Collection|array
    {
        return RejectResource::collection($this->reject->all())->toArray($request);
    }
}
