<?php 
$connection = new mysqli("localhost","root","","clinic"); 
		$sqlAllD="SELECT * FROM `derivationrecord`";
        $queryAllD=$connection->query($sqlAllD);
        echo "[";
        $count=0;
        while ($rowAllD=$queryAllD->fetch_object()) {
        	echo "'".$rowAllD->name."'";
        	if($rowAllD->id!=13){
        		echo ",";
        	}else{
        		echo "],";
        	}
        }
       
	echo "
        ['2004/05',  165,      938,         522,             998,           450,      614, 456 ,789 ,641],
         ['2005/06',  135,      1120,        599,             1268,          288,      682, 142 ,412, 963],
         ['2006/07',  157,      1167,        587,             807,           397,      623, 123, 789, 256],
         ['2007/08',  139,      1110,        615,             968,           215,      609, 789 , 652, 963],
         ['2008/11',  136,      691,         629,             1026,          366,      566, 123, 456,789]"	;
?>