# qscmf-columntype-modal
qscmf 列表类型控件--modal框

#### 安装

```php
composer require quansitech/qscmf-columntype-modal
```

#### 如何使用
+ 设置modal框内容，可自定义html
> ```blade
> 通过使用占位符，可以动态展示list的值。
> 如列name，只需用 __name__ 作为占位符，生成list后会自动替换成该记录的真实name值。
> 若列名存在下划线，如nick_name，那么占位符就是 __nick_name__ ，以此类推。
> ```
> ```php
> // 可以与formBuilder结合使用，展示渲染后的html
>  public function genModelHtml($id){
>      $info = D('Post')->getOne($id); 
>      $builder = new FormBuilder();
>      $builder
>          ->addFormItem('title', 'text', '标题')
>          ->addFormItem('summary', 'textarea', '简介')
>          ->addFormItem('cover', 'picture', '封面', '尺寸为214*250px', ['width' => 214, 'height' => 250])
>          ->setFormData($info)
>          ->setShowBtn(false)
>          ->setReadOnly(true);
>
>      return $builder->display(true);
>  }
> 
> $data_list = D('User')->limit(10)->select();
> foreach ($data_list as &$v){
>     $v['modal_html'] = $this->genModelHtml($v['post_id']);
> }
> 
> // 当value为数组
> ->addTableColumn('nick_name', '用户名', 'modal', ['content' => '__modal_html__'], false, '点击查看更多信息')
> 
> //当value为字符串
> ->addTableColumn('nick_name', '用户名', 'modal', '__modal_html__', false, '点击查看更多信息')
> ```

+ 设置api_url，将接口返回的info设置为modal框内容
> 1. 接口说明
>> + 需要返回JSON数据格式
>> + 若数据正常则设置status为1，否则为0
>> + 将需要返回的内容赋值给info
>
> 2. 用例
>
> ```php
> // api_url的参数支持使用占位符，动态替换list的值
> // 如列id，只需用 __id__ 作为占位符，生成list后会自动替换成该记录的真实id值。
> // 若列名存在下划线，如user_id，那么占位符就是 __user_id__ ，以此类推。
>  $option = [
>      'api_url' => U('genModelHtml', ['id'=>'__id__'], true, true),
>      'width' => '50%',
>      'height' => '50%'
>  ];
>  
>  // ListBuilder对应列配置
>  ->addTableColumn('nick_name', '用户名', 'modal', $option, false, '点击查看更多信息');
>
> public function genModelHtml($id){
>    $info = D('User')->getOne($id); 
>    
>    if (!$info){
>        $this->ajaxReturn(['status' => 0, 'info' => 'not found']);
>    }
>    $builder = new FormBuilder();
>    $builder
>        ->addFormItem('title', 'text', '标题')
>        ->addFormItem('summary', 'textarea', '简介')
>        ->addFormItem('cover', 'picture', '封面', '尺寸为214*250px', ['width' => 214, 'height' => 250])
>        ->setFormData($info)
>        ->setShowBtn(false)
>        ->setReadOnly(true);
>
>    $this->ajaxReturn(['status' => 1, 'info' => $builder->display(true)]);
>}
>```

+ 设置modal框宽度与高度，默认宽度50%，高度60%
>```php
>    $option = [
>        'content' => 'modal content',
>        'width' => '50%',
>        'height' => '50%'
>    ];
>
>    ->addTableColumn('nick_name', '用户名', 'modal', $option, false, '点击查看更多信息')
>```