<?php

namespace App\Repositories\Backend\Loop\Tags;

use App\Models\Loop\LoopsTags;
use App\Models\Loop\Loops;
use App\Exceptions\GeneralException;

/**
 * Class EloquentLoopTagsRepository
 * @package App\Repositories\Backend\Loop
 */
class EloquentLoopTagsRepository implements LoopTagsRepositoryContract
{

    /**
     * @param  $id
     * @return mixed
     */
    public function find($id)
    {
        return LoopsTags::find($id);
    }

    /**
     * @param  $input
     * @throws GeneralException
     * @return static
     */
    public function store($input)
    {
        if (LoopsTags::where('title', $input['title'])->first()) {
            throw new GeneralException(trans('exceptions.backend.loop.tags_already_exists'));
        }
        $tags       = new LoopsTags;
        $tags->title = $input['title'];
        $tags->sort = $input['sort'];
        return $tags->save();
    }

    /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @return mixed
     */
    public function getTagsPaginated($per_page, $order_by = 'id', $sort = 'asc')
    {
        $list = LoopsTags::orderBy($order_by, $sort)
            ->select(['id','title','created_at','sort'])
            ->paginate($per_page);

        if(!empty($list)){
            foreach($list as $k => $v){
                $loops = Loops::where('loops_tags_id',$v['id'])
                    ->count();
                $list[$k]['loops'] = $loops;
            }
        }
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

    /**
     * 置空圈子的类别
     * @param  $id
     * @return mixed
     */
    private function clearTagsByLoop($id){
        Loops::where('loops_tags_id',$id)->update(['loops_tags_id'=>0]);
    }

}
