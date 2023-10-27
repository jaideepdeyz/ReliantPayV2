<script>
    window.addEventListener('message', event => {
        $.toast({
            heading: 'event.detail[0].heading',
            text: 'event.detail[0].heading',
            showHideTransition: 'slide',
            icon: 'event.detail[0].heading',
            position: 'top-right'
        })
    });
</script>
