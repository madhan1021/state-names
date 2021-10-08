<?php
   namespace STATENAME\Master;

   use STATENAME\Common\PostgreDB;

class User
   {
       function STN($data){
           $retobj = [];
         $statename = (isset($data->StateName)) ? $data->StateName : null;
         $statecode = (isset($data->StateCode)) ? $data->StateCode : null;

         $sql ='INSERT INTO cms.statename(statename,statecode) VALUES($1,$2)';

         $db = new PostgreDB();

         $db->Query($sql,[$statename,$statecode]);

         $db->DBClose();



            $retobj=["message" => "successfully Done"];

           return $retobj;
       }

  /**
   * @throws \Exception
   */
  function TABLE ($data){
        $retobj = [];

      $sql ='SELECT * from cms.statename ORDER by id ';

      $db = new PostgreDB();

      $db->Query($sql,[]);
      $row = $db->FetchAll();
      $db->DBClose();


      if (count($row)>0) {

         $retobj=["message" => "successfully Done"];
      }

        return $row;
    }

    function EDIT($data){
      $retobj = [];

      $statename = isset($data->StateName) ? $data->StateName : null;
      $statecode = isset($data->StateCode) ? $data->StateCode : null;

    $sql ='INSERT INTO cms.statename(statename,statecode) VALUES($1,$2)';

    $db = new PostgreDB();

    $db->Query($sql,[$statename,$statecode]);
   //  $column = $db->FetchAll();
    $db->DBClose();
       $retobj=["message" => "successfully Done"];

      return $retobj;
  }

  function REMOVE($data){
      $retobj = [];

      $id = isset($data->id) ? $data->id : null;
      $sql ='DELETE FROM cms.statename where id=$1';

      $db = new PostgreDB();


      if ($db->Query($sql,[$id])) {

         $retobj=["message" => "successfully Done"];
       }
      $db->DBClose();
      return $retobj;
   }


   }
?>
