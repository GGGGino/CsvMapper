<?php 
namespace Ggggino;
class CsvMapper { 

  private $url;
  private $separatore;
  private $header;
  private $csv;

  public function __construct($url, $separatore = ","){
    $this->url = $url;
    $this->separatore = $separatore;
    if(!file_exists($this->url) || !is_readable($this->url))
      return FALSE;
    $this->createCsv();
  }

  /*
  *   Get the csv
  *
  */
  public function createCsv(){
    $this->header = NULL;
    $this->csv = array();
    if (($handle = fopen($this->url, 'r')) !== FALSE)
    {
      while (($row = fgetcsv($handle, 1000, $this->separatore)) !== FALSE)
      {
        if(!$this->header)
          $this->header = $this->trimField($row);
        else
          $this->csv[] = array_combine($this->header, $this->trimField($row));
      }
      fclose($handle);
    }
  }

  /*
  *   Search by the name of the name's header
  *
  */
  public function getBy($nomeHeader, $cerca){
    $ris = array();
    foreach( $this->csv as $key => $value ){
      if(isset($value[$nomeHeader]) && $value[$nomeHeader] == $cerca){
        $ris[$key] = $value; 
      }
    }
    return $ris;
  }

  /*
  *   Print Csv
  *
  */
  public function getCsv(){
    return $this->csv;
  }

  /*
  *  Trim the field when create the csv
  *
  */
  public function trimField($row){
    foreach($row as &$value)
      $value = trim($value);
    return $row;
  }

  /*
  *  Get header
  *  
  */
  public function getHeader(){
    return $this->header;
  }

  /*
  *   Select Distinct values for column $nomeHeader
  *
  */
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

  /*
  *  sortBy($header, $type)
  *  $header = name of the header to sort
  *  $type = type of the sort "ASC" || "DESC"
  *
  */
  public function sortBy($header, $type="ASC"){
    $arrayHeaders = array();
    $sort = $type == "ASC" ? SORT_ASC : SORT_DESC;
    if(!in_array($header, $this->header)){
      echo "Inserire header corretto";
      return;
    }
    foreach($this->csv as $key => $value){
      $arrayHeaders[$key] = $value[$header];
    }
    $csv = $this->csv;
    array_multisort($arrayHeaders,$sort,SORT_STRING,$csv);
    return $csv;
  }
} 
