<?php
/** @var CActiveDataProvider $posters */
/** @var CategoryPosters $currentCategory */
?>

<?php if ($currentCategory->is_affisha): ?>
    <div class="content active row">
        <div id="panelItems" data-columns>
            <?php $this->renderPartial(
                'partials/_affishesItems',
                [
                    'posters' => $posters,
                    'currentCategory' => $currentCategory
                ]
            ); ?>
        </div>
    </div>
<?php else: ?>
    <div class="content active row" class="kino-afisha">
        <div id="panelItems" class="row collapse">
            <?php $this->renderPartial(
                'partials/_otherItems',
                [
                    'posters' => $posters,
                    'currentCategory' => $currentCategory
                ]
            ); ?>
        </div>
    </div>
<?php endif; ?>

<script type="text/javascript">
        $(document).ready(function () {
    $("#panelItems").freetile({
        selector: '.item',
        containerResize: false
        });
    });
</script>