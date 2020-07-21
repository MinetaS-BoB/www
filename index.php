<?php




print <<< HTML



<!DOCTYPE html>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Hello, BoB</title>
    <link href="/shop/js/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bob.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
      <div class="page-header">
        <h1 class="center">Hello, BoB</h1>
      </div>
      
      <p class="bg-primary title">유의사항</p>
      <ul>
	  	<li>공격행위는 모두가 보고 있음</li>
	  	<li>타인이 문제를 풀 수 없도록 파일 변조 금지(데이터 추가는 가능)</li>
	  	<li>자신이 생각했을때 취약점이라고 생각하는 부분들을 모두 보고서로 정리</li>
	  	<li>모의해킹 대상은 하단 홈페이지</li>
	  </ul>
	  <br /><br />
	  
	  <p class="bg-primary title">보고서 작성 안내</p>
      <ul>
      	<li>자유양식, 이메일로 제출</a></li>
      	<li>보고서 첫장에 발견한 취약점들을 요약 정리</a></li>
      	<li>보고서 두번째장 이후부터 단계별 풀이/공격 과정을 화면 스냅샷과 공격코드 등을 이용하여 짧게 설명</a></li>
	  	<li>풀이/공격을 위해 작성/사용한 코드는 파일 형태로 같이 첨부</li>
	  </ul>
	  <br /><br />
      
      
      <p class="bg-primary title">모의해킹 대상 홈페이지</p>
      <div class="center">
      <button type="button" class="btn btn-warning btn-lg"><a href="/shop" target="_blank">밥마트</a></button>
	  <button type="button" class="btn btn-success btn-lg"><a href="/webhard" target="_blank">밥하드</a></button>
	  <button type="button" class="btn btn-danger btn-lg"><a href="/chat" target="_blank">밥채팅</a></button>
	  </div>
	  

    </div>
    
    
    
    
    <br /><br />


  </body>
</html>



HTML;

?>
