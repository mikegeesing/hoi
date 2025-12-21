<script type="text/javascript">
    // Add placeholder for search domain input
    function addPlaceholderForSearchDomainInput() {
        jQuery(
            '.panel[menuitemname="Register a New Domain"] .input-group .form-control'
        ).attr("placeholder", "{$LANG.findyourdomain}"); // Place the variable directly here
    }

    // Fire function on content load dom
    document.addEventListener("DOMContentLoaded", function () {
        addPlaceholderForSearchDomainInput();
    });
</script>
