<?php

foreach ($row as $q) {
    echo "<option value='" . $q->id_user . "'>" . $q->user_fname . ' ' . $q->user_lname . "</option>";
}
