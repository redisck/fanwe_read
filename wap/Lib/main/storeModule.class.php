<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

class storeModule extends MainBaseModule
{

	public function index()
	{
		global_run();		
		init_app_page();		

		$param['data_id'] = intval($_REQUEST['data_id']); //分类ID
        
		$request = $param;
		//获取品牌
		$data = request_api("store","index",$param);
		
		
		// 优惠券
		foreach ($data['youhui_list'] as $k=>$v){
		    $data['youhui_list'][$k]['youhui_url'] = wap_url("index", 'youhui', array('data_id'=>$v['id']) );
		}
		
		// 活动
		foreach ($data['event_list'] as $k=>$v){
		    $data['event_list'][$k]['event_url'] = wap_url("index", 'event', array('data_id'=>$v['id']) );
		}
	 
		// 优惠信息
		foreach ($data['store_info']['promotes'] as $k=>$v){
		    $promote[] = $v['description'];
		}
		
		// 团购
		foreach ($data['tuan_list'] as $k=>$v){
		    $data['tuan_list'][$k]['tuan_url'] = wap_url("index", 'deal', array('data_id'=>$v['id']) );
		}
		
		// 商品
		foreach ($data['deal_list'] as $k=>$v){
		    $data['deal_list'][$k]['deal_url'] = wap_url("index", 'deal', array('data_id'=>$v['id']) );
		}
		
		// 推荐商家
		foreach ($data['location_list'] as $k=>$v){
		    $data['location_list'][$k]['location_url'] = wap_url("index", 'store', array('data_id'=>$v['id']) );
		    $data['location_list'][$k]['avg_point'] = round($v['avg_point'], 1);
		    
		    $distance = $v['distance'];
		    $distance_str = "";
		    if($distance>0)
		    {
		        if($distance>1500)
		        {
		            $distance_str =  round($distance/1000)."km";
		        }
		        else
		        {
		            $distance_str = round($distance)."米";
		        }
		    }
		    $data['location_list'][$k]['distance'] = $distance_str;
		    
		}
		
		
		foreach ($data['other_supplier_location'] as $k=>$v){
		    $data['other_supplier_location'][$k]['location_url'] = wap_url("index", 'store', array('data_id'=>$v['id']) );
		    
		    
		    $distance = $v['distance'];
		    $distance_str = "";
		    if($distance>0)
		    {
		        if($distance>1500)
		        {
		            $distance_str =  round($distance/1000)."km";
		        }
		        else
		        {
		            $distance_str = round($distance)."米";
		        }
		    }
		    $data['other_supplier_location'][$k]['distance'] = $distance_str;
		}
		
		// 分店数
		$data['other_supplier_location_count'] = count($data['other_supplier_location']);
		
		// 评价链接
		$data['dp_url'] = wap_url("index", 'dp_list', array( 'data_id'=>$param['data_id'], 'type'=>'store') );
		
		// 优惠买单地址
		$data['store_pay_url'] = wap_url("index", 'store_pay', array('id'=>$param['data_id']) );
		
		$data['store_info']['promote_str'] = join('，', $promote);
		
		$data['store_info']['ref_avg_price'] = round($data['store_info']['ref_avg_price']);
       
		if(intval($data['id'])==0)
		{
		    app_redirect(wap_url("index"));
		}
		$GLOBALS['tmpl']->assign("request",$request);
		$GLOBALS['tmpl']->assign("store_info",$data['store_info']);
		$GLOBALS['tmpl']->assign("data",$data);		
		$GLOBALS['tmpl']->display("store.html");
	}
	
	
}
?>