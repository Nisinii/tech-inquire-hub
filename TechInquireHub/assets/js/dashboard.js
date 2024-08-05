function submitSearch() {
    document.getElementById("searchForm").submit();
}

document.addEventListener('DOMContentLoaded', function () {
    var modeSwitch = document.querySelector('.mode-switch');

        modeSwitch.addEventListener('click', function () {
            document.documentElement.classList.toggle('dark');
            modeSwitch.classList.toggle('active');

            // Store the theme preference in localStorage
            var isDarkMode = document.documentElement.classList.contains('dark');
            localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');
        });

        // Retrieve the theme preference from localStorage
        var theme = localStorage.getItem('theme');
        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
            modeSwitch.classList.add('active');
        }


    var prevPageBtn = document.getElementById('prevPageBtn');
    var nextPageBtn = document.getElementById('nextPageBtn');
    var currentPageSpan = document.getElementById('currentPage');
    var totalPages = Math.ceil(document.querySelectorAll('.project-box-wrapper').length / 6);
    var currentPage = 1;

    // Function to update the visibility of project-boxes based on the current page
    function updateProjectBoxesVisibility() {
        var projectBoxWrappers = document.querySelectorAll('.project-box-wrapper');
        projectBoxWrappers.forEach(function (wrapper, index) {
            var displayStyle = index >= (currentPage - 1) * 6 && index < currentPage * 6 ? 'flex' : 'none';
            wrapper.style.display = displayStyle;
        });
        currentPageSpan.textContent = currentPage;
    }

    // Event listener for previous page button
    prevPageBtn.addEventListener('click', function () {
        if (currentPage > 1) {
            currentPage--;
            updateProjectBoxesVisibility();
        }
    });

    // Event listener for next page button
    nextPageBtn.addEventListener('click', function () {
        if (currentPage < totalPages) {
            currentPage++;
            updateProjectBoxesVisibility();
        }
    });

    // Initial visibility setup
    updateProjectBoxesVisibility();
});