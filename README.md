# qscmf-columntype-modal
点击弹出对话框

#### 安装

```php
composer require quansitech/qscmf-columntype-modal
```

```blade
使用技巧
1. api与content均支持使用占位符动态替换数据
```

```php
// 当使用api的方式返回内容时，链接根据api需要带该记录的参数，如id，只需用__id__作为占位符，生成list后会自动替换成该记录的真实id值
// 如变量存在下划线，nick_name，那么占位符就是 __nick_name__，以此类推
$option = [
    'api_url' => U('genModelHtml', ['id'=>'__id__'], true, true),
    'width' => '50%',
    'height' => '50%'
];
->addTableColumn('nick_name', '用户名', 'modal', $option, false, '点击查看更多信息');
```

#### 如何使用
+ 通过value设置宽度与高度，默认宽度50%，高度60%
```php
    $option = [
        'content' => 'modal content',
        'width' => '50%',
        'height' => '50%'
    ];

    ->addTableColumn('nick_name', '用户名', 'modal', $option, false, '点击查看更多信息')
```
+ 通过value设置模态框内容，可自定义html
```php
    $content = 'modal content';
    // value为数组
    ->addTableColumn('nick_name', '用户名', 'modal', ['content' => $content], false, '点击查看更多信息')

    // value字符串
    ->addTableColumn('nick_name', '用户名', 'modal', $content, false, '点击查看更多信息')

```
+ 使用技巧
```php
    // 与formBuilder结合使用，展示渲染后的html
    public function genModelHtml(){
        $info = [
            'title' => 'title',
            'summary' => 'summary',
            'cover' => 2
        ];
        $builder = new FormBuilder();
        $builder
            ->addFormItem('title', 'text', '标题')
            ->addFormItem('summary', 'textarea', '简介')
            ->addFormItem('cover', 'picture', '封面', '尺寸为214*250px', ['width' => 214, 'height' => 250])
            ->setFormData($info)
            ->setShowBtn(false)
            ->setReadOnly(true);

        return $builder->display(true);
    }

    // ListBuilder对应列配置
    ->addTableColumn('nick_name', '用户名', 'modal', $this->genModelHtml(), false, '点击查看更多信息')
```

+ 通过value设置api_url，支持展示接口返回的内容
```php
// 接口返回JSON数据格式
// 若数据正常则设置status为1，否则为0
// 将需要返回的内容赋值给info
public function genModelHtml($id){
    $info = D('User')->getOne($id); 
    
    if (!$info){
        $this->ajaxReturn(['status' => 0, 'info' => 'not found']);
    }
    $builder = new FormBuilder();
    $builder
        ->addFormItem('title', 'text', '标题')
        ->addFormItem('summary', 'textarea', '简介')
        ->addFormItem('cover', 'picture', '封面', '尺寸为214*250px', ['width' => 214, 'height' => 250])
        ->setFormData($info)
        ->setShowBtn(false)
        ->setReadOnly(true);

    $this->ajaxReturn(['status' => 1, 'info' => $builder->display(true)]);
}

$option = [
    'api_url' => U('genModelHtml', ['id'=>'__id__'], true, true),
    'width' => '50%',
    'height' => '50%'
];

// ListBuilder对应列配置
->addTableColumn('nick_name', '用户名', 'modal', $option, false, '点击查看更多信息');
```