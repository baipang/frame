<?php
class Loader
{
    protected $controllerDirectoryPath = array();

    protected $modelDirectoryPath = array();

    protected $libraryDirectoryPath = array();

    protected $viewDirectoryPath = array();

    public function __construct()
    {
        $this->modelDirectoryPath = 'MPATH';
        $this->controllerDirectoryPath = 'CPATH';
        $this->viewDirectoryPath = 'VPATH';
        $this->libraryDirectoryPath = 'LPATH';

        spl_autoload_register(array($this, 'load_controller'));
    }

    public function load_controller($controller)
    {
        if ($controller) {
            set_include_path($this->controllerDirectoryPath);
            spl_autoload_extensions('.php');
            spl_autoload($this);
        }
    }

    public function load_models($model)
    {
        if ($model) {
            set_include_path($this->modelDirectoryPath);
            spl_autoload_extensions('.php');
            spl_autoload($this);
        }

    }

    public function load_library($libary)
    {
        if ($libary) {
            set_include_path($this->libraryDirectoryPath);
            spl_autoload_extensions('.php');
            spl_autoload($this);
        }
    }

    public function initialize_class($libary)
    {

        try {
            if (is_array($libary)) {
                foreach ($libary as $class) {
                    $arrayObj = new $class;

                }
                return $this;
            }
            if (is_string($libary)) {
                $stringObj = new $libary;
            } else {
                throw new Exception('Class name must be string');
            }

            if (null == $libary) {
                throw new Exception('You must enter the name of the class');
            }

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}