<?php

function responseJson($statue,$message,$data=null){
      $respones=[
        'status'=>$statue,
        'message'=>$message,
        'data'=>$data,
      ];

      return response()->json($respones,200);
}
