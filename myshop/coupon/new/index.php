<?php
/* 新規クーポン作成ページ */

//  My shop ID.
$shop_id = $this->GetShopID();

//  Form
$form_config = $this->config()->form_coupon( $shop_id );
//$this->d($config);
$this->form()->AddForm( $form_config );
$form_name = $form_config->name;
$this->d( Toolbox::toArray($config) );

//  Action
$action = $this->GetAction();
$this->mark($action,'controller');


switch( $action ){
	case 'index':
		$this->template('index.phtml');
		break;
		
	case 'confirm':
		if(!$this->form()->Secure('form_coupon') ){
			$args['message'] = '入力内容を確かめて下さい。';
			$this->template('index.phtml',$args);
		}else{
			$this->template('confirm.phtml');
		}
		$this->form()->debug('form_coupon');
		break;
	
	case 'commit':
		if( $this->form()->Secure('form_coupon') ){
				
			//  Do Insert
			$config = $this->config()->insert_coupon($shop_id);
			$result = $this->pdo()->insert($config);
				
			//  View result
			if( $result === false ){
				$args['message'] = 'Couponレコードの作成に失敗しました。';
			}else{
			//	$args['message'] = '新規クーポンを作成しました。';
				$coupon_id = $result;
				$this->Location("app://myshop/coupon/edit/$coupon_id");
			}
		}else{
			$args = null;
		}
	
		$this->template('form.phtml',$args);
		break;
	}
		