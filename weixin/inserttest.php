<?php

			$con = mysqli_connect("rm-bp1e5bfxg58i45dkv.mysql.rds.aliyuncs.com","r65tsd8o72","Jumponline13");
			if ($con)
				{
					$contentStr = $contentStr."\n数据库连接成功！";
				}

			mysqli_query($con,"set names 'utf8'");
			mysqli_select_db($con,"r65tsd8o72");

			mysqli_query($con,"INSERT `LDSF_MSG_RECEIVE`(`OPEN_ID`,`MSG_CONTENT`) VALUES('aaa','hello');");



			$con = mysqli_connect("rm-bp1e5bfxg58i45dkv.mysql.rds.aliyuncs.com","r65tsd8o72","Jumponline13");
			if ($con)
				{
					$contentStr = $contentStr."\n数据库连接成功！";
				}

			mysqli_query($con,"set names 'utf8'");
			mysqli_select_db($con,"r65tsd8o72");

			mysqli_query($con,"INSERT `LDSF_MSG_RECEIVE`(`OPEN_ID`) VALUES('".$fromUsername."');");

?>