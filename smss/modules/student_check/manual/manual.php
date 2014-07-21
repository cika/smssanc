<BR><center><FONT SIZE="4" COLOR="#FF0000"><B>คู่มือการใช้งานระบบ</B></FONT></center><BR><BR>

	<link rel="stylesheet" href="./jquery/themes/ui-lightness/jquery.ui.all.css">
	<script src="./jquery/jquery-1.5.1.js"></script>
	<script src="./jquery/external/jquery.bgiframe-2.1.2.js"></script>
	<script src="./jquery/ui/jquery.ui.core.js"></script>
	<script src="./jquery/ui/jquery.ui.widget.js"></script>
	<script src="./jquery/ui/jquery.ui.mouse.js"></script>
	<script src="./jquery/ui/jquery.ui.draggable.js"></script>
	<script src="./jquery/ui/jquery.ui.position.js"></script>
	<script src="./jquery/ui/jquery.ui.resizable.js"></script>
	<script src="./jquery/ui/jquery.ui.dialog.js"></script>

	<script>
	// increase the default animation speed to exaggerate the effect
	$.fx.speeds._default = 300;
	$(function() {
		$( "#dialog" ).dialog({
			height: screen.height-120,
			width: screen.width-40,
			minHeight: screen.height-120,
			minWidth: screen.width-40,
			autoOpen: false,
			show: "blind",
			hide: "explode",
				modal: true,
				resizable: false
		});

		$( "#opener" ).click(function() {
			$( "#dialog" ).dialog( "open" );
			doajax("abouts");
			return false;
		});
		$( "#opener1" ).click(function() {
			$( "#dialog" ).dialog( "open" );
			doajax("setyear");
			return false;
		});
		$( "#opener2" ).click(function() {
			$( "#dialog" ).dialog( "open" );
			doajax("setuser");
			return false;
		});
		$( "#opener3" ).click(function() {
			$( "#dialog" ).dialog( "open" );
			doajax("save");
			return false;
		});
		$( "#opener4" ).click(function() {
			$( "#dialog" ).dialog( "open" );
			doajax("report");
			return false;
		});
	});
	</script>
<script language="javascript" src="./modules/<?php echo $_GET['option']."/";?>ajax.js"></script>  
<script language="javascript">  
function doajax(f){  
    var ajax1=createAjax();   
    ajax1.onreadystatechange=function(){  
        if(ajax1.readyState==4 && ajax1.status==200){  
            var repl=document.getElementById('pdf');  
            repl.innerHTML=ajax1.responseText;  
        }else{  
            return false;  
        }  
    }  
    ajax1.open("GET","./modules/<?php echo $_GET['option']."/manual/";?>data.php?option=student_check&h="+screen.height +"&f="+f,true);  
    ajax1.send(null);  
}  
</script>  
<div id="dialog" title="คู่มือการใช้งาน">
<p id="pdf"></p>
</div>
<TABLE  align=center>
<TR>
	<TD width=35 align=center><img src='./modules/<?php echo $_GET['option']."/";?>images/Tag1.png' border=0 width=32></TD>
	<TD align=left><a id=opener href='#' alt='แนะนำระบบ' title='แนะนำระบบ' ><FONT COLOR='#000'>แนะนำระบบ</FONT></a></TD>
</TR>
<TR>
	<TD width=35 align=center><img src='./modules/<?php echo $_GET['option']."/";?>images/Tag1.png' border=0 width=32></TD>
	<TD align=left><a id=opener1 href='#' alt='การตั้งค่าปีการศึกษา' title='การตั้งค่าปีการศึกษา' ><FONT COLOR='#000'>การตั้งค่าปีการศึกษา</FONT></a></TD>
</TR>
<TR>
	<TD width=35 align=center><img src='./modules/<?php echo $_GET['option']."/";?>images/Tag1.png' border=0 width=32></TD>
	<TD align=left><a id=opener2 href='#' alt='การกำหนดผู้รับผิดชอบ' title='การกำหนดผู้รับผิดชอบ' ><FONT COLOR='#000'>การกำหนดผู้รับผิดชอบ</FONT></a></TD>
</TR>
<TR>
	<TD width=35 align=center><img src='./modules/<?php echo $_GET['option']."/";?>images/Tag1.png' border=0 width=32></TD>
	<TD align=left><a id=opener3 href='#' alt='การบันทึกการมาเรียน' title='การบันทึกการมาเรียน' ><FONT COLOR='#000'>การบันทึกการมาเรียน</FONT></a></TD>
</TR>
<TR>
	<TD width=35 align=center><img src='./modules/<?php echo $_GET['option']."/";?>images/Tag1.png' border=0 width=32></TD>
	<TD align=left><a id=opener4 href='#' alt='การเรียกดูรายงาน' title='การเรียกดูรายงาน' ><FONT COLOR='#000'>การเรียกดูรายงาน</FONT></a></TD>
</TR>
</TABLE>
