<?php

namespace App\Repositories\Backend;

use App\Exceptions\GeneralException;
use App\Models\Access\User\User;
use App\Models\Goods\Goods;
use App\Models\Ods\Orders;
use App\Models\Loop\Loops;
use App\Models\Loop\LoopsMessages;


/**
 * Class EloquentLoopTagsRepository
 * @package App\Repositories\Backend\Loop
 */
class EloquentDashboardRepository implements DashboardRepositoryContract
{
    /**
     * @return array
     */
    public function getCountList(){
        $list = [
            'users_count' => User::count(),
            'loops_count' => Loops::count(),
            'goods_count' => Goods::count(),
            'orders_count'=> Orders::count(),
        ];
        return $list;
    }

    /**
     * @return mixed
     */
    public function getNewUsers(){
        $map = User::take(8)->orderBy('id','desc')->get();
        return $map;
    }

    /**
     * @return mixed
     */
    public function getNewGoods(){
        $map = Goods::take(8)->orderBy('id','desc')->get();
        return $map;
    }

    /**
     * @param int $loops_id
     * @return mixed
     */
    public function getNewMessages($loops_id = 1){
        $map = LoopsMessages::with('loops_authority')->where('loops_id',$loops_id)->orderBy('id','desc')->take(8)->get();
        return $map;
    }

    /**
     * @return mixed
     */
    public function getNewOrders(){
        $map = Orders::with('users','goods','business','users_address')->take(8)->orderBy('id','desc')->get();
        return $map;
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
}
