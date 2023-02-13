<?php
session_start();
require "../barcode/vendor/autoload.php";
$Bar = new Picqer\Barcode\BarcodeGeneratorPNG();
//$code = $Bar->getBarcode($_GET['text'], $Bar::TYPE_CODE_39);
$path="../config.php";
include_once($path);
if($_SESSION['admin_type']!='admin')
{
 header("Location:../registered_list.php");
}
$uid=base64_decode('test123');
if($_POST["metric"])
{
    
$result=mysqli_query($conn,"update certificate_print_setup set metric='".$_POST["metric"]."',top='".$_POST["top"]."',bottom='".$_POST["bottom"]."',left_indent='".$_POST["left"]."',font='".$_POST["font"]."',paper_size='".$_POST["paper_size"]."',img_type='".$_POST["img_type"]."',orientation='".$_POST["orientation"]."' where id=1");

?>
<script>
location.href="../search.php";
    
</script>
<?php
exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generate Bar Code</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <style>
        body, html {
            height: 100%;
        }
        #qrbox>div {
            margin: auto;
        }
        #qrbox{
            text-align:auto;
            width: 5cm;
        }
        .disp{
                position: relative;
                display: flex;
                height: 30px;
        }
        .title{
            padding-right:10px;
        }
        .font{
            font-size:24px;
            display: block;
            margin-bottom: -10px;
            
        }
        .text1 {
            
        }
        .text2 {
            
        }
        @page{
            margin:0;
        }
        @media print {

        html, body {
           /* margin-top:-40px;*/
            width: auto;
            height: auto;

          }
          .non_printable{
              display:none;
          }
        }
        footer{
            display:none;
                bottom: 0;
                    position: absolute;
                    background-color: #2d7eab;
                    width: 100%;
                    text-align: center;
                    padding: 10px;
                    font-size: 24px;
                    font-weight: 700;
                    color: ghostwhite;
        }
    </style>
</head>
<body class="bg">
    <div class="container non_printable" style="width:60%">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-heading" style="text-align: center;padding: 10px;font-size: 40px;">
                    Metrics
                </div>
            </div>


        </div>

        <?php
        $sqry_setup=mysqli_query($conn,"select * from certificate_print_setup where id=1");
$fetch_setup=mysqli_fetch_assoc($sqry_setup);
?>
                    <form method="post" action="" novalidate>
        <div class="row" >

            <div class="col-md-3 disp">
                    <span class="title"> Metric:</span>
                    <select  name="metric" />
                        <option value="cm" <?php if($fetch_setup['metric']=='cm') echo 'selected';?>>cm</option>
                        <option value="mm" <?php if($fetch_setup['metric']=='mm') echo 'selected';?>>mm</option>
                        <option value="px" <?php if($fetch_setup['metric']=='px') echo 'selected';?>>px</option>
                    </select>
            </div>
            <div class="col-md-3 disp">
                    <span class="title">Orientation:</span>
                    <select  name="orientation" />
                        <option value="portrait" <?php if($fetch_setup['orientation']=='portrait') echo 'selected';?>>portrait</option>
                        <option value="landscape" <?php if($fetch_setup['orientation']=='landscape') echo 'selected';?>>landscape</option>
                    </select>
            </div>             
            <div class="col-md-3 disp">
                    <span class="title">Left:</span>
                    <input type="number" name="left" style="width: 70%;" value="<?php echo $fetch_setup['left_indent'];?>" />
            </div>            
            <div class="col-md-3 disp">
                    <span class="title">Top:</span>
                    <input type="number" name="top" style="width: 70%;" value="<?php echo $fetch_setup['top'];?>" />
            </div>
            <div class="col-md-3 disp">
                    <span class="title">Bottom:</span>
                    <input type="number" name="bottom" style="width: 70%;" value="<?php echo $fetch_setup['bottom'];?>" />
            </div>
             <div class="col-md-3 disp">
                    <span class="title">Font:</span>
                    <input type="number" name="font" style="width: 70%;" value="24" value="<?php echo $fetch_setup['font'];?>" />
            </div>
        </div>


         <div class="row" style="margin-top: 20px;">
            <div class="col-md-4 disp">
                    <span class="title"> Paper-Size:</span>
                    <select  name="paper_size" />
                        <option value="A3" <?php if($fetch_setup['paper_size']=='A3') echo 'selected';?>>A3</option><option value="A3 Landscape" <?php if($fetch_setup['paper_size']=='A3 Landscape') echo 'selected';?>>A3 Landscape</option>
                        <option value="A4" <?php if($fetch_setup['paper_size']=='A4') echo 'selected';?>>A4</option><option value="A4 Landscape" <?php if($fetch_setup['paper_size']=='A4 Landscape') echo 'selected';?>>A4 Landscape</option>
                        <option value="A5" <?php if($fetch_setup['paper_size']=='A5') echo 'selected';?>>A5</option><option value="A5 Landscape">A5 Landscape</option>
                    </select>
            </div>
            <div class="col-md-4 disp">
                    <span class="title"> Image Type:</span>
                    <select  name="img_type" />
                        <option value="qr" <?php if($fetch_setup['paper_size']=='qr') echo 'selected';?>>QR Code</option>
                        <option value="image" <?php if($fetch_setup['paper_size']=='image') echo 'selected';?>>Image</option>
                        
                        <option value="Both" <?php if($fetch_setup['paper_size']=='Both') echo 'selected';?>>Both</option>

                    </select>
            </div>
             <div class="col-md-4 disp" style="float:right">
                    <button name="configure" type="submit" >Configure</button>
            </div>

        </div>
        </form>
    </div>
    <div class="container" id="panel">
        <span class="non_printable"><br><br><br></span>
        <div class="row" id="badge">
            <div class="col-md-6 offset-md-3 qrContainer" style="background: white; padding: 20px; box-shadow: 0px 1px 5px #888888;
                <?php
                    if($fetch_setup['orientation'] == 'landscape'){
                        ?>
                        transform: rotate(90deg);                        
                <?php
                    }
                ?>
            ">
                <div id="top">

                </div>
                <div id="qrbox" data-numSpans="1">
                    <span class="font text1"><b>Title. Name</b></span>
                    <?php
                    // echo '<img src="data:image/png;base64,' . base64_encode($Bar->getBarcode($uid, $Bar::TYPE_CODE_128)) . '">';
                    ?>
                </div>
                <div id="bottom">

                </div>
            </div>
        </div>
    </div>


        <footer><p>Print Setup Completed!</p></footer>
<script>
jQuery.fn.rotate = function(degrees) {
    $(this).css({'-webkit-transform' : 'rotate('+ degrees +'deg)',
                 '-moz-transform' : 'rotate('+ degrees +'deg)',
                 '-ms-transform' : 'rotate('+ degrees +'deg)',
                 'transform' : 'rotate('+ degrees +'deg)'});
};

var o=(function(){
  var o={
    init:function(){
        this.doc=$(document);
        this.top=$("#top");
        this.bottom=$("#bottom");
        this.left=$("#qrbox");
        this.input_top=$("input[name='top']");
        this.input_btm=$("input[name='bottom']");
        this.input_left=$("input[name='left']");
        this.input_font=$("input[name='font']");
        this.metric=$("select[name='metric']");
        this.Ometric=$("select[name='orientation']");
        this.metric_val=$("select[name='metric']").find("option:Selected").val();
        this.Ometric_val=$("select[name='orientation']").find("option:Selected").val();
        this.paper=$("select[name='paper_size']");
        this.paper_val=$("select[name='paper_size']").find("option:Selected").val();
    }
};
o.init();
console.log(o);
return o;
})();

var pages = (function() {
    var style = document.createElement('style');
    document.head.appendChild(style);
    return function (rule) {
        style.innerHTML = rule;
    };
}());

pages.size = function (size) {
    pages('@page {size: ' + size + '}');
};

  o.paper.on("change",function(){
     pages.size($(this).val());
     o.paper_val=$(this).val();
  });


  o.metric.on("change",function(){
     o.top.css("margin-top",0);
     o.bottom.css("margin-top",0);
     $("input").each(function(){
        $(this).val(0);
     });
     o.metric_val=$(this).val();

  });

  o.Ometric.on("change",function(){
     if($(this).val() == 'landscape'){
        $(".qrContainer").rotate(90);
     } else {
         $(".qrContainer").rotate(0);
     }

     o.top.css("margin-top",0);
     o.bottom.css("margin-top",0);
     o.Ometric_val=$(this).val();

  });




  o.input_top.on("input",function(){
     var temp=$(this).val()+o.metric_val;
     o.top.css("margin-top",temp);

  });
  o.input_left.on("input",function(){
     var temp=$(this).val()+o.metric_val;
     o.left.css("margin-left",temp);

  });
  o.input_btm.on("input",function(){
     var temp=$(this).val()+o.metric_val;
     o.bottom.css("margin-top",temp);

  });
  o.input_font.on("input",function(){
      $(".font").css("font-size",$(this).val()+"px");
  });
</script>
</body>
</html>
