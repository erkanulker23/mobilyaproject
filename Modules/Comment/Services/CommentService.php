<?php

namespace Modules\Comment\Services;

use Modules\Comment\Entities\Comment;
use Modules\Core\Services\Base\BaseService;

class CommentService extends BaseService
{
    /**
     * CommentService constructor.
     *
     * @return void
     */
    public function __construct(protected Comment $model)
    {
        parent::__construct();
    }
}
