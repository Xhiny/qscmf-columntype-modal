<?php
namespace ModalColumnType;

use Bootstrap\Provider;
use Bootstrap\RegisterContainer;
use ModalColumnType\ColumnType\Modal\Modal;

class ModalProvider implements Provider {

    public function register(){
        RegisterContainer::registerListColumnType('modal', Modal::class);

        RegisterContainer::registerSymLink(WWW_DIR . '/Public/column-type-modal', __DIR__ . '/../asset');
    }
}