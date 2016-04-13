<?php

namespace App\Models\Loop\Traits\Attribute;

/**
 * Class LoopsTagsAttribute
 * @package App\Models\Loop\Traits\Attribute
 */
trait LoopsTagsAttribute
{



    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (access()->allow('edit-users')) {
            return '<a href="' . route('admin.loop.tags.edit', $this->id) . '" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#edit-tags-'.$this->id.'"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.edit') . '"></i></a> ';
        }

        return '';
    }



    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if ($this->id > 2 ) {
            if (access()->allow('delete-users')) {
                return '<a href="' . route('admin.loop.tags.destroy', $this->id) . '" data-method="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a>';
            }
        }
        return '';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return $this->getEditButtonAttribute() .
        $this->getDeleteButtonAttribute();
    }
}