<script language="JavaScript">
<!--
function SearchCheckForm(f){
  if(!f.keyword.value){
  alert('검색어를 입력해주세요');
  f.keyword.focus();
  return false;
  }
 }
//-->
</script>
<table>
  <tr>
    <td height="10"></td>
  </tr>
</table>
<table width="884" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="207" align="center"><? getBannerPicture($MainSkin , "Logo1");?></td>
          <td><table width="100%" height="52" border="0" cellpadding="0" cellspacing="0">
              <tr>
              </tr>
              <tr>
                <td align="right" style="padding:0 0 0 0">
                  <? if(!isMember()):?>
                  <a href="./" class="link_white_s" onfocus = "this.blur()">홈</a> | <a href="<?=$CART_MAIN_FILE_NAME;?>" class="link_white_s" onfocus = "this.blur()">장바구니</a>
                  | <a href="<?=$MEMBER_MAIN_FILE_NAME?>?query=wish" class="link_white_s" onfocus = "this.blur()">찜한상품</a>
                  | <a href="<?=$MEMBER_MAIN_FILE_NAME?>?query=login" class="link_white_s" onfocus = "this.blur()">로그인</a>
                  | <a href="<?=$MEMBER_MAIN_FILE_NAME?>?query=accept" class="link_white_s" onfocus = "this.blur()">회원가입</a>
                  | <a href="<?=$MEMBER_MAIN_FILE_NAME?>?query=order" class="link_white_s" onfocus = "this.blur()">주문/배송조회</a>
                  | <a href="<?=$MEMBER_MAIN_FILE_NAME?>?query=passsearch" class="link_white_s" onfocus = "this.blur()">ID/PW찾기</a>
                  <? else :?>
                  <a href="./" class="link_white_s">홈</a> | <a href="<?=$CART_MAIN_FILE_NAME;?>" class="link_white_s" onfocus = "this.blur()">장바구니</a>
                  | <a href="<?=$MEMBER_MAIN_FILE_NAME?>?query=wish" class="link_white_s" onfocus = "this.blur()">찜한상품</a>
                  | <a href="<? echo ${MEMBER_FOLDER_NAME}; ?>/LOG_OUT.php" class="link_white_s" onfocus = "this.blur()">로그아웃</a>
                  | <a href="<?=$MEMBER_MAIN_FILE_NAME?>?query=mypage" class="link_white_s" onfocus = "this.blur()">마이페이지</a>
                  | <a href="<?=$MEMBER_MAIN_FILE_NAME?>?query=order" class="link_white_s" onfocus = "this.blur()">주문/배송조회</a>
                  | <a href="javascript:open_memo('<? echo $SKIN_FOLDER_NAME ; ?>');" class="link_white_s" onfocus = "this.blur()">쪽지(<? echo number_format(getTotalNotReadMemoCnt($_COOKIE[MEMBER_ID]))?>)</a>
                  | <a href="javascript:open_scrap('<? echo $SKIN_FOLDER_NAME ; ?>');" class="link_white_s" onfocus = "this.blur()">스크랩(<? echo number_format(getTotalScrapCnt($_COOKIE[MEMBER_ID] , "BOARD"))?>)</a>
                  <? endif; ?>
                </td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>


	    <form action="<? echo $SEARCH_MAIN_FILE_NAME; ?>" name="SearchCheck" class="form-inline" method = "post" onsubmit='return SearchCheckForm(this);'>
		<input type="hidden" name="Target" value="all">
		<input type="hidden" name="query" value="search">

	    <table width="100%">
        <tr>
            <td align="left" width="200px">
	          <div class="align_left">
		          <input type="text" name="keyword" class="form-control" style="width: 175px"><input type="submit" class="btn btn-danger" style="width: 175px" value="Search">
		      </div>
            </td>
			<td class='sub_menu'>
				<div class="sub_menu_top">
		      <a href="<? echo $MEMBER_MAIN_FILE_NAME; ?>?query=order"> 주문/배송조회</a> |
		      <a href="<? echo $HTML_MAIN_FILE_NAME; ?>?html=inquiry&IID=INQ1"> 상담문의</a> | 
		      <a href="<? echo $BOARD_MAIN_FILE_NAME; ?>?BID=qna&GID=board"> 고객센터</a> |
		      <a href="<? echo $HTML_MAIN_FILE_NAME; ?>?html=guide"> 이용안내</a>
				</div>
			</td>
        </tr>
		</table>
		</form>


      </td>
  </tr>
</table>
