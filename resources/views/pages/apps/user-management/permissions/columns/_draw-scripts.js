// Add click event listener to delete buttons
document.querySelectorAll('[data-kt-action="delete_row"]').forEach(function (element) {
    element.addEventListener('click', function (e) {
        if (confirm('Are you sure you want to remove?')) {
            Livewire.emit('delete_permission', this.getAttribute('data-permission-id'));
        }
    });
});
