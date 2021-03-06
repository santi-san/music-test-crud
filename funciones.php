<?php

function getHtmlAlert($alertText, $alertClass) {
    return <<< HTML_ALERT
        <div class="alert $alertClass alert-dismissible" role="alert">
            <div class="alert-message">
                                  $alertText					
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
HTML_ALERT;
}