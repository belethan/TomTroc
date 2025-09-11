<?php
?>
<div class="custom-bg text-dark">
    <div class="d-flex align-items-center justify-content-center min-vh-100 px-2">
        <div class="text-center">
            <h1 class="display-1 fw-bold"><?= $errorinfo->getcode() ?></h1>
            <p class="fs-2 fw-medium mt-4">Oops! la page est introuvable</p>
            <p class="mt-4 mb-5"><?= $errorinfo->getmessage()?></p>
        </div>
    </div>
</div>
