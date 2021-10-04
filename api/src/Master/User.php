<?php
   namespace STATENAME\Master;

   class User
   {
       function STN($data){
           $retobj = [];
      // var_dump($data);
      // die();
         $statename = isset($data->StateName) ? $data->StateName : null;
         $statecode = isset($data->StateCode) ? $data->StateCode : null;
         $sql ='INSERT INTO cms.statename(statename,statecode) VALUES($1,$2)';

         $db = new \STATENAME\Common\PostgreDB();

         $db->Query($sql,[$statename,$statecode]);
        //  $column = $db->FetchAll();
         $db->DBClose();

         // var_dump($rows);
        //  if (count($column)>0) {

            $retobj=["message" => "sucessfully Done"];
        //  }

           return $retobj;
       }

       function TABLE ($data){
        $retobj = [];
   // var_dump($data);
   // die();

      $sql ='SELECT * from cms.statename ORDER by id ';

      $db = new \STATENAME\Common\PostgreDB();

      $db->Query($sql,[]);
      $row = $db->FetchAll();
      $db->DBClose();

      // var_dump($rows);
      if (count($row)>0) {

         $retobj=["message" => "sucessfully Done"];
      }

        return $row;
    }

    function EDIT($data){
      $retobj = [];
 // var_dump($data);
 // die();
    $statename = isset($data->StateName) ? $data->StateName : null;
    $statecode = isset($data->StateCode) ? $data->StateCode : null;
    $sql ='INSERT INTO cms.statename(statename,statecode) VALUES($1,$2)';

    $db = new \STATENAME\Common\PostgreDB();

    $db->Query($sql,[$statename,$statecode]);
   //  $column = $db->FetchAll();
    $db->DBClose();

    // var_dump($rows);
   //  if (count($column)>0) {

       $retobj=["message" => "sucessfully Done"];
   //  }

      return $retobj;
  }

  function REMOVE($data){
      $retobj = [];
      // var_dump($data);
      // die();

      $id = isset($data->id) ? $data->id : null;
      $sql ='DELETE FROM cms.statename where id=$1';

      $db = new \STATENAME\Common\PostgreDB();


      if ($db->Query($sql,[$id])) {

         $retobj=["message" => "sucessfully Done"];
       }

      //  $column = $db->FetchAll();
      $db->DBClose();

      // var_dump($rows);

      return $retobj;
   }


   }
?>
