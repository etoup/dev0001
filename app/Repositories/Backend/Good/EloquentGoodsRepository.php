<?php

namespace App\Repositories\Backend\Good;

use App\Exceptions\GeneralException;
use App\Models\Goods\Goods;


/**
 * Class EloquentLoopTagsRepository
 * @package App\Repositories\Backend\Loop
 */
class EloquentGoodsRepository implements GoodsRepositoryContract
{

    /**
     * @param  $id
     * @return mixed
     */
    public function find($id)
    {
        return Goods::find($id);
    }



    /**
     * @param  $per_page
     * @param  string      $order_by
     * @param  string      $sort
     * @return mixed
     */
    public function getGoodsPaginated($per_page, $order_by = 'id', $sort = 'desc')
    {
        $list = Goods::with('users')
            ->orderBy($order_by, $sort)
            ->paginate($per_page);
//        dd($list);
        return $list;
    }

    /**
     * @param $per_page
     * @param int $status
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getLookGoodsPaginated($per_page, $status = 0, $order_by = 'id', $sort = 'asc'){
        $list = Goods::with('users')
            ->where('status',$status)
            ->orderBy($order_by, $sort)
            ->paginate($per_page);
//        dd($list);
        return $list;
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function destroy($id){
        $goods = $this->find($id);
        if ($goods->delete()) {
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.goods.destroy-error'));
    }

    /**
     * @param $input
     * @return bool
     * @throws GeneralException
     */
    public function doDown($input){
        $goods = $this->find($input['id']);
        if($goods->status == 1){
            $goods->status = -1;
            $goods->remark = $input['remark'];
            $goods->save();
            return true;
        }else{
            throw new GeneralException('无效操作');
        }
    }

    /**
     * @param $input
     * @return bool
     * @throws GeneralException
     */
    public function store($input){
        $goods = $this->find($input['id']);
        if($input['stocks'] <= $input['numbers']){
            $goods->title = $input['title'];
            $goods->profiles = $input['profiles'];
            $goods->price = $input['price'];
            $goods->numbers = $input['numbers'];
            $goods->stocks = $input['stocks'];
            $goods->remark = $input['remark'];
            $goods->save();
            return true;
        }else{
            throw new GeneralException('库存不能大于数量');
        }
    }

    /**
     * @param $id
     * @param $status
     * @return bool
     * @throws GeneralException
     */
    public function lookOk($id,$status){
        $goods = $this->find($id);
        if(count($goods)){
            $goods->status = $status;
            $goods->save();
            return true;
        }else{
            throw new GeneralException('无效操作');
        }
    }

    /**
     * @param $input
     * @return bool
     * @throws GeneralException
     */
    public function lookNo($input){
        $goods = $this->find($input['id']);
        if(count($goods)){
            $goods->status = $input['status'];
            $goods->remark = isset($input['remark']) ? $input['remark'] : '';
            $goods->save();
            return true;
        }else{
            throw new GeneralException('无效操作');
        }
    }
}
