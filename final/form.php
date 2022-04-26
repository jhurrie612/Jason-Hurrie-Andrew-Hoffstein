<?php
include 'top.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
        
$importantPositions = array('Quarterback', 'Running Back', 'Wide Receiver', 'Other');

$dataIsGood = false;

$firstName = '';
$lastName = '';
$email = '';
$importantPosition = 'Quarterback';
$reason = '';
$draft = 'Quarterback';
$cooperKupp= false;
$jonathanTaylor= false;
$tomBrady = false;
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
                $firstName = getData('txtFirstName');
                $lastName = getData('txtLastName');
                $email = getData('txtEmail');
                $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                $importantPosition = getData('lstImportantPosition');
                $reason = getData('txtReason');
                $draft= getData('radDraft');
                $cooperKupp= (int) getData('chkCooperKupp');
                $jonathanTaylor= (int) getData('chkJonathanTaylor');
                $tomBrady = (int) getData('chkTomBrady');
                $other = (int) getData('chkOther');

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
                    print '<p class="mistake">There was an error with your submission, please choose a favorite position.</p>';
                    $dataIsGood = false;
                }
                
                
                if($reason == ''){
                    print '<p class="mistake">Please tell us why you chose this position.</p>';
                    $dataIsGood = false;
                } elseif(!verifyAlphaNum($reason)){
                    print '<p class="mistake">Your input contains invalid characters, please just use letters.</p>';
                    $dataIsGood = false;
                }
                
                if($draft != 'Quarterback' AND $draft != "Running Back" 
                AND $draft != "Wide Receiver") { 
                    print '<p class="mistake">Please tell us your thoughts on these positions.</p>';
                    $dataIsGood = false;
                }

                $totalChecked = 0;

                if($cooperKupp != 1) $cooperKupp = 0;
                $totalChecked += $cooperKupp;

                if($jonathanTaylor != 1) $jonathanTaylor = 0;
                $totalChecked += $jonathanTaylor;

                if($tomBrady != 1) $tomBrady = 0;
                $totalChecked += $tomBrady;

                if($other != 1) $other = 0;
                $totalChecked += $other;

                if($totalChecked == 0){
                    print '<p class="mistake">Please choose at least one checkbox.</p>';
                    $dataIsGood = false;
                }
                //save data
                if($dataIsGood){
                    try{
                        $sql = 'INSERT INTO tblImportantPosition
                        (fldFirstName, fldLastName, fldEmail, 
                        fldImportantPosition, fldReason, fldDraft, 
                        fldQuarterback, fldRunningBack, fldWideReceiver, fldOther)
                    VALUES
                        (?, ?, ?, ?, ?,?, ?, ?, ?, ?)';
                        $statement= $pdo->prepare($sql);
                        $data = array($firstName, $lastName, $email, $importantPosition, 
                        $reason, $draft, $cooperKupp, $jonathanTaylor, $tomBrady, $other);

                        if($statement->execute($data)){
                            print '<h2>Thank you</h2>';
                            print '<p>Record is succesfully saved!</p>';

                            $to = $email;
                            $from = 'Andrew and Jason <ahoffste@uvm.edu>';
                            $subject = 'Andrew and Jason Fantasy Football';

                            $mailMessage = '<p style="font: 12pt serif;">Thank you for filling out our survey.</p>';

                            $header = "MIME-Version: 1.0\r\n";
                            $header .= "Content-type: text/html; charset=utf-8\r\n";
                            $header .= "From: " . $from . "\r\n";

                            $mailSent = mail($to, $subject, $mailMessage, $header);

                            if ($mailSent) {
                                print "<p>A copy of your survey has been emailed to you for your records.</p>";
                                print $mailMessage;
                                }
                                
                        } else{
                            print '<p>Record is NOT succesfully saved!</p>';
                        }

                    } catch(PDOException $e){
                        print '<p>Could not insert the record, please contact Jason or Andrew.</p>';
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
                        <label class="required" for="txtFirstName">First Name:</label>
                        <input type="text" name="txtFirstName" id="txtFirstName" value="<?php print $firstName; ?>" required>
                    </p>
                    <p>
                        <label class="required" for="txtLastName">Last Name:</label>
                        <input type="text" name="txtLastName" id="txtLastName" value="<?php print $lastName; ?>" required>
                    </p>
                    <p>
                        <label class="required" for="txtEmail">Email Address:</label>
                        <input type="email" name="txtEmail" id="txtEmail" value="<?php print $email; ?>" required>
                    </p>
                </fieldset>
                <fieldset class="listbox">
                    <legend>Most Important Position</legend>
                    <p>
                        <select id="lstImportantPosition" name="lstImportantPosition" tabindex="120">
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
                        <label for="txtReason">Tell us why this is the most important fantasy football position?</label>
                        <textarea id="txtReason" name="txtReason" tabindex="200">
                        <?php print $reason;?></textarea>
                    </p>
                </fieldset>

                <fieldset class="radio">
                    <legend>Which of these positions would you draft first this season?</legend>
                    <p>
                        <input type="radio" id="radDraftQuarterback" name="radDraft" value="Quarterback" tabindex="410" 
                        required <?php 
                            if($draft == "Quarterback") print 'checked';?>>
                        <label for="radDraftQuarterback">Quarterback</label>
                    </p>

                    <p>
                        <input type="radio" id="radDraftRunningBack" name="radDraft" value="Running Back" tabindex="410" 
                        required <?php 
                            if($draft == "Running Back") print 'checked';?>>
                        <label for="radDraftRunningBack">Running Back</label>
                    </p>

                    <p>
                        <input type="radio" id="radDraftWideReceiver" name="radDraft" value="Wide Receiver" tabindex="410" 
                        required <?php 
                            if($draft == "Wide Receiver") print 'checked';?>>
                        <label for="radDraftWideReceiver">Wide Receiver</label>
                    </p>
                </fieldset>

                <fieldset class="checkbox">
                    <legend>Check all those that you believe have the chance to score the most fantasy football points this season.</legend>
                    <p>
                        <input id="chkCooperKupp" name="chkCooperKupp" tabindex="510" type="checkbox" value="1" <?php 
                            if($cooperKupp) print 'checked';?>>
                        <label for="chkCooperKupp">Cooper Kupp</label>
                    </p>

                    <p>
                        <input id="chkJonathanTaylor" name="chkJonathanTaylor" tabindex="510" type="checkbox" value="1" <?php 
                            if($jonathanTaylor) print 'checked';?>>
                        <label for="chkJonathanTaylor">Jonathan Taylor</label>
                    </p>

                    <p>
                        <input id="chkTomBrady" name="chkTomBrady" tabindex="510" type="checkbox" value="1" <?php 
                            if($tomBrady) print 'checked';?>>
                        <label for="chkTomBrady">Tom Brady</label>
                    </p>
                    <p>
                        <input id="chkOther" name="chkOther" tabindex="510" type="checkbox" value="1" <?php 
                            if($other) print 'checked';?>>
                        <label for="chkOther">Other</label>
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