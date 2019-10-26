<?php
function ValidateEmail($email)
{
   $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
   return preg_match($pattern, $email);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['formid']) && $_POST['formid'] == 'form1')
{
   $mailto = 'test@landing4business.ru';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'LEAD!!!';
   $message = '';
   $success_url = './TH-PopUp.php';
   $error_url = '';
   $error = '';
   $eol = "\n";
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;
   if (!ValidateEmail($mailfrom))
   {
      $error .= "The specified email address is invalid!\n<br>";
   }
   if (!empty($error))
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $error, $errorcode);
      echo $errorcode;
      exit;
   }
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $message .= $eol;
   $message .= "IP Address : ";
   $message .= $_SERVER['REMOTE_ADDR'];
   $message .= $eol;
   $logdata = '';
   foreach ($_POST as $key => $value)
   {
      if (!in_array(strtolower($key), $internalfields))
      {
         if (!is_array($value))
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
         }
         else
         {
            $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
         }
      }
   }
   $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
   $body .= '--'.$boundary.$eol;
   $body .= 'Content-Type: text/plain; charset=UTF-8'.$eol;
   $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
   $body .= $eol.stripslashes($message).$eol;
   if (!empty($_FILES))
   {
       foreach ($_FILES as $key => $value)
       {
          if ($_FILES[$key]['error'] == 0)
          {
             $body .= '--'.$boundary.$eol;
             $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
             $body .= 'Content-Transfer-Encoding: base64'.$eol;
             $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
             $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
          }
      }
   }
   $body .= '--'.$boundary.'--'.$eol;
   if ($mailto != '')
   {
      mail($mailto, $subject, $body, $header);
   }
   header('Location: '.$success_url);
   exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Untitled Page</title>
<meta name="generator" content="WYSIWYG Web Builder 14 - http://www.wysiwygwebbuilder.com">
<link href="css/wb.validation.css" rel="stylesheet" type="text/css">
<link href="css/2.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/wb.validation.min.js"></script>
<script type="text/javascript" src="js/wwb14.min.js"></script>
<script type="text/javascript">   
   $(document).ready(function()
   {
      $("#Form1").submit(function(event)
      {
         var isValid = $.validate.form(this);
         return isValid;
      });
      $("#phone").validate(
      {
         required: true,
         type: 'text',
         length_min: '16',
         length_max: '16',
         color_text: '#FFFFFF',
         color_hint: '#FFFFFF',
         color_error: '#FFE507',
         opacity: 0.00,
         color_border: '#FFFFFF',
         nohint: true,
         font_family: 'Arial',
         font_size: '13px',
         position: 'topleft',
         offsetx: 0,
         offsety: 0,
         effect: 'fade',
         error_text: 'Введите верный номер телефона!'
      });
   });
</script>
<link href="http://fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic&subset=latin,cyrillic" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Roboto&subset=latin,cyrillic,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic&subset=latin,cyrillic,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic&subset=latin,cyrillic,cyrillic-ext" rel="stylesheet" type="text/css">
</head>
<body>
   <script>   setTimeout('yaCounterXXXXXXX.reachGoal("TARGET30SEK");', 30000);
   </script><script>   
   $(document).ready(function() {
         $(Form1).keydown(function(event){
           if(event.keyCode == 13) {
             event.preventDefault();
             return false;
         }
      });
   });
   </script>
   <div id="wb_Form1" style="position:absolute;left:0px;top:15px;width:356px;height:282px;z-index:13;">
      <form name="Form1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="Form1">
         <input type="hidden" name="formid" value="form1">
         <input type="hidden" name="Подобрать ипотеку" value="">
         <div id="wb_Text2" style="position:absolute;left:31px;top:240px;width:297px;height:30px;text-align:center;z-index:1;">
            <span style="color:#000000;">Данные используются только для обратной связи, не подлежат обработке.</span></div>
         <div id="wb_Text1" style="position:absolute;left:10px;top:13px;width:342px;height:24px;text-align:center;z-index:2;">
            <span style="color:#51473C;font-family:Lato;font-size:20px;">ПОДОБРАТЬ ИПОТЕКУ</span></div>
         <div id="wb_Shape3" style="position:absolute;left:189px;top:148px;width:140px;height:50px;z-index:3;">
            <a href="./1.php"><img src="images/img0051.png" id="Shape3" alt="" style="width:140px;height:50px;"></a></div>
         <div id="wb_Shape2" style="position:absolute;left:31px;top:148px;width:140px;height:50px;z-index:4;">
            <a href="javascript:history.back()" onclick="ShowObject('wb_Text3', 1);ShowObject('wb_Text4', 0);ShowObject('Layer2', 1);return false;"><img src="images/img0052.png" id="Shape2" alt="" style="width:140px;height:50px;"></a></div>
         <input type="submit" id="Button1" onmouseover="ShowObject('Image6', 0);return false;" onmouseout="ShowObject('Image6', 1);return false;" name="" value="Оставить заявку" class="style1" style="position:absolute;left:189px;top:148px;width:140px;height:56px;z-index:5;">
         <div id="wb_Text4" style="position:absolute;left:30px;top:51px;width:297px;height:23px;visibility:hidden;text-align:center;z-index:6;">
            <span style="color:#000000;font-family:'Lato Light';font-size:19px;">Это точно Ваш телефон?</span></div>
         <div id="wb_Text3" style="position:absolute;left:0px;top:54px;width:356px;height:19px;visibility:hidden;text-align:center;z-index:7;">
            <span style="color:#000000;font-family:'Lato Light';font-size:16px;">Введите верный номер телефона</span></div>
         <div id="Layer2" style="position:absolute;text-align:left;left:14px;top:142px;width:330px;height:68px;z-index:8;">
            <div id="wb_Shape1" style="position:absolute;left:18px;top:3px;width:297px;height:56px;z-index:0;">
               <a href="#" onclick="ShowObject('Layer2', 0);ShowObject('wb_Text4', 1);ShowObject('wb_Text3', 0);return false;"><img src="images/img0053.png" id="Shape1" alt="" style="width:297px;height:56px;"></a></div>
         </div>
         <input type="tel" id="phone" style="position:absolute;left:33px;top:81px;width:282px;height:44px;z-index:9;" name="Tel_" value="" spellcheck="false" placeholder="+7(___) ___-__-__" $.fn.inputmasks="function(maskOpts," mode)="">
         <input type="checkbox" id="Checkbox1" name="Checkbox1" value="on" checked style="position:absolute;left:32px;top:209px;z-index:10;" required>
         <div id="wb_Text5" style="position:absolute;left:58px;top:213px;width:287px;height:13px;z-index:11;" display:="" none="">
            <span style="color:#000000;"><a href="javascript:popupwnd('srubsuvorov.ru_politika.pdf','no','no','no','no','no','no','','0','800','750')" class="style1" target="_self">Согласен(а) с Политикой конфиденциальности.</a></span></div>
      </form>
   </div>
   <script>   
       (function(e){function t(){var e=document.createElement("input"),t="onpaste";return e.setAttribute(t,""),"function"==typeof e[t]?"paste":"input"}var n,a=t()+".mask",r=navigator.userAgent,i=/iphone/i.test(r),o=/android/i.test(r);e.mask={definitions:{9:"[0-9]",0:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},dataName:"rawMaskFn",placeholder:"_"},e.fn.extend({caret:function(e,t){var n;if(0!==this.length&&!this.is(":hidden"))return"number"==typeof e?(t="number"==typeof t?t:e,this.each(function(){this.setSelectionRange?this.setSelectionRange(e,t):this.createTextRange&&(n=this.createTextRange(),n.collapse(!0),n.moveEnd("character",t),n.moveStart("character",e),n.select())})):(this[0].setSelectionRange?(e=this[0].selectionStart,t=this[0].selectionEnd):document.selection&&document.selection.createRange&&(n=document.selection.createRange(),e=0-n.duplicate().moveStart("character",-1e5),t=e+n.text.length),{begin:e,end:t})},unmask:function(){return this.trigger("unmask")},mask:function(t,r){var c,l,s,u,f,h;return!t&&this.length>0?(c=e(this[0]),c.data(e.mask.dataName)()):(r=e.extend({placeholder:e.mask.placeholder,completed:null},r),l=e.mask.definitions,s=[],u=h=t.length,f=null,e.each(t.split(""),function(e,t){"?"==t?(h--,u=e):l[t]?(s.push(RegExp(l[t])),null===f&&(f=s.length-1)):s.push(null)}),this.trigger("unmask").each(function(){function c(e){for(;h>++e&&!s[e];);return e}function d(e){for(;--e>=0&&!s[e];);return e}function m(e,t){var n,a;if(!(0>e)){for(n=e,a=c(t);h>n;n++)if(s[n]){if(!(h>a&&s[n].test(R[a])))break;R[n]=R[a],R[a]=r.placeholder,a=c(a)}b(),x.caret(Math.max(f,e))}}function p(e){var t,n,a,i;for(t=e,n=r.placeholder;h>t;t++)if(s[t]){if(a=c(t),i=R[t],R[t]=n,!(h>a&&s[a].test(i)))break;n=i}}function g(e){var t,n,a,r=e.which;8===r||46===r||i&&127===r?(t=x.caret(),n=t.begin,a=t.end,0===a-n&&(n=46!==r?d(n):a=c(n-1),a=46===r?c(a):a),k(n,a),m(n,a-1),e.preventDefault()):27==r&&(x.val(S),x.caret(0,y()),e.preventDefault())}function v(t){var n,a,i,l=t.which,u=x.caret();t.ctrlKey||t.altKey||t.metaKey||32>l||l&&(0!==u.end-u.begin&&(k(u.begin,u.end),m(u.begin,u.end-1)),n=c(u.begin-1),h>n&&(a=String.fromCharCode(l),s[n].test(a)&&(p(n),R[n]=a,b(),i=c(n),o?setTimeout(e.proxy(e.fn.caret,x,i),0):x.caret(i),r.completed&&i>=h&&r.completed.call(x))),t.preventDefault())}function k(e,t){var n;for(n=e;t>n&&h>n;n++)s[n]&&(R[n]=r.placeholder)}function b(){x.val(R.join(""))}function y(e){var t,n,a=x.val(),i=-1;for(t=0,pos=0;h>t;t++)if(s[t]){for(R[t]=r.placeholder;pos++<a.length;)if(n=a.charAt(pos-1),s[t].test(n)){R[t]=n,i=t;break}if(pos>a.length)break}else R[t]===a.charAt(pos)&&t!==u&&(pos++,i=t);return e?b():u>i+1?(x.val(""),k(0,h)):(b(),x.val(x.val().substring(0,i+1))),u?t:f}var x=e(this),R=e.map(t.split(""),function(e){return"?"!=e?l[e]?r.placeholder:e:void 0}),S=x.val();x.data(e.mask.dataName,function(){return e.map(R,function(e,t){return s[t]&&e!=r.placeholder?e:null}).join("")}),x.attr("readonly")||x.one("unmask",function(){x.unbind(".mask").removeData(e.mask.dataName)}).bind("focus.mask",function(){clearTimeout(n);var e;S=x.val(),e=y(),n=setTimeout(function(){b(),e==t.length?x.caret(0,e):x.caret(e)},10)}).bind("blur.mask",function(){y(),x.val()!=S&&x.change()}).bind("keydown.mask",g).bind("keypress.mask",v).bind(a,function(){setTimeout(function(){var e=y(!0);x.caret(e),r.completed&&e==x.val().length&&r.completed.call(x)},0)}),y()}))}})})(jQuery);
   </script>
   <script>   
       $(function(){
           //тут поставить нужный номер поля ввода, если несколько полей, то под друг другом
           $("#phone").mask("+7?(999)999-99-99");
   
       })
   </script></body>
</html>