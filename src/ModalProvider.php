<?php
namespace ModalColumnType;

use Bootstrap\Provider;
use Bootstrap\RegisterContainer;
use ModalColumnType\ColumnType\Modal\Modal;

class ModalProvider implements Provider {

    public function register(){
        RegisterContainer::registerListColumnType('modal', Modal::class);
    }
}