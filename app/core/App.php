<?php
class App
{
  protected $controller='Home';
  protected $method='index';
  protected $param=[];
  public function __construct()
  {
    
    $url= $this->parsingURL();
    if($url==NULL)
    {
      $url=[$this->controller];
    }
    if(file_exists('../app/controllers/'.$url[0].'.php'))
    {
      $this->controller = $url[0];
      
      unset($url[0]);
    }
    
    require '../app/controllers/' . $this->controller . '.php';
    $this->controller = new $this->controller;

    //methods
    if(isset($url[1]) )
    {
      if(method_exists($this->controller, $url[1]))
      {
        $this->method=$url[1];
        unset($url[1]);
      }
    }
    //param kelola
if(!empty($url))
{
  var_dump($url);
}
  }

  //Nge parsing url
  public function parsingURL()
  {
    if(isset($_GET['url']))
    {
      //menghilangkan / akhir
      $url= rtrim($_GET['url'], '/');
      $url= filter_var($url,FILTER_SANITIZE_URL);
      $url=explode('/', $url);
      return $url;
    }
  }
}
