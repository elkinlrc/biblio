<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML>
<HEAD>
<META content="IE=10.000" http-equiv="X-UA-Compatible">
<TITLE>Dynarch Calendar -- Single calendar for multiple fields</TITLE>     
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="js/jscal2.js"></script>
	<script src="js/es.js"></script>

	<LINK href="css/jscal2.css" rel="stylesheet" type="text/css">  
    <LINK href="css/border-radius.css" rel="stylesheet" type="text/css"> 
    <LINK href="css/steel.css" rel="stylesheet" type="text/css"> 
</HEAD>   
<BODY>
<p>A continuación se encuetra el ejemplo para el manejo de calendarios</p>
<INPUT id="f_date1" size="30"><BUTTON id="f_btn1">...</BUTTON><br />
<INPUT id="f_date2" size="30"><BUTTON id="f_btn2">...</BUTTON><br />
<INPUT id="f_date3" size="30"><BUTTON id="f_btn3">...</BUTTON><br />
<INPUT id="f_date4" size="30"><BUTTON id="f_btn4">...</BUTTON><br />     
<INPUT id="f_date5" size="30"><BUTTON id="f_btn5">...</BUTTON>     
<script type="text/javascript">
//<![CDATA[
      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: 12,
		  weekNumbers: true,
		  max: 20130730
      });
      cal.manageFields("f_btn1", "f_date1", "%Y-%m-%d %I:%M %p");
      cal.manageFields("f_btn2", "f_date2", "%b %e, %Y %I:%M %p");
      cal.manageFields("f_btn3", "f_date3", "%e %B %Y %I:%M %p");
      cal.manageFields("f_btn4", "f_date4", "%A, %e %B, %Y %I:%M %p");
      cal.manageFields("f_btn5", "f_date5", "%d/%m/%Y");
    //]]>
</script>
</BODY>
</HTML>