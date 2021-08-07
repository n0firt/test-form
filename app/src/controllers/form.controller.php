<?php

namespace App\Controllers {

    use App\Core\IController;

    class FormController implements IController {

        private array $params;
        
        public function __construct(array $params) {
            $this->params = $params;
        }

        public function Action(): void {

        }

    }

}