<?php

namespace App\Repositories\Backend\Loop\Authority;

use App\Models\Loop\LoopsAuthority;
use App\Models\Loop\Loops;
use App\Exceptions\GeneralException;

/**
 * Class EloquentLoopAuthorityRepository
 * @package App\Repositories\Backend\Loop\Authority
 */
class EloquentLoopAuthorityRepository implements LoopAuthorityRepositoryContract
{

    /**
     * @param  $id
     * @return mixed
     */
    public function find($id)
    {
        return LoopsAuthority::find($id);
    }

    /**
     * @param  $input
     * @throws GeneralException
     * @return static
     */
    public function store($input)
    {
        if (LoopsAuthority::where('title', $input['title'])->first()) {
            throw new GeneralException(trans('exceptions.backend.loop.authority_already_exists'));
        }
        $authority       = new LoopsAuthority;
        $authority->types = $input['types'];
        $authority->title = $input['title'];
        $authority->path = $input['path'];
        $authority->icon = $input['icon'];
        $authority->sort = $input['sort'];
        return $authority->save();
    }

    /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @return mixed
     */
    public function getTagsPaginated($per_page, $order_by = 'id', $sort = 'asc')
    {
        $list = LoopsAuthority::orderBy($order_by, $sort)
            ->paginate($per_page);

        return $list;
    }

    /**
     * @param  $id
     * @param  $input
     * @return mixed
     */
    public function update($id,$input)
    {
        $tag = $this->find($id);

        return $tag->update($input);
    }

    /**
     * @param  $id
     * @return mixed
     */
    public function destroy($id)
    {
        $tag = $this->find($id);
        //$this->clearTagsByLoop($id);
        return $tag->delete();
    }


}
