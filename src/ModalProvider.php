<?php
namespace ColumnType\modal;

use Bootstrap\Provider;
use Bootstrap\RegisterContainer;
use Qscmf\Builder\ColumnType\Modal\Modal;

class ModalProvider implements Provider {

    public function register(){
        RegisterContainer::registerListColumnType('modal', Modal::class);
    }
}