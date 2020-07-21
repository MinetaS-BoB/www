<?
include ("./ROOT_CHECK.php");
?>
<iframe id="ifrm" width="100%"  marginheight="0" marginwidth="0" scrolling="no" align="middle" src="./sql/" frameborder="0"></iframe> 
<script>
<!--
function getReSize()// 아이프레임 사이즈 자동 조절
{
       try {
              var objFrame = document.getElementById("ifrm");
              var objBody = ifrm.document.body; 

              ifrmHeight = objBody.scrollHeight + (objBody.offsetHeight - objBody.clientHeight); 
			
              if (ifrmHeight > 1000) { 
                     objFrame.style.height = ifrmHeight; 
              } else {
                     objFrame.style.height = 1000;
              } 
              objFrame.style.width = '99%'
       } catch(e) {
       };
} 
function getRetry()
{
       getReSize(); 
       setTimeout('getRetry()',500);
}
getRetry();
//-->
</script>
