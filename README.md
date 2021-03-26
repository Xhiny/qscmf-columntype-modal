# qscmf-columntype-modal
点击弹出对话框

#### 安装

```php
composer require quansitech/qscmf-columntype-modal
```

#### 如何使用
+ 通过value可自定义模态框html
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