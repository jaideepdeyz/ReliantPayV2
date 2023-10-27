<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('message', (event) => {
            $.toast({
                heading: event.heading,
                text: event.text,
                showHideTransition: 'slide',
                icon: event.heading,
                position: 'top-right'
            });
        });
    });
</script>
