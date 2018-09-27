<?php
/**
 * Created by PhpStorm.
 * User: wangyifeng
 * Date: 2018/5/24
 * Time: 上午10:57
 */

namespace Vendor\power\view;

class View
{
    private $arrayConfig = array(
        'suffix' => '.html',
        'templateDir' => 'template/',
        'compiredir' => 'cache',
        'cache_htm' => '.htm',
        'cache_time' => 7200,
        'php_return' => false,
    );

    public $path;          //绝对地址
    public $file;
    private $compiler;     //编译器
    private $value = array();
    private static $instance = null;

    public function __construct($arrayConfig = array())
    {
        $this->arrayConfig += $arrayConfig;
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function setConfig($key, $value = null)
    {
        if (is_array($key)) {
            $this->arrayConfig += $key;
        } else {
            $this->arrayConfig[$key] = $value;
        }

    }

    public function getConfig($key = null)
    {
        if ($key) {
            return $this->arrayConfig[$key];
        }
        return $this->arrayConfig;
    }

    public function assign($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->value[$k] = $v;
            }
        } else {
            $this->value[$key] = $value;

        }
    }

    public function setPath($path)
    {
        $this->file = $path;
        $this->path = $this->arrayConfig['templateDir'] .$path .$this->arrayConfig['suffix'];
    }

    public function show($path)
    {
        $this->setPath($path);
        if (!is_file($this->path)) {
            exit('找不到对应的模版');
        }

        $compileFile = $this->getCompiredPath();
        if (!$this->isFileExist($compileFile) || $this->isExpired()) {
            $this->compiler = new Compile($this->path, $compileFile, $this->arrayConfig);
            //TODO 做模版匹配需要添加，现在仅支持原生的不需要添加。后期考虑可以添加。不过没有必要
//            $this->compiler->value = $this->value;

            $this->compiler->compile();
        }

        extract($this->value, EXTR_OVERWRITE);
        include $compileFile;
    }


    protected function isFileExist($path)
    {
        return is_file($path);
    }

    protected function isExpired()
    {
        $compileFile = $this->getCompiredPath();
        $lastModified = $this->lastModified($this->path);

        return $lastModified >= $this->lastModified($compileFile);
    }

    protected function getCompiredPath()
    {
        return $this->arrayConfig['compiredir'] .'/' .md5($this->file) .'.php';
    }

    protected function lastModified($path)
    {
        return filemtime($path);
    }
}
