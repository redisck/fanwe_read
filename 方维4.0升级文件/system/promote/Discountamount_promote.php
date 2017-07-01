<?php
// +----------------------------------------------------------------------
// | Fanwe 方维o2o商业系统
// +----------------------------------------------------------------------
// | Copyright (c) 2010 http://www.fanwe.com All rights reserved.
// +----------------------------------------------------------------------

$lang = array(
	'name'	=>	'减额促销',
	'description'	=>	'购买XX金额立减XX元',
	'discount_limit'	=>	'减额标准，即满XX元',
	'discount_amount'	=>	'减额额度，即立减XX元',
        'discount_type' =>"促销规则类型"  //1 满立减促销   2 折扣促销
);

$config = array(
	'discount_limit'	=>	'',
	'discount_amount' =>	'',
        'is_supplier'=>1,
        'discount_type' =>"1"
);

/* 模块的基本信息 */
if (isset($read_modules) && $read_modules == true)
{
    $module['class_name']    = 'Discountamount';

    /* 名称 */
    $module['name']    = $lang['name'];
    
    /* 描述 */
    $module['description']    = $lang['description'];

	$module['config'] = $config;
    $module['lang'] = $lang;
    return $module;
}


require_once(APP_ROOT_PATH.'system/libs/promote.php');
class Discountamount_promote implements promote {
	public function count_buy_total($region_id,
									$delivery_id,
									$payment,
									$account_money,
									$all_account_money,
									$ecvsn,
									$ecvpassword,
									$goods_list,
									$result,
									$paid_account_money,
									$paid_ecv_money,
									$old_result){
										
		//取出接口配置
		$promote_obj = $GLOBALS['db']->getRow("select * from ".DB_PREFIX."promote where class_name='Discountamount'");
		$promote_cfg = unserialize($promote_obj['config']);
		

		if($old_result['total_price']>=$promote_cfg['discount_limit'])
		{
			
			$old_result['total_price'] = $old_result['total_price'] - $promote_cfg['discount_amount'] > 0 ? $old_result['total_price'] - $promote_cfg['discount_amount'] : 0;
			$old_result['pay_total_price']	=	$old_result['pay_total_price'] - $promote_cfg['discount_amount'] > 0 ? $old_result['pay_total_price'] - $promote_cfg['discount_amount'] : 0;
			
			$old_result['pay_price'] = $old_result['total_price'] + $old_result['delivery_fee'] +  $old_result['payment_fee']; //加上运费
			$old_result['pay_price'] = $old_result['pay_price'] - $old_result['paid_account_money'] - $old_result['paid_ecv_money'];
			$old_result['pay_price'] = $old_result['pay_price'] - $old_result['user_discount']; //扣除用户折扣
			
			// 当余额 + 代金券 > 支付总额时优先用代金券付款  ,代金券不够付，余额为扣除代金券后的余额
			if($old_result['ecv_money'] + $old_result['account_money'] > $old_result['pay_price'])
			{
				if($old_result['ecv_money'] >= $old_result['pay_price'])
				{
					$ecv_use_money = $old_result['pay_price'];
					$old_result['account_money'] = 0;
				}
				else
				{
					$ecv_use_money = $old_result['ecv_money'];
					$old_result['account_money'] = $old_result['pay_price'] - $ecv_use_money;
				}
			}
			else
			{
				$ecv_use_money = $old_result['ecv_money'];
			}
		
				
		    $old_result['pay_price'] = $old_result['pay_price'] - $ecv_use_money - $old_result['account_money'];
	
		    $old_result['promote_description'][] = $promote_obj['description'];
			
			$result = $old_result;
		}
		else
		$result = $old_result;

		return $result;
	}
        
        
        /**
         * 买单优惠
         * @param type $money
         * @return type
         */
        public function count_store_pay($money,$conf){
            $pay_amount = 0;
            $discount_price = 0;
            //取出促销规则
            $conf_obj = unserialize($conf);
            $discount_limit = $conf_obj['discount_limit'];
            $discount_amount = $conf_obj['discount_amount'];
            
            if($money>=$discount_limit){
                $discount_price = intval($money/$discount_limit)*$discount_amount;
                $pay_amount = $money - $discount_price;
            }else{
                $pay_amount = $money;
                $discount_price = 0;
            }
            
            $result = array();
            //业务流程
            $resutl['pay_amount'] = $pay_amount;
            $resutl['discount_price'] = $discount_price;
            return $resutl;
        }
}
?>