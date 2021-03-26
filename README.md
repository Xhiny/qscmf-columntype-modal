# qscmf-columntype-modal
点击弹出对话框

#### 安装

```php
composer require quansitech/qscmf-columntype-modal
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
    // 与formBuilder结合使用，可将渲染后的html直接放入弹窗
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