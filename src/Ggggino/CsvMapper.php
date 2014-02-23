<?php 
namespace Ggggino;
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
  }

  /**
  *   Get the csv
  *
  **/
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
  public function getBy($nomeHeader, $cerca){
    $ris = array();
    foreach( $this->csv as $key => $value ){
      if(isset($value[$nomeHeader]) && $value[$nomeHeader] == $cerca){
        $ris[$key] = $value; 
      }
    }
    return $ris;
  }

  /**
  *   Stamp Csv
  *
  */
  public function stampCsv(){
    return $this->csv;
  }

  /**
  *   Select Distinct values for column $nomeHeader
  *
  **/
  public function selDistinctHead($nomeHeader){
    $ris[0] = $this->csv[0];
    foreach( $this->csv as $key => $value ){
      $match = false;
      foreach( $ris as $key2 => $value2 ){
        if($value2[$nomeHeader] == $value[$nomeHeader]){
          $match = true;
        }
      }
      if(!$match){
       $ris[$key] = $value;
      }
    }
    return $ris;
  }
} 
