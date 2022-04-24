<nav>
    <a class="<?php
    if($pathParts['filename'] == 'index') {
        print 'activePage';
    }
    ?>" href="index.php">Top QB</a>

    <a class="<?php
    if($pathParts['filename'] == 'detail') {
        print 'activePage';
    }
    ?>" href="detail.php">Top RB</a>

    <a class="<?php
    if($pathParts['filename'] == 'array') {
        print 'activePage';
    }
    ?>" href="array.php">Top WR</a>

    <a class="<?php
    if($pathParts['filename'] == 'form') {
        print 'activePage';
    }
    ?>" href="form.php">Survey</a>
</nav>