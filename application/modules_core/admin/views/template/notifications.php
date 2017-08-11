<li class="menu">
    <ul class="notif">
        <li class="header">
            <strong>Notifications</strong>
        </li>
    </ul>
</li>
<?php
foreach ($notifications as $q) {
    $notif_id = $this->misc->encode_id($q->id_notification);
    $id = $this->misc->encode_id($q->reference_id); //transaction id
    $url = admin_url($q->class_name . '/' . $q->link . '/' . $id);
    ?>
    <li class="menu">
        <ul class="notif">
            <li><a href="<?= $url; ?>" onclick="update_seen('<?= $notif_id; ?>')">
                    <?php
                    switch (strtolower($q->class_name)) {
                        case 'purchase_requisitions':
                            echo '<i class="icon16 icomoon-icon-file-5"></i>';
                            break;
                        case 'purchase_orders':
                            echo '<i class="icon16 icomoon-icon-file-6"></i>';
                            break;
                        case 'deliveries':
                            echo '<i class="icon16 icomoon-icon-cart-add"></i>';
                            break;
                        case 'releasing':
                            echo '<i class="icon16 icomoon-icon-cart-remove"></i>';
                            break;
                        case 'equipment_loan_rental':
                            echo '<i class="icon16 icomoon-icon-tools"></i>';
                            break;
                        case 'payment_requests':
                            echo '<i class="icon16 icomoon-icon-tag-5"></i>';
                            break;
                        default:
                            echo '<i class="icon16  icomoon-icon-libreoffice"></i>';
                            break;
                    }
                    ?>
                    <?= "($q->class_title) $q->status"; ?>
                </a>
            </li>
        </ul>
    </li>
    <?php
}
?>


