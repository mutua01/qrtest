<!-- Your page content here -->
</main>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>

        
        var sidebar = document.getElementById('sidebarMenu');
        var navbarToggler = document.querySelector('.navbar-toggler');

        navbarToggler.addEventListener('click', function() {
            if (sidebar.classList.contains('collapse')) {
                sidebar.classList.remove('collapse');
            } else {
                sidebar.classList.add('collapse');
            }
        });


        $(document).ready(function(){
    // Function to load data and paginate
    function loadData(page){
        $.ajax({
            url: 'fetch_units.php',
            type: 'post',
            data: {page: page},
            success: function(response){
                $("#unitTable tbody").html(response);
            }
        });
    }

    // Load initial data on page load
    loadData(1);

    // Handle pagination click event
    $(document).on("click", ".pagination li a", function(e){
        e.preventDefault();
        var page = $(this).data("page");
        loadData(page);
    });
});



document.getElementById('unit').addEventListener('input', function() {
    var input = this.value.trim(); // Trim whitespace
    var resultsContainer = document.getElementById('unitResults');

    // Clear previous results
    resultsContainer.innerHTML = '';

    if (input.length === 0) {
        // If input is empty, do nothing
        return;
    }

    // Fetch matching units using AJAX
    fetch('search_units.php?input=' + input)
        .then(response => response.json())
        .then(data => {
            if (data.length === 0) {
                // If no matches found, display message
                resultsContainer.textContent = 'No matches found';
            } else {
                // Display matching units
                data.forEach(unit => {
                    var option = document.createElement('div');
                    option.textContent = unit.name;
                    option.classList.add('unitOption');
                    option.dataset.unitId = unit.id; // Set unit ID as dataset
                    resultsContainer.appendChild(option);
                });

                // Add click event listener to each result
                resultsContainer.querySelectorAll('.unitOption').forEach(option => {
                    option.addEventListener('click', function() {
                        document.getElementById('unit').value = this.textContent;
                        document.getElementById('unitId').value = this.dataset.unitId; // Set unit ID in hidden input field
                        resultsContainer.innerHTML = ''; // Clear results
                    });
                });
            }
        })
        .catch(error => console.error('Error searching units:', error));
});



    </script>
</body>
</html>