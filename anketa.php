<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>
<body>
    
    <?php
       
         $anketa = $_GET ['anketa'];
         $checkbox = $_GET ['checkbox'];
         $send = $_GET ['buttonSend'];

        if ($send) {
            if ($anketa) {

                
          if ($checkbox) {
                    $dotaz = "update jedlo set ".$anketa."=".$anketa."+1";
                    $conn = mysqli_connect("localhost:3306", "root", "", "anketa");
                    if(!$conn){
                        die("Connection failed: " . mysqli_connect_error());
                    }

                         if ($_COOKIE['clickedPHP'] == true) {
                        echo "You have already voted";
                    }
                            else {

                                 if($conn->query($dotaz) == true) {
                                  echo "Thanks for voting";

                            $dotaz = "select * from jedla";
                            $conn = mysqli_connect("localhost:3306", "root", "", "anketa");
                            $result = $conn->query($dotaz);
                            if ($result->num_rows > 0) {
                                setcookie("clickedPHP", true);

                                while($row = $result->fetch_assoc()) {
                                    $res = $row["pizza"]+$row["špagety"]+$row["halušky"]+$row["rezeň"]+$row["šalát"];
                                   

                                 $pizza = number_format($row["pizza"]/$res, 3)*100;
                                   
                                    $špagety = number_format($row["špagety"]/$res, 3)*100;
                                    
                                    $halušky = number_format($row["halušky"]/$res, 3)*100;
                                    $rezeň = number_format($row["rezeň"]/$res, 3)*100;
                                    $šalát = number_format($row["šalát"]/$res, 3)*100;
                                    


 echo "<div>
                                    <div>
                                    


                                    <span style='width:100px; display:inline-block'>pizza:</span>
                                    <div class='jedla' style='width:".$pizza."%;height:10px;background:pink;border-radius:5px; display:inline-block'></div> ".$pizza."%
                                    </div>

                                    <div>
                                    <span style='width:100px; display:inline-block'>špagety:</span>
                                    <div class='jedla' style='width:".$špagety."%;height:10px;background:orange; display:inline-block; border-radius:5px'></div> ".$špagety."%
                                    </div>

                                    <div>
                                    <span style='width:100px; display:inline-block'>halušky:</span>
                                    <div class='jedla'style='width".$halušky."%;height:10px;background:white; display:inline-block; border-radius:5px'></div> ".$halušky."%
                                    </div>

                                    <div>
                                    <span style='width:100px; display:inline-block'>rezeň:</span>
                                    <div class='jedla' style='width:".$rezeň."%;height:10px;background:brown; display:inline-block; border-radius:5px'></div> ".$rezeň."%
                                    </div>

                                    <div>
                                    <span style='width:100px; display:inline-block'>šalát:</span>
                                    <div class='jedla' style='width:".$šalát."%;height:10px;background:green; display:inline-block; border-radius:5px'></div> ".$šalát."%
                                    </div>"
                                    ."</div>";
                                }
                            } 
                            else {
                                echo "0 results";
                            }
                        }
                    }
               
                }
                else {
                    echo 'Musite súhlasiť so spracovanim osobných údajov.';
                }
            }
            else {
                echo 'Prosim, vyberte si jednu z možností.';
            }
        }

    ?>
</body>
</html>