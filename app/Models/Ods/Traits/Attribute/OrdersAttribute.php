<?php

namespace App\Models\Ods\Traits\Attribute;

/**
 * Class OrdersAttribute
 * @package App\Models\Ods\Traits\Attribute
 */
trait OrdersAttribute
{



    /**
     * @return string
     */
    public function getSeeButtonAttribute()
    {
        if (access()->allow('edit-users')) {
            return '<a href="' . route('admin.orders.see', $this->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.see') . '"></i></a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (access()->allow('edit-users')) {
            return '<a href="' . route('admin.orders.edit', $this->id) . '" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#edit-'.$this->id.'"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.edit') . '"></i></a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if (access()->allow('delete-users')) {
            return '<a href="' . route('admin.orders.destroy', $this->id) . '" data-method="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a>';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getSeeButtonAttribute() .
        $this->getEditButtonAttribute() .
        $this->getDeleteButtonAttribute();
    }
}