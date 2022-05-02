<?php
include 'top.php';
?>
    <main>
        <h1>SQL</h1>
        <h2>Create Table</h2>
        <pre>
            CREATE TABLE tblQBtable (
                pmkQBtable INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                fldQuarterback VARCHAR(20),
                fldGame VARCHAR(20),
                fldPoints VARCHAR(20)
            )
        </pre>

        <h2>Insert Data</h2>
        <pre>
        INSERT INTO tblQBtable (fldQuarterback, fldGame, fldPoints) VALUES
        ('Michael Vick', '11/15/2010', '49.3'),
        ('Aaron Rodgers', '10/2/2011', '46.9'),
        ('Drew Brees', '9/5/2013', '46.3'),
        ('Peyton Manning', '9/5/2013', '46.3'),
        ('Nick Foles', '11/3/2013', '45.2')
        </pre>

        <h2>Select Records</h2>
        <pre>
        SELECT fldQuarterback, fldGame, fldPoints FROM tblQBtable
        </pre>

        <h2> Create table for form</h2>
        <pre>
        CREATE TABLE tblImportantPosition (
            pmkImportantPositionId INT NOT NULL AUTO_INCREMENT 
            PRIMARY KEY,
            fldImportantPosition varchar(15),
            fldReason text,
            fldFirstName varchar(40),
            fldLastName varchar(40),
            fldEmail varchar(50),
            fldDraft varchar(15),
            fldQuarterback tinyint(1),
            fldRunningBack tinyint(1),
            fldWideReceiver tinyint(1),
            fldOther tinyint(1)    
        )
        </pre>

        <h2>Insert record</h2>
        <pre>
            INSERT INTO tblImportantPosition
                (fldImportantPosition, fldReason, fldFirstName, fldLastName, fldEmail, 
                fldDraft, fldQuarterback, fldRunningBack, 
                fldWideReceiver, fldOther)
            VALUES
                ('Quarterback', 'This position is the most important position on the team.', 
                'Andrew', 'Hoffstein', 'andrew@thehoffsteins.com', 
                'Quarterback', '1', '0', '0', '0')
        </pre>
    </main>
<?php
include 'footer.php';
?>