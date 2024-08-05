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

    // Add input event listener to update answer_content when the editor content changes
    const editor = document.getElementById('editor');
    editor.addEventListener('input', function () {
        const editorContent = editor.innerHTML;
        document.getElementById('answer_content').value = editorContent;
    });

    // Use the toggleFormatting function for all formatting buttons
    const formattingButtons = document.querySelectorAll('.toolbar button');
    formattingButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            toggleFormatting(button.dataset.command, null, event);
        });
    });

    function toggleFormatting(command, value = null, event) {
        event.stopPropagation();

        const editor = document.getElementById('editor');
        const selection = window.getSelection();
        const range = selection.getRangeAt(0);

        // Check if the user double-clicked on an already formatted element
        const parentNode = range.commonAncestorContainer.parentNode;
        const currentElement = parentNode.nodeName.toLowerCase();

        const modal = document.getElementById('myModal');

        if (currentElement === command) {
            // Remove the formatting
            const selectedText = range.extractContents();
            range.deleteContents();
            range.insertNode(selectedText);
        } else {
            // Apply or remove formatting
            switch (command) {
                case 'bold':
                case 'italic':
                    document.execCommand(command, false, value);
                    break;

                case 'code':
                    // Wrap the selected text in <code> tags
                    const codeElement = document.createElement('code');
                    codeElement.appendChild(range.extractContents());
                    range.deleteContents();
                    range.insertNode(codeElement);
                    break;

                case 'unorderedList':
                case 'orderedList':
                    // Wrap the selected text in <ul> or <ol> tags
                    const listElement = document.createElement(command === 'unorderedList' ? 'ul' : 'ol');
                    const listItemElement = document.createElement('li');
                    listItemElement.appendChild(range.extractContents());
                    listElement.appendChild(listItemElement);
                    range.deleteContents();
                    range.insertNode(listElement);
                    break;

                case 'removeFormatting':
                    // Remove specific formatting manually
                    const formattedElement = range.commonAncestorContainer;
                    if (formattedElement.nodeName.toLowerCase() === 'code' ||
                        formattedElement.nodeName.toLowerCase() === 'ul' ||
                        formattedElement.nodeName.toLowerCase() === 'ol') {
                        const selectedText = range.extractContents();
                        range.deleteContents();
                        range.insertNode(selectedText);
                    } else {
                        document.execCommand('removeFormat', false, null);
                    }
                    break;

                case 'header':
                    // Create a header using h2
                    const headerElement = document.createElement('h2');
                    headerElement.appendChild(range.extractContents());
                    range.deleteContents();
                    range.insertNode(headerElement);
                    break;

                case 'subHeader':
                    // Create a header using h2
                    const subHeaderElement = document.createElement('h3');
                    subHeaderElement.appendChild(range.extractContents());
                    range.deleteContents();
                    range.insertNode(subHeaderElement);
                    break;

                case 'blockquote':
                    // Create a blockquote
                    const blockquoteElement = document.createElement('blockquote');
                    blockquoteElement.appendChild(range.extractContents());
                    range.deleteContents();
                    range.insertNode(blockquoteElement);
                    break;

                default:
                    break;
            }
        }

        // Update the hidden input with the content after applying formatting
        const editorContent = editor.innerHTML;
        document.getElementById('answer_content').value = editorContent;
    }

});

document.getElementById('image').addEventListener('change', function () {
    const fileNameSpan = document.querySelector('.file-name');
    if (this.files.length > 0) {
        fileNameSpan.textContent = this.files[0].name;
    } else {
        fileNameSpan.textContent = 'No file chosen';
    }
});