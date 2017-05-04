<pre>
    <?php
//    if(isset($this->seatDara['seatNo']))
//    print_r($this->seatDara['seatNo'][0]);
    date_default_timezone_set("Asia/Colombo");
    //echo date('d-m-Y H:i:s');
    ?>
</pre>
<div id="area">
    <div id="print" style="text-align:center; color: #d14"></div>
    <div id="holder">       
        <ul id="place">


            <?php
            //exit();
            Session::init();
            $this->busBooker = new Booker_Model();
            
            $busNo = $this->seatDara['busNo'];
            $noOfSeat = $this->seatDara['noOfSeat'];
            $bus_book_date = $this->seatDara['bus_book_date'];
            $journeyNo = $this->seatDara['journeyNo'];
            $bookSeat = array();
            $bookStatus = array();
            $selecting_s = array();

            if (isset($this->seatDara['seatNo']))
                $selecting_s = $this->seatDara['seatNo'];

            if (isset($this->seatDara['session']))
                if (($this->seatDara['session']) == 1)
                    if ((Session::get('sessionforSelectin_s')) == true)
                        $selecting_s = Session::get('sessionforSelectin_s');


            //print_r($selecting_s); exit();
            //echo $selecting_s;                    
//++++++++++++++++++++++++++++++++++++++++++++++++

            /* call  searchAvailableSeat funtion get Available Seat bookStatus */
            $seat = $this->busBooker->xhrSearchAvailableSeat($busNo, $bus_book_date, $journeyNo);

            foreach ($seat as $key => $value) {
                $bookSeat[$key] = $value['seatNo'];
                $bookStatus[$key] = $value['status'];
            }
            //print_r($seat);    exit();
//                     foreach ($bookSeat as $key => $value) {
//                         echo $value.$bookStatus[$key];
//                     }exit();
            /* call  displayBusSeat funtion display Bus Seat on web page */
            displayBusSeat($noOfSeat, $bookSeat, $bookStatus, $selecting_s);

//++++++++++++++++++++++++++++++++++++++++++++++++ 

            /* funtion is set Seat */

            function displayBusSeat($noOfSeat, $bookSeat, $bookStatus, $selecting_s) {
//                    exit();
                $noOfSeat = $noOfSeat;
                $bookSeat = $bookSeat;
                $bookStatus = $bookStatus;
                $selecting_s = $selecting_s;
                $rows = 5;
                $cols = 13;
                $rows2 = 5;
                $cols2 = 10;
                $rowCssPrefix = 'row-';
                $colCssPrefix = 'col-';
                $seatWidth = 40;
                $seatHeight = 40;
                $seatCss = 'seat';
                $hidingSeatCss = 'hidingSeats';
                $selectedSeatCss = 'selectedSeat';
                $selectingSeatCss = 'selectingSeat';
                $pendingSeatCss = 'pendingSeat';
                $str = array();
                $seatNo;
                $className = '';
                $p;
                $x = 0; //alert(noOfSeat);


                if ($noOfSeat == 49) {
                    for ($i = 0; $i < $cols; $i++) {
                        for ($j = 0; $j < $rows; $j++) {
                            $p = ($i * $rows + $j + 1);
                            if ($p == 3 || $p == 8 || $p == 13 || $p == 18 || $p == 23 || $p == 28 || $p == 33 || $p == 38 || $p == 43 || $p == 48 || $p == 53 || $p == 58 || $p == 4 || $p == 5 || $p == 39 || $p == 40) {
                                $seatNo = null;
                                $className = $seatCss . ' ' . $hidingSeatCss . ' ' . $rowCssPrefix . $i . ' ' . $colCssPrefix . $j;
                            } else {
                                $seatNo = (++$x); //bookSeat=[5,8,9];
                                if ($bookSeat != null) {
                                    //echo $bookSeat; exit();
                                    foreach ($bookSeat as $key => $value) { //echo $bookSeat; exit();
                                        if ($x == $value) {
                                            if ($bookStatus[$key] == 'B')
                                                $className = $seatCss . ' ' . $rowCssPrefix . $i . ' ' . $colCssPrefix . $j . ' ' . $selectedSeatCss;
                                            else if ($bookStatus[$key] == 'P')
                                                $className = $seatCss . ' ' . $rowCssPrefix . $i . ' ' . $colCssPrefix . $j . ' ' . $pendingSeatCss;
                                            if ($selecting_s != null)
                                                foreach ($selecting_s as $key2 => $value2) {
                                                    if ($value2 == $x) { //echo $value2; exit();
                                                        $className = $className . ' ' . $selectingSeatCss;
                                                        break;
                                                    }
                                                }
                                            break;
                                        } else {
                                            $className = $seatCss . ' ' . $rowCssPrefix . $i . ' ' . $colCssPrefix . $j;
                                        }
                                    } //print_r($className); exit();
                                }else{
                                    $className = $seatCss . ' ' . $rowCssPrefix . $i . ' ' . $colCssPrefix . $j;
                                }
                            }
                            echo '<li class="' . $className . '" seatno="' . $seatNo . '" style="top:' . ($j * $seatHeight) . 'px; left:' . ($i * $seatWidth) . 'px"><a title="' . $seatNo . '"> ' . $seatNo . ' </a></li>';
                        }
                    }
                }else if ($noOfSeat == 40) {
                    for ($i = 0; $i < $cols2; $i++) {
                        for ($j = 0; $j < $rows2; $j++) {
                            $p = ($i * $rows2 + $j + 1);
                            if ($p == 3 || $p == 4 || $p == 8 || $p == 13 || $p == 18 || $p == 23 || $p == 28 || $p == 33 || $p == 38 || $p == 43) {
                                $seatNo = null;
                                $className = $seatCss . ' ' . $hidingSeatCss . ' ' . $rowCssPrefix . $i . ' ' . $colCssPrefix . $j;
                            } else {
                                $seatNo = (++$x); //bookSeat=[5,8,9];
                                if ($bookSeat != null) {
                                    //echo $bookSeat; exit();
                                    foreach ($bookSeat as $key => $value) { //echo $bookSeat; exit();
                                        if ($x == $value) {
                                            if ($bookStatus[$key] == 'B')
                                                $className = $seatCss . ' ' . $rowCssPrefix . $i . ' ' . $colCssPrefix . $j . ' ' . $selectedSeatCss;
                                            else if ($bookStatus[$key] == 'P')
                                                $className = $seatCss . ' ' . $rowCssPrefix . $i . ' ' . $colCssPrefix . $j . ' ' . $pendingSeatCss;
                                            if ($selecting_s != null)
                                                foreach ($selecting_s as $key2 => $value2) {
                                                    if ($value2 == $x) { //echo $value2; //exit();
                                                        $className = $className . ' ' . $selectingSeatCss;
                                                        break;
                                                    }
                                                }
                                            break;
                                        } else {
                                            $className = $seatCss . ' ' . $rowCssPrefix . $i . ' ' . $colCssPrefix . $j;
                                        }
                                    } //print_r($className); exit();
                                }else{
                                    $className = $seatCss . ' ' . $rowCssPrefix . $i . ' ' . $colCssPrefix . $j;
                                }
                            }
                            echo '<li class="' . $className . '" seatno="' . $seatNo . '" style="top:' . ($j * $seatHeight) . 'px; left:' . ($i * $seatWidth) . 'px"><a title="' . $seatNo . '"> ' . $seatNo . ' </a></li>';
                        }
                    }
                }
            }
            ?>
        </ul>
    </div>
</div> 