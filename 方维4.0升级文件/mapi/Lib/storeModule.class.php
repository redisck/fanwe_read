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
	
	
	/**
	 * 商家详细页
	 * 输入：data_id 门店id
	 * 无
	 * 

	 * store_info:object 门店信息
	 * 结构如下
		Array
		(
		    [preview] => http://localhost/o2onew/public/attachment/201502/25/14/54ed67b2cd14b_388x236.jpg [string] 展示图：300x182
		    [id] => 21
		    [share_url] => [string] 分享链接
		    [supplier_id] => 23
		    [is_verify] => 0
		    [avg_point] => 5.0000
		    [address] => 台江区宝龙万象城4楼391号
		    [name] => 桥亭活鱼小镇（万象城店）
		    [tel] => 059188855588
		    [brief] => <p align="center"><br />			
		    [store_images] => Array
		        (
		            [0] => Array
		                (
		                    [brief] => 
		                    [image] => http://localhost/o2onew/public/attachment/201502/25/14/54ed6a9a856ba.jpg [string]图集： 300x182
		                )
		        )
		     [xpoint] => float 经度
		     [ypoint] => float 纬度
		
		)
		
	 * other_supplier_location:array 其它门店
	 * 结构如下		
		Array
        (
            [0] => Array
                (
                    [preview] => http://localhost/o2onew/public/attachment/201502/25/14/54ed67b2cd14b_388x236.jpg [string]其它门店展示图： 150x84
                    [id] => 22
                    [is_verify] => 0
                    [avg_point] => 0.0
                    [address] => 晋安区新店镇五四北泰禾广场六楼（中影影院旁，音乐-百度KTV旁边）
                    [name] => 桥亭活鱼小镇（泰禾广场店）
                    [distance] => 0
                )
       )         
	 * tuan_list:array 团购列表
	 * 结构如下
	 * Array
        (
            [0] => Array
                (
                    [id] => 74 [int] 团购ID
                    [name] => 仅售75元！价值100元的镜片代金券1张，仅适用于镜片，可叠加使用。[string] 团购名称
                    [sub_name] => 镜片代金券 [string] 团购短名称
                    [brief] => 【36店通用】明视眼镜 [string] 团购简介
                    [buy_count] => 1 [int] 销量
                    [current_price] => 75 [float] 现价
                    [origin_price] => 100 [float] 原价
                    [icon] => http://localhost/o2onew/public/attachment/201502/25/17/54ed9d05a1020_150x84.jpg [string] 团购图片 150x84
                    [end_time_format] => 2017-02-28 18:00:08 [string] 格式化的结束时间
                    [begin_time_format] => 2015-02-25 18:00:10 [string] 格式化的开始时间
                    [begin_time] => 1424829610 [int] 开始时间戳
                    [end_time] => 1488247208 [int] 结束时间戳
                    [auto_order] => 1 [int] 免预约 0:否 1:是
                    [is_lottery] => 1 [int] 是否抽奖 0:否 1:是
                    [distance]	=>	[float] 有地理定位时的离当前地的距离(米)
                    [xpoint] => [float] 团购所在经度
                    [ypoint] => [float] 团购所在纬度
                    [is_today] => [int] 是否为今日团购 0否 1是
                )
       )
	 * deal_list:array 商城商品列表
	 * 结构如下
	 * Array
        (
            [0] => Array
                (
                    [id] => 74 [int] 商品ID
                    [name] => 仅售75元！价值100元的镜片代金券1张，仅适用于镜片，可叠加使用。[string] 商品名称
                    [sub_name] => 镜片代金券 [string] 商品短名称
                    [brief] => 【36店通用】明视眼镜 [string] 商品简介
                    [buy_count] => 1 [int] 销量
                    [current_price] => 75 [float] 现价
                    [origin_price] => 100 [float] 原价
                    [icon] => http://localhost/o2onew/public/attachment/201502/25/17/54ed9d05a1020_150x84.jpg [string] 商品图片 150x84
                    [end_time_format] => 2017-02-28 18:00:08 [string] 格式化的结束时间
                    [begin_time_format] => 2015-02-25 18:00:10 [string] 格式化的开始时间
                    [begin_time] => 1424829610 [int] 开始时间戳
                    [end_time] => 1488247208 [int] 结束时间戳
                    [is_refund] => 1 [int] 是否随时退 0:否 1:是
                )
       )
	 * event_list:array 活动列表
	 * 结构如下
	 * Array
       (
            [0] => Array
                (
                    [id] => 4 [int] 活动ID
                    [name] => 贵安温泉自驾游 [string] 活动名称
                    [icon] => http://localhost/o2onew/public/attachment/201502/26/14/54eec33c40e99_600x364.jpg [string] 活动图片 300x182
                    [submit_begin_time_format] => 2015-02-01 14:54:53 [string] 格式化活动报名开始时间
                    [submit_end_time_format] => 2020-02-26 14:54:55 [string] 格式化活动报名结束时间
                    [sheng_time_format] => 06天04小时50分 [string] 活动报名剩余时间
                )
       )
	 * youhui_list:array 优惠列表
	 * Array
        (
            [0] => Array
                (
                    [id] => 23 [int] 优惠券ID
                    [name] => 华莱士30元抵用券 [string] 优惠券名称
                    [list_brief] => 华莱士30元抵用券 [string] 优惠券列表简介
                    [icon] => http://localhost/o2onew/public/attachment/201502/26/11/54ee8fc5497f9_150x84.jpg [string] 优惠券图片 150x84
                    [down_count] => 4 [int] 下载量
                    [begin_time] => 2015-02-01至2020-02-26 [string] 时间
                )
       )
     *
     *
     * dp_list 评论列表
     * Array 
       (
        [0] => Array
        (
            [id] => '7' [int] 评论id
            [create_time] => '2013-04-26' [string] 评论时间
            [content] => '垃圾地方，老板坑人，两个人去吃硬要给我们2斤8两的鱼，一大半都没吃，最关键的没吃过这么难吃的酸菜鱼。去吃保证会后悔' [string] 评论内容
            [reply_content] => '' [string] 回复内容
            [point] => '1' [int] 评论分数
            [user_name] => 'z3074219' [string] 评论的用户名
            [images] => 
                Array (
                  [0] => 'http://192.168.3.148/fwshop/public/comment/201510/25/06/fe7b2a5dc01d7c82f5197448c160d2ee58_120x120.jpg' [string] 评论图片 60x60
                  [1] => 'http://192.168.3.148/fwshop/public/comment/201510/25/06/d66685328e8b42c0d38cb7461ba78c6151_120x120.jpg' [string] 评论图片 60x60
                  [2] => 'http://192.168.3.148/fwshop/public/comment/201510/25/06/c0e84dbc56f72e881053ffcb103280fe31_120x120.jpg' [string] 评论图片 60x60
                )
            [images_v1' => 
                Array (
                  [0] => 'http://192.168.3.148/fwshop/public/comment/201510/25/06/fe7b2a5dc01d7c82f5197448c160d2ee58_200x200.jpg' [string] 评论图片 50x50
                  [1] => 'http://192.168.3.148/fwshop/public/comment/201510/25/06/d66685328e8b42c0d38cb7461ba78c6151_200x200.jpg' [string] 评论图片 50x50
                  [2] => 'http://192.168.3.148/fwshop/public/comment/201510/25/06/c0e84dbc56f72e881053ffcb103280fe31_200x200.jpg' [string] 评论图片 50x50
                )
            [oimages' => 
                Array (
                  [0] => 'http://192.168.3.148/fwshop/public/comment/201510/25/06/fe7b2a5dc01d7c82f5197448c160d2ee58.jpg' [string] 评论图片 原图
                  [1] => 'http://192.168.3.148/fwshop/public/comment/201510/25/06/d66685328e8b42c0d38cb7461ba78c6151.jpg' [string] 评论图片 原图
                  [2] => 'http://192.168.3.148/fwshop/public/comment/201510/25/06/c0e84dbc56f72e881053ffcb103280fe31.jpg' [string] 评论图片 原图
                )
          )
        )
     *
     * location_list 推荐商家
     * Array (
          [0 => 
              Array (
                [preview] => 'http://192.168.3.148/fwshop/public/attachment/201601/29/11/56aada5615140_360x330.jpg' [string] 门店展示图片 92x82
                [preview_v1] => 'http://192.168.3.148/fwshop/public/attachment/201601/29/11/56aada5615140_360x260.jpg' [string] 门店展示图片 90x65
                [preview_v2] => 'http://192.168.3.148/fwshop/public/attachment/201601/29/11/56aada5615140_128x128.jpg' [string] 门店展示图片 64x64
                [id] => [23] [string] 门店id
                [is_verify] => 0 [int] 是否认证
                [avg_point] => '5.0000' [float] 评论的平均分数
                [address] => '嵊州市三江街道世贸广场27、29号（新国商北侧，中行边）' [string] 门店地址
                [name] => '金樽人家' [string] 门店名称
                [distance] => '' [string] 当前位置与门店距离（米）
                [xpoint] => [float] 门店所在经度
                [ypoint] => [float] 门店所在纬度
                [tel] => '0575-83178977' [string] 门店电话
                [dealcate_name' => '酒店' [string] 门店分类名称
                [area_name' => NULL  [string] 门店地区名称
              )
         )
      
	 * page_title:string 页面标题
	 * 
	 */
	public function index()
	{
		$root = array();
		$root['status'] = 1;
		$root['info'] = '';
		
		$store_id = intval($GLOBALS['request']['data_id']);//门店ID
		
		
		
		require_once APP_ROOT_PATH."system/model/supplier.php";
		$store_info = get_location($store_id);
		
	    if($store_info){
            $root['id'] = $store_info['id'];
        }else{
            output($root,0,"门店数据未找到");
        }
        
        // 获取商户优惠信息
        $store_info['promotes'] = array();
        if ($store_info['open_store_payment'] == 1) {
            $promotes = $GLOBALS['db']->getAll("select * from ".DB_PREFIX."promote where supplier_id=".$store_info['supplier_id']);
            $store_info['promotes'] = $promotes;
        }

		//商户图库
		$store_images = $GLOBALS['db']->getAll("select brief,image from ".DB_PREFIX."supplier_location_images where supplier_location_id = ".$store_id." and status = 1 order by sort limit ".MAX_SP_IMAGE);
	 
		foreach($store_images as $k=>$v)
		{
			$store_images[$k]['image'] = get_abs_img_root(get_spec_image($v['image'],300,182));
		}
		$store_info['store_images'] = $store_images;
		
		//is_auto_order 1:手机自主下单;消费者(在手机端上)可以直接给该门店支付金额
		$store_info['is_auto_order'] = 0;
		$root['store_info'] = format_store_item($store_info);

		//其它门店
		$ext_condition = " supplier_id = ".$store_info['supplier_id']." and id != ".$store_id;
	    $join = '';
	    $field_append = '';
	    //开始身边团购的地理定位
	    $geo=$GLOBALS['geo'];
	    $ypoint =  $geo['ypoint'];  //ypoint
	    $xpoint =  $geo['xpoint'];  //xpoint
	    $address = $geo['address'];
	
	    if($xpoint>0)/* 排序（$order_type）  default 智能（默认）*/
	    {
	        $pi = PI;  //圆周率
	        $r = EARTH_R;  //地球平均半径(米)
	        $field_append = ", (ACOS(SIN(($ypoint * $pi) / 180 ) *SIN((sl.ypoint * $pi) / 180 ) +COS(($ypoint * $pi) / 180 ) * COS((sl.ypoint * $pi) / 180 ) *COS(($xpoint * $pi) / 180 - (sl.xpoint * $pi) / 180 ) ) * $r) as distance ";
	    }
	    
	    $result = get_location_list(50, array(), '', $ext_condition, '', $field_append);
	    
	    $indexs_supplier_rs = $result['list'];
	    foreach($indexs_supplier_rs as $k=>$v){
	        $indexs_supplier_rs[$k] = format_store_list_item($v);
	    }
	    $root['other_supplier_location'] = $indexs_supplier_rs?$indexs_supplier_rs:array();
	  
				
		require_once APP_ROOT_PATH."system/model/deal.php";
		//门店团购
		$result = get_deal_list(50,array(DEAL_ONLINE,DEAL_NOTICE),array()," left join ".DB_PREFIX."deal_location_link as l on d.id = l.deal_id "," d.buy_type <> 1 and d.is_shop = 0 and l.location_id =".$store_id);
		$indexs_deal = $result['list'];
		foreach($indexs_deal as $k=>$v){
			$indexs_deal[$k] = format_deal_list_item($v);
		}
		
		$root['tuan_list']=$indexs_deal?$indexs_deal:array();;
		
		//门店商品
		$result = get_goods_list(50,array(DEAL_ONLINE,DEAL_NOTICE),array()," left join ".DB_PREFIX."deal_location_link as l on d.id = l.deal_id "," d.buy_type <> 1 and d.is_shop = 1 and l.location_id =".$store_id);
		$indexs_deal = $result['list'];
		foreach($indexs_deal as $k=>$v){
			$indexs_deal[$k]=format_deal_list_item($v);
		}		
		
		$root['deal_list'] = $indexs_deal?$indexs_deal:array();
		
		
		//门店活动
		require_once APP_ROOT_PATH."system/model/event.php";
		$result = get_event_list(10,array(EVENT_NOTICE,EVENT_ONLINE),array()," left join ".DB_PREFIX."event_location_link as l on e.id = l.event_id "," l.location_id = ".$store_id);
		$indexs_event_rs = $result['list'];
		foreach($indexs_event_rs as $k=>$v){
			$indexs_event[$k] = format_event_list_item($v);
		}
		$root['event_list'] = $indexs_event?$indexs_event:array();
		
		//门店优惠券
		require_once APP_ROOT_PATH."system/model/youhui.php";			
		$result = get_youhui_list(50,array(YOUHUI_NOTICE,YOUHUI_ONLINE),array(), ' left join '.DB_PREFIX."youhui_location_link as l on y.id = l.youhui_id "," l.location_id = ".$store_id);
		$youhui_list = $result['list'];
		foreach($youhui_list as $k=>$v)
		{
			$youhui_list[$k] = format_youhui_list_item($v);
		}
		$root['youhui_list'] = $youhui_list?$youhui_list:array();
		
		/*点评数据*/
		require_once APP_ROOT_PATH."system/model/review.php";
	    require_once APP_ROOT_PATH."system/model/user.php";
	    
	    /*获点评数据*/
	    $dp_list = get_dp_list(5,$param=array("location_id"=>$store_id),"","");
	    $format_dp_list = array();
	    
	    
	    foreach($dp_list['list'] as $k=>$v){
	    
	        $temp_arr = array();
	         
	        $temp_arr['id'] = $v['id'];
	        $temp_arr['create_time'] = $v['create_time'] > 0 ?to_date($v['create_time'],'Y-m-d'):'';
	        $temp_arr['content'] = $v['content'];
	        $temp_arr['reply_content']= $v['reply_content']?$v['reply_content']:'';
	        $temp_arr['point'] = $v['point'];
	    
	        $uinfo = load_user($v['user_id']);
	        $temp_arr['user_name'] = $uinfo['user_name'];
	    
	    
	    
	        $images = array();
	        $images_v1 = array();
	        $oimages = array();
	    
	        if($v['images']){
	            foreach ($v['images'] as $ik=>$iv){
	                $images[] = get_abs_img_root(get_spec_image($iv,60,60,1));
	                $images_v1[] = get_abs_img_root(get_spec_image($iv, 50, 50,1));
	                $oimages[] = get_abs_img_root($iv);
	            }
	             
	        }
	        $temp_arr['images'] = $images;
	        $temp_arr['images_v1'] = $images_v1;
	        $temp_arr['oimages'] = $oimages;
	    
	    
	        $format_dp_list[] = $temp_arr;
	    }
	    $root['dp_list'] = $format_dp_list;
	    
	    /* 推荐商家 */
	    //缓存下来的地区配置
	    $area_data = load_auto_cache("cache_area",array("city_id"=>$GLOBALS['city']['id']));
	    $city_id = intval($GLOBALS['city']['id']);//城市分类ID
	    $quan_id_l = intval($GLOBALS['request']['qid']); //商圈id
	    $area_id_l = intval($area_data[$quan_id_l]['pid']); //大区id
	    if($area_id_l ==0 && $quan_id_l>0){
	        $area_id = $quan_id = intval($GLOBALS['request']['qid']); //商圈id
	    }else{
	        $quan_id = intval($GLOBALS['request']['qid']); //商圈id
	        $area_id = intval($area_data[$quan_id_l]['pid']); //大区id
	    }
	    
	    
	    $ytop = $latitude_top = floatval($GLOBALS['request']['latitude_top']);//最上边纬线值 ypoint
	    $ybottom = $latitude_bottom = floatval($GLOBALS['request']['latitude_bottom']);//最下边纬线值 ypoint
	    $xleft = $longitude_left = floatval($GLOBALS['request']['longitude_left']);//最左边经度值  xpoint
	    $xright = $longitude_right = floatval($GLOBALS['request']['longitude_right']);//最右边经度值 xpoint
	    $ypoint =  $m_latitude = $GLOBALS['geo']['ypoint'];  //ypoint
	    $xpoint = $m_longitude = $GLOBALS['geo']['xpoint'];  //xpoint
	    
	    $ext_condition = '';
	    if($xpoint>0) 
	    {
	        $pi = PI;  //圆周率
	        $r = EARTH_R;  //地球平均半径(米)
	        $field_append = ", (ACOS(SIN(($ypoint * $pi) / 180 ) *SIN((sl.ypoint * $pi) / 180 ) +COS(($ypoint * $pi) / 180 ) * COS((sl.ypoint * $pi) / 180 ) *COS(($xpoint * $pi) / 180 - (sl.xpoint * $pi) / 180 ) ) * $r) as distance ";
	        	
	        if($ybottom!=0&&$ytop!=0&&$xleft!=0&&$xright!=0)
	        {
	            if($ext_condition!="")
	                $ext_condition.=" and ";
	            $ext_condition.= " sl.ypoint > $ybottom and sl.ypoint < $ytop and sl.xpoint > $xleft and sl.xpoint < $xright ";
	    
	            $limit = 300;
	        }
	        $order = " distance asc, ";
	    }
	    else
	        $order = "";
	  
	    $condition_param = array("aid"=>$area_id,"qid"=>$quan_id,"city_id"=>$city_id);
	    $order .= " sl.is_recommend desc, sl.good_rate desc, sl.avg_point desc, sl.is_verify desc ";
	    
	    // 设置多表链接
		$join .= ' LEFT JOIN '.DB_PREFIX.'deal_cate Dealcate ON Dealcate.id = sl.deal_cate_id ';
		$join .= ' LEFT JOIN '.DB_PREFIX.'supplier_location_area_link slal ON sl.id = slal.location_id';
		$join .= ' LEFT JOIN '.DB_PREFIX.'area area ON area.id = slal.area_id';
		
		$field_append .= ", Dealcate.name as dealcate_name, slal.area_id as area_id,  area.name as area_name ";
		$group_by = " GROUP BY  sl.id ";
	    
	    require_once APP_ROOT_PATH."system/model/supplier.php";
	    if($ext_condition!=""){
	       $ext_condition .= ' and sl.id <> '.$store_id.' ';
	    }else{
	        $ext_condition .= ' sl.id <> '.$store_id.' ';
	    }
	    $location_result = get_location_promote_list(5,$condition_param, $join,$ext_condition, $group_by, $order,$field_append);
	    
	    foreach($location_result['list'] as $k=>$v) 
	    {
	        $location_list[$k] = format_store_list_item($v);
	    }
	    $root['location_list'] = $location_list;
		
		$root['page_title'] = $GLOBALS['m_config']['program_title']?$GLOBALS['m_config']['program_title']." - ":"";
		$root['page_title'].="门店详情";
		output($root);
	}
	
	
	
	
}
?>