<?php

namespace App\Models\Goods\Traits\Attribute;

/**
 * Class GoodsTagsAttribute
 * @package App\Models\Goods\Traits\Attribute
 */
trait GoodsAttribute
{



    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (access()->allow('edit-users')) {
            return '<a href="' . route('admin.goods.edit', $this->id) . '" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#edit-'.$this->id.'"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.edit') . '"></i></a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getListButtonAttribute(){
        if (access()->allow('edit-users')) {
            return '<a href="' . route('admin.loop.tags.edit', $this->id) . '" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#edit-tags-'.$this->id.'"><i class="fa fa-navicon" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.order_list') . '"></i></a> ';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getDownButtonAttribute(){
        if ($this->status == 10) {
            if (access()->allow('edit-users')) {
                return '<a href="' . route('admin.goods.down', $this->id) . '" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#down-' . $this->id . '"><i class="fa fa-hand-o-down" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.down') . '"></i></a> ';
            }
        }
        return '';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if (access()->allow('delete-users')) {
            return '<a href="' . route('admin.goods.destroy', $this->id) . '" data-method="delete" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.crud.delete') . '"></i></a>';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getLookOkButtonAttribute(){
        if ($this->status == 1) {
            if (access()->allow('edit-users')) {
                return '<a href="' . route('admin.goods.look-ok', $this->id) . '" name="look-ok" class="btn btn-xs btn-primary"><i class="fa fa-check" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.look.ok') . '"></i></a> ';
            }
        }
        return '';
    }

    /**
     * @return string
     */
    public function getLookNoButtonAttribute()
    {
        if ($this->status == 1) {
            if (access()->allow('delete-users')) {
                return '<a href="' . route('admin.goods.look-no', $this->id) . '" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#look-no-' . $this->id . '"><i class="fa fa-close" data-toggle="tooltip" data-placement="top" title="' . trans('buttons.general.look.no') . '"></i></a>';
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
        $this->getDownButtonAttribute() .
        $this->getLookOkButtonAttribute() .
        $this->getLookNoButtonAttribute() . ' ' .
        $this->getDeleteButtonAttribute();
    }

    /**
     * @return string
     */
    public function getLookButtonsAttribute()
    {
        return $this->getEditButtonAttribute() .
        $this->getLookOkButtonAttribute() .
        $this->getLookNoButtonAttribute();
    }
}