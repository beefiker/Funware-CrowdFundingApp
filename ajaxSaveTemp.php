<?php
try{
  require 'dbInfo.php';
  include 'isSession.php';

  function MakeCookie($param, $cookieName){
    if($param != ""){
        setcookie($cookieName, $param, time()+60*60*2);
    }
  }
  

  if(count($_REQUEST) > 0){

    // 프로젝트명
    $pName = $_REQUEST["pName"];
    // 목표 펀딩금액
    $donateLimit = $_REQUEST["donateLimit"]; 
    // 펀딩 기간
    $dateLimit = $_REQUEST["dateLimit"]; 
    // 게임 스토리라인
    $storyline = $_REQUEST["storyline"]; 
    // 게임 플롯
    $summary = $_REQUEST["summary"]; 
    // 은행
    $etpBank = $_REQUEST["etpBank"]; 
    // 계좌번호 앞 자리
    $etpAccount1 = $_REQUEST["etpAccount1"]; 
    // 계좌번호 뒷 자리
    $etpAccount2 = $_REQUEST["etpAccount2"];
    // 주당가격
    $etpPerValue = $_REQUEST["etpPerValue"]; 
    // 프로젝트 카테고리
    $pCategory = $_REQUEST["pCategory"]; 
    // 트레일러 링크
    $trailer = $_REQUEST["trailer"];
    // 기업 이름
    $etpName = $_REQUEST["etpName"]; 
    // 기업 설명
    $etpDesc = $_REQUEST["etpDesc"]; 
    // 기업 URL
    $etpURL = $_REQUEST["etpURL"]; 
    // 기업 가치
    $etpValue = $_REQUEST["etpValue"];
    
    // 쿠키 생성
    MakeCookie($pName, "pName");
    MakeCookie($donateLimit, "donateLimit");
    MakeCookie($dateLimit, "dateLimit");
    MakeCookie($storyline, "storyline");
    MakeCookie($summary, "summary");
    MakeCookie($etpBank, "etpBank");
    MakeCookie($etpAccount1, "etpAccount1");
    MakeCookie($etpAccount2, "etpAccount2");
    MakeCookie($etpPerValue, "etpPerValue");
    MakeCookie($pCategory, "pCategory");
    MakeCookie($trailer, "trailer");
    MakeCookie($etpName, "etpName");
    MakeCookie($etpDesc, "etpDesc");
    MakeCookie($etpURL, "etpURL");
    MakeCookie($etpValue, "etpValue");

    // 기준쿠키
    setcookie("isCookie", true, time()+60*60*2);

    $result['msg'] = '파일은 임시저장되지 않습니다.';

  }else{
      // echo 'bye';
      $result['msg'] = '임시저장에 실패했습니다.';
  }
  
//   setcookie();

}catch(Exception $e){
    echo $e;
    $result['msg'] = '죄송합니다. 서버 오류입니다.';
}finally{
    echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}
?>