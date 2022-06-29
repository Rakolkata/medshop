<?php 
function is_valid($input_val = false, $filter_type = false){
 //Readme first
  // $filter_type = INT,FLOAT, A-Z0-9, A-Z_0-9, NAME, NUMBER, A-Z, _A-Z , 0-9, _0-9
  //----------------------------------------------------------------------
  // "_" for whitespace and "-" for Range 
  //-------------------------------------
  
  if($input_val != false and $filter_type != false){
  
    switch ($filter_type){
      case 'INT': $filter_type = '/^[0-9]*$/i'; break;
      case 'FLOAT': $filter_type = '/^-?\d*[.]?\d*$/'; break;
      case 'A-Z0-9': $filter_type = '/^[a-z0-9]*$/i'; break;
      case 'A-Z_0-9': $filter_type = '/^[ a-z0-9]*$/i'; break;
      case 'NAME': $filter_type = '/^[ a-z0-9]*$/i'; break;
      case 'A-Z': $filter_type = '/^[a-z]*$/i'; break;
      case '_A-Z': $filter_type = '/^[ a-z]*$/i'; break;
      case '0-9': $filter_type = '/^[0-9]*$/'; break;
      case 'NUMBER': $filter_type = '/^[0-9]*$/i'; break;
      case '_0-9': $filter_type = '/^[ 0-9]*$/'; break;
      case '_NUMBER': $filter_type = '/^[ 0-9]*$/i'; break;
    }

    if(preg_match($filter_type,$input_val)){
        return true;
    }else{
        return false;
    }
 
  }
  
}

?>