<?php

namespace ModalColumnType\ColumnType\Modal;

use Illuminate\Support\Str;
use Qscmf\Builder\ColumnType\ColumnType;
use Think\View;

class Modal extends ColumnType
{
    public function build(array &$option, array $data, $listBuilder)
    {
        $view = new View();
        $view->assign('gid', Str::uuid());
        $view->assign('item', $option);
        $view->assign('value', $data[$option['name']]);

        $view = $this->parseOptionValue($option['value'], $view);

        return $view->fetch(__DIR__ . '/modal.html');
    }

    private function parseOptionValue($value, $view){
        if (is_array($value)){
            $content = $value['content'];
        }else{
            $content = $value;
        }

        $view->assign('content', $content);

        return $view;
    }
}