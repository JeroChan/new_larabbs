<?php

header("Content-type:text/html;charset=utf-8");
if(isset($_GET['page'])){



    $page = $_GET['page'];

    $url = "http://vip.stock.finance.sina.com.cn/quotes_service/api/json_v2.php/Market_Center.getHQNodeData?page={$page}&num=10&sort=symbol&asc=1&node=gn_rzrq&symbol=&_s_r_a=page";

    $datastr = juhecurl($url);

    echo ($datastr);
    $datastr1 = ext_json_decode($datastr);

    $datarr = json_decode($datastr1,1);

    echo '<br/>';

    echo 'var_dump';

    var_dump($datarr);
}




function ext_json_decode($str, $mode=false){
    if(preg_match('/\w:/', $str)){

        $str = preg_replace('/([a-z][A-Z]+):/is', '"$1":', $str);
    }
    return $str; // json_decode($str, $mode);

}

function juhecurl($url,$params=false,$ispost=0){
    header('Content-Type:text/html; charset=gb_2312');
    $httpInfo = array();
    $ch = curl_init();

    curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
    curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
    curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    if( $ispost )
    {
        curl_setopt( $ch , CURLOPT_POST , true );
        curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
        curl_setopt( $ch , CURLOPT_URL , $url );
    }
    else
    {
        if($params){
            curl_setopt( $ch , CURLOPT_URL , $url.'/'.$params );
        }else{
            curl_setopt( $ch , CURLOPT_URL , $url);
        }
    }
    $response = curl_exec( $ch );
    if ($response === FALSE) {
        return false;
    }
    $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
    $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
    curl_close( $ch );

    return $response;
}

