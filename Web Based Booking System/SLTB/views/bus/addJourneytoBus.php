<div class="main-button">
    <button class="btn"><a href="<?php echo URL; ?>bus"><img class="table-button"/></a></button>
</div>

<div class="">
    <div id="bodyhead"><h1>Add Journey for Bus</h1></div><br/>
    <label>
        <?php
        $url = explode('/', $_GET['url']);
        if (isset($url[3])) {
            if ($url[3] == 'false')
                echo '<P style="color:red;">Only two allow</p>';
        }
        ?>
    </label>
    <?php
    //print_r($this->searchAllBus)
    ?>
    <?php
    ?>
    <div id="tSize">
        <div class="tSizeS">
            <div class="demo_jui">
                <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
                    <thead>
                        <tr>
                            <th>Bus No</th>
                            <th>Journey No</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Bus No</th>
                            <th>Journey Point</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        if (isset($this->searchJourneyforBus)) {
//                        print_r($this->searchEntryPointForJourney);
                            foreach ($this->searchJourneyforBus as $key => $value) {
                                echo '<tr>';
                                echo '<td>' . $value['busNo'] . '</td>';
                                echo '<td>' . $value['journeyNo'] . '</td>';
                                echo '<td>
                            <a href="' . URL . 'bus/deleteJourneyforBus/' . $value['journey_for_bus_No'] . '/' . $value['busNo'] . '"><img class="table-delete-button" alt="Delete"/></a>
                        </td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="spacer"></div>
        <div class="tFotm">
            <form id="EntryPointForJourney_create_form" action="<?php echo URL; ?>bus/addJourneyforBus/" method="post">
                <label for="journey" class="required">Journey Number</label>

                <?php
                $url = explode('/', $_GET['url']);
                if (isset($url[2])) {
                    echo '<input type="hidden" name="busNo" value="' . $url[2] . '"><br/>';
                }
                ?>
                <?php
                if (isset($this->searchAllJourney)) {
                    foreach ($this->searchAllJourney as $key => $value) {
                        echo '<label></label>';
                        echo '<input type="radio" name="journeyNo" id="journeyNoRedioBtn" value="' . $value['journeyNo'] . '"/>' . ' ' . $value['journeyNo'] . '<br/>';
                    }
                }
                ?>

                <label ></label>
                <input type="submit" name="addJourney" id="" value="Add Data">
            </form>
        </div>
    </div>
</div>