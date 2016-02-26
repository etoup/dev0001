<?php

namespace App\Models\Loop\Traits\Attribute;

/**
 * Class LoopsTagsAttribute
 * @package App\Models\Loop\Traits\Attribute
 */
trait LoopsAttribute
{



    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if ($this->id != 1) {
            if (access()->allow('edit-users')) {
                return '<a href="' . route('admin.loop.edit', $this->id) . '" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#edit-' . $this->id . '"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.edit') . '"></i></a> ';
            }
        }
        return '';
    }

    /**
     * @return string
     */
    public function getListButtonAttribute(){
        if (access()->allow('edit-users')) {
            return '<a href="' . route('admin.loop.msg-list', $this->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-navicon" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.msg_list') . '"></i></a> ';
        }
        return '';
    }

    /**
     * @return string
     */
    public function getUpDownButtonAttribute(){
        if ($this->loops_tags_id == 1) {
            switch($this->sort){
                case 0:
                    if (access()->allow('edit-users')) {
                        return '<a href="' . route('admin.loop.cancel-top', $this->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-hand-o-down" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.noup') . '"></i></a> ';
                    }
                    break;
                default:
                    if (access()->allow('edit-users')) {
                        return '<a href="' . route('admin.loop.do-top', $this->id) . '" class="btn btn-xs btn-primary"><i class="fa fa-hand-o-up" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.up') . '"></i></a> ';
                    }
            }
        }
        return '';
    }


    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if ($this->id != 1) {
            if (access()->allow('delete-users')) {
                return ' <a href="' . route('admin.loop.destroy', $this->id) . '" data-method="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a> ';
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
        $this->getListButtonAttribute() .
        $this->getUpDownButtonAttribute() .
        $this->getDeleteButtonAttribute();
    }
}