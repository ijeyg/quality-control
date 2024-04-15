<?php

namespace Modules\QualityControl\Services\Reject;

use Illuminate\Http\RedirectResponse;
use Modules\QualityControl\Contracts\Reject\RejectInterface;

class DeleteRejectService
{
    /**
     * @param RejectInterface $reject
     */
    public function __construct(private RejectInterface $reject)
    {
        //
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function handle($id)
    {
        $this->reject->getById($id)->values()->delete();
        $this->reject->delete($id);
        return redirect()->back()->with(['message' => ' با موفقیت حذف شد']);
    }
}
