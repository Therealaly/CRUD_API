<?php
require_once "config.php";
$request_method=$_SERVER["REQUEST_METHOD"];
switch ($request_method) {
   case 'GET':
         if(!empty($_GET["nim"]))
         {
            $id=strval($_GET["nim"]);
            //$mk=strval($_GET["kode_mk"]);
            get_mhs($id); //$mk
         }
         else
         {
            get_mhss();
         }
         break;
   case 'POST':
         if(!empty($_GET["nim"]) && !empty($_GET["kode_mk"]) )
         {
            $id=strval($_GET["nim"]);
            $mk=strval($_GET["kode_mk"]);
            update_nilai($id, $mk);
         }
         else
         {
            insert_nilai();
         }     
         break; 
   case 'DELETE':
          $id=strval($_GET["nim"]);
          $mk=strval($_GET["kode_mk"]);
            delete_nilai($id, $mk);
            break;
   default:
      // Invalid Request Method
         header("HTTP/1.0 405 Method Not Allowed");
         break;
      break;
 }



   function get_mhss()
   {
      global $mysqli;
      $query="SELECT mahasiswa.nim, mahasiswa.nama, mahasiswa.alamat, mahasiswa.tanggal_lahir, matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks, perkuliahan.nilai FROM perkuliahan INNER JOIN mahasiswa ON perkuliahan.nim=mahasiswa.nim INNER JOIN matakuliah ON perkuliahan.kode_mk=matakuliah.kode_mk";
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Get List Mahasiswa Successfully.',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   function get_mhs($id) //$mk
   {
      global $mysqli;
      $query="SELECT mahasiswa.nim, mahasiswa.nama, mahasiswa.alamat, mahasiswa.tanggal_lahir, matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks, perkuliahan.nilai 
      FROM perkuliahan 
      INNER JOIN mahasiswa ON perkuliahan.nim=mahasiswa.nim 
      INNER JOIN matakuliah ON perkuliahan.kode_mk=matakuliah.kode_mk";
      if($id != 0)
      {
         $query.=" WHERE mahasiswa.nim= '$id' "; //AND matakuliah.kode_mk= '$mk'
      }
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Get Nilai Mahasiswa Berdasarkan NIM Successfully.',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
        
   }
 
   function insert_nilai()
         {
            global $mysqli;
            if(!empty($_POST["nim"]) && !empty($_POST["kode_mk"]) && !empty($_POST["nilai"])){
               $data=$_POST;
         }else{
            $data = json_decode(file_get_contents('php://input'), true);
         }

         $arrcheckpost = array('nim' => '','kode_mk' => '', 'nilai' => '');
         $hitung = count(array_intersect_key($data, $arrcheckpost));
         if($hitung == count($arrcheckpost)){
           
               $result = mysqli_query($mysqli, "INSERT INTO perkuliahan SET
               nim = '$data[nim]',
               kode_mk = '$data[kode_mk]',
               nilai = '$data[nilai]'");                
               
               if($result)
               {
                  $response=array(
                     'status' => 1,
                     'message' =>'NIlai Mahasiswa Added Successfully.'
                  );
               }
               else
               {
                  $response=array(
                     'status' => 0,
                     'message' =>'Nilai Addition Failed.'
                  );
               }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Parameter Do Not Match'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }
 
   function update_nilai($id, $mk)
      {
         global $mysqli;
         if(!empty($_POST["nilai"])){
            $data=$_POST;
         }else{
            $data = json_decode(file_get_contents('php://input'), true);
         }

         $arrcheckpost = array('nilai' => '');
         $hitung = count(array_intersect_key($data, $arrcheckpost));
         if($hitung == count($arrcheckpost)){
          
              $result = mysqli_query($mysqli, "UPDATE perkuliahan SET
              nilai = '$data[nilai]'
              WHERE nim='$id' AND kode_mk='$mk'");
          
            if($result)
            {
               $response=array(
                  'status' => 1,
                  'message' =>'Nilai Mahasiswa Updated Successfully.'
               );
            }
            else
            {
               $response=array(
                  'status' => 0,
                  'message' =>'Nilai Updation Failed.'
               );
            }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Parameter Do Not Match'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }
 
   function delete_nilai($id, $mk)
   {
      global $mysqli;
      $query="DELETE FROM `perkuliahan` WHERE nim = '$id' AND kode_mk = '$mk'";
      if(mysqli_query($mysqli, $query))
      {
         $response=array(
            'status' => 1,
            'message' =>'Mahasiswa Deleted Successfully.'
         );
      }
      else
      {
         $response=array(
            'status' => 0,
            'message' =>'Mahasiswa Deletion Failed.'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }

 
?> 
