<?php
/*
**  View rendering class
*/

namespace App\Core {

    class View {

        private string $view;
        private array $params;

        /*
        **  Set view name and needed to render params
        */
        public function __construct(string $view, array $params = []) {
            $this->view = $view;
            $this->params = $params;
        }

        /*
        **  Output view in layout
        */
        public function Render(): void {
            $content = $this->getTemplate($this->view, $this->params);
            echo $this->getTemplate('layout', ['content' => $content]);
        }

        /*
        **  Get interpreted template php file
        */
        private function getTemplate($view, $params): string {
            extract($params);
            ob_start();
            include '../controllers/' . $view . '.php';
            return ob_get_clean();
        }
    }

}