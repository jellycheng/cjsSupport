<?php
namespace CjsSupport;

final class GlobalSingleton
{
    protected static $instance = null;

    //$_SERVER['REQUEST_URI']
    private $requestUri;

    //控制器类名（含命名空间的）
    private $controllerName;

    //控制器类的方法名
    private $controllerMethod;

    //工程项目代码根目录
    private $basePath;

    //用于扩展全局数据，数组格式
    private $extData = [];

    private function __construct()
    {

    }

    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * @return mixed
     */
    public function getRequestUri()
    {
        return $this->requestUri;
    }

    /**
     * @param mixed $requestUri
     */
    public function setRequestUri($requestUri)
    {
        $this->requestUri = $requestUri;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @param mixed $controllerName
     */
    public function setControllerName($controllerName)
    {
        $this->controllerName = $controllerName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getControllerMethod()
    {
        return $this->controllerMethod;
    }

    /**
     * @param mixed $controllerMethod
     */
    public function setControllerMethod($controllerMethod)
    {
        $this->controllerMethod = $controllerMethod;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * @param mixed $basePath
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
        return $this;
    }

    /**
     * @return array
     */
    public function getExtData()
    {
        return $this->extData;
    }

    /**
     * @param array $extData
     */
    public function setExtData($extData)
    {
        $this->extData = $extData;
        return $this;
    }

    /**
     * @param $extData
     * @param string $val
     * @return $this
     */
    public function appendExtData($extData, $val='')
    {
        if(is_array($extData)) {
            $this->extData = array_merge($this->extData, $extData);
        } else {
            $this->extData[$extData] = $val;
        }
        return $this;
    }

    public function __toString() {
        return "requestUri=" . $this->getRequestUri() . ", controllerName=" . $this->getControllerName() .
               ", controllerMethod=" . $this->getControllerMethod() . ", basePath=" . $this->getBasePath() .
               ", extData=" . var_export($this->getExtData(), true);
    }

}