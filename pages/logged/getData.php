<?php 

$connection = new mysqli("localhost","root","","clinic"); 
		$sqlAllD="SELECT * FROM `derivations` where derivation_type_id=$derivationTypeId";
        $queryAllD=$connection->query($sqlAllD);
        $queryAllDL=$connection->query($sqlAllD);
        $last=0;
        $array=array();
        while ($queryAllDL->fetch_object()) {
        	$last++;

        }
        echo "['asd',";
        $count=0;
        while ($rowAllD=$queryAllD->fetch_object()) {
        	$sqlDR="SELECT * FROM `derivationrecord` where  DerivationId=$rowAllD->id";
        	$queryDR=$connection->query($sqlDR);
        	$countDR=0;
			while ($rowDR=$queryDR->fetch_object()) {
					$countDR++;
        	        }
        	        array_push($array, $countDR);
        	echo "'".$rowAllD->name."'";
        	if($count==$last-1){
        		echo "],";
        	}else{
        		echo ",";
        	}
        	$count++;
        }
        echo "['2017/05',";
        for($i=0;$i<count($array);$i++){
        	echo $array[$i];
        	if($i==count($array)-1){
        		echo "],";
        	}else{
        		echo ",";
        	}
        }


  	/*echo "['2017/06',691,629,456],";*/
?>
<?php 

       
	/*echo " ['Month', 'Bolivia', 'Ecuador', 'Madagascar', 'Papua New Guinea', 'Rwanda', 'Average'],
         ['2004/05',  165,      938,         522,             998,           450,      614.6],
         ['2005/06',  135,      1120,        599,             1268,          288,      682],
         ['2006/07',  157,      1167,        587,             807,           397,      623],
         ['2007/08',  139,      1110,        615,             968,           215,      609.4],
         ['2008/09',  136,      691,         629,             1026,          366,      569.6]";
*/?>