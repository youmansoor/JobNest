<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const userNameBtn = document.getElementById('user-name-btn');
    const dropdown = document.getElementById('user-dropdown');

    if (userNameBtn) {
      userNameBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
      });

      document.addEventListener('click', function () {
        dropdown.style.display = 'none';
      });
    }
  });
</script>