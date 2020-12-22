
<a href="slider/" target="_blank">List</a>
<a href="slider/form" target="_blank">Add</a>
<a href="slider/form/1" target="_blank">Edit</a>
<a href="slider/delete/1" target="_blank">Delete</a>
<a href="slider/change-status-active/1" target="_blank">Status</a>

<?php
    $linkList = route('slider');
    $linkAdd = route('slider/form');
    $linkEdit = route('slider/form', ['id' => 1]);

    echo '<h3 style="color: red">' . $linkList . '</h3>';
    echo '<h3 style="color: red">' . $linkAdd . '</h3>';
    echo '<h3 style="color: red">' . $linkEdit . '</h3>';
