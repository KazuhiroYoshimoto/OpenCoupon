<?php

class CouponConfig extends ConfigMgr
{

	//===========================================//
	
	function form_test()
	{
		// I create form config.
		$form_config = new Config;
		
		// form name
		$form_config->name = 'form_test';
		
		// input text
		$input_name = 'test';
		$form_config->input->$input_name->name  = 'test';
		$form_config->input->$input_name->type  = 'text';
		$form_config->input->$input_name->value = 'default';
		
		// input submit
		$input_name = 'submit';
		$form_config->input->$input_name->name  = 'submit';
		$form_config->input->$input_name->type  = 'submit';
		$form_config->input->$input_name->value = 'submit';
		
	//	$this->d( Toolbox::toArray($form_config) );
		
		return $form_config;
	}
	
	function form_buy()
	{
		// I create form config.
		$form_config = new Config;
	
		// form name
		$form_config->name = 'form_buy';
	//	$form_config->action = '/buy/login'; // URL controll by controller
		
		// input text
		$input_name = 'coupon_id';
		$form_config->input->$input_name->name  = 'coupon_id';
		$form_config->input->$input_name->type  = 'hidden';
		$form_config->input->$input_name->value = 'default';
		
		// input text
		$input_name = 'quantity';
		$form_config->input->$input_name->name  = $input_name;
		$form_config->input->$input_name->type  = 'select';
		$form_config->input->$input_name->validate->required = true;
		$form_config->input->$input_name->style  = 'font-size:1em; height:1.5em;';
		$form_config->input->$input_name->id  = 'quantity';
		//$input['onchange'] = 'change_quantity();';
		$form_config->input->$input_name->onchange  = 'change_quantity();';
		//$form_config->input->$input_name->option->none->value = '';
		
		for( $i=1; $i<10; $i++){
			$form_config->input->$input_name->option->$i->label   = $i;
			$form_config->input->$input_name->option->$i->value   = $i;
			//$option['style'] = 'text-align:center;';
			$form_config->input->$input_name->option->$i->style   = 'text-align:center;';
		}
		
		// input submit
		$input_name = 'submit';
		$form_config->input->$input_name->name  = 'submit';
		$form_config->input->$input_name->type  = 'submit';
		$form_config->input->$input_name->class  = 'submit';
		$form_config->input->$input_name->style  = 'font-size: 16px;';
		$form_config->input->$input_name->value = 'この内容で購入';
		
		return $form_config;
	}
	
	/**
	 * Get Form Buy Confirm Config
	 * 
	 * @param  integer $account_id
	 * @param  integer $coupon_id
	 * @return  Config
	 */
	function form_buy_confirm( $aid, $cid )
	{
		$config = $this->form_buy();
		$config->merge( $this->form_address($aid,$cid) );
		
		$config->name = 'form_buy_confirm';	
//		$this->d( Toolbox::toArray($config) );
		
		return $config;	
	}
	
	function form_login()
	{
		$form_config = new Config;
	
		// form name
		$form_config->name = 'form_login';
	
		// input text
		$input_name = 'email';
		$form_config->input->$input_name->name  = $input_name;
		$form_config->input->$input_name->type  = 'text';
		$form_config->input->$input_name->label = 'メールアドレス';
		$form_config->input->$input_name->required = true;
		$form_config->input->$input_name->errors->required = '%sが未入力です。';
		
		$input_name = 'password';
		$form_config->input->$input_name->name  = $input_name;
		$form_config->input->$input_name->type  = 'text';
		$form_config->input->$input_name->label = 'パスワード';
		$form_config->input->$input_name->required = true;
		$form_config->input->$input_name->errors->required = '%sが未入力です。';
		
		/*
		$input_name = 'remember';
		$form_config->input->$input_name->name   = $input_name;
		$form_config->input->$input_name->type   = 'text';
		$form_config->input->$input_name->label  = 'パスワードの保存';
		$form_config->input->$input_name->cookie = true;
		*/
		
		// input submit
		$input_name = 'submit';
		$form_config->input->$input_name->name  = 'submit';
		$form_config->input->$input_name->type  = 'submit';
		$form_config->input->$input_name->class  = 'submit';
		$form_config->input->$input_name->style  = 'font-size: 16px;';
		$form_config->input->$input_name->value = ' ログインして購入手続きに進む ';
		
		return $form_config;
	}

	function form_register()
	{
		$form_config = new Config;
		
		//  form name
		$form_config->name   = 'form_register';
		$form_config->action = 'app:/register/confirm';
		
		//  First name
		$input_name = 'first_name';
		$form_config->input->$input_name->label = '姓';
		$form_config->input->$input_name->required = true;

		//  Last name
		$input_name = 'last_name';
		$form_config->input->$input_name->label = '名';
		$form_config->input->$input_name->required = true;
		$form_config->input->$input_name->errors->required = '%sが未入力です。';
		
		//  nickname
		$input_name = 'nick_name';
		$form_config->input->$input_name->label = 'ニックネーム';
		$form_config->input->$input_name->tail  = '<br/>';
		$form_config->input->$input_name->required = true;
		$form_config->input->$input_name->errors->required = '%sが未入力です。';

		//  E-mail
		$input_name = 'email';
		$form_config->input->$input_name->label = 'メールアドレス';
		$form_config->input->$input_name->tail  = '<br/>';
		$form_config->input->$input_name->required = true;
		$form_config->input->$input_name->errors->required = '%sが未入力です。';
		$form_config->input->$name->validate->permit = 'email';
		
		//  E-mail (confirm)
		$input_name = 'email_confirm';
		$form_config->input->$input_name->label = 'メールアドレス（確認）';
		$form_config->input->$input_name->tail  = '<br/>';
		$form_config->input->$input_name->required = true;
		$form_config->input->$input_name->validate->compare = 'email';
		$form_config->input->$input_name->errors->required = '%sが未入力です。';
		
		//  Password
		$input_name = 'password';
		$form_config->input->$input_name->label = 'パスワード';
		$form_config->input->$input_name->type  = 'password';
		$form_config->input->$input_name->tail  = '<br/>';
		$form_config->input->$input_name->required = true;
		$form_config->input->$input_name->errors->required = '%sが未入力です。';
		
		//  Password (confirm)
		$input_name = 'password_confirm';
		$form_config->input->$input_name->label = 'パスワード（確認）';
		$form_config->input->$input_name->type  = 'password';
		$form_config->input->$input_name->tail  = '<br/>';
		$form_config->input->$input_name->required = true;
		$form_config->input->$input_name->validate->compare = 'password';
		$form_config->input->$input_name->errors->required = '%sが未入力です。';
		
		//  Gender
		$input_name = 'gender';
		$form_config->input->$input_name->label = '性別';
		$form_config->input->$input_name->type  = 'select';
		$form_config->input->$input_name->required = true;
		$form_config->input->$input_name->errors->required = '%sが未入力です。';
			//  Empty
			$form_config->input->$input_name->options->e->value = '';
			//  Male
			$form_config->input->$input_name->options->m->label = '男性';
			$form_config->input->$input_name->options->m->value = 'M';
			//  Female
			$form_config->input->$input_name->options->f->label = '女性';
			$form_config->input->$input_name->options->f->value = 'F';
			
		//  Prefe
		$input_name = 'pref';
		$form_config->input->$input_name->label = '都道府県';
		$form_config->input->$input_name->type  = 'select';
		$form_config->input->$input_name->required = true;
		$form_config->input->$input_name->errors->required = '%sが未入力です。';
			
			$form_config->input->$input_name->options = $this->model('JapanesePref')->UsedToForms();
		
		//  birthday
		$input_name = 'birthday';
		$form_config->input->$input_name->label  = '生年月日';
		$form_config->input->$input_name->joint  = '-';
		$form_config->input->$input_name->cookie = true;
		$form_config->input->$input_name->validate->permit = 'date';
				
			$i = 'year';
			$form_config->input->$input_name->options->$i->type  = 'select';
			$form_config->input->$input_name->options->$i->tail  = '-';
			$form_config->input->$input_name->options->$i->value = '1980';
				
			for( $n=1; $n<=80; $n++){
				$v = date('Y') - $n;
				$form_config->input->$input_name->options->$i->options->$v->value = $v;
			}
			
			$i = 'month';
			$form_config->input->$input_name->options->$i->type  = 'select';
			$form_config->input->$input_name->options->$i->tail  = '-';
			$form_config->input->$input_name->options->$i->validate->required  = true;
			
			for( $n=0; $n<=12; $n++){
				$form_config->input->$input_name->options->$i->options->$n->value = $n ? $n: '';
			}
			
			$i = 'day';
			$form_config->input->$input_name->options->$i->type  = 'select';
			$form_config->input->$input_name->options->$i->validate->required  = true;
			for( $n=0; $n<=31; $n++){
				$form_config->input->$input_name->options->$i->options->$n->value = $n ? $n: '';
			}
			
		//  Agree
		$input_name = 'agree';
		$form_config->input->$input_name->label = '利用規約';
		$form_config->input->$input_name->type  = 'checkbox';
		$form_config->input->$input_name->validate->required = true;
			//  Agree option
			$form_config->input->$input_name->options->yes->label = '利用規約に同意する';
			$form_config->input->$input_name->options->yes->value = 1;
			
		//  submit
		$input_name = 'submit';
		$form_config->input->$input_name->type   = 'submit';
		$form_config->input->$input_name->class  = 'submit';
		$form_config->input->$input_name->style  = 'font-size: 16px;';
		$form_config->input->$input_name->value  = ' この内容で仮登録する ';
		
		return $form_config;
	}
	
	function form_address( $account_id, $coupon_id )
	{
		$form_config = new Config();
		
		$qu = " first_name, last_name, pref <- t_customer.account_id = $account_id ";
		list( $first_name, $last_name, $pref ) = $this->pdo()->quick($qu);
		$pref = $this->model('JapanesePref')->GetName($pref);
		
		//  form name
		$form_config->name   = 'form_address';
		$form_config->action = "app:/buy/$coupon_id/commit";
		
		//  First name
		$input_name = 'first_name';
		$form_config->input->$input_name->label = '姓';
		$form_config->input->$input_name->value = $first_name;
		$form_config->input->$input_name->required = true;
		
		//  Last name
		$input_name = 'last_name';
		$form_config->input->$input_name->label = '名';
		$form_config->input->$input_name->value = $last_name;
		$form_config->input->$input_name->required = true;
		$form_config->input->$input_name->errors->required = '%sが未入力です。';
		
		//  postcode
		$input_name = 'postcode';
		$form_config->input->$input_name->label = '郵便番号';
		$form_config->input->$input_name->required = true;
		$form_config->input->$input_name->errors->required = '%sが未入力です。';
		
		//  pref
		$input_name = 'pref';
		$form_config->input->$input_name->label = '都道府県';
		$form_config->input->$input_name->value = $pref;
		$form_config->input->$input_name->required = true;
		$form_config->input->$input_name->errors->required = '%sが未入力です。';

		//  city
		$input_name = 'city';
		$form_config->input->$input_name->label = '市区町村';
		$form_config->input->$input_name->required = true;
		$form_config->input->$input_name->errors->required = '%sが未入力です。';
		
		//  address
		$input_name = 'address';
		$form_config->input->$input_name->label = '丁目番地';
		$form_config->input->$input_name->required = true;
		$form_config->input->$input_name->errors->required = '%sが未入力です。';
		
		//  building
		$input_name = 'building';
		$form_config->input->$input_name->label = '建物名';
		$form_config->input->$input_name->errors->required = '%sが未入力です。';
		
		return $form_config;
	}
	
	function form_payment()
	{
		$form_config = new Config;
		
		//  form name
		$form_config->name   = 'form_payment';
		$form_config->action = 'ctrl:/execute';
		
		//  card no
		$input_name = 'card_no';
		$form_config->input->$input_name->label    = "カード番号";
		$form_config->input->$input_name->required = true;
		
		//  exp year
		$input_name = 'exp_yy';
		$form_config->input->$input_name->label = "カード有効期限（年）";
		$form_config->input->$input_name->type  = 'select';
		$form_config->input->$input_name->options = $this->model('Helper')->GetFormOptionsDateYear();
		$form_config->input->$input_name->required = true;
		
		//  exp month
		$input_name = 'exp_mm';
		$form_config->input->$input_name->label = "カード有効期限（月）";
		$form_config->input->$input_name->type  = 'select'; 
		$form_config->input->$input_name->options = $this->model('Helper')->GetFormOptionsDateMonth();
		$form_config->input->$input_name->required = true;
					
		//  csc
		$input_name = 'csc';
		$form_config->input->$input_name->label = "セキュリティコード";
		$form_config->input->$input_name->required = true;

		/*
		//  支払い方法？（リボ、分割？）
		$input_name = 'paymode';
		$form_config->input->$input_name->label = "paymode";
		$form_config->input->$input_name->required = true;
		
		//  支払い方法？（回数？）
		$input_name = 'incount';
		$form_config->input->$input_name->label = "incount";
		$form_config->input->$input_name->validate->required = true;
		*/
		
		//  submit
		$input_name = 'submit';
		$form_config->input->$input_name->type   = 'submit';
		$form_config->input->$input_name->class  = 'submit';
		$form_config->input->$input_name->style  = 'font-size: 16px;';
		$form_config->input->$input_name->value  = ' 決済 ';
		
		return $form_config;
	}

	//===========================================//
	
	function credit( $id, $amount )
	{
		$config = new Config();
		
		//  Get email
		$qu = " email <- t_account.id = $id ";
		$email = $this->pdo()->Quick($qu);
		
		//  Decrypt email
		$blowfish = new Blowfish();
		$email = $blowfish->Decrypt($email);
		
		$cardno = $this->form()->GetValue('card_no', 'form_payment');
		$exp_yy = $this->form()->GetValue('exp_yy',  'form_payment');
		$exp_mm = $this->form()->GetValue('exp_mm',  'form_payment');
		$cardexp = "$exp_yy-$exp_mm";
		
		//  Create config
		$config->email   = $email;
		$config->cardno  = $cardno;
		$config->cardexp = $cardexp;
		$config->amount  = $amount;
	//	$this->d( Toolbox::toArray($config) );
		
		return $config;
	}
	
	//===========================================//

	function database()
	{
		$config = parent::database();
	
		$config->database = 'op_coupon';
		$config->user     = 'op_coupon';
	
		return $config;
	}
	
	function select_coupon()
	{
		$config = $this->select();
		$config->table = 't_coupon';
		return $config;
	}

	function select_coupon_default()
	{
		$config = $this->select_coupon();
		$config->order = 'updated desc';
		$config->limit = 1;
		return $config;
	}
	
	function select_buy()
	{
		$config = $this->select();
		$config->table = 't_buy';
		return $config;
	}
	
	function select_shop()
	{
		$config = $this->select();
		$config->table = 't_shop';
		return $config;
	}
	
	function select_account()
	{
		$config = $this->select();
		$config->table = 't_account';
		return $config;
	}
	
	function insert_account()
	{
		$_post = $this->form()->GetInputValueAll('form_register');
		//$this->d($_post);
		
		$blowfish = new Blowfish();
		
		$email    = $_post->email;
		$password = $_post->password;
		
		$config = parent::insert('t_account');
		$config->set->email     = $blowfish->Encrypt( $email, '04B915BA43FEB5B6' );
		$config->set->email_md5 = md5($email);
		$config->set->password  = md5($password);
		
		return $config;
	}
	
	function insert_customer( $account_id )
	{
		if(!$account_id){
			$this->StackError("acount_id is empty.");
			return false;
		}
		
		$_post = $this->form()->GetInputValueAll('form_register');
		//$this->d($_post);
		
		$nick_name  = $_post->nick_name;
		$first_name = $_post->first_name;
		$last_name  = $_post->last_name;
		$gender     = $_post->gender;
		$pref       = $_post->pref;
		$birthday   = $_post->birthday;
		
		$config = parent::insert('t_customer');

		$config->set->account_id = $account_id;
		$config->set->nick_name   = $nick_name;
		$config->set->first_name  = $first_name;
		$config->set->last_name   = $last_name;
		$config->set->gender      = $gender;
		$config->set->pref        = $pref;
		$config->set->birthday    = $birthday;
		
		return $config;
	}

	function insert_address( $account_id )
	{
		if(!$account_id){
			$this->StackError("acount_id is empty.");
			return false;
		}
		
		$_post = $this->form()->GetInputValueAll('form_buy_confirm');
		$_post = $this->Decode($_post);
	//	$this->d($_post);

		$last_name  = $_post->last_name;
		$first_name = $_post->first_name;
		$postcode   = $_post->postcode;
		$pref       = $_post->pref;
		$city       = $_post->city;
		$address    = $_post->address;
		$building   = $_post->building;
		
		$config = parent::insert('t_address');
	
		$config->set->account_id  = $account_id;
		$config->set->first_name  = $first_name;
		$config->set->last_name   = $last_name;
		$config->set->postcode    = $postcode;
		$config->set->pref        = $pref;
		$config->set->city        = $city;
		$config->set->address     = $address;
		$config->set->building    = $building;
	
		return $config;
	}
}
