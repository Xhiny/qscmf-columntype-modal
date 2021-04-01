<?php

namespace ModalColumnType\ColumnType\Modal;

use Illuminate\Support\Str;
use Qscmf\Builder\ColumnType\ColumnType;
use Think\View;

class Modal extends ColumnType
{
    protected $content = null;
    protected $width = null;
    protected $height = null;
    protected $api_url = null;

    public function build(array &$option, array $data, $listBuilder)
    {
        $this->init($option['value']);

        $view = new View();
        $view->assign('width', $this->width);
        $view->assign('height', $this->height);
        $view->assign('content', $this->content);
        $view->assign('api_url', $this->api_url);

        $view->assign('gid', Str::uuid());
        $view->assign('item', $option);
        $view->assign('value', $data[$option['name']]);

        return $view->fetch(__DIR__ . '/modal.html');
    }

    /**
     * @param null $content
     */
    protected function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @param null $api_url
     */
    protected function setApiUrl($api_url): void
    {
        $this->api_url = $api_url;
    }

    /**
     * @param null $width
     */
    protected function setWidth($width): void
    {
        $this->width = $width;
    }

    /**
     * @param null $height
     */
    protected function setHeight($height): void
    {
        $this->height = $height;
    }

    private function init($value){
        if (is_array($value)){
            $value['width'] && $this->setWidth($value['width']);
            $value['height'] && $this->setHeight($value['height']);
            $value['api_url'] && $this->setApiUrl($value['api_url']);
            !$this->api_url && $this->parseContent($value['content']);
        }else{
            $this->parseContent($value);
        }
    }

    private function parseContent($value){
        if (is_array($value)){
            $content = $value['content'];
        }else{
            $content = $value;
        }

        $this->setContent($content);
    }
}