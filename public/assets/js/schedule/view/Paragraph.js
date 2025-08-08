export default {
    createParagraph(context, schedule) {
        const paragraph = document.createElement('p');
        paragraph.style.backgroundColor = schedule.color;
        paragraph.textContent = schedule.letter;
        paragraph.classList.add('table__grid-p');
        paragraph.setAttribute('title', schedule.description);
        context.appendChild(paragraph);
    },
    removeParagraphs(context, schedule) {
        if (parseInt(schedule.id) === 0) context.textContent = '';
    }
}
