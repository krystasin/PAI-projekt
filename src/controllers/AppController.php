<?php

class AppController
{
    private $request;

    public function __construct()    {
        $this->request = $_SERVER['REQUEST_METHOD'];
    }
    protected function isPost() : bool {        return $this->request === 'POST';    }
    protected function isGet() : bool {        return $this->request === 'GET';    }


    protected function render(string $template = null, array $variables = [])
    {

/*        $headerPath = 'public/views/headers/header.php';
        $navigationPath = 'public/views/static/navigation.php';
        $footerPath = 'public/views/static/footer.php';*/

        $templatePath = 'public/views/' . $template . '.php';
        $output = 'File not found';

        if (file_exists($templatePath)) {
            extract($variables);

            ob_start();
/*            include $headerPath;
            include $navigationPath;*/
            include $templatePath;
/*            include $footerPath;*/
            $output = ob_get_clean();
        }
        print $output;
    }



}