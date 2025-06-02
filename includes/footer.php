<!-- includes/footer.php, right before </body> -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const MAX_LENGTH = 200; // characters before truncation

    document.querySelectorAll('.entry').forEach(entry => {
        const fullText = entry.innerHTML; 
        // Create a temporary element to extract plain text length
        const tmpDiv = document.createElement('div');
        tmpDiv.innerHTML = fullText;
        const plainText = tmpDiv.textContent || tmpDiv.innerText || "";

        if (plainText.length > MAX_LENGTH) {
        // Truncate plain text, then re‐insert as HTML up to that length
            const truncated = plainText.slice(0, MAX_LENGTH) + '… ';
            // Create a <span> to hold the overflowing content
            const moreSpan = document.createElement('span');
            moreSpan.style.display = 'none';
            // The remainder (full HTML) will go inside moreSpan
            moreSpan.innerHTML = fullText;

            // Overwrite entry’s innerHTML with the truncated text + “Read more” link
            entry.innerHTML = '';
            const truncatedNode = document.createTextNode(truncated);
            entry.appendChild(truncatedNode);

            // “Read more” link
            const readMoreLink = document.createElement('a');
            readMoreLink.href = 'javascript:void(0)';
            readMoreLink.innerText = 'Read more';
            readMoreLink.style.color = 'var(--accent-color)';
            readMoreLink.style.cursor = 'pointer';

            entry.appendChild(readMoreLink);
            entry.appendChild(moreSpan);

        
            readMoreLink.addEventListener('click', () => {
                const isExpanded = moreSpan.style.display === 'inline';
                if (isExpanded) {
                // Collapse
                entry.innerHTML = '';
                entry.appendChild(document.createTextNode(truncated));
                entry.appendChild(readMoreLink);
                entry.appendChild(moreSpan);
                moreSpan.style.display = 'none';
                readMoreLink.innerText = 'Read more';
                } else {
                // Expand
                entry.innerHTML = '';
                entry.appendChild(moreSpan);
                moreSpan.style.display = 'inline';
                entry.appendChild(readMoreLink);
                readMoreLink.innerText = 'Show less';
                }
            });
        }
    });
});
</script>


</body>
</html>
