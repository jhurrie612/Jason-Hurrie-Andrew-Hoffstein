<?php
include 'top.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
        
$importantPositions = array('CooperKupp', 'TomBrady', 'JonathanTaylor', 'Biomass');

$dataIsGood = false;

$firstName = '';
$lastName = '';
$email = '';
$importantPosition = 'Biomass';
$reason = '';
$draft = 'Quarterback';
$CooperKupp= false;
$JonathanTaylor= false;
$TomBrady = false;
$other = false;

function getData($field){
    if (!isset($_POST[$field])) {
        $data = "";
    } else {
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data);
    }
    return $data;
}

function verifyAlphaNum($testString) {
    // Check for letters, numbers and dash, period, space and single quote only.
    // added & ; and # as a single quote sanitized with html entities will have 
    // this in it bob's will be come bob's
    return (preg_match ("/^([[:alnum:]]|-|\.| |\'|&|;|#)+$/", $testString));
}


?>
    <main>
    <h1>Most Important Fantasy Football Position</h1>
        <section class="form-info">
            <h4>Thank You!</h4>
            <figure class="rounded">
                <img class="rounded" alt="thanks" src="images/thanks.jpg">
                <figcaption><cite><a href=https://t3.ftcdn.net/jpg/02/91/52/22/360_F_291522205_XkrmS421FjSGTMRdTrqFZPxDY19VxpmL.jpg target="_blank">Thank you for your submission.</a></cite></figcaption>
            </figure>
            <?php
            if($_SERVER["REQUEST_METHOD"] == 'POST'){

                // Sanitize data
                $firstName = getData('txtfirstName');
                $lastName = getData('txtlastName');
                $email = getData('txtemail');
                $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                $importantPosition = getData('lstimportantPosition');
                $reason = getData('txtreason');
                $draft= getData('raddraft');
                $CooperKupp= (int) getData('chkCooperKupp');
                $JonathanTaylor= (int) getData('chkJonathanTaylor');
                $TomBrady = (int) getData('chkTomBrady');
                $other = (int) getData('chkother');

                // validate form
                $dataIsGood = true;

                if($firstName == ''){
                    print '<p class="mistake">Please type in your first name.</p>';
                    $dataIsGood = false;
                } elseif(!verifyAlphaNum($firstName)){
                    print '<p class="mistake">Your first name contains invalid characters.</p>';
                    $dataIsGood = false;
                }
                
                if($lastName == ''){
                    print '<p class="mistake">Please type in your last name.</p>';
                    $dataIsGood = false;
                } elseif(!verifyAlphaNum($lastName)){
                    print '<p class="mistake">Your last name contains invalid characters.</p>';
                    $dataIsGood = false;
                }

                if($email == ''){
                    print '<p class="mistake">Please type in your email.</p>';
                    $dataIsGood = false;
                } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    print '<p class="mistake">Your email contains invalid characters.</p>';
                    $dataIsGood = false;
                }

                
                if($importantPosition == ''){
                    print '<p class="mistake">Please choose a favorite position.</p>';
                    $dataIsGood = false;
                } elseif(!in_array($importantPosition, $importantPositions)){
                    print '<p class="mistake">Please choose a favorite position.</p>';
                    $dataIsGood = false;
                }
                
                
                if($reason == ''){
                    print '<p class="mistake">Please tell us why you chose this position.</p>';
                    $dataIsGood = false;
                } elseif(!verifyAlphaNum($reason)){
                    print '<p class="mistake">Your input contains invalid characters, please just use letters.</p>';
                    $dataIsGood = false;
                }
                
                if($draft != 'Quarterback' AND $draft != "RunningBack" 
                AND $draft != "WideReceiver") { 
                    print '<p class="mistake">Please tell us your thoughts on these positions.</p>';
                    $dataIsGood = false;
                }

                $totalChecked = 0;

                if($CooperKupp != 1) $CooperKupp = 0;
                $totalChecked += $CooperKupp;

                if($JonathanTaylor != 1) $JonathanTaylor = 0;
                $totalChecked += $JonathanTaylor;

                if($TomBrady != 1) $TomBrady = 0;
                $totalChecked += $TomBrady;

                if($other != 1) $other = 0;
                $totalChecked += $other;

                if($totalChecked == 0){
                    print '<p class="mistake">Please choose at least one checkbox.</p>';
                    $dataIsGood = false;
                }
                //save data
                if($dataIsGood){
                    try{
                        $sql = ' INSERT INTO tblImportantPosition
                        (fldfirstName, fldlastName, fldemail, 
                        fldimportantPosition, fldreason, fldradio, 
                        fldCooperKupp, fldJonathanTaylor, fldTomBrady, fldother)
                    VALUES
                        (?, ?, ?, ?, ?,?, ?, ?, ?, ?)';
                        $statement= $pdo->prepare($sql);
                        $data = array($firstName, $lastName, $email, $importantPosition, 
                        $reason, $draft, $CooperKupp, $JonathanTaylor, $TomBrady, $other,);

                        if($statement->execute($data)){
                            print '<h2>Thank you</h2>';
                            print '<p>Record is succesfully saved!</p>';
                        } else{
                            print '<p>Record is NOT succesfully saved!</p>';
                        }

                    } catch(PDOException $e){
                        print '<p>Couldn\t insert the record, please contact someone</p>';
                    }
                } // data is good
            } // end submitting form
            ?>
        </section>

        <section class="form-feedback">
            <h2>Results from the survey will show here.</h2>
            <?php
            print '<p>Post Array:</p><pre>';
            print_r($_POST);
            print '</pre>';
            ?>
            <h2>Thank you</h2>
        </section>

        <section class="form-it-self">
            <h2>We Need Your Help!</h2>
            <p>We want to find out what NFL position you think is the most important when you are playing fantasy football.</p>

            <h2>Survey Here</h2>
            <form action="#" id="frmfavRenewable" method="POST" class="center">
                <fieldset>
                    <legend>Contact Information</legend>
                    <p>
                        <label class="required" for="txtfirstName">First Name:</label>
                        <input type="text" name="txtfirstName" id="txtfirstName" value="<?php print $firstName; ?>" required>
                    </p>
                    <p>
                        <label class="required" for="txtlastName">Last Name:</label>
                        <input type="text" name="txtlastName" id="txtlastName" value="<?php print $lastName; ?>" required>
                    </p>
                    <p>
                        <label class="required" for="txtemail">Email Address:</label>
                        <input type="email" name="txtemail" id="txtemail" value="<?php print $email; ?>" required>
                    </p>
                </fieldset>
                <fieldset class="listbox">
                    <legend>Most Important Position</legend>
                    <p>
                        <select id="lstimportantPosition" name="lstimportantPosition" tabindex="120">
                            <option value="Quarterback" <?php 
                            if($importantPosition == "Quarterback") print 'selected';?>>Quarterback</option>

                            <option value="Running Back" <?php 
                            if($importantPosition == "Running Back") print 'selected';?>>Running Back</option>

                            <option value="Wide Receiver" <?php 
                            if($importantPosition == "Wide Receiver") print 'selected';?>>Wide Receiver</option>

                            <option value="Other" <?php 
                            if($importantPosition == "Other") print 'selected';?>>Other</option>

                        </select>
                    </p>
                </fieldset>

                <fieldset class="textarea">
                    <p>
                        <label for="txtreason">Tell us why this is the most important fantasy football position?</label>
                        <textarea id="txtreason" name="txtreason" tabindex="200">
                        <?php print $reason;?></textarea>
                    </p>
                </fieldset>

                <fieldset class="radio">
                    <legend>Which of these positions would you draft first this season?</legend>
                    <p>
                        <input type="radio" id="raddraftQuarterback" name="raddraft" value="Quarterback" tabindex="410" 
                        required <?php 
                            if($draft == "Quarterback") print 'checked';?>>
                        <label for="raddraftQuarterback">Quarterback</label>
                    </p>

                    <p>
                        <input type="radio" id="raddraftRunningBack" name="raddraft" value="RunningBack" tabindex="410" 
                        required <?php 
                            if($draft == "RunningBack") print 'checked';?>>
                        <label for="raddraftRunningBack">Running Back</label>
                    </p>

                    <p>
                        <input type="radio" id="raddraftWideReceiver" name="raddraft" value="WideReceiver" tabindex="410" 
                        required <?php 
                            if($draft == "WideReceiver") print 'checked';?>>
                        <label for="raddraftWideReceiver">Wide Receiver</label>
                    </p>
                </fieldset>

                <fieldset class="checkbox">
                    <legend>Check all those that you believe have the chance to score the most fantasy football points this season.</legend>
                    <p>
                        <input id="chkCooperKupp" name="chkCooperKupp" tabindex="510" type="checkbox" value="1" <?php 
                            if($CooperKupp) print 'checked';?>>
                        <label for="chkCooperKupp">Cooper Kupp</label>
                    </p>

                    <p>
                        <input id="chkJonathanTaylor" name="chkJonathanTaylor" tabindex="510" type="checkbox" value="1" <?php 
                            if($JonathanTaylor) print 'checked';?>>
                        <label for="chkJonathanTaylor">Jonathan Taylor</label>
                    </p>

                    <p>
                        <input id="chkTomBrady" name="chkTomBrady" tabindex="510" type="checkbox" value="1" <?php 
                            if($TomBrady) print 'checked';?>>
                        <label for="chkTomBrady">Tom Brady</label>
                    </p>
                    <p>
                        <input id="chkother" name="chkother" tabindex="510" type="checkbox" value="1" <?php 
                            if($other) print 'checked';?>>
                        <label for="chkother">Other</label>
                    </p>
                </fieldset>

                <fieldset class="buttons">
                    <p>
                        <input id="btnsubmit" name="btnsubmit" tabindex="900" type="submit" value="Submit">
                    </p>
                </fieldset>
            </form>
        </section>
    </main>
<?php
include 'footer.php';
?>