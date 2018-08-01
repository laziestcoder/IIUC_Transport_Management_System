<?php

namespace Encore\Admin\Grid\Tools;

abstract class BatchAction
{
    protected $id;

    protected $resource;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setResource($resource)
    {
        $this->resource = $resource;
    }

    public function getToken()
    {
        return csrf_token();
    }

    public function script()
    {
        return '';
    }

    protected function getElementClass()
    {
        return '.grid-batch-' . $this->id;
    }
}
