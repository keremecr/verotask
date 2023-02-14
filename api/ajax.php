<?php
if(isset($_POST['search']) && !empty($_POST['search'])){
    $search=$_POST['search'];
    $filtretask=[];
    $filtretitle=[];
    $filtredesc=[];
    $filtrecolor=[];
    $curl = curl_init();
    curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.baubuddy.de/index.php/login",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\"username\":\"365\", \"password\":\"1\"}",
      CURLOPT_HTTPHEADER => [
        "Authorization: Basic QVBJX0V4cGxvcmVyOjEyMzQ1NmlzQUxhbWVQYXNz",
        "Content-Type: application/json"
      ],
    ]);

    $response = curl_exec($curl);
    $response=json_decode($response,true);
    $access_token=$response['oauth']['access_token'];
    curl_close($curl);
    $curl1 = curl_init();
    curl_setopt_array($curl1, [
      CURLOPT_URL => "https://api.baubuddy.de/dev/index.php/v1/tasks/select",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_HTTPHEADER => [
       'Authorization: Bearer '.$access_token.''
      ],
    ]);
    $response = curl_exec($curl1);
    $response=json_decode($response,true);
    
    foreach($response as $res){
        $findtask=strripos($res['task'],$search,0);
        $findtitle=strripos($res['title'],$search,0);
        $finddesc=strripos($res['description'],$search,0);
        $findcolor=strripos($res['colorCode'],$search,0);
        if(!empty($findtask) OR !empty($findtitle) OR !empty($finddesc) OR !empty($findcolor)){
            array_push($filtretask,$res['task']);
            array_push($filtretitle,$res['title']);
            array_push($filtredesc,$res['description']);
            array_push($filtrecolor,$res['colorCode']);
        }
    }
   $html='';
    for($i=0;$i<count($filtretask);$i++){
        $html .='<tr>
                                    <td>'.$filtretask[$i].'</td>
                                    <td>'.$filtretitle[$i].'</td>
                                    <td>'.$filtredesc[$i].'</td>
                                    <td style="color:'.$filtrecolor[$i].'">'.$filtrecolor[$i].'</td>
                                </tr>';
    }
    echo $html;
}