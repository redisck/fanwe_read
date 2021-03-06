<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: 云淡风轻(97139915@qq.com)
// +----------------------------------------------------------------------

class SupplierSubmitAction extends CommonAction{
	
	public function index()
	{			

		if(isset($_REQUEST['is_publish']))
		{
			$map['is_publish'] = intval($_REQUEST['is_publish']);
		}	
	
		if (method_exists ( $this, '_filter' )) {
			$this->_filter ( $map );
		}
	
		$model = D (MODULE_NAME);
		if (! empty ( $model )) {
			$this->_list ( $model, $map );
		}
	
		
		$this->display ();
		return;
	}
	
	public function edit() {		
		$id = intval($_REQUEST ['id']);
		$condition['id'] = $id;		
		$vo = M(MODULE_NAME)->where($condition)->find();
		$cate_config = unserialize($vo['cate_config']);
		$vo['deal_cate_id'] = $cate_config['deal_cate_id'];
		$vo['deal_cate'] = M("DealCate")->where("id=".$vo['deal_cate_id'])->getField("name");
		
		$vo['deal_cate_type'] = M("DealCateType")->where(array("id"=>array("in",$cate_config['deal_cate_type_id'])))->findAll();
		
		$location_config = unserialize($vo['location_config']);
		$location_config[] = 0;
		$vo['area_list'] = M("Area")->where(array("id"=>array("in",$location_config)))->order("pid asc")->findAll();

		$vo['city'] = M("DealCity")->where("id=".$vo['city_id'])->getField("name");
		
		$this->assign ( 'vo', $vo );
		$this->display ();
	}
	
	public function update() {
		B('FilterString');
		$data = M("SupplierSubmit")->getById(intval($_REQUEST['id']));
		if(!$data)
		{
			$this->error("非法的数据");
		}
		
			
		$cate_config = unserialize($data['cate_config']);
		$data['deal_cate_id'] = $cate_config['deal_cate_id'];
		$data['deal_cate_type_list'] = $cate_config['deal_cate_type_id'];		
		$data['area_list'] = unserialize($data['location_config']);
		
		
		if($data['location_id']==0)
		{
			$supplier_id = intval($_REQUEST['supplier_id']);
			if($supplier_id == 0)
			{
				//先创建商户
				$supplier_info['name'] = $data['name'];
				$supplier_info['bank_info'] = $data['h_bank_info'];
				$supplier_info['bank_user'] = $data['h_bank_user'];
				$supplier_info['bank_name'] = $data['h_bank_name'];
				$supplier_info['preview'] = $data['h_supplier_logo'];
				//公司信息
				$supplier_info['h_name'] = $data['h_name'];
				$supplier_info['h_faren'] = $data['h_faren'];
				$supplier_info['h_tel'] = $data['h_tel'];
				$supplier_info['is_effect'] =1;
				$supplier_info['city_id'] = $data['city_id'];
				$supplier_id = M("Supplier")->add($supplier_info);
				$location_info['is_main'] = 1;
			}
			
			$location_info['name'] = $data['name'];			
			$location_info['address'] = $data['address'];
			$location_info['tel'] = $data['tel'];
			$location_info['xpoint'] = $data['xpoint'];
			$location_info['ypoint'] = $data['ypoint'];
			$location_info['supplier_id'] = $supplier_id;
			$location_info['open_time'] = $data['open_time'];
			$location_info['city_id'] = $data['city_id'];
			$location_info['deal_cate_id'] = $data['deal_cate_id'];
			$location_info['preview'] = $data['h_supplier_image'];
			$location_info['biz_license'] = $data['h_license'];
			$location_info['biz_other_license'] = $data['h_other_license'];	
			$location_info['is_effect'] = 1;
			$data['location_id'] = M("SupplierLocation")->add($location_info);
			
			foreach($data['deal_cate_type_list'] as $deal_cate_type_id)
			{
				$link = array();
				$link['location_id'] = $data['location_id'];
				$link['deal_cate_type_id'] = $deal_cate_type_id;
				M("DealCateTypeLocationLink")->add($link);
			}
			
			foreach($data['area_list'] as $area_id)
			{
				$link = array();
				$link['location_id'] = $data['location_id'];
				$link['area_id'] = $area_id;
				M("SupplierLocationAreaLink")->add($link);
			}
			syn_supplier_location_match($data['location_id']);
			// 插入关键字
			require_once APP_ROOT_PATH."system/model/search_key_words.php";
			insertKeyWordsApi($data['location_id'], 4);
		}
		
		if($data['location_id']>0)
		{

		//会员未绑定商户，或绑定的不是同名商户管理员，创建一个商户管理员
				$account['account_name'] = $data['account_name'];
				$account['account_password'] = $data['account_password'];
				$account['supplier_id'] = $location_info['supplier_id'];
				$account['is_effect'] = 1;
				$account['description'] = $data['h_name']." 法人：".$data['h_faren']." 电话：".$data['h_tel'];
				$account['update_time'] = NOW_TIME;		
				$account['mobile'] = $data['account_mobile'];
				$account['is_main'] = 1;
				$account['allow_delivery'] = 1;
				$account['allow_charge'] = 1;

				$id = M("SupplierAccount")->add($account);
				
				if($id)
				{
					//添加成功
					$link = array();
					$link['account_id'] = $id;
					$link['location_id'] = $data['location_id'];
					M("SupplierAccountLocationLink")->add($link);
					
					//认领成功
					$location_info['biz_license'] = $data['h_license'];
					$location_info['biz_other_license'] = $data['h_other_license'];				
					M("SupplierLocation")->save($location_info);
					
					$this->assign("jumpUrl",u("SupplierLocation/edit",array("id"=>$data['location_id'])));
					M("SupplierSubmit")->where("id=".intval($_REQUEST['id']))->setField("is_publish",1);
					save_log($data['name']."审核成功",1);
					if($data['user_id']>0){
						$user_info = M("User")->getById($data['user_id']);
						$user_info['is_merchant'] = 1;
						$user_info['merchant_name'] = $account['account_name'];
						M("User")->save($user_info);
					}
					
					$this->success("审核成功");
				}
				else
				{
					$this->error("审核失败，请联系系统管理员");
				}					
		}		
	}
	
	
	
	public function foreverdelete() {
		//彻底删除指定记录
		$ajax = intval($_REQUEST['ajax']);
		$id = $_REQUEST ['id'];
		if (isset ( $id )) {
				$condition = array ('id' => array ('in', explode ( ',', $id ) ) );
				$rel_data = M(MODULE_NAME)->where($condition)->findAll();				
				foreach($rel_data as $data)
				{
					$info[] = $data['name'];	
				}
				if($info) $info = implode(",",$info);
				$list = M(MODULE_NAME)->where ( $condition )->delete();	
				//删除相关预览图
//				foreach($rel_data as $data)
//				{
//					@unlink(get_real_path().$data['preview']);
//				}			
				if ($list!==false) {
										
					save_log($info.l("FOREVER_DELETE_SUCCESS"),1);
					$this->success (l("FOREVER_DELETE_SUCCESS"),$ajax);
				} else {
					save_log($info.l("FOREVER_DELETE_FAILED"),0);
					$this->error (l("FOREVER_DELETE_FAILED"),$ajax);
				}
			} else {
				$this->error (l("INVALID_OPERATION"),$ajax);
		}
	}
	
	
}
?>