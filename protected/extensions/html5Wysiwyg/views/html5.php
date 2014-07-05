<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('<?php echo $identifier ?>').wysihtml5({
        <?php if ($locale != null): ?>
            "locale":'<?php echo $locale ?>',
        <?php endif; ?>
            "name":'<?php echo $name ?>',
            "font-styles":<?php echo $this->boolToString($buttons['font-styles'])?>,
            "emphasis":<?php echo $this->boolToString($buttons['emphasis'])?>,
            "lists":<?php echo $this->boolToString($buttons['lists'])?>,
            "html":<?php echo $this->boolToString($buttons['html'])?>,
            "link":<?php echo $this->boolToString($buttons['link'])?>,
            "image":<?php echo $this->boolToString($buttons['image'])?>,
            "color":<?php echo $this->boolToString($buttons['color'])?>,
            "stylesheets": <?php echo $this->boolToString($buttons['color'])?>
        });
    });
</script>