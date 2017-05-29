<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../content/bootstrap.min.css" rel="stylesheet">
    <link href="../content/ejthemes/default-theme/ej.web.all.min.css" rel="stylesheet" />
    <link href="../content/default.css" rel="stylesheet" />
    <link href="../content/default-responsive.css" rel="stylesheet" />
    <!--[if lt IE 9]>
         <script src="../scripts/jquery-1.11.3.min.js" type="text/javascript"></script>
     <!--<![endif]-->
    <!--[if gte IE 9]><!-->
    <script src="../scripts/jquery-3.1.1.min.js" type="text/javascript"></script>
    <!--<![endif]-->
    <script src="../scripts/ej.web.all.min.js" type="text/javascript"></script>
    <script src="../scripts/properties.js" type="text/javascript"></script>
  </head>
 <body>  
    <div class="content-container-fluid">      
        <div class="row">                
            <div class="cols-sample-area">                                                  
                <div id="container"></div>                                     
            </div>              
        </div>
    </div>  
    <div id="Tooltip" style="display: none;">
        <div id="icon"> 
            <div id="eficon">
            </div>
        </div>
        <div id="value">
            <div>
               <label id="efpercentage">&nbsp;#point.y#
               </label>
               <label id="ef">Efficiency
               </label>
            </div>
        </div>
    </div>
     
  <script type="text/javascript" language="javascript">
    $(function ()
    {
        $("#container").ejChart(
        {
            //Initializing Primary X Axis   
            primaryXAxis:
            {
                range: { min: 2005, max: 2011, interval: 1 },
                title: { text: 'Year' },
                valueType:'category'
            },  
            
            //Initializing Primary Y Axis   
            primaryYAxis:
            {
                labelFormat: "{value}%",
                title: { text: 'Efficiency' },
                range: { min: 25, max: 50, interval: 5 }
            },  
            
            //Initializing Common Properties for all the series
            commonSeriesOptions: 
            {
                type: 'line', enableAnimation: true,
                tooltip:{ visible :true, template:'Tooltip'},
                marker:
                {
                    shape: 'circle',
                    size:
                    {
                        height: 10, width: 10
                    },
                    visible: true
                },
                 border : {width: 2}                             
            },  
            
            //Initializing Series               
            series: 
            [
                {
                points: [{ x: 2005, y: 28 }, { x: 2006, y: 25 },{ x: 2007, y: 26 }, { x: 2008, y: 27 }, 
                         { x: 2009, y: 32 }, { x: 2010, y: 35 }, { x: 2011, y: 30 }],                        
                name: 'India'
                },                      
                {
                points: [{ x: 2005, y: 31 }, { x: 2006, y: 28 },{ x: 2007, y: 30 }, { x: 2008, y: 36 }, 
                         { x: 2009, y: 36 }, { x: 2010, y: 39 }, { x: 2011, y: 37 }],                        
                name: 'Germany'
                },
                {
                points: [{ x: 2005, y: 36 }, { x: 2006, y: 32 },{ x: 2007, y: 34 }, { x: 2008, y: 41 }, 
                         { x: 2009, y: 42 }, { x: 2010, y: 42 }, { x: 2011, y: 43 }],                        
                name: 'England'
                },                  
                {
                points: [{ x: 2005, y: 39 }, { x: 2006, y: 36 },{ x: 2007, y: 40 }, { x: 2008, y: 44 }, 
                         { x: 2009, y: 45 }, { x: 2010, y: 48 }, { x: 2011, y: 46 }],                        
                name: 'France'
                }
            ],
            isResponsive: true,
            load:"loadTheme",
            title :{text: 'Efficiency of oil-fired power production'},
            size: { height: "600" },
            legend: { visible: true}
        });
    });  
  </script>
  <style class="cssStyles">
        label{
        margin-bottom : -25px !important ;
        text-align :center !important;
        }
        .tooltipDivcontainer {
            background-color:#E94649;        
            color: white;
            width:130px;
        }
        #Tooltip >div:first-child {
            float: left;
        }
        #Tooltip #value {
            float: right;
            height: 50px;
            width: 68px;
        }
        #Tooltip #value >div {
            margin: 5px 5px 5px 5px;            
        }
        #Tooltip #efpercentage {
            font-size: 20px;
            font-family: segoe ui;
            padding-left: 2px;
        }
         #Tooltip #ef {
            font-size: 12px;
            font-family: segoe ui;
        }
        #eficon {
            background-image: url("../content/images/chart/eficon.png");
            height: 60px;           
            width: 60px;
            background-repeat: no-repeat;
        }        
  </style>  
 </body>
</html>