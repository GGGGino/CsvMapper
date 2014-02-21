<?php 
class CsvMapper { 

  private $url;
  private $separatore;
  private $csv = array();

  public function __construct($url, $separatore = ","){
    $this->url = $url;
    $this->separatore = $separatore;
    if(!file_exists($this->url) || !is_readable($this->url))
      return FALSE;
    $this->getCsv();
    print_r($this->csv);
  }

  public function getCsv(){
    $header = NULL;
    if (($handle = fopen($this->url, 'r')) !== FALSE)
    {
      while (($row = fgetcsv($handle, 1000, $this->separatore)) !== FALSE)
      {
        if(!$header)
          $header = $row;
        else
          $this->csv[] = array_combine($header, $row);
      }
      fclose($handle);
    }
  }
  /**
  *   Search by the name of the name's header
  *
  **/
  public function getBy($nomeHeader){
    
  }

} 