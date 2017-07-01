<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2014 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

class dealModule extends MainBaseModule
{

	public function index()
	{
		global_run();		
		init_app_page();
		
		$data_id = intval($_REQUEST['data_id']);
		if($data_id==0)
			$data_id = intval($GLOBALS['db']->getOne("select id from ".DB_PREFIX."deal where uname = '".strim($_REQUEST['data_id'])."'"));
		
		$data = request_api("deal","index",array("data_id"=>$data_id,"type"=>1));
		 
		
		if(intval($data['id'])==0)
		{
			app_redirect(wap_url("index"));
		}
		
		$data['detail_url'] = wap_url("index", 'deal_detail', array('data_id'=>$data['id']) );
		$data['dp_url'] = wap_url("index", 'dp_list', array('data_id'=>$data['id'], 'type'=>'deal') );
		
		 
		// 优惠互动
	    $data['promotes_list'] = join('，',  $data['promotes_list']);
		
		// 商家其它团购商品
		foreach ($data['other_location_deal'] as $k=>$v){
		    $data['other_location_deal'][$k]['old_url'] =  wap_url("index", 'deal', array('data_id'=>$v['id']) );
		    
		}
		
		// 商家其它门店
		foreach ($data['supplier_location_list'] as $k=>$v){
		    $data['supplier_location_list'][$k]['location_url'] =  wap_url("index", 'store', array('data_id'=>$v['id']) );
		    
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
		    $data['supplier_location_list'][$k]['distance'] = $distance_str;
		    
		
		}
		
		// 推荐商品
		foreach ($data['recommend_data'] as $k=>$v){
		    $data['recommend_data'][$k]['rd_url'] =  wap_url("index", 'deal', array('data_id'=>$v['id']) );
		
		}
		 
		//是否存在关联商品
		$relate_data = $data['relate_data'];
		if($relate_data){
			//把主产品加入 relate_data
			$newGoodsList = array();
			foreach( $relate_data['goodsList'] as $k=>$item ){
				if( intval($item['id'])!=$data_id ){
					$newGoodsList[] = $item;
				}
			}
			//goodsList wap展示为两个商品一组，需要改造一下
			$rsGoodsList = array();
			for( $k=0;$k<ceil(count($newGoodsList)/2);$k++ ){
				$item1 = $newGoodsList[$k*2];
				$item2 = $newGoodsList[$k*2+1];
				if(!$item2){
					$item1['widthP'] = '50%';
				}else{
					$item1['widthP'] = '100%';
				}
				$rsGoodsList[$k][] = $item1;
				if($item2){
					$item2['widthP'] = '100%';
					$rsGoodsList[$k][] = $item2;
				}			
			}
			$GLOBALS['tmpl']->assign("goodsList",$rsGoodsList);
			$GLOBALS['tmpl']->assign("jsonDeal",json_encode($relate_data['dealArray']));
			$GLOBALS['tmpl']->assign("jsonAttr",json_encode($relate_data['attrArray']));
			$GLOBALS['tmpl']->assign("jsonStock",json_encode($relate_data['stockArray']));
		}
		$hasRelateGoods = !empty($relate_data)?1:0;
		$GLOBALS['tmpl']->assign("hasRelateGoods",$hasRelateGoods);
		
		$GLOBALS['tmpl']->assign("download",url("index","app_download"));
		$GLOBALS['tmpl']->assign("data",$data);		
		$GLOBALS['tmpl']->display("deal.html");
	}
	
	public function add_collect(){
	    global_run();
	    init_app_page();
	
	
	    $param=array();
	    $param['id'] = intval($_REQUEST['id']);
	    $data = request_api("deal","add_collect",$param);
	    ajax_return($data);
	}
	
}
?>