<?php
/**
 * Created by PhpStorm.
 * User: wangyifeng
 * Date: 2018/5/24
 * Time: 上午10:57
 */

namespace Vendor\power\view;

class Compile
{
    private $template; //待编译文件
    private $content;  //需要替换的文本
    private $compile;  //编译后的文件
    private $left = '{'; //左定界符
    private $right = '}'; //右定界符
    private $value = array();
    private $phpTurn;
    private $tT = array();
    private $tR = array();

    public function __construct($template, $compileFile, $config)
    {
        $this->template = $template;
        $this->compile = $compileFile;
        $this->content = file_get_contents($template);

        if ($config['php_return'] === false) {
        }
        //TODO 添加替换功能，需要以下正则(鸡肋)
//        $this->tT[] = "#\{\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\}#";
/*        $this->tR[] = "<?php echo \$this->value['\\1']; ?>";*/
    }

    public function compile()
    {
        //TODO 模版替换功能 (鸡肋)
//        $this->convertToPhp();
        file_put_contents($this->compile, $this->content);
    }

    public function convertToPhp()
    {
        $this->content = preg_replace($this->tT, $this->tR, $this->content);
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }
}